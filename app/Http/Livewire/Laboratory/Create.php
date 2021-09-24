<?php

namespace App\Http\Livewire\Laboratory;

use App\Http\Livewire\LaboratoryComponent;
use App\Models\Laboratory;
use Livewire\Component;

class Create extends Component
{
    public $open = false;

    public $name, 
        $description;
    
    protected $rules = [
        "name" => "required|max:160",
        "description" => "required|max:500"
    ];

    public function save(){
        $laboratory = $this->validate();
        Laboratory::create($laboratory);
        $this->reset(['name', 'description']);
        $this->open = false;
        $this->emit('success', 'El laboratorio se creó satisfactoriamente');
        $this->emitTo(LaboratoryComponent::class, 'added');
    }

    public function render()
    {
        return view('livewire.laboratory.create');
    }
}
