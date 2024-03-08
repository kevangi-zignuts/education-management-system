<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\User;

class InstitutionController extends Controller
{
    public function institute(){
        $institutions = Institution::all();
        return view('institutionPage', ['institutions' => $institutions]);
    }

    public function store(Request $request){
        $request->validate([
            'institute_name' => 'required',
        ]);

        Institution::create([
            'institute_name' => $request['institute_name'],
        ]);

        return redirect()->back()->with('success', 'New institute is added');
    }

    public function addteacher($id){
        $institute = Institution::findOrFail($id);
        $teachers = User::where('role', 'teacher')
                        ->where(function ($query) use ($institute) {
                            $query->whereNull('institute_id')
                                ->orWhere('institute_id', $institute->id);
                        })->get();
        $selectedTeachers = User::where('institute_id', $institute->id)->get();
        return view('addTeacherInstitute', ['teachers' => $teachers, 'id' => $id, 'selectedTeachers' => $selectedTeachers]);
    }

    public function storeTeacher(Request $request, $id){
        $institute = Institution::findOrFail($id);
        $previouslyAssociatedTeachers = User::where('institute_id', $institute->id)->get();
        foreach ($previouslyAssociatedTeachers as $teacher) {
            $teacher->update(['institute_id' => null]);
        }
        $selectedTeacherIds = $request->input('teacher_ids', []);
        foreach($selectedTeacherIds as $teacher){
            $teacher = User::findOrFail($teacher);
            $teacher->update(['institute_id' => $institute->id]);
        }
        return redirect()->route('institution')->with('success', 'Add teacher Successfullly');
    }

    public function viewTeacher($id){
        $user = User::where('institute_id', $id);
        $teacherNames = $user->pluck('name')->toArray();
        return view('viewTeacher', ['teacherNames' => $teacherNames]);
    }
}
