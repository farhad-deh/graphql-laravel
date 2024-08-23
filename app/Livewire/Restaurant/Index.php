<?php

namespace App\Livewire\Restaurant;

use App\Models\Restaurant;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{
    public Collection $restaurants;

    public function mount()
    {
        $this->restaurants = Restaurant::all();
    }

    public function render()
    {
        return view('livewire.restaurant.index');
    }
}
