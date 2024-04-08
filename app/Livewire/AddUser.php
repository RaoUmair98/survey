<?php

namespace App\Livewire;

use App\Mail\UserCreatedMail;
use App\Models\Role;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;


class AddUser extends Component
{

    public $email;
    public $name;
    public $reportsTo;
    public $role_id;
    public $users;
    public $roles;
    public User $user;
    public $showDiv = false;


    public function mount()
    {
        $this->user = new User();
        $this->users = User::all();
        $this->roles = Role::where('id', '>', Auth::user()->role_id)->get();
    }

    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|email|unique:users,email',
        'reportsTo' => 'required',
        'role_id' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {


        $validatedData = $this->validate();
        $password = "password";



        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($password),
            'role_id' => $this->role_id,
            'manager_id' =>  $this->reportsTo,

        ]);


        session()->flash('success_message', 'User :' . $this->name . ' successfully added.');

        $manager = User::find($this->reportsTo);
        // $response = Password::sendResetLink(["email" => $this->email]);
        Mail::to($user)->send(new  UserCreatedMail());
       
        $this->reset();
        $this->roles = Role::where('id', '>', Auth::user()->role_id)->get();

    }

    public function openDiv()
    {


        $this->users = User::where('role_id', '<', $this->role_id)->get();
        $this->showDiv = !$this->showDiv;
    }

    public function render()
    {
        return view('livewire.add-user');
    }
}
