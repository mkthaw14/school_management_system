<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Grade extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "academic_year_id",
    ];

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class, "academic_year_id");
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function getStudents()
    {
        //dd($this->id);
        $students = Student::whereHas("section", function($query)  {
            $query->where("grade_id", $this->id);
        })->get();

        return $students;
    }

    public function getStudentsByGender($gender)
    {
        //dd($this->id);
        $students = Student::whereHas("section", function($query) use ($gender) {
            $query->where("grade_id", $this->id)->where("gender", $gender);
        })->get();

        return $students;
    }

}

