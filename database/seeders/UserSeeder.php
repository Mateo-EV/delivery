<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "name" => "Mateo Rioja Portocarrero",
            "email" => "riojamatthew@gmail.com",
            "password" => Hash::make("77030293"),
            "dni" => "77030293",
            "telephone" => "977895791"
        ]);

        $admin = Role::create(["name"=>"Admin"]);

        $user->assignRole($admin);

        $users = User::factory(50)->create();

        $roles = [
            Role::create(["name"=>"Receptor"]),
            Role::create(["name"=>"Motorizado"])
        ];

        foreach($users as $user){
            $rol = rand(0,1);
            $user->assignRole($roles[$rol]);
            if($rol == 1){
                $user->motorcyclist()->create([
                    "license" => Str::random(1)."-".rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9),
                    "model" => Str::random(3)."-".rand(0,9).rand(0,9).rand(0,9),
                    "km" => 180
                ]);
            }
        }
    }
}
