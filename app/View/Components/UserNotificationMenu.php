<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class UserNotificationMenu extends Component
{
    public $notifications;
    public $unreadCount;
    /**
     * Create a new component instance.
     */
    public function __construct($count = 10)
    {
        $user  = Auth::user();
        if (!$user) {
            $this->notifications = [];
            return;
        }
        $this->notifications = $user->notifications()
            ->take($count)
            ->get();  //limit(5)


        $this->unreadCount = $user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-notification-menu');
    }
}
