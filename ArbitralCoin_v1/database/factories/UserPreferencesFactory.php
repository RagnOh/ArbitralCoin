<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserPreferences;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class UserPreferencesFactory extends Factory
{
    protected $model = UserPreferences ::class;

    public function definition()
    {
        return [
            'deposito' => $this->faker->numberBetween(5, 50),
            'guadagno' => $this->faker->numberBetween(1, 5),
            
        ];
    }
}
