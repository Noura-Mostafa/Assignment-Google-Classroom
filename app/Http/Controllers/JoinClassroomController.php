<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\UserClassroomScope;

class JoinClassroomController extends Controller
{

    public function create($id)
    {
        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)
            ->active()->findOrFail($id);

        try {
            $this->exists($classroom, Auth::id());
        } catch (Exception $e) {
            return redirect()->route('classrooms.show', $id);
        }


        return view('classroom.join', compact('classroom'));
    }


    public function store(Request $request, $id)
    {
        $request->validate([
            'role' => 'in:student , teacher',
        ]);

        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)
            ->active()->findOrFail($id);


        try {
            $classroom->join(Auth::id(), $request->input('role', 'student'));
        } catch (Exception $e) {
            return redirect()->route('classrooms.show', $id);
        }

        return redirect()->route('classrooms.show', $id);
    }


    protected function exists(Classroom $classroom, $user_id)
    {
        $exists =  $classroom->users()
            ->wherePivot('user_id', $user_id)
            ->exists();
        if ($exists) {
            throw new Exception('User already joined the class');
        }
    }
}
