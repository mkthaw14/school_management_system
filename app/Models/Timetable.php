<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timetable extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "day_id",
        "time_id",
        "teacher_id",
        "section_id",
        "subject_id"
    ];



    public function time()
    {
        return $this->belongsTo(Time::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function getSectionByDayIDAndTimeID($day_id, $time_id)
    {
        $timetable = TimeTable::where("day_id", $day_id)->where("time_id", $time_id)->get()->first();
        if(!$timetable)
            return "Empty";

        $section = Section::find($timetable->section_id);
        return $section;
    }

    public function getByTeacherIDAndDayIDAndTimeID($teacher_id, $day_id, $time_id)
    {
        $timetable = TimeTable::where("teacher_id", $teacher_id)->where("day_id", $day_id)->where("time_id", $time_id)->get()->first();
        //$section = Section::find($timetable->section_id);
        return $timetable;
    }

    public function getBySectionIDAndDayIDAndTimeID($section_id, $day_id, $time_id)
    {
        $timetable = TimeTable::where("section_id", $section_id)->where("day_id", $day_id)->where("time_id", $time_id)->get()->first();
        return $timetable;
    }

    public function getSection($section_id)
    {
        return Section::find($section_id);
    }

    public function getSubject($subject_id)
    {
        return Subject::find($subject_id);
    }

    public function getTeacher($teacher_id)
    {
        return Teacher::find($teacher_id);
    }

    public function getDay($id)
    {
        return Day::find($id);
    }

    public function getTime($id)
    {
        return Time::find($id);
    }


}

/**
 * SELECT tt.*, d.name, t.period, s.name as subject_name, teacher.name as teacher_name, sec.name as section_name FROM `timetables` tt, times t, days d, subjects s, teachers teacher, sections sec  WHERE d.id = tt.day_id And t.id = tt.time_id And s.id = tt.subject_id And sec.id = tt.section_id And teacher.id = tt.teacher_id;
 */
