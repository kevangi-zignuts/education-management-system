<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Subject;
use App\Models\User;

class SubjectController extends Controller
{
    /**
     * index Page of the Subjects
     */
    public function subject(){
        $subjects = Subject::all();
        return view('subject.index', ['subjects' => $subjects]);
    }

    /**
     * Store the data of the new Subject added
     */
    public function store(Request $request){
        $request->validate([
            'subject_name' => 'required',
        ]);

        Subject::create([
            'subject_name' => $request['subject_name'],
        ]);

        return redirect()->back()->with('success', 'New subject is added');
    }

    /**
     * View Teacher of the perticuler subject
     */
    public function viewTeacher($id){
        $subject    = Subject::find($id);
        $teachers   = $subject->user()->where('role', 'Teacher')->get();
        return view('users.teacher.view', ['teachers' => $teachers]);
    }

    /**
     * View Student of the perticuler subject
     */
    public function viewStudent($id){
        $subject    = Subject::find($id);
        $students   = $subject->user()->where('role', 'Student')->get();
        return view('users.student.view', ['students' => $students]);
    }
}
