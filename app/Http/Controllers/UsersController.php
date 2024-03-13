<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\View\View;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class UsersController extends Controller
{
    /**
     * Show Users Dashboard
     */
    public function dashboard(){
        // $users = User::where('role', 'Teacher')
        //             ->orWhere('role', 'Student')->paginate(7);
        $teacher_count   = User::where('role', 'teacher')->count();
        $student_count   = User::where('role', 'student')->count();
        $subject_count   = Subject::count();
        $institute_count = Institution::count();
        return view('dashboard', ['teacher_count' => $teacher_count, 'student_count' => $student_count, 'subject_count' => $subject_count, 'institute_count' => $institute_count]);
    }

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

        User::create($request->only([
            'name',
            'email',
            'password',
            'role',
            'class'
        ]));

        return redirect()->route('dashboard')->with('success', 'New User is added');
    }

    /**
     * Edit the data of the particular user
     */
    public function edit($id){
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the data of the particular user
     */
    public function update(Request $request, $id){
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255',
                            Rule::unique('users', 'email')->where(function ($query) use ($id) {
                                return $query->where('id', '<>', $id);
                            }),
                        ],
            'role'  => 'required',
            'class' => 'required',
        ]);
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'role', 'class']));
        return redirect()->route('dashboard')->with('success', 'User record updated Successfully');
    }

    /**
     * Delete the data of the particular user
     */
    public function delete($id){
        $user = User::find($id);
        if(!$user){
            return redirect()->route('dashboard')->with('fail', 'We can not found data');
        }
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }

    /**
     * Index Page of the Teacher
     */
    public function teacherIndex(){
        $teachers = User::where('role', 'Teacher')->paginate(7);
        return view('users.teacher.index', ['teachers' => $teachers]);
    }

    /**
     * Index Page of the Student
     */
    public function studentIndex(){
        $students = User::where('role', 'Student')->paginate(7);
        return view('users.student.index', ['students' => $students]);
    }

    /**
     * open a form for add Subject to the particular user
     */
    public function addSubject($id){
        $user           = User::findOrFail($id);
        $subjects       = Subject::all();
        $userSubjectIds = [];
        foreach ($user->subject as $userSubject) {
            $userSubjectIds[] = $userSubject->id;
        }
        return view('subject.add', ['subjects' => $subjects, 'user' => $user, 'userSubjectIds' => $userSubjectIds,]);
    }

    /**
     * Store a form data of a subject of the particular user
     */
    public function storeSubject(Request $request, $id){
        $user       = User::findOrFail($id);
        $subjectIds = $request->input('subjects');

        $user->subject()->sync($subjectIds);

        if($user->role === 'Teacher'){
            return redirect()->route('user.teacher.index')->with('success', 'Add Subject Successfully');
        }
        return redirect()->route('user.student.index')->with('success', 'Add Subject Successfully');
    }

    /**
     * For view the details of the particular Teacher
     */
    public function viewTeacher($id){
        $user = User::with(['subject', 'institute'])->findOrFail($id);
        return view('users.teacher.view', ['user' => $user]);
    }

    /**
     * For view the details of the particular Student
     */
    public function viewStudent($id){
        $user = User::with('subject')->findOrFail($id);
        return view('users.student.view', ['user' => $user]);
    }

    /**
     * Form Section for the add institute for a particular teacher
     */
    public function addInstitute($id){
        $user         = User::findOrFail($id);
        $institutions = Institution::all();

        if($institutions->isEmpty()){
            return redirect()->back()->with('error', 'There is no institute Available');
        }

        return view('institution.add', ['institutions' => $institutions, 'user' => $user]);
    }

    /**
     * Store the data of the form for the add institute for a particular teacher
     */
    public function storeInstitute(Request $request, $id){
        $teacher = User::findOrFail($id);
        $teacher->update(['institute_id' => $request['institute']]);

        return redirect()->route('user.teacher.index')->with('success', 'Add Institute Successfully');
    }

}
