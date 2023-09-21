<?php

namespace App\Models;

use App\Models\DeviceToken;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends User
{
    use HasFactory , HasApiTokens , Notifiable , TwoFactorAuthenticatable;

    public function devices()
    {
        return $this->morphMany(DeviceToken::class , 'tokenable') ;
    }
}
