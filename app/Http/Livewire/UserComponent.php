<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserComponent extends Component
{
    use WithPagination;

    public $user, 
        $name,
        $email,
        $password, 
        $dni, 
        $telephone, 
        $rol, 
        $license, 
        $model, 
        $km;

    public $open = false, $open_edit = false;

    public $isMotorized = false;

    public $length = 10,
        $sort = 'name',
        $direction = 'asc',
        $search;

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
            'rol' => 'in:1,2,3'
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

    public function edit(User $user){
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->dni = $user->dni;
        $this->telephone = $user->telephone;
        $this->rol = $user->roles[0]->id;
        $this->updatedRol();
        if($user->roles[0]->name == "Motorizado"){
            $this->license = $user->motorcyclist->license;
            $this->model = $user->motorcyclist->model;
            $this->km = $user->motorcyclist->km;
        }
        $this->open_edit = true;
    }

    public function update(){
        $validated = $this->validate([
            'name' => 'required|min:10|max:160|string',
            'email' => 'required|min:5|max:255|email|unique:users,id,'.$this->user->id,
            'password' => [
                'nullable',
                'min:10',
                'max:60',
                Password::min(8)->numbers()->mixedCase()
            ],
            'dni' => 'required|string|size:8|regex:/^[0-9]{7,8}$/|unique:users,id,'.$this->user->id,
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:20',
            'rol' => 'in:1,2,3'
        ]);

        if($this->rol == 3){
            $validatedMotor = $this->validate([
                'license' => 'required|min:5|max:20',
                'model' => 'required|min:7|max:7',
                'km' => 'required|numeric|min:0|max:200'
            ]);
        }
        
        if(!$this->password){
            unset($validated["password"]);
        } else{
            $validated["password"] = Hash::make($validated["password"]);
        }

        $this->user->update($validated);

        if($this->rol == 3){
            $this->user->motorcyclist()->update($validatedMotor);
        }

        $this->emit('success', 'El usuario se editó satisfactoriamente');
        $this->render();
    }

    public function updatedRol(){
        if($this->rol == 3){
            $this->isMotorized = true;
        } else{
            $this->isMotorized = false;
        }
    }

    public function save()
    {
        $this->validate();

        if($this->rol == 3){
            $this->validate([
                'license' => 'required|min:5|max:20',
                'model' => 'required|min:7|max:7',
                'km' => 'required|numeric|min:0|max:200'
            ]);
        }

        $user = User::create([
            "name" => $this->name,
            "email" => $this->email,
            "dni" => $this->dni,
            "telephone" => $this->telephone,
            "password" => Hash::make($this->password)
        ]);

        $user->roles()->sync([$this->rol]);

        if($this->rol == 3){
            $user->motorcyclist()->create([
                "license" => $this->license,
                "model" => $this->model,
                "km" => $this->km
            ]);
        }
        $this->resetAll();
        $this->sort = 'created_at';
        $this->direction = 'desc';
        $this->open = false;
        $this->emit('success', 'El usuario se creó satisfactoriamente');
        $this->render();
        $this->resetPage();
    }

    public function resetAll(){
        $this->reset(['name', 'email', 'password', 'dni', 'telephone', 'rol', 'license', 'model', 'km']);
    }

    public function generate(){
        $this->password = Str::ucfirst(Str::random(10));
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function destroy(User $user)
    {
        if($user->roles[0]->name == "Motorizado"){
            $user->motorcyclist()->delete();
        }
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
        $this->emit('success', 'El usuario se eliminó satisfactoriamente');
        $this->render();
    }

    public function render()
    {
        $users = User::where("name", "like", "%".$this->search."%")
            ->orWhere("email", "like", "%".$this->search."%")
            ->orWhere("dni", "like", "%".$this->search."%")
            ->orWhere("telephone", "like", "%".$this->search."%")
            ->orWhereHas("roles", function (Builder $query){$query->where('name', 'like', "%".$this->search."%");})
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->length);

        $roles = Role::all();

        return view('livewire.user-component', compact('users', 'roles'));
    }
}
