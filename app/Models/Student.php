<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "profile",
        "nrc",
        "gender",
        "date_of_birth",
        "section_id",
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function getAge()
    {
        $dob = date("Y", strtotime($this->date_of_birth));
        $age = date("Y") - $dob;
        return $age;
    }

    public function getGender()
    {
        $gender = $this->gender == 1 ? "Male" : "Female";
        return $gender;
    }


}
