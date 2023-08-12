<?php

namespace App\Models;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Observers\ClassroomObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Scopes\UserClassroomScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    public static string $disk = 'uploads';

    protected $fillable = [
        'name', 'section', 'subject', 'room', 'theme', 'cover_image_path', 'code', 'user_id'
    ];


    public function getRouteKeyName()
    {
        return 'id';
    }

    public static function uploadCoverImage($file)
    {
        $path = $file->store('/covers', [
            'disk' => static::$disk,
        ]);

        return $path;
    }

    public static function deleteCoverImage($path)
    {
        if (!$path || !Storage::disk(Classroom::$disk)->exists($path)) {
            return;
        }
        return Storage::disk(Classroom::$disk)->delete($path);
    }

    //local scope
    public function scopeActive(Builder $query)
    {
        $query->where('status', '=', 'active');
    }

    public function scopeRecent(Builder $query)
    {
        $query->orderBy('updated_at', 'DESC');
    }

    public function scopeStatus(Builder $query, $status = 'active')
    {
        $query->where('status', '=', $status);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['search'] ?? '' , function ($builder , $value) {
            $builder->where('name' ,'LIKE' , "%{$value}%")
            ->orwhere('section' ,'LIKE' , "%{$value}%")
            ->orwhere('room' ,'LIKE' , "%{$value}%");
        });
    }

    protected static function booted()
    {

        static::observe(ClassroomObserver::class);

        static::addGlobalScope(new UserClassroomScope);
    }

    //Relations

    public function classworks(): HasMany
    {
        return $this->hasMany(Classwork::class , 'classroom_id' , 'id');
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class , 'classroom_id' , 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['role' , 'created_at']);
    }

    public function teachers()
    {
        return $this->users()->wherePivot('role' , 'teacher');
    }

    public function students()
    {
        return $this->users()->wherePivot('role' , 'student');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    

    public function join($user_id, $role = 'student')
    {

        $exists = $this->users()
        ->wherePivot('user_id', $user_id)
        ->exists(); 

        if ($exists) {
            throw new Exception('User already joined the class');
        }

        return $this->users()->attach($user_id , [
            'role'=> $role,
            'created_at' =>now()
        ]);

    }

    //Accessor
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image_path) {
            return asset('uploads/' . $this->cover_image_path);
        }
        return "https://placehold.co/444x110";
    }

    public function getUrlAttribute()
    {
        return route('classrooms.show', $this->id);
    }
}
