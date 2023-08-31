<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewClassworkNotification;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->get();

        return view('notifications.index' , compact('notifications'));
    }
}
