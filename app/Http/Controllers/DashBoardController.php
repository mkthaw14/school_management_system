<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\Timetable;
use App\Models\Day;
use App\Models\Time;
use App\Models\Subject;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Grade;

class DashBoardController extends Controller
{
    public function index()
    {
        $academic_year = AcademicYear::where("yearOne", date("Y"))->get()->first();
        
        $teachers = Teacher::all();
        $students = Student::all();
        $grades = [];

        if(!$academic_year)
        {
            $academic_year = AcademicYear::orderBy("id", "desc")->get()->first();
        }

        $year_id = $academic_year ? $academic_year->id : 0;

        $grades = Grade::select('*')->where("academic_year_id", $year_id)->groupBy('name')->paginate(4);
        
        
        //dd($grades);
        $subjects = Subject::all();
        return view("dashboard", compact("academic_year", "grades" , "teachers", "students", "subjects"));
    }
}
