<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ClassworkController extends Controller
{
    protected function getType(Request $request)
    {
        $type = $request->query('type');
        $allowed_types = [Classwork::TYPE_ASSIGNMENT, Classwork::TYPE_MATERIAL, Classwork::TYPE_QUESTION];

        if (!in_array($type, $allowed_types)) {
            $type = Classwork::TYPE_ASSIGNMENT;
        }
        return  $type;
    }

    public function index(Request $request , Classroom $classroom)
    {
        $this->authorize('viewAny' , [Classwork::class , $classroom]);

        $classworks = $classroom->classworks()
            ->with('topic')
            ->latest('published_at')
            ->filter($request->query())
            ->where(function ($query) {
                $query->whereRaw(
                'EXISTS (SELECT 1 FROM classwork_user WHERE classwork_user.classwork_id = classworks.id
                AND classwork_user.user_id = ?)',
                Auth::id()
                );

                $query->orWhereRaw('
                EXISTS (SELECT 1 FROM classroom_user 
                WHERE classroom_user.classroom_id = classworks.classroom_id
                AND classroom_user.user_id = ?
                AND classroom_user.role = ?

                )' , [Auth::id() , 'teacher']);
            })
            ->get();

        return view('classworks.index', [
            'classroom' => $classroom,
            'classworks' => $classworks->groupBy('topic_id'),
            'topics' => Topic::all(),
        ]);
    }


    public function create(Request $request, Classroom $classroom)
    {

        // Gate::authorize('classworks.create', [$classroom]);
        $this->authorize('create' , [Classwork::class , $classroom]);


        $type = $this->getType($request);

        $classwork = new Classwork();

        $topics = $classroom->topics;

        return view('classworks.create', compact('classroom', 'type', 'classwork'));
    }


    public function store(Request $request, Classroom $classroom)
    {

        $this->authorize('create' , [Classwork::class , $classroom]);

        // if (Gate::denies('classworks.create', [$classroom])) {
        //     abort(403);
        // };

        $type = $this->getType($request);


        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'topic_id' => ['nullable', 'int', 'exists:topics,id'],
            'options.grade' => [Rule::requiredIf(fn () => $type == 'assignment'), 'numeric', 'min:0'],
            'options.due' => ['nullable', 'date', 'after:published_at'],
        ]);

        $request->merge([
            'user_id' => Auth::id(),
            'type' => $type,
            'published_at' => now(),
        ]);

        DB::transaction(function () use ($classroom, $request) {
            $classwork = $classroom->classworks()->create($request->all());


            $classwork->users()->attach($request->input('students'));
        });

        return redirect()->route('classrooms.classworks.index', $classroom->id)
            ->with('success', __('Classwork created!'));
    }


    public function show(Classroom $classroom, Classwork $classwork)
    {
       // Gate::authorize('classworks.view' , [$classwork]);
       $this->authorize('view' , $classwork);

        $classwork->load('comments.user');

        $submissions = Auth::user()->submissions()
            ->where('classwork_id', $classwork->id)
            ->get();

        return view('classworks.show', [
            'classroom' => $classroom,
            'classwork' => $classwork,
            'submissions' => $submissions,
        ]);
    }


    public function edit(Request $request, Classroom $classroom, Classwork $classwork)
    {
        $this->authorize('update' , $classwork);
        // Gate::authorize('classworks.update' , [$classwork]);

        $type = $classwork->type->value;

        $assigned = $classwork->users()->pluck('id')->toArray();

        return view('classworks.edit', [
            'classroom' => $classroom,
            'classwork' => $classwork,
            'type' => $type,
            'assigned' => $assigned
        ]);
    }


    public function update(Request $request, Classroom $classroom, Classwork $classwork)
    {
        $this->authorize('update' , $classwork);
        // Gate::authorize('classworks.update' , [$classwork]);


        $type = $classwork->type;

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'topic_id' => ['nullable', 'int', 'exists:topics,id'],
            'options.grade' => [Rule::requiredIf(fn () => $type == 'assignment'), 'numeric', 'min:0'],
            'options.due' => ['nullable', 'date', 'after:published_at'],
        ]);

        $classwork->update($validated);

        $classwork->users()->sync($request->input('students'));


        return redirect()->route('classrooms.classworks.index', $classroom->id)
            ->with('success', __('Classwork updated!'));
    }


    public function destroy(Classroom $classroom, Classwork $classwork)
    {

        $this->authorize('delete' , $classwork);
        // Gate::authorize('classworks.delete' , [$classwork]);

        $classwork->delete();

        return redirect()->route('classrooms.classworks.index', $classroom->id);
    }
}
