<?php

namespace App\Notifications\Channels;

use App\Services\HadaraSms;
use Illuminate\Support\Facades\Http;
use Illuminate\Notifications\Notification;

class HadaraSmsChannel
{
    public function send($notifiable , Notification $notification): void
    {
        $service = new HadaraSms(config('services.hadara.key'));

        $service->send(
            $notifiable->routeNotificationForHadara($notification),
            $notification->toHadara($notifiable),
        );
    }
}