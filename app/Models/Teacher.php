<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "profile",
        "gender",
        "date_of_birth",
        "email",
        "phone",
        "education"
    ];

    public function getYearOfBirth()
    {
        $year = date("d/F/Y", strtotime($this->date_of_birth));
        //$year = Carbon::createFromFormat("d/m/Y", $dob)->format("d/F/Y");
        return $year;
    }

    public function getAge()
    {
        $dob = date("Y", strtotime($this->date_of_birth));
        $age = date("Y") - $dob;
        return $age;
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }


    public function grades()
    {
        return $this->belongsToMany(Grade::class)->withTimestamps();
    }

    public function getGender()
    {
        $gender = $this->gender == 1 ? "Male" : "Female";
        return $gender;
    }
}
