<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class UserClassroomScope implements Scope
{

    public function apply(Builder $builder, Model $model): void
    {
        if ($id = Auth::id()) {
            $builder
                    ->where(function($query) use ($id) {
                    $query->where('classrooms.user_id', '=', $id)
                          ->orWhereExists(function($query) use ($id){
                          $query->select(DB::raw('1'))
                            ->from('classroom_user')
                            ->whereColumn('classroom_user.classroom_id' , 'classrooms.id')
                            ->where('classroom_user.user_id' , '=' , $id);
                    });
                    });
    }
}

}