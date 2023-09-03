<?php

namespace App\Http\Controllers\Api\V1;

use Throwable;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomResource;
use Illuminate\Support\Facades\Response;

class ClassroomController extends Controller
{

    public function index()
    {
        $classrooms = Classroom::with('user:id,name', 'topics')
            ->withCount('students as students')
            ->paginate(2); 

        return ClassroomResource::collection($classrooms);
        
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required']
            ]);
        } catch (Throwable $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                ], 422);
        }
        $classroom = Classroom::create($request->all());

        return Response::json([
            'code' => 100,
            'message' => __('Classroom Created.'),
            'classroom' => $classroom,
        ] , 201 );
    }


    public function show(Classroom $classroom)
    {
        return new ClassroomResource($classroom->load('user')->loadCount('students'));
        
    }


    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => ['sometimes' , 'required' , Rule::unique('classrooms' , 'name')->ignore($classroom->id)],
            'section' => ['sometimes' , 'required']
        ]);

        $classroom->update($request->all());

        return [
            'code' => 100,
            'message' => __('Classroom Updated.'),
            'classroom' => $classroom,
        ];
    }


    public function destroy(string $id)
    {
        Classroom::destroy($id);

        return response()->json([] , 204);

    }
}
