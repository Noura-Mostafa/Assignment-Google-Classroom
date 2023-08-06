<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomPeopleController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\JoinClassroomController;

Route::get('/', function () {
       return view('welcome');
})->name('home');


Route::get('/dashboard', function () {
       return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
       Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
       Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
       Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



Route::middleware(['auth'])->group(function () {

       Route::get('classrooms/{classroom}/join', [JoinClassroomController::class, 'create'])
              ->middleware('signed')
              ->name('classrooms.join');

       Route::post('classrooms/{classroom}/join', [JoinClassroomController::class, 'store']);


       Route::prefix('classrooms/trashed')
              ->as('classrooms.')
              ->controller(ClassroomController::class)
              ->group(function () {
                     Route::get('/', 'trashed')->name('trashed');
                     Route::put('/{id}', 'restore')->name('restore');
                     Route::delete('/{id}', 'forceDelete')->name('force-delete');
              });


       Route::resource('/classrooms', ClassroomController::class)
              ->names([
                     'index' => 'classrooms.index',
                     'create' => 'classrooms.create',
                     'edit' => 'classrooms.edit',
                     'show' => 'classrooms.show',
                     'store' => 'classrooms.store',
                     'update' => 'classrooms.update',
                     'destroy' => 'classrooms.destroy',
              ]);


       Route::prefix('topics/trashed')
              ->as('topics.')
              ->controller(TopicsController::class)
              ->group(function () {
                     Route::get('/', 'trashed')->name('trashed');
                     Route::put('/{id}', 'restore')->name('restore');
                     Route::delete('/{id}', 'forceDelete')->name('force-delete');
              });


       Route::get('/topics', [TopicsController::class, 'index'])
              ->name('topics.index');

       Route::get('/topics/create/{classroom}', [TopicsController::class, 'create'])
              ->name('topics.create');

       Route::get('/topics/{id}', [TopicsController::class, 'show'])
              ->name('topics.show')->where('id', '\d+');

       Route::get('/topics/edit/{id}', [TopicsController::class, 'edit'])
              ->name('topics.edit')->where('id', '\d+');

       Route::post('/topics/{classroom}', [TopicsController::class, 'store'])
              ->name('topics.store');

       Route::put('/topics/{id}', [TopicsController::class, 'update'])
              ->name('topics.update')->where('id', '\d+');

       Route::delete('/topics/{id}', [TopicsController::class, 'destroy'])
              ->name('topics.destroy')->where('id', '\d+');


       Route::resource('classrooms.classworks', ClassworkController::class);

       Route::get('classrooms/{classroom}/people', [ClassroomPeopleController::class, 'index'])
              ->name('classrooms.people');

       Route::delete('classrooms/{classroom}/people', [ClassroomPeopleController::class, 'destroy'])
              ->name('classrooms.people.destroy');
});
