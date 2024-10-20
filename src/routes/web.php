<?php

use App\Http\Middleware\isLogin;
use App\Livewire\Car;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/')->middleware(isLogin::class);
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');


Route::middleware(['roleGuard:admin'])->group(function () {
    Route::get('/admin/control/panel/dashboard', Dashboard::class)->name('admin.panel.dashboard');
    Route::get('/admin/control/panel/cars', Car::class)->name('admin.panel.cars');
    Route::get('/admin/control/panel/petugas', Car::class)->name('admin.panel.cars');
});

Route::middleware(['roleGuard:member'])->group(function () {
    Route::get('/home', Home::class)->name('home');
});


Route::fallback(function () {
    return view('unauthorized');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});