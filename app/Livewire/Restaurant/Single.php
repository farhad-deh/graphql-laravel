<?php

namespace App\Livewire\Restaurant;

use App\Models\Restaurant;
use Livewire\Component;

class Single extends Component
{
    public Restaurant $restaurant;

    public function render()
    {
        return view('livewire.restaurant.single');
    }
}
