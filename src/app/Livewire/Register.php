<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required', message: 'NIK is Required.')]
    public $nik;
    #[Validate('required', message: 'Nama is Required.')]
    public $nama;
    #[Validate('required', message: 'Username is Required.')]
    public $username;
    #[Validate('required', message: 'Please select Jenis Kelamin.')]
    public $jk;
    #[Validate('required', message: 'Please enter phone number.')]
    public $notelp;
    #[Validate('required', message: 'Please enter password.')]
    public $password;
    #[Validate('required', message: 'Alamat is Required.')]
    public $alamat;
    public function register()
    {
        $this->validate();
        $member = Member::create([
            "nik" => $this->nik,
            "nama" => $this->nama,
            "user" => $this->username,
            "jk" => $this->jk,
            "telp" => $this->notelp,
            "alamat" => $this->alamat,
            "password" => bcrypt($this->password),
        ]);
        if ($member) {
            return redirect('/login');
        } else {
            session()->flash('error', 'terjadi kesalahan, coba lagi nanti');
        }
    }
    public function render()
    {
        return view('auth.register')->extends('layouts.master')->section('content');
    }
}
