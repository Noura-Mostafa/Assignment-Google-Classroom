<?php

namespace App\Actions;

use App\Models\Subscription;

class CreateSubscription
{
    /**
     * @param $data array
     * @return 
     */
    public function create(array $data): Subscription
    {
        return Subscription::forceCreate($data);
    }
}