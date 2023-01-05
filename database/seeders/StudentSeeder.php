<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("students")->insert([
            "name" => "mike",
            "profile" => "/storage/uploads/students/1/1.png",
            "gender" => "male",
            "date_of_birth" => "1989-11-10",
            "nrc" => "4534dffe",
            "section_id" => 1,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);

        DB::table("students")->insert([
            "name" => "whiteman",
            "profile" => "/storage/uploads/students/2/2.png",
            "gender" => "male",
            "date_of_birth" => "1989-11-10",
            "nrc" => "4568hntg",
            "section_id" => 2,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);

        DB::table("students")->insert([
            "name" => "redwings",
            "profile" => "/storage/uploads/students/3/3.png",
            "gender" => "male",
            "date_of_birth" => "1989-11-10",
            "nrc" => "65fsgssg",
            "section_id" => 2,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);
    }
}
