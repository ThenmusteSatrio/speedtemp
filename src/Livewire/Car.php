<?php

namespace App\Livewire;

use App;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Car extends Component
{
    use WithFileUploads;
    protected $listeners = ["delete" => "delete", "getAllCars" => "getAllCars", "getUpdateData" => "getUpdateData"];
    public $cars;
    public $nopol;
    public $brand;
    public $type;
    public $tahun;
    public $harga;
    public $status;
    public $foto;
    public $savedImage;

    public $modalCar = false;
    public $updateCar = false;


    public function validationData()
    {
        $this->validate([
            "nopol" => "required",
            "brand" => "required",
            "type" => "required",
            "tahun" => "required",
            "harga" => "required",
            "status" => "required",
        ]);
    }

    public function store()
    {
        $this->validationData();
        $pathImage = $this->foto->store("cars", "public");
        $result = \App\Models\Car::create(
            [
                "nopol" => $this->nopol,
                "brand" => $this->brand,
                "type" => $this->type,
                "tahun" => $this->tahun,
                "harga" => $this->harga,
                "status" => $this->status,
                "foto" => $pathImage,
            ]
        );
        if ($result) {
            $this->modalCar = false;
            $this->dispatch("update");
            $this->reset(['nopol', 'brand', 'type', 'tahun', 'harga', 'status', 'foto']);
        } else {
            session()->flash('error', 'Terjadi Kesalahan, data gagal disimpan');
        }
    }
    public function delete($nopol)
    {
        $car = \App\Models\Car::find($nopol);
        $car->delete();
    }
    public function update($nopol)
    {
        $this->validationData();
        $car = \App\Models\Car::find($nopol)->first();
        if (!Storage::exists('public/' . $this->foto)) {
            $this->savedImage = $this->foto->store('cars', 'public');
        }

        $result = $car->update([
            "nopol" => $this->nopol,
            "brand" => $this->brand,
            "type" => $this->type,
            "tahun" => $this->tahun,
            "harga" => $this->harga,
            "status" => $this->status,
            "foto" => $this->savedImage,
        ]);

        if ($result) {
            $this->modalCar = false;
            $this->dispatch("update");
            $this->reset(['nopol', 'brand', 'type', 'tahun', 'harga', 'status', 'foto']);
        } else {
            session()->flash('error', 'Terjadi Kesalahan, data gagal disimpan');
        }

    }
    public function getUpdateData($nopol)
    {
        $car = \App\Models\Car::find($nopol)->first();
        $this->nopol = $car->nopol;
        $this->brand = $car->brand;
        $this->type = $car->type;
        $this->tahun = $car->tahun;
        $this->harga = $car->harga;
        $this->status = $car->status;
        $this->foto = $car->foto;
        $this->savedImage = $car->foto;

        $this->dispatch("reload");
        $this->modalCar = true;
        $this->updateCar = true;
    }
    public function getAllCars()
    {
        $this->cars = \App\Models\Car::all();
        $this->dispatch("reload");
    }
    public function showTambahMobil(){
        $this->modalCar = true;
        $this->updateCar = false;
        $this->dispatch("reload");
    }
    public function clearData()
    {
        $this->reset(['nopol', 'brand', 'type', 'tahun', 'harga', 'status', 'foto']);
        $this->getAllCars();
    }
    public function reloadCars(){
        $this->dispatch("reload");
    }
    public function mount()
    {
        $this->getAllCars();
    }
    public function render()
    {
        return view('livewire.car')->extends('layouts.master')->section('content');
    }
}
