<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'brand' => $this->faker->randomElement(['Chevrolet', 'Fiat', 'Ford', 'Volkswagem']),
            'model' => $this->faker->name('10'),
            'plate' => $this->faker->unique()->bothify('###-####'),
            'user_id' => mt_rand(1, 10) //10 users on seeder
        ];
    }
}
