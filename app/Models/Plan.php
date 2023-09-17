<?php

namespace App\Models;

use App\Concerns\HasPrice;
use App\Models\User;
use App\Models\Feature;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory , HasPrice;

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'plan_feature')
               ->withPivot(['feature_value']);
    }
    
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class , 'subscriptions');
    }

}
