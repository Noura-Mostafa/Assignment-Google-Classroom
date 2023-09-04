<?php

namespace App\Http\Controllers\Api\V1;

use Throwable;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\ClassroomResource;

class ClassroomController extends Controller
{

    public function index()
    {
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.read')) {
            abort(403);
        };
        
        $classrooms = Classroom::with('user:id,name', 'topics')
            ->withCount('students as students')
            ->paginate(2); 

        return ClassroomResource::collection($classrooms);
        
    }


    public function store(Request $request)
    {
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.create')) {
            abort(403);
        };

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
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.read')) {
            abort(403);
        };

        return new ClassroomResource($classroom->load('user')->loadCount('students'));
        
    }


    public function update(Request $request, Classroom $classroom)
    {
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.update')) {
            abort(403);
        };

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
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.delete')) {
            abort(403);
        };

        Classroom::findOrFail($id)->delete();

        return response()->json([] , 204);

    }
}
