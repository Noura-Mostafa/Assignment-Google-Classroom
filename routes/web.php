<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\ClassroomController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

//classroom route
// Route::get('/classrooms', 'App\Http\Controllers\ClassroomController@index');
Route::get('/classrooms', [ClassroomController::class, 'index'])
       ->name('classrooms.index');
Route::get('/classrooms/create', [ClassroomController::class, 'create'])
       ->name('classrooms.create');
Route::get('/classrooms/{id}', [ClassroomController::class, 'show'])
       ->name('classrooms.show')
       ->where('id', '\d+');
Route::get('/classrooms/edit/{id}', [ClassroomController::class, 'edit'])
       ->name('classrooms.edit')->where('id', '\d+');
Route::post('/classrooms' , [ClassroomController::class , 'store'])
       ->name('classrooms.store');

Route::put('/classrooms/{id}', [ClassroomController::class, 'update'])
->name('classrooms.update')->where('id', '\d+');

Route::delete('/classrooms/{id}', [ClassroomController::class, 'destroy'])
->name('classrooms.destroy')->where('id', '\d+');


//topic route
Route::get('/topics', [TopicsController::class, 'index'])
       ->name('topics.index');
Route::get('/topics/create', [TopicsController::class, 'create'])
       ->name('topics.create');
Route::get('/topics/{id}', [TopicsController::class, 'show'])
       ->name('topics.show')
       ->where('id', '\d+');
Route::get('/topics/edit/{id}', [TopicsController::class, 'edit'])
       ->name('topics.edit')->where('id', '\d+');
Route::post('/topics' , [TopicsController::class , 'store'])
       ->name('topics.store');

Route::put('/topics/{id}', [TopicsController::class, 'update'])
->name('topics.update')->where('id', '\d+');

Route::delete('/topics/{id}', [TopicsController::class, 'destroy'])
->name('topics.destroy')->where('id', '\d+');