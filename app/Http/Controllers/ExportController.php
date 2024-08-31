<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keluar;
use Illuminate\Http\Request;
use App\Exports\BarangMasukExport;
use App\Exports\BarangKeluarExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function index(Request $request)
    {   
        $tipe = $request->input('tipe');
        $tanggalMulai = $request->input('start_date');
        $tanggalSelesai = $request->input('end_date');
        $barangs = [];
    
        if ($tipe === 'barang_masuk') {
            $barangs = Barang::whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])->get();
        } elseif ($tipe === 'barang_keluar') {
            $barangs = Keluar::whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])->get();
        }
    
        return view('dashboard.export.index', compact('barangs', 'tipe', 'tanggalMulai', 'tanggalSelesai'));
    }

    public function export(Request $request)
    {
        
        $request->validate([
            'type' => 'required|in:barang_masuk,barang_keluar',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        if ($type === 'barang_masuk') {
            return Excel::download(new BarangMasukExport($startDate, $endDate), 'barang_masuk.xlsx');
        } elseif ($type === 'barang_keluar') {
            return Excel::download(new BarangKeluarExport($startDate, $endDate), 'barang_keluar.xlsx');
        }
        return redirect()->back()->with('error', 'Invalid type selected');
    }
}
