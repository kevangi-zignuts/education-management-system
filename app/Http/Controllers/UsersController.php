<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function create(){
        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'role' => 'required',
            'class' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'class' => $request->class,
        ]);

        return redirect()->route('dashboard')->with('success', 'Add a new User');
    }

    public function teacher(){
        $teachers = User::where('role', 'Teacher')->get();
        return view('teacherPage', ['teachers' => $teachers]);
    }
    public function student(){
        $students = User::where('role', 'Student')->get();
        return view('studentPage', ['students' => $students]);
    }
    public function viewTeacher($id){
        $subject = Subject::find($id);
        $teachers = $subject->user()->where('role', 'Teacher')->get(['name']);
        $teacherNames = $teachers->pluck('name')->toArray();
        return view('teacherPage', ['teacherNames' => $teacherNames]);
    }
    public function viewStudent($id){
        $subject = Subject::find($id);
        $students = $subject->user()->where('role', 'Student')->get(['name']);
        $studentNames = $students->pluck('name')->toArray();
        return view('studentPage', ['studentNames' => $studentNames]);
    }
    public function showUserSubjects($id){
        try {
            $user = User::with('subject')->findOrFail($id);

            // Check if subjects are loaded
            if ($user->subject) {
                $subjects = $user->subject;
                return view('viewSubject', ['user' => $user, 'subjects' => $subjects]);
            } else {
                return redirect()->back()->with('error', 'No subjects found for user');
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'User Not found');
        }
    }
}
