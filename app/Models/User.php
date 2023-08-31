<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\Submission;
use App\Models\ClassworkUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail , HasLocalePreference
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value)
        );
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class)->withPivot(['role', 'created_at']);
    }

    public function createdClassrooms()
    {
        return $this->hasMany(Classroom::class, 'user_id');
    }
    
    public function classworks()
    {
        return $this->belongsToMany(Classwork::class)->withPivot(['grade' , 'status' , 'submitted_at' , 'created_at'])
               ->using(ClassworkUser::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id')
            ->withDefault();
    }
    
    public function routeNotificationForEmail($notification = null)
    {
        return $this->email;
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'Notifications.' . $this->id;
    }

    public function preferredLocale()
    {
        return $this->profile->locale;
    }
}
