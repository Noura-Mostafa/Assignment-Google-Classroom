<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View as BaseView;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;
use PhpParser\Node\Stmt\Class_;

class ClassroomController extends Controller
{
    //Actions
    public function index(Request $request): Renderable
    {
        $classrooms = Classroom::orderBy('created_at', 'DESC')->get(); //collection object

        return view('classroom.index', compact('classrooms'));
    }

    public function create(): Renderable
    {
        return view()->make('classroom.create', [
            'name' => 'Classroom'
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        //Method 1
        // $classroom = new Classroom();
        // $classroom->name = $request->post('name');
        // $classroom->section = $request->post('section');
        // $classroom->subject = $request->post('subject');
        // $classroom->room = $request->post('room');
        // $classroom->code = Str::random(8);
        // $classroom->cover_image_path = $request->post('cover_image');
        // $classroom->save();//insert


        //Method2 : mass assignment
        // $data = $request->all();
        // $data['code'] = Str::random(8);

        $request->merge([
            'code' => Str::random(8),
        ]);

        $classroom = Classroom::create($request->all());

        // $classroom->save();
        // $classroom = new Classroom();
        // $classroom->fill($request->all())->save();
        // $classroom->forcefill($request->all())->save();

        //PRG post redirect get
        return redirect()->route('classrooms.index');
    }


    public function show(int $id)
    {
        // $Classroom =Classroom::where('id' , '=' , $id)->first();
        $classroom = Classroom::findOrFail($id);
        $topic =Topic::all();
        return View::make('classroom.show')
            ->with([
                'id' => $id,
                'classroom' => $classroom,
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



    public function update(Request $request, $id)
    {
        $classroom = Classroom::findOrFail($id);

        $classroom->name = $request->post('name');
        $classroom->section = $request->post('section');
        $classroom->subject = $request->post('subject');
        $classroom->room = $request->post('room');
        $classroom->save(); //insert

        //Mass assignment
        $classroom->update($request->all());

        return Redirect::route('classrooms.index');
    }

    public function destroy($id)
    {
        // $count = Classroom::destroy($id);
        // Classroom::where('id' , '=' , $id)->delete();

        $classroom = Classroom::find($id);
        $classroom->delete();
        return Redirect::route('classrooms.index');
    }
}
