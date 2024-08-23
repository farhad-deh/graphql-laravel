<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Register extends Component
{
    public function register()
    {
        dd('test');
    }

    public function render()
    {
        $name = "farhad" ;
        return view('livewire.auth.register',compact('name'));
    }
}
