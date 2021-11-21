<?php

namespace Database\Factories;

use App\Models\Factura;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FacturaFactory extends Factory
{
    protected $model = Factura::class;

    public function definition()
    {
        return [
			'placa' => $this->faker->name,
			'value' => $this->faker->name,
			'empresa' => $this->faker->name,
			'operario' => $this->faker->name,
			'status' => $this->faker->name,
			'cliente_id' => $this->faker->name,
			'servicio_id' => $this->faker->name,
			'operario_id' => $this->faker->name,
			'empresa_id' => $this->faker->name,
        ];
    }
}
