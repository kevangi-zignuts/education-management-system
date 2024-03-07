<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Subject;
use App\Models\User;

class SubjectController extends Controller
{
    public function subject(){
        $subjects = Subject::all();
        return view('subject', ['subjects' => $subjects]);
    }

    public function store(Request $request){
        $request->validate([
            'subject_name' => 'required',
        ]);

        Subject::create([
            'subject_name' => $request['subject_name'],
        ]);

        return redirect()->back()->with('success', 'New subject is added');
    }

    public function storeSubject(Request $request){
        $request->validate([
            'subject_name' => 'required',
        ]);

        Subject::create([
            'subject_name' => $request['subject_name'],
        ]);

        return redirect()->back()->with('success', 'New subject is added');
    }

    public function addSubject($id){
        $user = User::findOrFail($id);
        $subjects = Subject::all();
        $userSubjectIds = [];
        foreach ($user->subject as $userSubject) {
            $userSubjectIds[] = $userSubject->id;
        }
        return view('addSubject', ['subjects' => $subjects, 'id' => $id, 'userSubjectIds' => $userSubjectIds,]);
    }

    public function userStore(Request $request, $id){
        $user = User::findOrFail($id);
        $subjectIds = $request->input('subjects');
        $user->subject()->sync($subjectIds);
        $teachers = User::where('role', 'Teacher')->get();
        $students = User::where('role', 'Student')->get();
        if($user->role === 'Teacher'){
            return view('teacherPage', ['teachers' => $teachers])->with('success', 'Add Subject Successfully');
        }
        return view('studentPage', ['students' => $students])->with('success', 'Add Subject Successfully');
    }




}
