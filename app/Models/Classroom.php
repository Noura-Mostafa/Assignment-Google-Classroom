<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Scopes\UserClassroomScope;
use App\Observers\ClassroomObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
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

    protected static function booted()
    {

        static::observe(ClassroomObserver::class);
        
        // static::creating(function (Classroom $classroom) {
        //     $classroom->code = Str::random(8);
        //     $classroom->user_id = Auth::id();
        // });

        // static::forceDeleted(function (Classroom $classroom) {
        //     static::deleteCoverImage($classroom->cover_image_path);
        // });

        // static::deleted(function (Classroom $classroom) {
        //     $classroom->status = 'deleted';
        //     $classroom->save();
        // });

        // static::restored(function (Classroom $classroom) {
        //     $classroom->status = 'active';
        //     $classroom->save();
        // });


        static::addGlobalScope(new UserClassroomScope);
    }

    public function join($user_id, $role = 'student')
    {
        return  DB::table('classroom_user')
            ->insert(
                [
                    'classroom_id' => $this->id,
                    'user_id' => $user_id,
                    'role' => $role,
                    'created_at' => now(),
                ]
            );
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
