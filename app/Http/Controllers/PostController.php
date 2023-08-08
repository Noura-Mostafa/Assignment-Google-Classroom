<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request , Classroom $classroom)
    {
        $request->validate([
            'content' => 'required|string',
            'id' => 'required|int',
            'type' => 'required|in:classwork,post',
        ]);

        Auth::user()->comments()->create([
            'commentable_id' => $request->input('id'), 
            'commentable_type' => $request->input('type'), 
            'content' => $request->input('content'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $request->merge([
            'user_id' => Auth::id(),
            'classroom_id' => $request->input('id'),
        ]);

        $posts = $classroom->posts()->create($request->all());

        return redirect()->route('classrooms.show' , $classroom->id)
            ->with([
               'posts' => $posts,
               'classroom' => $classroom 
            ]);


    }
}
