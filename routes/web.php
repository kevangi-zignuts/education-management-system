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

    // Routes that use for Users
    Route::group(['prefix' => 'user'], function(){
        Route::get('create', [UsersController::class, 'create'])->name('user.create');
        Route::post('register', [UsersController::class, 'store'])->name('user.store');
        Route::get('teacher', [UsersController::class, 'teacherIndex'])->name('teacher');
        Route::get('student', [UsersController::class, 'studentIndex'])->name('student');
        Route::get('add/institution/{id}', [UsersController::class, 'addInstitute'])->name('user.add.institute');
        Route::post('store/institution/{id}', [UsersController::class, 'storeInstitute'])->name('user.store.institute');
        Route::get('add/{id}', [UsersController::class, 'addSubject'])->name('subject.add');
        Route::get('view/subject/{id}', [UsersController::class, 'showUserSubjects'])->name('subject.view');
        Route::post('storeSubject/{id}', [UsersController::class, 'storeSubject'])->name('subject.user');
    });

    // Subject Page Route
    Route::group(['prefix' => 'subject'], function(){
        Route::get('', [SubjectController::class, 'subject'])->name('subject');
        Route::post('store', [SubjectController::class, 'store'])->name('subject.store');
        Route::get('viewTeacher/{id}', [SubjectController::class, 'viewTeacher'])->name('subject.view.teacher');
        Route::get('viewStudent/{id}', [SubjectController::class, 'viewStudent'])->name('subject.view.student');
    });

    // Institutions Page Route
    Route::group(['prefix' => 'institution'], function(){
        Route::get('', [InstitutionController::class, 'index'])->name('institution');
        Route::post('store', [InstitutionController::class, 'store'])->name('institution.store');
        Route::get('add/teacher/{id}', [InstitutionController::class, 'addteacher'])->name('institution.add.teacher');
        Route::post('store/teacher/{id}', [InstitutionController::class, 'storeTeacher'])->name('institution.store.teacher');
        Route::get('view/teacher/{id}', [InstitutionController::class, 'viewTeacher'])->name('institution.view.teacher');
    });

});

require __DIR__.'/auth.php';
