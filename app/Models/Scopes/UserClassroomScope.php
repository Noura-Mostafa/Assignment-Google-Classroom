<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class UserClassroomScope implements Scope
{

    public function apply(Builder $builder, Model $model): void
    {
        if ($id = Auth::id()) {
            $builder->where('user_id', '=', $id);
        }
    }
} 
