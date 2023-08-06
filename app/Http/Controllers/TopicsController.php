<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View as BaseView;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;

class TopicsController extends Controller
{
    public function index(): Renderable
    {
        $topic = Topic::all();

        return view('topic.index', compact('topic'));
    }

    public function create(Classroom $classroom)
    {
        return view()->make('topic.create', [
            'topic' => new Topic(),
            'classroom' => $classroom,
        ]);
    }

    public function store(TopicRequest $request, Classroom $classroom): RedirectResponse
    {

        $validated = $request->validated();

        $validated['classroom_id'] = $classroom->id;
        $validated['user_id'] = Auth::id();

        $topic = Topic::create($validated);

        return redirect()->route('classrooms.classworks.index', $classroom->id);
    }


    public function show(int $id, Classroom $classroom): BaseView
    {
        $topic = Topic::findOrFail($id);

        return View::make('topic.show', compact('classroom', 'topic'));
    }

    public function edit(int $id, Classroom $classroom)
    {
        $topic = Topic::find($id);
        if (!$topic) {
            abort(404);
        }

        return view()->make('topic.edit', compact('topic', 'classroom'));
    }



    public function update(TopicRequest $request, $id, Classroom $classroom)
    {
        $topic = Topic::findOrFail($id);

        $validated = $request->validated();

        $validated['classroom_id'] = $classroom->id;
        $validated['user_id'] = Auth::id();

        $topic->update($validated);

        return redirect()->route('topics.index', compact('topic', 'classroom'));
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return Redirect::back();
    }

    public function trashed()
    {
        $topics = Topic::onlyTrashed()
            ->latest('deleted_at')->get();

        return view('topic.trashed', compact('topics'));
    }

    public function restore($id)
    {
        $topic = Topic::onlyTrashed()->findOrFail($id);
        $topic->restore();

        return Redirect::route('topics.index')
            ->with('success', "Topic ({$topic->name}) restored");
    }

    public function forceDelete($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);
        $topic->forceDelete();

        return Redirect::route('topics.index')
            ->with('success', "Topic ({$topic->name}) trashed");
    }
}
