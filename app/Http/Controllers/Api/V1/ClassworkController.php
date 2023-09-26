<?php

namespace App\Http\Controllers\Api\V1;

use Throwable;
use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom)
    {

        return $classroom->classworks()
            ->latest('published_at')
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

    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => ['required','string']
            ]);
        } catch (Throwable $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                ], 422);
        }
        $classwork = Classwork::create($request->all());

        return Response::json([
            'code' => 100,
            'message' => __('Classwork Created.'),
            'classwork' => $classwork,
        ] , 201 );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Classwork::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Classroom $classroom, Classwork $classwork)
    {
        try {
            $request->validate([
                'title' => ['required','string']
            ]);
        } catch (Throwable $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                ], 422);
        }
        $classwork->update($request->all());

        return Response::json([
            'code' => 100,
            'message' => __('Classwork Updated.'),
            'classwork' => $classwork,
        ] , 201 );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Classroom::findOrFail($id)->delete();

        return response()->json([] , 204);
    }
}
