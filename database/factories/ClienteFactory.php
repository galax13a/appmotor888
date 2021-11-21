<?php

namespace Database\Factories;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Cliente::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'empresa_id' => $this->faker->randomElement([1,2,3,4])
        ];
    }
}
