<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Timetable;
use App\Models\Day;
use App\Models\Time;
use App\Models\Subject;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Grade;
use Illuminate\Http\Request;
use \Exception;
use App\Http\Requests\TimetableRequest;


class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days = Day::orderBy("id", "asc")->get();
        $times = Time::orderBy("id", "asc")->get();
        $timetable = new TimeTable;
        $teachers = Teacher::orderBy("id", "asc")->get();


        $academic_year = AcademicYear::where("yearOne", date("Y"))->get()->first();
        //dd($academic_year);
        //$grades = Grade::where("academic_year_id", $academic_year->id)->get();

        $sections = [];
        $grades = [];

        if(!$academic_year)
        {
            $academic_year = AcademicYear::orderBy("id", "desc")->get()->first();
        }

        //dd($academic_year);
        $year_id = $academic_year ? $academic_year->id : 0;

        //dd($year_id);
        $sections = Section::whereHas("grade", function($query) use($year_id) {
            $query->where("academic_year_id", $year_id);
        })->get();
    
        $grades = Grade::where("academic_year_id", $year_id)->get();



       // dd($sections);
       //$academic_year = AcademicYear::where("yearOne", date("Y"))->get()->first();


        return view("timetable.index", compact("academic_year","grades","sections", "teachers","timetable" ,"days", "times"));
    }

    public function list()
    {
        $timetables = TimeTable::paginate(5);
        return view("timetable.list", compact("timetables"));
    }

    public function deletedList()
    {
        $timetables = TimeTable::onlyTrashed()->paginate(5);
        return view("timetable.deletedList", compact("timetables"));
    }


    public function restore($id)
    {
        TimeTable::onlyTrashed()->where("id", $id)->restore();
        return redirect()->route("timetable.list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $days = Day::all();
        $times = Time::all();
        $sections = Section::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();

        $academic_year = AcademicYear::where("yearOne", date("Y"))->get()->first();

        $grades = [];

        if(!$academic_year)
        {
            $academic_year = AcademicYear::orderBy("id", "desc")->get()->first();
        }

        //dd($academic_year);
        $year_id = $academic_year ? $academic_year->id : 0;
        $grades = Grade::where("academic_year_id", $academic_year->id)->get();
        
        return view("timetable.create", compact("days", "times", "sections"
        , "teachers", "subjects", "grades"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimetableRequest $request)
    {



        //dd($request->all());

        $timetable = new Timetable;

        $timetable->teacher_id = $request->teacher_id;
        $timetable->subject_id = $request->subject_id;
        $timetable->section_id = $request->section_id;
        $timetable->day_id = $request->day_id;
        $timetable->time_id = $request->time_id;
        $timetable->save();
        
        return redirect()->route("timetable.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Timetable $timetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        $days = Day::all();
        $times = Time::all();

        $academic_year = AcademicYear::where("yearOne", date("Y"))->get()->first();
        $grades = [];

        if(!$academic_year)
        {
            $academic_year = AcademicYear::orderBy("id", "desc")->get()->first();
        }

        //dd($academic_year);
        $year_id = $academic_year ? $academic_year->id : 0;
        $grades = Grade::where("academic_year_id", $year_id)->get();

        $selected_section = Section::find($timetable->section_id);
        $selected_teacher = Teacher::find($timetable->teacher_id);

        $selected_grade = $selected_section->grade;
        $selected_subject = Subject::find($timetable->subject_id);

        $teachers = $selected_grade->teachers;
        $subjects = $selected_teacher->subjects;

        $selected_day = Day::find($timetable->day_id);
        $selected_time = Time::find($timetable->time_id);

        //dd($subjects);

        return view("timetable.edit", compact("timetable","days", "times"
        , "selected_section", "selected_teacher" , "selected_subject" , "selected_day", "selected_time", 
        "teachers", "subjects", "grades"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function update(TimetableRequest $request, Timetable $timetable)
    {
        $timetable->teacher_id = $request->teacher_id;
        $timetable->subject_id = $request->subject_id;
        $timetable->section_id = $request->section_id;
        $timetable->day_id = $request->day_id;
        $timetable->time_id = $request->time_id;
        $timetable->save();
        
        return redirect()->route("timetable.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        //dd($timetable);
        $timetable->delete();
        return redirect()->route("timetable.index");
    }

    public function getteacherandsection(Request $request)
    {
        $grade_id = $request->grade_id;
        $grade = Grade::find($grade_id);

        return response()->json([
            "teachers" => $grade->teachers,
            "sections" => $grade->sections,
        ]);
    }

    public function getsection(Request $request)
    {
        $grade_id = $request->grade_id;
        $grade = Grade::find($grade_id);

        return response()->json([
            "sections" => $grade->sections,
        ]);
    }


    public function getoveralltimetable()
    {
        $days = Day::orderBy("id", "asc")->get();
            $times = Time::orderBy("id", "asc")->get();
            $timetable = new TimeTable;
            $teachers = Teacher::orderBy("id", "asc")->get();


            $academic_year = AcademicYear::where("yearOne", date("Y"))->get()->first();
            //dd($academic_year);
            //$grades = Grade::where("academic_year_id", $academic_year->id)->get();

            $sections = [];
            $grades = [];
            if($academic_year)
            {

                $sections = Section::whereHas("grade", function($query) use($academic_year) {
                    $query->where("academic_year_id", $academic_year->id);
                })->get();

                $grades = Grade::where("academic_year_id", $academic_year->id)->get();
            }



           // dd($sections);
           //$academic_year = AcademicYear::where("yearOne", date("Y"))->get()->first();


        return view("timetable.overalltimetable", compact("grades","sections", "teachers","timetable" ,"days", "times"));
    }

    public function getsubject(Request $request)
    {
        $teacher = Teacher::find($request->teacher_id); 

        /* 
            SELECT st.*, s.name, t.name  FROM `subject_teacher` st, subjects s, teachers t WHERE st.subject_id = s.id And st.teacher_id = t.id;
        */
        return response()->json([
            "subjects" => $teacher->subjects
        ]);
    }

    public function searchteacher(Request $request)
    {
        try
        {
            //$timetables = TimeTable::all();
            $days = Day::all();
            $times = Time::all();
            $timetable = new Timetable;
            $teacher = Teacher::find($request->teacher_id);
            return view("timetable.teachertimetable", compact("days", "times", "timetable", "teacher"));
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }

    public function searchsection(Request $request)
    {
        try
        {
            //$timetables = TimeTable::all();
            $days = Day::all();
            $times = Time::all();
            $timetable = new Timetable;
            $section = Section::find($request->section_id);
            return view("timetable.sectiontimetable", compact("days", "times", "timetable", "section"));
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }

    public function getday()
    {
        $days = Day::orderBy("id", "asc")->get();

        return response()->json([
            "days" => $days
        ]);
    }

    public function gettime()
    {
        $times = Time::orderBy("id", "asc")->get();

        return response()->json([
            "times" => $times
        ]);
    }
}

/**
 * SELECT tt.*, d.name, t.period, s.name as subject_name, teacher.name as teacher_name, sec.name as section_name FROM `timetables` tt, times t, days d, subjects s, teachers teacher, sections sec  WHERE d.id = tt.day_id And t.id = tt.time_id And s.id = tt.subject_id And sec.id = tt.section_id And teacher.id = tt.teacher_id;
 */
