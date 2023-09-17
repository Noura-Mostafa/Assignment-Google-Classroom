<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthenticationController extends Controller
{
    public function create()
    {
        return view('admin.2fa' ,  [
            'user' =>  Auth::guard('admin')->user(),
        ]);
    }
}
