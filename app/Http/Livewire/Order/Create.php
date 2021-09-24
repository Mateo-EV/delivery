<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;

class Create extends Component
{
    public $open = false;

    public function save(){
        
    }

    public function render()
    {
        return view('livewire.order.create');
    }
}
