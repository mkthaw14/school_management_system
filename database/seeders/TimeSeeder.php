<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Time;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periods = ["9:00-9:45", "9:45-10:30", "10:30-11:15", "11:15-12:00", "12:30-1:15","1:15-2:00", "2:00-2:45"];

        foreach($periods as $p)
        {
            $time = new Time;
            $time->period = $p;
            $time->save();
        }

    }
}
