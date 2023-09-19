<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Stream;
use App\Models\Profile;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View as BaseView;
use App\Http\Requests\ClassroomRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;

class ClassroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('subscribed')->only('create' , 'store');
    }


    public function index(Request $request): Renderable
    {
        $this->authorize('view-any' , Classroom::class);

        $success = session('success');

        $classrooms = Classroom::active()
            ->status('active')
            ->recent()
            ->orderBy('created_at', 'DESC')
            ->filter($request->query())
            ->simplePaginate(4);

        return view('classroom.index', compact('classrooms', 'success'));
    }

    public function create(): Renderable
    {
        return view()->make('classroom.create', [
            'name' => 'Classroom',
            'classroom' => new Classroom(),

        ]);
    }

    public function store(ClassroomRequest $request): RedirectResponse
    {

        $validated = $request->validated();
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $path = Classroom::uploadCoverImage($file);
            $validated['cover_image_path'] = $path;
        }

        DB::beginTransaction();

        try {
            $classroom = Classroom::create($validated);

            $classroom->join(Auth::id(), 'teacher');

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }

        return redirect()->route('classrooms.index', compact('classroom'))->with('success', 'Classroom created');
    }


    public function show(int $id , Stream $stream)
    {

        $stream = Stream::get();
        $classroom = Classroom::findOrFail($id);
        $topics = Topic::where('classroom_id', '=', $id)->get();

        $invitation_link = URL::signedRoute('classrooms.join', [
            'classroom' => $classroom->id,
            'code' => $classroom->code,
        ]);

        return View::make('classroom.show')
            ->with([
                'id' => $id,
                'classroom' => $classroom,
                'topics' => $topics,
                'invitation_link' => $invitation_link,
                'stream' => $stream,
            ]);
    }

    public function edit($id): BaseView
    {
        $classroom = Classroom::find($id);
        if (!$classroom) {
            abort(404);
        }
        return view()->make('classroom.edit')->with([
            'id' => $id,
            'classroom' => $classroom,
        ]);
    }


    public function update(ClassroomRequest $request, $id)
    {
        $classroom = Classroom::findOrFail($id);
        $validated = $request->validated();

        $classroom->name = $request->post('name');
        $classroom->section = $request->post('section');
        $classroom->subject = $request->post('subject');
        $classroom->room = $request->post('room');

        if ($request->hasFile('cover_image')) {
            $oldImagePath = $classroom->cover_image_path;
            if ($oldImagePath) {
                $classroom->deleteCoverImage($oldImagePath);
            }

            // Upload the new image
            $file = $request->file('cover_image');
            $path = $classroom->uploadCoverImage($file);
            $classroom->cover_image_path = $path;
        }

        $classroom->save($validated);

        Session::flash('success', 'Classroom updated!');
        return Redirect::route('classrooms.index');
    }

    public function destroy($id)
    {
        $classroom = Classroom::find($id);
        $classroom->delete();

        return Redirect::route('classrooms.index')->with('success', 'Classroom has been trashed');
    }

    public function trashed()
    {
        $classrooms = Classroom::onlyTrashed()
            ->latest('deleted_at')->get();

        return view('classroom.trashed', compact('classrooms'));
    }

    public function restore($id)
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->restore();

        return Redirect::route('classrooms.trashed')
            ->with('success', "Classroom ({$classroom->name}) has been restored");
    }

    public function forceDelete($id)
    {
        $classroom = Classroom::withTrashed()->findOrFail($id);
        $classroom->forceDelete();

        // $path = $classroom->cover_image_path;
        // $classroom->deleteCoverImage($path);

        return Redirect::route('classrooms.trashed')
            ->with('success', "Classroom ({$classroom->name}) has been Deleted");
    }

    public function chat(Classroom $classroom)
    {
        return view('classroom.chat' , [
            'classroom' => $classroom,
        ]);
    }
}
