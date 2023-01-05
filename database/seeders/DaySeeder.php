<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Day;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

        foreach($days as $d)
        {
            $day = new Day;
            $day->name = $d;
            $day->save();
        }

    }
}
