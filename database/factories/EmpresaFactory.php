<?php

namespace Database\Factories;
use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Empresa::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'users_id' => $this->faker->randomElement([1,2,3,4,5])
        ];
    }
}
