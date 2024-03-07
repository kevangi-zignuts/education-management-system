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
        $subjects = Subject::all();
        return view('addSubject', ['subjects' => $subjects, 'id' => $id]);
    }

    public function userStore(Request $request, $id){
        $user = User::findOrFail($id);
        $subjectIds = $request->input('subjects');
        $user->subject()->syncWithoutDetaching($subjectIds);
        return redirect()->back()->with('success', 'Add Subject Successfully');
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

    public function viewTeacher($id){
        $usersInSubject = User::whereHas('subject', function ($query) use ($id) {
            $query->where('subject_id', $id);
        })->where('role', 'Teacher')->get(['name']);
        $userNames = $usersInSubject->pluck('name')->toArray();
        return view('viewTeacher', ['teacherNames' => $userNames]);
    }
    public function viewStudent($id){
        $usersInSubject = User::whereHas('subject', function ($query) use ($id) {
            $query->where('subject_id', $id);
        })->where('role', 'Student')->get(['name']);
        $userNames = $usersInSubject->pluck('name')->toArray();
        return view('viewStudent', ['studentNames' => $userNames]);
    }
}
