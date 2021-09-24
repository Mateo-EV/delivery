<?php

namespace App\Http\Livewire\Motorcycle;

use App\Http\Livewire\MotorcycleComponent;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $open = false;

    public $name,
        $email,
        $password, 
        $dni, 
        $telephone, 
        $license, 
        $model, 
        $km;

    protected function rules(){ 
        return [
            'name' => 'required|min:10|max:160|string',
            'email' => 'required|min:5|max:255|email|unique:users',
            'password' => [
                'required',
                'min:10',
                'max:60',
                Password::min(8)->numbers()->mixedCase()
            ],
            'dni' => 'required|string|size:8|regex:/^[0-9]{7,8}$/|unique:users',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:20',
            'license' => 'required|min:5|max:20',
            'model' => 'required|min:7|max:7',
            'km' => 'required|numeric|min:0|max:200'
        ];
    }

    public function save(){
        $this->validate();

        $user = User::create([
            "name" => $this->name,
            "email" => $this->email,
            "dni" => $this->dni,
            "telephone" => $this->telephone,
            "password" => Hash::make($this->password)
        ]);

        $user->assignRole('Motorizado');

        $user->motorcyclist()->create([
            "license" => $this->license,
            "model" => $this->model,
            "km" => $this->km
        ]);

        $this->reset(['name', 'email', 'password', 'dni', 'telephone', 'license', 'model', 'km']);
        $this->open = false;
        $this->emit('success', 'El motorizado se creó satisfactoriamente');
        $this->emitTo(MotorcycleComponent::class, 'added');
    }

    public function generate(){
        $this->password = Str::ucfirst(Str::random(10));
    }

    public function render()
    {
        return view('livewire.motorcycle.create');
    }
}
