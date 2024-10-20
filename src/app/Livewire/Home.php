<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;

class Home extends Component
{
    public $cars;
    public $car;
    public function setCar($car){
        $this->car = $car;
    }
    public $explore = false;
    public function getCars(){
        $this->cars = Car::all();
    }
    public function render()
    {
        return view('users.home')->extends('layouts.master')->section('content');
    }
}
