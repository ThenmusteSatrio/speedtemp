<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('admin.dashboard')->extends('layouts.master')->section('content');
    }
}
