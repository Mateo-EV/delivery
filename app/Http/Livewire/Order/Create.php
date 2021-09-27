<?php

namespace App\Http\Livewire\Order;

use App\Models\Customer;
use App\Models\Laboratory;
use App\Models\Location;
use App\Models\Motorcyclist;
use App\Models\Order;
use Livewire\Component;

class Create extends Component
{
    public $open = false;

    public $code,
        $document,
        $ndocument;

    public $customer,
        $address,
        $location,
        $district,
        $province,
        $reference;

    public $payment,
        $currency,
        $amount,
        $channel,
        $motorcyclist;

    public $arrival;

    public $laboratory,
        $description;

    public $newLocation = false;

    public $state = 0;

    public function save(){
        $this->validate([
            "code" => "required|max:10|regex:/^[0-9]+/",
            "laboratory" => "required|uuid|exists:laboratories,id",
            "document" => "required|in:BOLETA,FACTURA",
            "ndocument" => "required|max:10|regex:/^[0-9]+$/",
        ]);

        if($this->newLocation){
            $this->validate([
                "customer" => "required|uuid|exists:customers,id",
                "address" => "required|string|max:255",
                "province" => "required|string|max:100",
                "district" => "required|string|max:100",
                "reference" => "nullable|string|max:255"
            ]);
        } else{
            $location = $this->validate([
                "location" => "required|uuid|exists:locations,id"
            ]);
        }

        $this->validate(
            [
                "payment" => "required|in:CONTADO,CRÉDITO",
                "currency" => "required|in:SOL,DÓLAR",
                "channel" => "required|in:EFECTIVO,MASTERCARD,VISA,DEPÓSITO",
                "amount" => "required|regex:/^\d*(\.\d{1,2})?$/",
                "arrival" => "required|date_format:Y-m-d|after:today",
                "motorcyclist" => "required|exists:motorcyclists,user_id"
            ],
            [
                "arrival.after" => "El campo fecha de llegada debe ser una fecha posterior a hoy"
            ]
        );

        if($this->newLocation){
            $customer = Customer::find($this->custumer);
            $location = $customer->locations()->create([
                "address" => $this->address,
                "province" => $this->province,
                "district" => $this->district,
                "reference" => $this->reference,
            ]);
        }

        $order = new Order();
        $order->code = $this->code;
        $order->document = $this->document;
        $order->ndocument = $this->ndocument;
        $order->laboratory()->associate($this->laboratory);
        $order->costumer = $this->costumer;
        $order->code = $this->code;
    }

    public function updatedNewLocation(){
        $this->reset(["location", "district", "province", "reference", "address"]);
    }

    public function updatedLaboratory($laboratory){
        $laboratory = $laboratory ? Laboratory::find($laboratory) : "";
        if(!$laboratory){
            $this->reset('description');
        } else{
            $this->description = $laboratory->description;
        }
    }

    public function updatedCustomer(){
        $this->reset(["location", "district", "province", "reference", "address"]);
        $this->newLocation = false;
    }

    public function updatedLocation($location){
        if(!$this->newLocation){
            $location = $location ? Location::find($location) : "";
            if(!$location){
                $this->reset(['district', 'province', 'reference']);
            } else{
                $this->district = $location->district;
                $this->province = $location->province;
                $this->reference = $location->reference;
            }
        }
    }

    public function nextstate(){
        $rules = [
            [
                "code" => "required|max:10|regex:/^[0-9]+/",
                "laboratory" => "required|uuid|exists:laboratories,id",
                "document" => "required|in:BOLETA,FACTURA",
                "ndocument" => "required|max:10|regex:/^[0-9]+$/",
            ],
            [
                "customer" => "required|uuid|exists:customers,id",
                "address" => "required|string|max:255",
                "province" => "required|string|max:100",
                "district" => "required|string|max:100",
                "reference" => "nullable|string|max:255"
            ]
        ];

        if($this->state != 1){
            $validated = $this->validate($rules[$this->state]);
        } else{
            if($this->newLocation){
                $validated = $this->validate($rules[$this->state]);
            } else{
                $validated = $this->validate([
                    "location" => "required|uuid|exists:locations,id"
                ]);
            }
        }

        if($validated){
            $this->state++;
        }
    }

    public function render()
    {
        $laboratories = Laboratory::all();
        $motorcyclists = Motorcyclist::all();
        $customers = Customer::all();
        $locations = [];
    
        if($this->customer){
            $locations = Location::where("customer_id", $this->customer)->get();
            if($locations->count() == 0){
                $this->newLocation = true;
            }
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
