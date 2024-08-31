<?php

namespace App\Charts;

use App\Models\Barang;
use App\Models\Keluar;
use Illuminate\Support\Carbon;
use ArielMejiaDev\LarapexCharts\LineChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BulananBarangChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): LineChart
{
    // Array bulan
    $months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Augustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    // Inisialisasi array untuk menyimpan data
    $barangMasuk = array_fill(0, 12, 0);
    $barangKeluar = array_fill(0, 12, 0);

    // Mengambil data barang masuk dan keluar per bulan
    foreach ($months as $index => $month) {
        $startDate = Carbon::create(now()->year, $index + 1, 1)->startOfMonth();
        $endDate = Carbon::create(now()->year, $index + 1, 1)->endOfMonth();
        
        $barangMasuk[$index] = Barang::whereBetween('tanggal', [$startDate, $endDate])->count();
        $barangKeluar[$index] = Keluar::whereBetween('tanggal', [$startDate, $endDate])->count();
    }

    return (new LineChart)
        ->setTitle('Barang Masuk dan Barang Keluar per Bulan')
        ->setSubtitle('Data Bulanan untuk Tahun Ini')
        ->addData('Barang Masuk', $barangMasuk)
        ->addData('Barang Keluar', $barangKeluar)
        ->setXAxis($months);
}
}
