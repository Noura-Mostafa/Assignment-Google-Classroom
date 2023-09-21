<?php

namespace App\Notifications;

use App\Models\Classwork;
use Illuminate\Bus\Queueable;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Channels\HadaraSmsChannel;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use Illuminate\Notifications\Messages\VonageMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use Illuminate\Notifications\Messages\DatabaseMessage;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;
use Illuminate\Notifications\Messages\BroadcastMessage;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;

class NewClassworkNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected Classwork $classwork)
    {
        // $this->onQueue('notifications');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $via = ['database',
        //FcmChannel::class
         //'mail',
         //'broadcast' ,
         // 'vonage',
         //HadaraSmsChannel::class
        ];
        return $via;
    }

    public function toFcm($notifiable)
    {
        $content = __(':name posted a new :type :title', [
            'name' => $this->classwork->user->name,
            'type' => __($this->classwork->type->value),
            'title' => $this->classwork->title,
        ]);

        return FcmMessage::create()
            ->setData([
                'classwork_id' => "{$this->classwork->id}",
                'user_id' => "{$this->classwork->user_id}",
            ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('New Classwork')
                ->setBody($content)
                ->setImage('http://example.com/url-to-image-here.png'))
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
    }

    public function toMail(object $notifiable): MailMessage
    {
        $classwork = $this->classwork;
        $content = __(':name posted a new :type :title', [
            'name' => $classwork->user->name,
            'type' => __($classwork->type->value),
            'title' => $classwork->title,
        ]);
 
        return (new MailMessage)
            ->subject(__('New :type', ['type' => $this->classwork->type->value]))
            ->greeting(__('Hi :name', ['name' => $notifiable->name]))
            ->line($content)
            ->action(__('Go to classwork'), route('classrooms.classworks.show', [$classwork->classroom_id, $classwork->id]))
            ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable): DatabaseMessage  //|array
    {
        return new DatabaseMessage($this->createMessage());
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->createMessage());
    }

    public function toHadara(object $notifiable):string
    {
        return __('A new Classwork created');
    }

    public function toVonage(object $notifiable): VonageMessage
    {
        return (new VonageMessage)
            ->content(__('A new Classwork created'));
    }

    protected function createMessage(): array
    {
        
        $classwork = $this->classwork;
        $content = __(':name posted a new :type :title', [
            'name' => $classwork->user->name,
            'type' => __($classwork->type->value),
            'title' => $classwork->title,
        ]);

        return [
            'title' => __('New :type', [
                'type' => $this->classwork->type->value
            ]),
            'body' => $content,
            'image' => '',
            'link' => route('classrooms.classworks.show', [$classwork->classroom_id, $classwork->id]),
            'classwork_id' => $classwork->id,
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
