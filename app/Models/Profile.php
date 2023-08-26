<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'first_name' , 'last_name' , 'gender' , 'country', 'birthday' , 'locale' , 'timezone'
    ];
    protected $casts = [
        'birthday' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
