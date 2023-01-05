<?php

namespace App\Http\Controllers;

use App\Rules\LessThan;
use App\Rules\GreaterThan;
use App\Rules\EqualTo;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academicYears = AcademicYear::orderBy("id", "desc")->paginate(2);;
        return view("academic_year.index", compact("academicYears"));
    }

    public function deletedList()
    {
        $academicYears = AcademicYear::onlyTrashed()->paginate(2);
        return view("academic_year.deletedList", compact("academicYears"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("academic_year.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maxYearTwo = date("Y") + 1;
        
        $targetYearOne = $request->yearTwo - 1;

        $request->validate([
            "yearOne" => ["required","unique:academic_years,yearOne", "integer", "lt:".$request->yearTwo, new EqualTo($targetYearOne)],
            "yearTwo" => ["required", "integer", "lte:".$maxYearTwo],
        ]);

        //dd("Pass");
        $academicYear = new AcademicYear;
        $academicYear->yearOne = $request->yearOne;
        $academicYear->yearTwo = $request->yearTwo;
        $academicYear->save();

        return redirect()->route("academic_year.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicYear $academicYear)
    {
        return view("academic_year.edit", compact("academicYear"));
    }

    public function restore($id)
    {
        AcademicYear::onlyTrashed()->where("id", $id)->restore();
        return redirect()->route("academic_year.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicYear $academicYear)
    {
        $maxYearTwo = date("Y") + 1;
        
        $targetYearOne = $request->yearTwo - 1;

        $request->validate([
            "yearOne" => ["required", Rule::unique("academic_years")->ignore($academicYear->id) , "integer", "lt:".$request->yearTwo, new EqualTo($targetYearOne)],
            "yearTwo" => ["required", "integer", "lte:".$maxYearTwo],
        ]);
        
        $academicYear->yearOne = $request->yearOne;
        $academicYear->yearTwo = $request->yearTwo;
        $academicYear->save();
        
        return redirect()->route("academic_year.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();
        return redirect()->route("academic_year.index");
        //dd($academicYear);
    }
}

/**
 *  GET|HEAD        academic_year ................................... academic_year.index › AcademicYearController@index
  *POST            academic_year ................................... academic_year.store › AcademicYearController@store
  *GET|HEAD        academic_year/create .......................... academic_year.create › AcademicYearController@create
  *GET|HEAD        academic_year/{academic_year} ..................... academic_year.show › AcademicYearController@show
  *PUT|PATCH       academic_year/{academic_year} ................. academic_year.update › AcademicYearController@update
  *DELETE          academic_year/{academic_year} ............... academic_year.destroy › AcademicYearController@destroy
  *GET|HEAD        academic_year/{academic_year}/edit ................ academic_year.edit › AcademicYearController@edit
 */
