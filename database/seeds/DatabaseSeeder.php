<?php

use App\Role;
use App\User;
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
        // $this->call(UsersTableSeeder::class);
        Role::create(["name" => "Administrador"]);
        Role::create(["name" => "Común"]);
        User::create([
            "name" => "4dm1n",
            "email" => "4dm1n@keiron.cl",
            "role_id" => 1,
            "password" => bcrypt("Pollo")
        ]);
    }
}
