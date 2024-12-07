<?php
namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition()
    {
        return [
            'animal_name' => $this->faker->word,            // Random animal name
            'location' => $this->faker->city,               // Random location
            'inspector' => $this->faker->name,              // Random inspector name
            'inspection_date' => $this->faker->date(),      // Random date
            'description' => $this->faker->sentence,        // Random description
        ];
    }
}
