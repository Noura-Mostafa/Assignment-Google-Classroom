<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Classwork;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Relation::enforceMorphMap([
            'post' => Post::class,
            'classwork' => Classwork::class,
            'user' => User::class,
        ]);
    }
}
