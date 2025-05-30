<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MeasureName;
use App\Models\Measure;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MeasureValue>
 */
class MeasureValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'measure_name_id' => MeasureName::pluck('id')->random(),
            'measure' => $this->faker->randomFloat(),
            'measure_id' => Measure::factory(),
        ];
    }
}       