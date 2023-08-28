<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Classwork;
use App\Events\ClassworkCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewClassworkNotification;
use Illuminate\Support\Facades\Notification;

class SendNotificationToAssignedStudents
{
    
    public function __construct(public Classwork $classwork)
    {
   
    }

    public function handle(ClassworkCreated $event): void
    {
        Notification::send($event->classwork->users , new NewClassworkNotification($event->classwork));
    }
}
