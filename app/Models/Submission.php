<?php

namespace App\Models;

use App\Models\Classwork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'classwork_id' , 'content' , 'type'
    ];

    public function classwork()
    {
        return $this->belongsTo(Classwork::class);
    }
}
