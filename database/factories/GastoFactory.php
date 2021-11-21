<?php

namespace Database\Factories;
use App\Models\Gasto;
use Illuminate\Database\Eloquent\Factories\Factory;

class GastoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Gasto::class;
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(["ACPM", "Recargas", "Prestamos", "Gliserina", "Arriendos"]),
            'empresa_id' => $this->faker->randomElement([1,2,3,4]),
            'value' => $this->faker->randomElement([12000,15000,25000,35000,0]),
            'status' => 1
        ];
    }
}
