<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Classwork;
use App\Events\ClassworkCreated;
use App\Jobs\SendClassroomNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewClassworkNotification;

class SendNotificationToAssignedStudents
{

    public function __construct(public Classwork $classwork)
    {
    }

    public function handle(ClassworkCreated $event): void
    {
        $classwork = $event->classwork;

        $job = new SendClassroomNotification($classwork->users, new NewClassworkNotification($classwork));

        $job->onQueue('y');

        dispatch($job)->onQueue('default');
    }
}
