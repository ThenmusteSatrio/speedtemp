<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCar extends Component
{
    public function render()
    {
        return view('livewire.add-car');
    }
}
