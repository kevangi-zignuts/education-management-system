<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use App\Models\Institution;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * Register Form for the teacher and student
     */
    public function create(){
        return view('register');
    }

    /**
     * Store data of the teacher and student in users table
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'  => ['required', 'confirmed'],
            'role'      => 'required',
            'class'     => 'required',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'class'     => $request->class,
        ]);

        return redirect()->route('dashboard')->with('success', 'New User is added');
    }

    /**
     * Index Page of the Teacher
     */
    public function teacherIndex(){
        $teachers = User::where('role', 'Teacher')->paginate(5);
        return view('users.teacher.index', ['teachers' => $teachers]);
    }

    /**
     * Index Page of the Student
     */
    public function studentIndex(){
        $students = User::where('role', 'Student')->paginate(5);
        return view('users.student.index', ['students' => $students]);
    }

    /**
     * open a form for add Subject to the perticuler user
     */
    public function addSubject($id){
        $user           = User::findOrFail($id);
        $subjects       = Subject::all();
        $userSubjectIds = [];
        foreach ($user->subject as $userSubject) {
            $userSubjectIds[] = $userSubject->id;
        }
        return view('subject.add', ['subjects' => $subjects, 'id' => $id, 'userSubjectIds' => $userSubjectIds,]);
    }

    /**
     * Store a form data of a subject of the perticular user
     */
    public function storeSubject(Request $request, $id){
        $user           = User::findOrFail($id);
        $subjectIds     = $request->input('subjects');

        $user->subject()->sync($subjectIds);

        if($user->role === 'Teacher'){
            return redirect()->route('teacher')->with('success', 'Add Subject Successfully');
        }
        return redirect()->route('student')->with('success', 'Add Subject Successfully');
    }

    /**
     * For view the Subject of the perticuler user
     */
    public function showUserSubjects($id){
        try {
            $user = User::with('subject')->findOrFail($id);

            // Check if subjects are loaded
            if (!$user->subject->isEmpty()) {
                $subjects = $user->subject;
                return view('subject.view', ['user' => $user, 'subjects' => $subjects]);
            } else {
                return redirect()->back()->with('error', 'No subjects found for user');
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'User Not found');
        }
    }

    /**
     * Form Section for the add institute for a perticuler teacher
     */
    public function addInstitute($id){
        $user = User::findOrFail($id);
        if($user->institute_id !== null){
            return redirect()->back()->with('error', 'Already associated with some institute');
        }
        $institutions = Institution::all();
        return view('institution.add', ['institutions' => $institutions, 'user' => $user]);
    }

    /**
     * Store the data of the form for the add institute for a perticuler teacher
     */
    public function storeInstitute(Request $request, $id){
        $teacher = User::findOrFail($id);
        $teacher->update(['institute_id' => $request['institute']]);
        return redirect()->route('teacher')->with('success', 'Add Institute Successfully');
    }

}
