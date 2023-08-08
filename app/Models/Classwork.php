<?php

namespace App\Models;

use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;
use App\Models\ClassworkUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classwork extends Model
{
    use HasFactory;

    const TYPE_ASSIGNMENT = 'assignment';
    const TYPE_MATERIAL = 'material';
    const TYPE_QUESTION = 'question';

    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';


    protected $fillable = [
        'classroom_id' , 'user_id' , 'topic_id' , 'title' , 'description' ,
        'type' , 'status' , 'published_at' , 'options' ,
    ];

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
        return $this->belongsToMany(User::class)->withPivot(['grade' , 'status' , 'submitted_at' , 'created_at'])
               ->using(ClassworkUser::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable')->latest();
    }
}
