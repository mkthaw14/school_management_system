<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\SubjectAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$subjectAssignment = SubjectAssignment::all();
        $subjects = Subject::paginate(3);
        return view("subject.index", compact("subjects"));
    }

    public function deletedList()
    {
        $subjects = Subject::onlyTrashed()->paginate(3);
        return view("subject.deletedList", compact("subjects"));
    }

    public function restore($id)
    {
        Subject::onlyTrashed()->where("id", $id)->restore();
        return redirect()->route("subject.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::all();
        return view("subject.create", compact("teachers"));
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
        $request->validate([
            "name" => "required|unique:subjects,name",
        ]);

        $subject = new Subject;
        $subject->name = $request->name;
        $subject->save();
        $subject->teachers()->attach($request->teachers);

        return redirect()->route("subject.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $teachers = Teacher::all();
        return view("subject.edit", compact("subject", "teachers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            "name" => ["required", Rule::unique("subjects")->ignore($subject->id)],
        ]);

        $subject->name = $request->name;
        $subject->save();
        $subject->teachers()->sync($request->teachers);

        return redirect()->route("subject.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route("subject.index");
    }
}
