<?php

namespace Database\Factories;

use App\Models\employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employee>
 */
class employeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=employee::class;
    public function definition(): array
    {
        return [
            //
            'name' => fake()->name(),
            'age' => fake()->unique()->numberBetween(1,100),
        ];
    }
}
