<?php

namespace App\Http\Livewire\Order;

use App\Models\Customer;
use App\Models\Laboratory;
use App\Models\Location;
use App\Models\Motorcyclist;
use Livewire\Component;

class Create extends Component
{
    public $open = false;

    public $laboratory,
        $customer,
        $description;

    // public function save(){
        
    // }

    public function updatedLaboratory($laboratory){
        $laboratory = Laboratory::find($laboratory);
        $this->description = $laboratory->description;
    }

    public function render()
    {
        $laboratories = Laboratory::all();
        $motorcyclists = Motorcyclist::all();
        $customers = Customer::all();
        $locations = [];
    
        if($this->customer){
            $locations = Location::where("customer_id", $this->customer)->get();
        }

        return view('livewire.order.create',
            compact(
                'laboratories',
                'motorcyclists',
                'customers',
                'locations'
            )
        );
    }
}
