<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service;
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Service::class;
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(["Lavado Standar Moto", "Polichada", "Lavado de Carro Standar", "Lavado Tapiceria", "Moto de 15"]),
            'cars_id' => $this->faker->randomElement([1,2,3,4]),
            'value' => $this->faker->randomElement([12000,15000,25000,35000,50000])
        ];
    }
}
