<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = array(["name" => "Myanmar", 'teacher' => [1]], 
        ["name" => "English", "teacher" => [1]],
        ["name" => "Mathematics", "teacher" => [3,5]],
        ["name" => "Physics", "teacher" => [5,3]],
        ["name" => "Chemistry", "teacher" => [2,4]],
        ["name" => "Biology", "teacher" => [2,4]],
    );

        foreach($subjects as $s)
        {
            $subject = new Subject;
            $subject->name = $s["name"];
            $subject->save();
            $subject->teachers()->attach($s["teacher"]);
        }
    }
}
