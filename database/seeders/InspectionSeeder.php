<?php

namespace Database\Seeders;

use App\Models\Inspection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i <10; $i++) {
            Inspection::create([
                'animal'=>$faker->word,
                'cage_treatment'=>$faker->word,
                'date'=>$faker->date,
                'environmental_care'=>$faker->word,
                'feeding'=>$faker->word,
                'medical_treatment'=>$faker->word,
                'inspector'=>$faker->name,
                'location'=>$faker->word,
                'suggestion'=>$faker->word,
                'result'=>$faker->word
            ]);
        }
    }
}
