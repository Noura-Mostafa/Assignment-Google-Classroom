<?php

namespace App\Models;

use App\Models\Topic;
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
}
