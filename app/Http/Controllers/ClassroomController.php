<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View as BaseView;
use App\Http\Requests\ClassroomRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;

class ClassroomController extends Controller
{
    //Actions
    public function index(Request $request): Renderable
    {
        $success = session('success');
        $classrooms = Classroom::orderBy('created_at', 'DESC')->get();

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

        $request->merge([
            'code' => Str::random(8),
        ]);

        $validated = $request->validated();
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');  //$request->cover_image //return obj uploadedFile
            $path = Classroom::uploadCoverImage($file);
            $request->merge([
                'cover_image_path' => $path,
            ]);
        }
        $validated['code'] = Str::random(8);
        $classroom = Classroom::create($validated);

        //PRG post redirect get
        return redirect()->route('classrooms.index')->with('success', 'Classroom created');
    }


    public function show(int $id)
    {
        $classroom = Classroom::findOrFail($id);
        $topics = Topic::where('classroom_id', '=', $id)->get();
        return View::make('classroom.show')
            ->with([
                'id' => $id,
                'classroom' => $classroom,
                'topics' => $topics,
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

        $path = $classroom->cover_image_path;
        $classroom->deleteCoverImage($path);

        $classroom->delete();

        return Redirect::route('classrooms.index')->with('success', 'Classroom deleted');
    }
}
