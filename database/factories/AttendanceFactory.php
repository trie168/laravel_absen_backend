<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'date' => $this->faker->dateTime(),
            'time_in' => $this->faker->dateTime(),
            'time_out' => $this->faker->dateTime(),
            'latlon_in' => $this->faker->latitude() . ',' . $this->faker->longitude(),
            'latlon_out' => $this->faker->latitude() . ',' . $this->faker->longitude(),
            'status' => $this->faker->randomElement(['present', 'absent', 'late', 'early_leave']),
        ];
    }
}
