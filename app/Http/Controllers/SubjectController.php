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
    public function index(){
        $subjects = Subject::paginate(7);
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

        return redirect()->back()->with('success', 'New subject is added');
    }

    /**
     * Edit the data of the Subject
     */
    public function edit($id){
        $subject  = Subject::findOrFail($id);
        $subjects = Subject::paginate(7);

        return view('subject.edit', ['subject' => $subject, 'subjects' => $subjects]);
    }

    /**
     * Uadate the data of the Subject
     */
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

        return redirect()->route('subject.index')->with('success', 'Subject updated Successfully');
    }

    /**
     * View Teacher of the particular subject
     */
    public function viewTeacher($id){
        $subject  = Subject::findOrFail($id);
        $teachers = $subject->user()->where('role', 'Teacher')->get();

        if($teachers->isEmpty()){
            return redirect()->back()->with('error', 'No teachers are taught this subject');
        }

        return view('users.teacher.viewInSubOrInst', ['teachers' => $teachers, 'subject' => $subject->subject_name]);
    }

    /**
     * View Student of the particular subject
     */
    public function viewStudent($id){
        $subject  = Subject::findOrFail($id);
        $students = $subject->user()->where('role', 'Student')->get();

        if($students->isEmpty()){
            return redirect()->back()->with('error', 'No Student studied this subject');
        }

        return view('users.student.viewInSubject', ['students' => $students, 'subject' => $subject->subject_name]);
    }

    /**
     * Delete the data of Subject
     */
    public function delete($id){
        $subject = Subject::findOrFail($id);

        if(!$subject){
            return redirect()->route('subject.index')->with('fail', 'We can not found data');
        }

        $subject->delete();
        return redirect()->route('subject.index')->with('success', 'Subject deleted successfully');
    }

}
