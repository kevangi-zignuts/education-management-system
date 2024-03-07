<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\InstitutionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes that use for Teacher and Student Registration
    Route::group(['prefix' => 'user'], function(){
        Route::get('create', [UsersController::class, 'create'])->name('user.create');
        Route::post('register', [UsersController::class, 'store'])->name('user.store');
        Route::get('teacher', [UsersController::class, 'teacher'])->name('teacher');
        Route::get('student', [UsersController::class, 'student'])->name('student');
        Route::get('subject/viewTeacher/{id}', [UsersController::class, 'viewTeacher'])->name('subject.view.teacher');
        Route::get('subject/viewStudent/{id}', [UsersController::class, 'viewStudent'])->name('subject.view.student');
        Route::get('viewSubject/{id}', [UsersController::class, 'showUserSubjects'])->name('subject.view');
    });

    Route::get('subject', [SubjectController::class, 'subject'])->name('subject');
    Route::post('store', [SubjectController::class, 'store'])->name('subject.store');
    Route::get('add/{id}', [SubjectController::class, 'addSubject'])->name('subject.add');
    Route::post('storeSubject/{id}', [SubjectController::class, 'userStore'])->name('subject.user');
    Route::get('institution', [InstitutionController::class, 'institute'])->name('institution');

});

require __DIR__.'/auth.php';
