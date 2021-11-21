<?php

namespace Database\Factories;

use App\Models\Caja;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CajaFactory extends Factory
{
    protected $model = Caja::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'fecha' => $this->faker->name,
			'valor' => $this->faker->name,
			'status' => $this->faker->name,
			'gastos_id' => $this->faker->name,
			'empresa_id' => $this->faker->name,
        ];
    }
}
