<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\SubjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SubjectAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        return view("subject_assignment.index", compact("subjects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view("subject_assignment.create", compact("grades", "teachers", "subjects"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        DB::transaction(function() use ($request) {
           //$subject->subject_assignments()->attach($request->teachers);
            foreach ($request->teachers as $t_id) {
                $subjectAssignment = new SubjectAssignment;
                $subjectAssignment->subject_id = $request->subject_id;
                $subjectAssignment->teacher_id = $t_id;
                $subjectAssignment->grade_id = $request->grade_id;

                //dd($request->grade_id);
                $subjectAssignment->save();
                //dd($k);
            }
        });

        return redirect()->route("subject_assignment.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_subject = Subject::find($id);
        //dd($edit_subject);
        $subjects = Subject::all();
        $grades = Grade::all();
        $teachers = Teacher::all();
        $subjectAssignment = SubjectAssignment::find($id);
        return view("subject_assignment.edit", compact("edit_subject","grades", "teachers", "subjects", "subjectAssignment"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request) {


            foreach ($request->teachers as $t_id) {
                $subjectAssignment = new SubjectAssignment;
                $subjectAssignment->subject_id = $request->subject_id;
                $subjectAssignment->teacher_id = $t_id;
                $subjectAssignment->grade_id = $request->grade_id;

                //dd($request->grade_id);
                $subjectAssignment->save();
                //dd($k);
            }

        }); 

        return redirect()->route("subject_assignment.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
