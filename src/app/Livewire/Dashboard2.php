<?php

namespace App\Livewire;

use App\Charts\BukuChart;
use App\Charts\MonthlyUsersChart;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Peminjaman;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalKategori;
    public $totalBuku;
    public $totalUsers;
    public $totalJumlahPeminjaman;
    public $bukuCharts;

    public $arrayOfBook;
    public $arrayTitle;


    public function mount()
    {
        $buku = Peminjaman::select('BukuId', \DB::raw('count(BukuId) as occurrences'))->groupBy('BukuId')->orderBy('occurrences', 'desc')->limit(5)->get();
        $peminjaman = Peminjaman::count();
        $this->arrayOfBook = $buku->map(function ($buku) use ($peminjaman) {
            return Peminjaman::where("BukuId", $buku->BukuId)->count() / $peminjaman * 100;
        });

        $this->arrayTitle = $buku->map(function ($buku) {
            return $buku->buku->judul;
        });

        $this->totalKategori = KategoriBuku::count();
        $this->totalBuku = Buku::count();
        $this->totalJumlahPeminjaman = $peminjaman;
        $this->totalUsers = User::where("role", "user")->count();
        $harusDikembalikan = Peminjaman::where("Status", "Belum Dikembalikan")->where("TglPengembalian", now()->format('Y-m-d'))->update(["Status" => "Dikembalikan"]);
    }
    public function render(MonthlyUsersChart $peminjamanChart)
    {
        return view('admin.dashboard', ['peminjamanChart' => $peminjamanChart->build()])->extends('layouts.master')->section('content');
    }
}
