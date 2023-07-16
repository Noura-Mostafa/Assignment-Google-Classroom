<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View as BaseView;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;

class TopicsController extends Controller
{
    //Actions
    public function index(): Renderable
    {
        $topic = Topic::all();

        return view('topic.index', compact('topic'));
    }

    public function create()
    {
        $classroom = Classroom::all();

        return view()->make('topic.create', [
            'name' => 'Topic',
            'classroom' => $classroom
        ]);
    }

    public function store(TopicRequest $request): RedirectResponse
    {
        
        $classroom = Classroom::all();

        $validated = $request->validated();
        
        $topic = new Topic();
        $topic->name = $request->post('name');
        $topic->classroom_id = $request->input('classroom_id');
        $topic->user_id = $request->input('user_id');

        $topic->save($validated);//insert

        return redirect()->route('topics.index' , compact('classroom'));
    }


    public function show(int $id): BaseView
    {
        $classroom = Classroom::all();

        $topic = Topic::findOrFail($id);

        return View::make('topic.show', compact('classroom', 'id', 'topic'));
    }

    public function edit(int $id)
    {
        $topic = Topic::find($id);
        if (!$topic) {
            abort(404);
        }

        $classroom = Classroom::all();

        return view()->make('topic.edit', compact('topic', 'classroom', 'id'));
    }



    public function update(TopicRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $validated = $request->validated();

        $topic->name = $request->post('name');
        $topic->classroom_id = $request->input('classroom_id');
        $topic->user_id = $request->input('user_id');
        $topic->save($validated);

        return Redirect::route('topics.index');
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return Redirect::route('topics.index');
    }
}
