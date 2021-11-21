<?php

namespace Database\Factories;
use App\Models\CarsType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarsTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = CarsType::class;
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(["Carro", "Moto", "Camioneta"]),
            'empresa_id' => $this->faker->randomElement([1,2,3,4])
        ];
    }
}
