<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClassworkController extends Controller
{
    protected function getType(Request $request){
        $type = $request->query('type');
        $allowed_types = [Classwork::TYPE_ASSIGNMENT, Classwork::TYPE_MATERIAL, Classwork::TYPE_QUESTION];

        if(!in_array($type , $allowed_types)){
            $type = Classwork::TYPE_ASSIGNMENT;
        }
        return  $type ;
    }

    public function index(Classroom $classroom)
    {
        $classworks = $classroom->classworks()
               ->with('topic')
               ->latest('published_at')
               ->get();        

        return view('classworks.index' , [
            'classroom' => $classroom,
            'classworks' => $classworks->groupBy('topic_id'),
            'topics' => Topic::all(),
        ]);
    }

    
    public function create(Request $request , Classroom $classroom)
    {
        $type = $this->getType($request);

        $classwork = new Classwork();

        $topics = $classroom->topics;

        return view('classworks.create' , compact('classroom' , 'type' , 'classwork'));
    }

    
    public function store(Request $request , Classroom $classroom)
    {
        $type = $this->getType($request);

    
        $request->validate([
            'title' => ['required' , 'string' , 'max:255'],
            'description' => ['nullable' , 'string'],
            'topic_id' => ['nullable' , 'int' , 'exists:topics,id'],
            'options.grade' => [Rule::requiredIf(fn() => $type == 'assignment'), 'numeric' , 'min:0'],
            'options.due' => ['nullable' , 'date' , 'after:published_at'],
        ]);

        $request->merge([
            'user_id' => Auth::id(),
            'type' => $type,
            'published_at' => now(),
        ]);

        DB::transaction(function() use ($classroom , $request) {
            $classwork = $classroom->classworks()->create($request->all());


        $classwork->users()->attach( $request->input('students') );

        });
        
        return redirect()->route('classrooms.classworks.index' , $classroom->id)
               ->with('success' , 'Classwork created!');
    }


    public function show(Classroom $classroom , Classwork $classwork)
    {
        $classwork->load('comments.user');
        
        $submissions = Auth::user()->submissions()
                  ->where('classwork_id' , $classwork->id)
                  ->get();

        return view('classworks.show',[
            'classroom' => $classroom,
            'classwork' => $classwork,
            'submissions' => $submissions,
        ]);
    }

    
    public function edit(Request $request , Classroom $classroom ,Classwork $classwork)
    {
        $type = $classwork->type->value;

        $assigned = $classwork->users()->pluck('id')->toArray();

        return view('classworks.edit',[
            'classroom' => $classroom,
            'classwork' => $classwork,
            'type' => $type,
            'assigned' =>$assigned
        ]);
    }

    
    public function update(Request $request,Classroom $classroom, Classwork $classwork)
    {
        
        $type = $classwork->type;

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'topic_id' => ['nullable', 'int', 'exists:topics,id'],
            'options.grade' => [Rule::requiredIf(fn() => $type == 'assignment'), 'numeric' , 'min:0'],
            'options.due' => ['nullable' , 'date' , 'after:published_at'],
        ]);

        $classwork->update($validated);

        $classwork->users()->sync($request->input('students'));


        return redirect()->route('classrooms.classworks.index' , $classroom->id)
               ->with('success' , 'Classwork updated!');
    }

    
    public function destroy(Classroom $classroom , Classwork $classwork)
    {

        $classwork->delete();
        
        return redirect()->route('classrooms.classworks.index' , $classroom->id);

    }
}
