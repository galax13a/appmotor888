<?php

namespace Database\Factories;

use App\Models\Operario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OperarioFactory extends Factory
{
    protected $model = Operario::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'dni' => $this->faker->randomElement([989891,2,38989,4]),
			'wsp' => $this->faker->randomElement([7878222,65545452,38787878,465655656]),
			'status' =>1,
			'empresa_id' => $this->faker->randomElement([1,2,3,4])
        ];
    }
}
