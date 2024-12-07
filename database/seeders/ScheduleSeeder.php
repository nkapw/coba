<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID'); // Localized data for Indonesia
        
        for ($i = 0; $i < 10; $i++) {
            Schedule::create([
                'animal_name' => $faker->word,
                'location' => $faker->city,           // Realistic location
                'inspector' => $faker->name,          // Realistic Indonesian name
                'inspection_date' => $faker->date('Y-m-d'), // Correct date format
                'description' => $faker->sentence,    // Descriptive sentence for context
            ]);
        }
    }
}
