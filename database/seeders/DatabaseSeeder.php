<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(5)->create();
         \App\Models\Empresa::factory(5)->create();
         \App\Models\CarsType::factory(5)->create();
         \App\Models\Service::factory(5)->create();
         \App\Models\Cliente::factory(6)->create();
         \App\Models\Gasto::factory(5)->create();
         \App\Models\Operario::factory(5)->create();
        // $this->call(UserSeeder::class);
    
    }
}
