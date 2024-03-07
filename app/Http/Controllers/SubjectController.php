<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

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

    public function addSubject(Request $request){
        $subjects = Subject::all();
        return view('addSubject', ['subjects' => $subjects]);
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
}
