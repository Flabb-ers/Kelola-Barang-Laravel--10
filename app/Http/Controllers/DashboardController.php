<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Keluar;
use Illuminate\Http\Request;
use App\Charts\BulananBarangChart;
use Illuminate\Routing\Controller;


class DashboardController extends Controller
{

    public function index(BulananBarangChart $data)
    {
        $chart=$data->build();
        $tanggal = now()->toDateString();
        $jumlahBarang = Barang::whereDate("tanggal", $tanggal)->count();
        $jumlahKeluar = Keluar::whereDate("tanggal", $tanggal)->count();
        $totalBarang = Barang::with("kategori","keluar")->count();
        $totalKeluar = Keluar::with("kategori","barang")->count();
        $tanggalFormat = Carbon::parse($tanggal)->format('d F Y');
        return view("dashboard.index", compact(["tanggalFormat", "jumlahBarang", "jumlahKeluar", "totalBarang","totalKeluar","chart"]));
    }
}
