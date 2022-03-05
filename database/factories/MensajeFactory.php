<?php

namespace Database\Factories;

use App\Models\Mensaje;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MensajeFactory extends Factory
{
    protected $model = Mensaje::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'mensaje' => $this->faker->name,
			'img' => $this->faker->name,
			'link' => $this->faker->name,
			'status' => $this->faker->name,
			'empresa_id' => $this->faker->name,
        ];
    }
}
