<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Models\Subject;
use App\Models\User;

class SubjectController extends Controller
{
    /**
     * index Page of the Subjects
     */
    public function subject(){
        $subjects = Subject::paginate(5);
        return view('subject.index', ['subjects' => $subjects]);
    }

    /**
     * Store the data of the new Subject added
     */
    public function store(Request $request){
        $request->validate([
            'subject_name' => [
                'required',
                Rule::unique('subjects', 'subject_name')->whereNull('deleted_at'),
            ],
        ]);

        Subject::create($request->only([
            'subject_name',
        ]));
        // Subject::create([
        //     'subject_name' => $request['subject_name'],
        // ]);

        return redirect()->back()->with('success', 'New subject is added');
    }

    /**
     * View Teacher of the perticuler subject
     */
    public function viewTeacher($id){
        $subject    = Subject::findOrFail($id);
        $teachers   = $subject->user()->where('role', 'Teacher')->get();
        return view('users.teacher.view', ['teachers' => $teachers, 'subject' => $subject->subject_name]);
    }

    /**
     * View Student of the perticuler subject
     */
    public function viewStudent($id){
        $subject    = Subject::findOrFail($id);
        $students   = $subject->user()->where('role', 'Student')->get();
        return view('users.student.view', ['students' => $students, 'subject' => $subject->subject_name]);
    }

    public function delete($id){
        $subject = Subject::findOrFail($id);
        if(!$subject){
            return redirect()->route('subject')->with('fail', 'We can not found data');
        }
        $subject->delete();
        return redirect()->route('subject')->with('success', 'Subject deleted successfully');
    }

    public function edit($id){
        $subject = Subject::findOrFail($id);
        $subjects = Subject::paginate(5);
        // return redirect()->route('subject', ['subject' => $subject]);
        return view('subject.edit', ['subject' => $subject, 'subjects' => $subjects]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'subject_name' => [
                'required',
                Rule::unique('subjects', 'subject_name')->where(function ($query) use ($id) {
                    return $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
            ],
        ]);
        $subject = Subject::findOrFail($id);
        $subject->update($request->only(['subject_name']));
        return redirect()->route('subject')->with('success', 'Subject updated Successfully');
    }
}
