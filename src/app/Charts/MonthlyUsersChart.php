<?php

namespace App\Charts;

use App\Models\Peminjaman;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class MonthlyUsersChart extends Chart
{
    protected $chart;

    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        parent::__construct();

    }

    public function build()
    {
        $peminjamanToday = Peminjaman::where("TglPinjam", now()->format('Y-m-d'))->count();
        $peminjamanTodayMin1 = Peminjaman::where("TglPinjam", now()->subDays(1)->format('Y-m-d'))->count();
        $peminjamanTodayMin2 = Peminjaman::where("TglPinjam", now()->subDays(2)->format('Y-m-d'))->count();
        $peminjamanTodayMin3 = Peminjaman::where("TglPinjam", now()->subDays(3)->format('Y-m-d'))->count();
        $peminjamanTodayMin4 = Peminjaman::where("TglPinjam", now()->subDays(4)->format('Y-m-d'))->count();
        $peminjamanTodayMin5 = Peminjaman::where("TglPinjam", now()->subDays(5)->format('Y-m-d'))->count();

        $pengembalianToday = Peminjaman::where("TglPengembalian", now()->format('Y-m-d'))->count();
        $pengembalianTodayMin1 = Peminjaman::where("TglPengembalian", now()->subDays(1)->format('Y-m-d'))->count();
        $pengembalianTodayMin2 = Peminjaman::where("TglPengembalian", now()->subDays(2)->format('Y-m-d'))->count();
        $pengembalianTodayMin3 = Peminjaman::where("TglPengembalian", now()->subDays(3)->format('Y-m-d'))->count();
        $pengembalianTodayMin4 = Peminjaman::where("TglPengembalian", now()->subDays(4)->format('Y-m-d'))->count();
        $pengembalianTodayMin5 = Peminjaman::where("TglPengembalian", now()->subDays(5)->format('Y-m-d'))->count();

        return $this->chart->areaChart()
            ->setTitle('Peminjaman & Pengembalian Harian')
            ->setSubtitle('Dalam periode 5 hari.')
            ->addData('Peminjaman', [$peminjamanTodayMin5, $peminjamanTodayMin4, $peminjamanTodayMin3, $peminjamanTodayMin2, $peminjamanTodayMin1, $peminjamanToday])
            ->addData('Pengembalian', [$pengembalianTodayMin5, $pengembalianTodayMin4, $pengembalianTodayMin3, $pengembalianTodayMin2, $pengembalianTodayMin1, $pengembalianToday])
            ->setXAxis([now()->subDays(5)->format('M d'), now()->subDays(4)->format('M d'), now()->subDays(3)->format('M d'), now()->subDays(2)->format('M d'), now()->subDays(1)->format('M d'), now()->format('M d')]);

        // return $this->chart->lineChart()
        //     ->setTitle('Peminjaman & Pengembalian Harian')
        //     ->setSubtitle('Dalam periode 5 hari.')
        //     ->addData('Peminjaman', [$peminjamanTodayMin5, $peminjamanTodayMin4, $peminjamanTodayMin3, $peminjamanTodayMin2, $peminjamanTodayMin1, $peminjamanToday])
        //     ->addData('Pengembalian', [$pengembalianTodayMin5, $pengembalianTodayMin4, $pengembalianTodayMin3, $pengembalianTodayMin2, $pengembalianTodayMin1, $pengembalianToday])
        //     ->setXAxis([now()->subDays(5)->format('M d'), now()->subDays(4)->format('M d'), now()->subDays(3)->format('M d'), now()->subDays(2)->format('M d'), now()->subDays(1)->format('M d'), now()->format('M d')]);
    }

}
