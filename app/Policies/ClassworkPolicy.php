<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Auth\Access\Response;
use App\Models\Scopes\UserClassroomScope;

class ClassworkPolicy
{
    
    public function viewAny(User $user , Classroom $classroom): bool
    {
        return $user->classrooms()
        ->wherePivot('classroom_id', '=', $classroom->id)
        ->exists();
    }

    
    public function view(User $user, Classwork $classwork): bool
    {
        $teacher = $user->classrooms()
                ->wherePivot('classroom_id', '=', $classwork->classroom_id)
                ->wherePivot('role', '=', 'teacher')
                ->exists();


            $assigned = $user->classworks()
                ->wherePivot('classwork_id', '=', $classwork->id)
                ->exists();

            return ($teacher || $assigned);
    }

    
    public function create(User $user , Classroom $classroom): bool
    {
        $result = $user->classrooms()
                ->withoutGlobalScope(UserClassroomScope::class)
                ->wherePivot('classroom_id', '=', $classroom->id)
                ->wherePivot('role', '=', 'teacher')
                ->exists();

            return  $result ;
    }

    
    public function update(User $user, Classwork $classwork): bool
    {
        return $classwork->user_id == $user->id && $user->classrooms()
                ->wherePivot('classroom_id', '=', $classwork->classroom_id)
                ->wherePivot('role', '=', 'teacher')
                ->exists();
    }

    
    public function delete(User $user, Classwork $classwork): bool
    {
        return $classwork->user_id == $user->id && $user->classrooms()
                ->wherePivot('classroom_id', '=', $classwork->classroom_id)
                ->wherePivot('role', '=', 'teacher')
                ->exists();
    }

}
