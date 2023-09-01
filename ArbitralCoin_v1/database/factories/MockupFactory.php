<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mockup;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class MockupFactory extends Factory
{
    protected $model = Mockup ::class;

    public function definition()
    {
        return [
            'price' => $this->faker->numberBetween(2, 50),
            
            
        ];
    }
}