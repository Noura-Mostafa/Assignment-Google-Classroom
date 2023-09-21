<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassroomPolicy
{
    
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function update(User $user, Classroom $classroom): bool
    {
        return  $user->classrooms()
        ->wherePivot('role', '=', 'teacher')
        ->exists();
    }


    public function delete(User $user, Classroom $classroom): bool
    {
        return  $user->classrooms()
        ->wherePivot('role', '=', 'teacher')
        ->exists();
    }

    
}
