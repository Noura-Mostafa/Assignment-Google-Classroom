<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassworkController;
use App\Http\Middleware\ApplyUserPreferences;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\JoinClassroomController;
use App\Http\Controllers\ClassroomPeopleController;

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

       Route::post('comments', [CommentController::class, 'store'])
              ->name('comments.store');

       Route::post('classrooms/{classroom}/posts', [PostController::class, 'store'])
              ->name('posts.store');

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

       Route::post('classworks/{classwork}/submissions', [SubmissionController::class, 'store'])
              ->name('submissions.store');
       Route::get('submissions/{submission}/file',  [SubmissionController::class, 'file'])
              ->name('submissions.file');

       Route::resource('profiles', ProfilesController::class)->except('index');

       Route::get('/change-language/{locale}', [LanguageController::class ,'changeLanguage'])->name('change.language');

});
