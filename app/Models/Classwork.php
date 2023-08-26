<?php

namespace App\Models;

use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;
use App\Models\Classroom;
use App\Models\Submission;
use App\Enums\ClassworkType;
use App\Models\ClassworkUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classwork extends Model
{
    use HasFactory;

    const TYPE_ASSIGNMENT = ClassworkType::ASSIGNMENT->value;
    const TYPE_MATERIAL = ClassworkType::MATERIAL->value;
    const TYPE_QUESTION = ClassworkType::QUESTION->value;

    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';


    protected $fillable = [
        'classroom_id' , 'user_id' , 'topic_id' , 'title' , 'description' ,
        'type' , 'status' , 'published_at' , 'options' ,
    ];

    protected $casts = [
        'options' => 'json',
        'classroom_id' => 'integer',
        'published_at' => 'datetime:Y-m-d',
        'type' => ClassworkType::class,
    ];

    public function getPublishedDateAttribute()
    {
        if ($this->published_at) {
            return $this->published_at->format('Y-m-d');
        }
    }

    protected static function booted()
    {
        static::creating(function(Classwork $classwork){
            if($classwork->published_at == null){
                $classwork->published_at= now();
            }
        });
    }


    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class , 'classroom_id' , 'id');
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class , 'topic_id' , 'id');
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,'classwork_user')
            ->withPivot(['grade' , 'submitted_at' , 'status' , 'created_at'])
            ->using(ClassworkUser::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable')->latest();
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['search'] ?? '' , function ($builder , $value) {
            $builder->where('title' ,'LIKE' , "%{$value}%");
        });
    }

    
}
