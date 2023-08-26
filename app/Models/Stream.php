<?php

namespace App\Models;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stream extends Model
{
    use HasFactory , HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id', 'content' , 'classroom_id' , 'link' //'id',
    ];

    public function getUpdatedAtColumn()
    {
        
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
       return $this->belongsTo(Classroom::class);
    }
}
