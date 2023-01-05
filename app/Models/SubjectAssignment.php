<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectAssignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillabe = [
        "grade_id",
        "subject_id",
        "teacher_id"
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function getTeacherName($id)
    {
        return Teacher::find($id)->name;
    }

    public function getGradeName($id)
    {
        return Grade::find($id)->name;
    }

    public function getGrade($id)
    {
        return Grade::find($id);
    }

    public function getTeacher($id)
    {
        return Teacher::find($id);
    }
}
