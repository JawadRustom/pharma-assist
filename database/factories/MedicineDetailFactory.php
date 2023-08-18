<?php

namespace Database\Factories;

use App\Models\Medicine;
use App\Models\MedicineType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicineDetail>
 */
class MedicineDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'medicine_type_id' => MedicineType::factory(),
            'content' => fake()->text(),
            'medicine_id' => Medicine::factory(),
        ];
    }
}
