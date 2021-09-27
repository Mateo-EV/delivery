<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Laboratory;
use App\Models\Location;
use App\Models\Motorcyclist;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::factory(50)->create();
        $customers = Customer::all();
        $laboratories = Laboratory::all();
        $motorcyclists = Motorcyclist::all();
        $users = User::whereHas("roles", function(Builder $query){
            $query->where('name', 'Receptor');
        })->get();

        

        $orders = Order::all();
        $locations = Location::all();

        foreach($orders as $order){
            $userR = rand(0, count($users)-1);
            $motorcyclistR = rand(0, count($motorcyclists)-1);
            $customerR = rand(0, 49);
            $locationR = rand(0, 49);
            $laboratorieR = rand(0, 9);
            $users[$userR]->orders()->saveMany([$order]);
            $motorcyclists[$motorcyclistR]->orders()->saveMany([$order]);
            $order->customer()->associate($customers[$customerR]);
            $order->location()->associate($locations[$locationR]->id);
            $order->laboratory()->associate($laboratories[$laboratorieR]->id);
            $order->save();
        }
    }
}
