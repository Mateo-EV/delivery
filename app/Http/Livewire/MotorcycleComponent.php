<?php

namespace App\Http\Livewire;

use App\Models\Motorcyclist;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class MotorcycleComponent extends Component
{
    use WithPagination;

    public $search,
        $sort = "name",
        $direction = "asc",
        $length = 10;

    public $user, 
        $password,
        $license,
        $model,
        $km;

    public $open = false;

    protected $listeners = ['added' => 'added'];

    protected function rules(){
        return [
            'user.name' => 'required|min:10|max:160|string',
            'user.email' => 'required|min:5|max:255|email|unique:users,id,'.$this->user->id,
            'password' => [
                'nullable',
                'min:10',
                'max:60',
                Password::min(8)->numbers()->mixedCase()
            ],
            'user.dni' => 'required|string|size:8|regex:/^[0-9]{7,8}$/|unique:users,id,'.$this->user->id,
            'user.telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:20',
        ];
    }

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

    public function edit(User $user){
        $this->user = $user;
        $this->license = $user->motorcyclist->license;
        $this->model = $user->motorcyclist->model;
        $this->km = $user->motorcyclist->km;
        $this->open = true;
    }

    public function update(){
        $this->validate();

        $this->user->save();

        if($this->password){
            $this->user->update([
                "password" => Hash::make($this->password)
            ]);
        }

        $validated = $this->validate([
            'license' => 'required|min:5|max:20',
            'model' => 'required|min:7|max:7',
            'km' => 'required|numeric|min:0|max:200'
        ]);

        $this->user->motorcyclist()->update($validated);

        $this->reset(['user', 'password', 'license', 'model', 'km']);
        $this->sort = 'updated_at';
        $this->direction = 'desc';
        $this->open = false;
        $this->render();
        $this->resetPage();

        $this->emit('success', 'El motorizado se actualizó satisfactoriamente');
    }

    public function destroy(User $user){
        $user->motorcyclist()->delete();
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
        $this->emit('success', 'El usuario se eliminó satisfactoriamente');
        $this->render();
    }

    public function render()
    {
        $search = "%".$this->search."%";
        $motorcycles = Motorcyclist::join('users', 'motorcyclists.user_id', '=', 'users.id')
            ->where("license", "like", $search)
            ->orWhere("model", "like", $search)
            ->orWhere("km", "like", $search)
            ->orWhere("name", "like", $search)
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->length);
        return view('livewire.motorcycle-component', compact('motorcycles'));
    }
}