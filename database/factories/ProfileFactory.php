<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genderArray = ['female', 'male'];
        $specialtyArray = ['Doctor', 'Student','Pharmacist','Other'];
        return [
            'birth_date'=>fake()->date(),
            'specialty'=>$specialtyArray[rand(0, 1)],
            'gender'=>$genderArray[rand(0, 3)],
            'user_id'=>User::factory(),
        ];
    }
}
