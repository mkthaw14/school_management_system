<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            AcademicYear::class,
            GradeSeeder::class,
            SectionSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            SubjectSeeder::class,
            DaySeeder::class,
            TimeSeeder::class,
        ]);

        //Seeding commands
        // php artisan make:seeder xxx 
        //php artisan db:seed
        //php artisan migrate:fresh --seed
        //php artisan db:seed --class=UserSeeder
    }
}
