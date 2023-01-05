<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\Section;
use App\Models\Time;
use App\Models\Day;
use App\Models\Timetable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
        //$this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $academic_year = AcademicYear::where("yearOne", date("Y"))->get()->first();
        $sections = [];

        if(!$academic_year)
        {
            $academic_year = AcademicYear::orderBy("id", "desc")->get()->first();
        }

        $year_id = $academic_year ? $academic_year->id : 0;

        $sections = Section::whereHas("grade", function($query) use($year_id) {
            $query->where("academic_year_id", $year_id);
        })->get();


        $times = Time::all();
        $days = Day::all();
        $timetable = new Timetable;
        return view('frontend', compact("sections", "times", "days", "timetable"));
    }

    public function timetable()
    {
        $academic_year = AcademicYear::where("yearOne", date("Y"))->get()->first();

        $sections = Section::whereHas("grade", function($query) use($academic_year) {
            $query->where("academic_year_id", $academic_year->id);
        })->get();

        return view('home_timetable', compact("sections"));
    }
}
