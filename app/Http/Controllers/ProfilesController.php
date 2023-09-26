<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProfilesController extends Controller
{

    public function show(Profile $profile)
    {
        $profile = Auth::user()->profile;
        return view('profiles.show' , [
            'profile' => $profile
        ]);
    }
    
    
    public function create(User $user , Profile $profile): View
    {
        return view('profiles.create' , [
            'profile' => $profile ,
            'user' => $user
        ]);
    }

    
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string'],
            'user_id' => ['int', 'exists:users,id'],
            'locale' => ['nullable'],
            'timezone' => ['nullable'],
        ]);

        Auth::user()->profile()->create($request->all());
        

        return Redirect::route('classrooms.index');
    }


    public function edit(Profile $profile): View
    {
        return view('profiles.edit' , compact('profile'));
    }

    
    public function update(Request $request , Profile $profile): RedirectResponse
    {

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string'],
            'user_id' => ['int', 'exists:users,id'],
            'timezone' => ['nullable'],
        ]);

        $profile->update($request->all());
        

        return Redirect::route('profile.show' , $profile->id);
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return Redirect::route('classrooms.index');

    }
}
