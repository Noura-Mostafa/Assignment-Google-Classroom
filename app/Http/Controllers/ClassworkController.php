<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\Topic;
use Illuminate\Http\Request;
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
               ->orderBy('published_at')
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

        $topics = $classroom->topics;

        return view('classworks.create' , compact('classroom' , 'type'));
    }

    
    public function store(Request $request , Classroom $classroom)
    {
        $type = $this->getType($request);

    
        $request->validate([
            'title' => ['required' , 'string' , 'max:255'],
            'description' => ['nullable' , 'string'],
            'topic_id' => ['nullable' , 'int' , 'exists:topics,id'],
        ]);

        $request->merge([
            'user_id' => Auth::id(),
            'type' => $type,
            'published_at' => now(),
        ]);

        $classwork = $classroom->classworks()->create($request->all());

        $classwork->users()->attach( $request->input('students') );

        return redirect()->route('classrooms.classworks.index' , $classroom->id)
               ->with('success' , 'Classwork created!');
    }


    public function show(Classroom $classroom , Classwork $classwork)
    {
        return view('classworks.show',[
            'classroom' => $classroom,
            'classwork' => $classwork,
        ]);
    }

    
    public function edit(Request $request , Classroom $classroom ,Classwork $classwork)
    {
        $type = $this->getType($request);

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
        
        $validated = $request->validate([
            'title' => ['required' , 'string' , 'max:255'],
            'description' => ['nullable' , 'string'],
            'topic_id' => ['nullable' , 'int' , 'exists:topics,id'],
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
