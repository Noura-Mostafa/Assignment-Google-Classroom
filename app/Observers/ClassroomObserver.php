<?php

namespace App\Observers;

use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClassroomObserver
{

    public function creating(Classroom $classroom): void
    {
        $classroom->code = Str::random(8);
        $classroom->user_id = Auth::id();
    }

    public function deleted(Classroom $classroom): void
    {
        $classroom->status = 'deleted';
        $classroom->save();
    }


    public function restored(Classroom $classroom): void
    {
        $classroom->status = 'active';
        $classroom->save();
    }


    public function forceDeleted(Classroom $classroom): void
    {
        $classroom->deleteCoverImage($classroom->cover_image_path);
    }
}
