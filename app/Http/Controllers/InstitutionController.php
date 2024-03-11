<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\User;

class InstitutionController extends Controller
{
    /**
     * index Page of the Intitutions
     */
    public function index(){
        $institutions = Institution::paginate(5);
        return view('institution.index', ['institutions' => $institutions]);
    }

    /**
     * Store the data of the new Institution added
     */
    public function store(Request $request){
        $request->validate([
            'institute_name' => 'required|unique:institutions,institute_name',
        ]);

        Institution::create([
            'institute_name' => $request['institute_name'],
        ]);

        return redirect()->back()->with('success', 'New institute is added');
    }

    /**
     * Open a form for add the teacher in the institution
     */
    public function addteacher($id){
        $institute  = Institution::findOrFail($id);
        $teachers   = User::where('role', 'teacher')
                        ->where(function ($query) use ($institute) {
                            $query->whereNull('institute_id')
                                ->orWhere('institute_id', $institute->id);
                        })->get();
        $selectedTeachers = User::where('institute_id', $institute->id)->get();
        return view('users.teacher.add', ['teachers' => $teachers, 'id' => $id, 'selectedTeachers' => $selectedTeachers]);
    }

    /**
     * store the data of the currently added teacher in the institute
     */
    public function storeTeacher(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'teacher_ids' => 'required|array',
        ]);
        $institute = Institution::findOrFail($id);
        // dd($request->has('teacher_ids'));
        if($request->has('teacher_ids')){
            // $previouslyAssociatedTeachers = User::where('institute_id', $institute->id)
            //                                     ->update(['institute_id' => null]);
            // $previouslyAssociatedTeachers = User::whereIn('id', $request->teacher_ids)
            //                                     ->update(['institute_id' => $institute->id]);
            $previouslyAssociatedTeachers = User::where(function ($query) use ($institute, $request) {
                    $query->where('institute_id', $institute->id)
                        ->update(['institute_id' => null]);
                    $query->whereIn('id', $request->teacher_ids)
                        ->update(['institute_id' => $institute->id]);
            })->get();
        }
        // foreach ($previouslyAssociatedTeachers as $teacher) {
        //     $teacher->update(['institute_id' => null]);
        // }
        // $selectedTeacherIds = $request->input('teacher_ids', []);
        // foreach($selectedTeacherIds as $teacher){
        //     $teacher = User::findOrFail($teacher);
        //     $teacher->update(['institute_id' => $institute->id]);
        // }
        return redirect()->route('institution')->with('success', 'Add teacher Successfullly');
    }

    /**
     * view all the teachers that are in the institution
     */
    public function viewTeacher($id){
        $user = User::where('institute_id', $id)->get();
        if ($user->isEmpty()) {
            return redirect()->back()->with('error', 'No teacher associated with this institute');
        }
        $institute = Institution::findOrFail($id);
        return view('users.teacher.view', ['teachers' => $user, 'institute' => $institute]);
    }

    public function delete($id){
        $institute = Institution::find($id);
        if(!$institute){
            return redirect()->route('institution')->with('fail', 'We can not found data');
        }
        $institute->delete();
        return redirect()->route('institution')->with('success', 'Institution deleted successfully');
    }
}
