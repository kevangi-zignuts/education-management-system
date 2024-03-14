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

Route::get('/sample', function () {
    return view('institution.email');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes that use for Users
    Route::group(['prefix' => 'user'], function(){
        Route::get('dashboard', [UsersController::class, 'dashboard'])->name('dashboard');
        Route::get('create/{role}', [UsersController::class, 'create'])->name('user.create');
        // Route::get('create', [UsersController::class, 'create'])->name('user.create');
        Route::post('register', [UsersController::class, 'store'])->name('user.store');
        Route::get('view/{id}', [UsersController::class, 'view'])->name('user.view');
        Route::get('edit/{id}', [UsersController::class, 'edit'])->name('user.edit');
        // Route::get('edit/{id}', [UsersController::class, 'edit'])->name('user.edit');
        Route::post('update/{id}', [UsersController::class, 'update'])->name('user.update');
        Route::post('delete/{id}', [UsersController::class, 'delete'])->name('user.delete');
        Route::get('index/{role}', [UsersController::class, 'index'])->name('user.index');
        // Route::get('teacher/index', [UsersController::class, 'teacherIndex'])->name('user.teacher.index');
        // Route::get('student/index', [UsersController::class, 'studentIndex'])->name('user.student.index');
        Route::get('add/subject/{id}', [UsersController::class, 'addSubject'])->name('user.subject.add');
        Route::post('store/subject/{id}', [UsersController::class, 'storeSubject'])->name('user.subject.store');
        Route::get('view/teacher/{id}', [UsersController::class, 'viewTeacher'])->name('user.teacher.view');
        Route::get('view/student/{id}', [UsersController::class, 'viewStudent'])->name('user.student.view');
        Route::get('add/institution/{id}', [UsersController::class, 'addInstitute'])->name('user.add.institute');
        Route::post('store/institution/{id}', [UsersController::class, 'storeInstitute'])->name('user.store.institute');
    });

    // Subject Page Route
    Route::group(['prefix' => 'subject'], function(){
        Route::get('index', [SubjectController::class, 'index'])->name('subject.index');
        Route::post('store', [SubjectController::class, 'store'])->name('subject.store');
        Route::get('edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
        Route::post('update/{id}', [SubjectController::class, 'update'])->name('subject.update');
        Route::get('view/teacher/{id}', [SubjectController::class, 'viewTeacher'])->name('subject.view.teacher');
        Route::get('view/student/{id}', [SubjectController::class, 'viewStudent'])->name('subject.view.student');
        Route::post('delete/{id}', [SubjectController::class, 'delete'])->name('subject.delete');
    });

    // Institutions Page Route
    Route::group(['prefix' => 'institution'], function(){
        Route::get('index', [InstitutionController::class, 'index'])->name('institution.index');
        Route::post('store', [InstitutionController::class, 'store'])->name('institution.store');
        Route::get('edit/{id}', [InstitutionController::class, 'edit'])->name('institution.edit');
        Route::post('update/{id}', [InstitutionController::class, 'update'])->name('institution.update');
        Route::post('delete/{id}', [InstitutionController::class, 'delete'])->name('institution.delete');
        Route::get('add/teacher/{id}', [InstitutionController::class, 'addTeacher'])->name('institution.add.teacher');
        Route::post('store/teacher/{id}', [InstitutionController::class, 'storeTeacher'])->name('institution.store.teacher');
        Route::get('view/{id}', [InstitutionController::class, 'viewTeacher'])->name('institution.view.teacher');
    });

});

require __DIR__.'/auth.php';
