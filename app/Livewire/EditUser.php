<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class EditUser extends Component
{

    public $userId;
    public $roles;
    public $users;
    public $user;
    public $showDiv = false;
    public $rules = [];

    public function mount()
    {

        $this->user = User::find($this->userId);
        $this->users = User::all();
        $this->roles = Role::where('id', '>', Auth::user()->role_id)->get();
        $this->rules = [
            'user.name' => 'required|string|min:6',
            'user.email' => 'required|email|unique:users,email,' . $this->user->id,
            'user.manager_id' => 'required',
            'user.role_id' => 'required',
        ];
    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function openDiv($id)
    {
        $this->users = User::where('role_id', '<', $id)->get();
        $this->dispatch('$refresh');
    }


    public function submit()
    {


        $validatedData = $this->validate();
        $this->user->update($validatedData);




        session()->flash('success_message', 'User :' . $this->user->name . ' successfully updated.');

        return redirect()->route('UserManagement',['role_id' => 1]);
    }



    public function render()
    {
        
        
        return view('livewire.edit-user');
    }
}
