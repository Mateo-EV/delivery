<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Laboratory;
use App\Models\Location;
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
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        Location::factory(50)->create();
        Customer::factory(50)->create();
        Laboratory::factory(10)->create();
        $this->call(OrderSeeder::class);
    }
}
