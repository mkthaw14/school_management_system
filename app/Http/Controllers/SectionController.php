<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$sections = Section::all();
        $sections = Section::paginate(2);
        return view("section.index", compact("sections"));
    }

    public function deletedList()
    {
        $sections = Section::onlyTrashed()->paginate(2);
        return view("section.deletedList", compact("sections"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        return view("section.create", compact("grades"));
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
            "grade_id" => "required|numeric",
            "name" => ["required", Rule::unique("sections")->where(function($query) use ($request) {
                return $query->where("grade_id", $request->grade_id);
            })]
        ]);

        $section = new Section;
        $section->grade_id = $request->grade_id;
        $section->name = $request->name;

        $section->save();
        return redirect()->route("section.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $grades = Grade::all();
        return view("section.edit", compact("section", "grades"));
    }

    public function restore($id)
    {
        Section::onlyTrashed()->where("id", $id)->restore();
        return redirect()->route("section.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            "grade_id" => "required|numeric",
            "name" => ["required", Rule::unique("sections")->ignore($section->id)->where(function($query) use ($request) {
                return $query->where("grade_id", $request->grade_id);
            })]
        ]);

        $section->grade_id = $request->grade_id;
        $section->name = $request->name;
        $section->save();

        return redirect()->route("section.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route("section.index");
    }
}

/*
GET|HEAD        section .................................................... section.index › SectionController@index
  POST            section .................................................... section.store › SectionController@store
  GET|HEAD        section/create ........................................... section.create › SectionController@create
  GET|HEAD        section/deleted ...................................................... SectionController@deletedList
  GET|HEAD        section/{section} ............................................ section.show › SectionController@show
  PUT|PATCH       section/{section} ........................................ section.update › SectionController@update
  DELETE          section/{section} ...................................... section.destroy › SectionController@destroy
  GET|HEAD        section/{section}/edit ....................................... section.edit › SectionController@edit
  PUT             section/{section}/restore ................................................ SectionController@restore */