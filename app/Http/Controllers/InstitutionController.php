<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

use App\Models\User;
use App\Mail\WelcomeMail;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstitutionController extends Controller
{
    /**
     * index Page of the Intitutions
     */
    public function index(){
        $institutions = Institution::paginate(7);
        return view('institution.index', ['institutions' => $institutions]);
    }

    /**
     * Store the data of the new Institution added
     */
    public function store(Request $request){
        $request->validate([
            'institute_name' => [
                'required',
                Rule::unique('institutions', 'institute_name')->whereNull('deleted_at'),
            ],
        ]);

        Institution::create($request->only([
            'institute_name'
        ]));

        return redirect()->back()->with('success', 'New institute is added');
    }

    /**
     * Edit the data of the Institution
     */
    public function edit($id){
        $institute  = Institution::findOrFail($id);
        $institutes = Institution::paginate(7);
        return view('institution.edit', ['institute' => $institute, 'institutions' => $institutes]);
    }

    /**
     * Update the data of the Institution
     */
    public function update(Request $request, $id){
        $request->validate([
            'institute_name' => [
                'required',
                Rule::unique('institutions', 'institute_name')->where(function ($query) use ($id) {
                    return $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
            ],
        ]);

        $institute = Institution::findOrFail($id);
        $institute->update($request->only(['institute_name']));

        return redirect()->route('institution.index')->with('success', 'Institute updated Successfully');
    }

    /**
     * Delete the data of the Institution
     */
    public function delete($id){
        $institute = Institution::find($id);
        if(!$institute){
            return redirect()->route('institution.index')->with('fail', 'We can not found data');
        }

        $institute->delete();
        $user = User::where('institute_id', $id)->update(['institute_id' => null]);

        return redirect()->route('institution.index')->with('success', 'Institution deleted successfully');
    }

    /**
     * Open a form for add the teacher in the institution
     */
    public function addTeacher($id){
        $institute = Institution::findOrFail($id);
        $teachers  = User::where('role', 'teacher')
                        ->where(function ($query) use ($institute) {
                        $query->whereNull('institute_id')
                            ->orWhere('institute_id', $institute->id);
                        })->get();

        if($teachers->isEmpty()){
            return redirect()->back()->with('error', 'Currently No teacher Available');
        }
        $selectedTeachers = User::where('institute_id', $institute->id)->get();

        return view('users.teacher.add', ['teachers' => $teachers, 'id' => $id, 'selectedTeachers' => $selectedTeachers]);
    }

    /**
     * store the data of the currently added teacher in the institute
     */
    public function storeTeacher(Request $request, $id){
        $request->validate([
            'teacher_ids' => 'array',
        ]);
        $institute = Institution::findOrFail($id);
        $beforeUpdatingTeachers = User::where('institute_id', $id)->get();
        if($request->has('teacher_ids')){
            User::where('institute_id', $institute->id)->update(['institute_id' => null]);
            User::whereIn('id', $request->teacher_ids)->update(['institute_id' => $institute->id]);

            $afterUpdatingTeachers = User::where('institute_id', $id)->get();
            foreach($afterUpdatingTeachers as $teacher){
                $matchingTeacher = $beforeUpdatingTeachers->firstWhere('id', $teacher->id);
                if(!$matchingTeacher){
                    \Mail::to($teacher->email)->send(new WelcomeMail($teacher->name, $institute->institute_name));
                }
            }
            if (Queue::size() > 0) {
                // return redirect()->route('institution.index')->with('warning', 'Emails are being sent. Please wait...');
                return redirect()->route('institution.index')->with('success', 'Add teacher Successfullly');
            }
        }
        User::where('institute_id', $institute->id)->update(['institute_id' => null]);
        return redirect()->route('institution.index')->with('success', "Add teacher Successfullly");
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
        return view('users.teacher.viewInSubOrInst', ['teachers' => $user, 'institute' => $institute]);
    }

}
