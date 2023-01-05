<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("teachers")->insert([
            "name" => "Win",
            "profile" => "/storage/uploads/teachers/1/1.png",
            "gender" => "male",
            "date_of_birth" => "1989-11-10",
            "email" => "win@gmail.com",
            "phone" => "09232445",
            "education" => "B.A History",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);


        $teacher = new Teacher;
        $teacher->name = "Aung";
        $teacher->profile = "/storage/uploads/teachers/2/2.png";
        $teacher->date_of_birth = "1980-11-10";
        $teacher->gender = "male";
        $teacher->email = "aung@gmail.com";
        $teacher->phone = "09343353";
        $teacher->education = "Bsc Mathematics";
        $teacher->save();

        $teacher->grades()->attach([1,5]);

        $teacher = new Teacher;
        $teacher->name = "Ghaw";
        $teacher->profile = "/storage/uploads/teachers/3/3.png";
        $teacher->date_of_birth = "1985-11-10";
        $teacher->gender = "male";
        $teacher->email = "ghaw@gmail.com";
        $teacher->phone = "09343353";
        $teacher->education = "Bsc Mathematics";
        $teacher->save();

        $teacher->grades()->attach([4,5]);

        $teacher = new Teacher;
        $teacher->name = "Albert";
        $teacher->profile = "/storage/uploads/teachers/4/4.png";
        $teacher->date_of_birth = "1992-11-10";
        $teacher->gender = "female";
        $teacher->email = "mm@gmail.com";
        $teacher->phone = "09343353";
        $teacher->education = "Bsc Chemistry";
        $teacher->save();

        $teacher->grades()->attach([2,4]);

        $teacher = new Teacher;
        $teacher->name = "Paul";
        $teacher->profile = "/storage/uploads/teachers/5/5.png";
        $teacher->date_of_birth = "1992-11-10";
        $teacher->gender = "male";
        $teacher->email = "paul@gmail.com";
        $teacher->phone = "09343353";
        $teacher->education = "Bsc Mathematics";
        $teacher->save();

        $teacher->grades()->attach([4,5]);
    }
}
