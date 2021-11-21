<?php

namespace Database\Factories;

use App\Models\Myuser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MyuserFactory extends Factory
{
    protected $model = Myuser::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'email' => $this->faker->name,
			'avatar' => $this->faker->name,
			'two_factor_secret' => $this->faker->name,
			'two_factor_recovery_codes' => $this->faker->name,
			'current_team_id' => $this->faker->name,
			'profile_photo_path' => $this->faker->name,
			'empresa_id' => $this->faker->name,
        ];
    }
}
