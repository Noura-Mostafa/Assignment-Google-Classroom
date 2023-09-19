<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\MessageSent;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;

class ClassroomMessagesController extends Controller
{
   
    public function index(Classroom $classroom)
    {
        return $classroom->messages()
            ->select([
                'messages.id',
                'messages.sender_id',
                'messages.recipient_id',
                'messages.recipient_type',
                'messages.body',
                'messages.created_at as sent_at'
            ])
            ->with('sender:id,name')
            ->latest()
            ->paginate(30);
    }


    public function store(Request $request, Classroom $classroom)
    {
        $request->validate([
            'body' => ['required' , 'string'],
        ]);

        $message =$classroom->messages()->create([
            'sender_id' => $request->user()->id,
            'body' => $request->post('body'),
        ]);

        // event(new MessageSent($message));
        MessageSent::broadcast($message)->toOthers();

        return $message;
    }

 
    public function show(Classroom $classroom , Message $message)
    {
        return $message;
    }


    public function update(Request $request,Classroom $classroom , Message $message)
    {
        $request->validate([
            'body' => ['required' , 'string'],
        ]);

        $message->update([
            'body' => $request->post('body')
        ]);

        return $message;
    }

    public function destroy(Classroom $classroom , Message $message)
    {
        $message->delete();

        return [];
    }
}
