<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View as BaseView;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;
use PhpParser\Node\Stmt\Class_;

class TopicsController extends Controller
{
    //Actions
    public function index(): Renderable
    {
        $topics = Topic::get();

        return view('topic.index', compact('topics'));
    }

    public function create(Request $request)
    {
        $classroom = Classroom::all();

        return view()->make('topic.create', [
            'name' => 'Topic'
        ] , compact('classroom'));
    }

    public function store(Request $request):RedirectResponse
    {
        $classroom = Classroom::all();
        
        $topic = new Topic();
        $topic->name = $request->post('name');
        $topic->classroom_id = $request->input('classroom_id');
        $topic->user_id = $request->input('user_id');

        $topic->save();//insert

        return redirect()->route('topics.index');

    }


    public function show(int $id): BaseView
    {
        $classroom = Classroom::all();

        $topic = Topic::findOrFail($id);

        return View::make('topic.show' , compact('classroom'))
            ->with([
                'id' => $id,
                'topic' => $topic,
            ]);
    }

    public function edit(int $id)
    {
        $topic = Topic::find($id);
        if (!$topic) {
            abort(404);
        }

        $classroom = Classroom::all();

        return view()->make('topic.edit', compact('topic' , 'classroom'))->with([
                'id' => $id,
                'topic' => $topic,
            ]);
    }



    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);

        $topic->name = $request->post('name');
        $topic->classroom_id = $request->input('classroom_id');
        $topic->user_id = $request->input('user_id');
        $topic->save();

        //Mass assignment
        $topic->update($request->all());

        return Redirect::route('topics.index');
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return Redirect::route('topics.index');
    }
}
