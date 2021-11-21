<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user  = new User();
        $user->name = 'HArold Suaza';
        $user->email = 'harold@hotmail.com';
        $user->save();

    }
}
