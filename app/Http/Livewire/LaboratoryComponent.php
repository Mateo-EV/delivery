<?php

namespace App\Http\Livewire;

use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithPagination;

class LaboratoryComponent extends Component
{
    use WithPagination;

    public $search,
        $sort = "name",
        $direction = "asc",
        $length = 10;

    public $open = false;

    public $laboratory;

    protected $listeners = ["added" => "added"];

    protected $rules = [
        "laboratory.name" => "required|max:160",
        "laboratory.description" => "required|max:500"
    ];

    public function order(string $sort){
        if($this->sort == $sort){
            $this->direction = $this->direction == 'desc' ? 'asc' : 'desc';
        } else{
            $this->direction = 'asc';
        }
        $this->sort = $sort;
    }

    public function added(){
        $this->sort = 'created_at';
        $this->direction = 'desc';
        $this->render();
        $this->resetPage();
    }

    public function destroy(Laboratory $laboratory){
        $laboratory->delete();
        $this->emit('success', 'El laboratorió se eliminó satisfactoriamente');
        $this->render();
    }

    public function edit(Laboratory $laboratory){
        $this->laboratory = $laboratory;
        $this->open = true;
    }

    public function update(){
        $this->validate();
        $this->laboratory->save();
        $this->reset('laboratory');
        $this->sort = 'updated_at';
        $this->direction = 'desc';
        $this->open = false;
        $this->render();
        $this->resetPage();

        $this->emit('success', 'El laboratorio se actualizó satisfactoriamente');
    }

    public function render()
    {
        $search = "%".$this->search."%";
        $laboratories = Laboratory::where("name", "like", $search)
                                ->orWhere("description", "like", $search)
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->length);
        return view('livewire.laboratory-component', compact('laboratories'));
    }
}
