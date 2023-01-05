<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::paginate(3);
        return view("grade.index", compact("grades"));
    }

    public function deletedList()
    {
        $grades = Grade::onlyTrashed()->paginate(3);
        return view("grade.deletedList", compact("grades"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academic_years = AcademicYear::all();
        return view("grade.create", compact("academic_years"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "academic_year_id" => "required",
            "name" => ["required", Rule::unique("grades")->where(function($query) use ($request) {
                return $query->where("academic_year_id", $request->academic_year_id);
            })]
        ]);

        $grade = new Grade;
        $grade->academic_year_id = $request->academic_year_id;
        $grade->name = $request->name;
        $grade->save();

        return redirect()->route("grade.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        return view("grade.edit", ["grade" => $grade, "academic_years" => AcademicYear::all()]);
    }

    public function restore($id)
    {
        Grade::onlyTrashed()->where("id", $id)->restore();
        return redirect()->route("grade.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            "academic_year_id" => "required",
            "name" => ["required", Rule::unique("grades")->ignore($grade->id)->where(function($query) use ($request) {
                return $query->where("academic_year_id", $request->academic_year_id);
            })]
        ]); 

        //dd($request->all());

        $grade->academic_year_id = $request->academic_year_id;
        $grade->name =  $request->name;
        $grade->save();

        return redirect()->route("grade.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route("grade.index");
    }
}

/*
* GET|HEAD        grade .......................................................... grade.index › GradeController@index
  POST            grade .......................................................... grade.store › GradeController@store
  GET|HEAD        grade/create ................................................. grade.create › GradeController@create
  GET|HEAD        grade/{grade} .................................................... grade.show › GradeController@show
  PUT|PATCH       grade/{grade} ................................................ grade.update › GradeController@update
  DELETE          grade/{grade} .............................................. grade.destroy › GradeController@destroy
  GET|HEAD        grade/{grade}/edit ............................................... grade.edit › GradeController@edit
*/ 
