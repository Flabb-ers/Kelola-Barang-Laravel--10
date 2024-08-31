<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keluar;
use App\Models\Kategori;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('dashboard.keluar.index', [
            "barangKeluar"=>Keluar::latest()->filter(request(["cari","kategori","tanggal_awal","tanggal_akhir"]))->paginate(5),
            "kategori"=>Kategori::all()
        ]);
        
    }
    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): view
    {
        $barangKeluar = Keluar::findOrFail($id);
        return view("dashboard.keluar.edit", compact("barangKeluar"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $barangKeluar = Keluar::findOrFail($id);
    $barangMasuk = Barang::where("kode", $barangKeluar->kode)->first();
    $rules = [
        "jumlah" => "required|numeric|min:1"
    ];

    $message = [
        "jumlah.numeric" => "Jumlah harus berupa angka",
        "jumlah.min"=>"Minimal 1"
    ];

    $validateData = $request->validate($rules,$message);
    $jumlahRequest = $request->jumlah;

    if ($barangMasuk) {
        if ($jumlahRequest == $barangKeluar->jumlah) {
            $barangMasuk->delete();
        } elseif ($jumlahRequest > $barangKeluar->jumlah) {
            $operasi = $jumlahRequest - $barangKeluar->jumlah;
            if ($barangMasuk->jumlah >= $operasi) {
                $barangMasuk->jumlah -= $operasi;
                $barangMasuk->save();
            } else {
                return redirect("/dashboard/keluar")->with("gagal", "Jumlah barang masuk tidak mencukupi !");
            }
        } elseif ($jumlahRequest < $barangKeluar->jumlah) {
            $operasi = $barangKeluar->jumlah - $jumlahRequest;
            $barangMasuk->jumlah += $operasi;
            $barangMasuk->save();
        }
    } else {
        Barang::create([
            "nama" => $barangKeluar->nama,
            "kode" => $barangKeluar->kode,
            "kategori_id" => $barangKeluar->kategori_id,
            "jumlah" => $barangKeluar->jumlah,
            "berat" => $barangKeluar->berat,
            "harga" => $barangKeluar->harga,
            "supplier" => $barangKeluar->supplier,
            "tanggal" => now()->toDateString()
        ]);
    }

    Keluar::where("id", $id)->update($validateData);
    return redirect("/dashboard/keluar")->with("success", "Barang berhasil diupdate");
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keluar = Keluar::findOrFail($id);
        $keluar->delete();
        return redirect("/dashboard/keluar")->with("success", "Barang berhasil terhapus");
    }

    public function batal($id)
    {
        $keluar = Keluar::find($id);
        $barang = Barang::where("kode", $keluar->kode)->first();
        if ($barang) {
            $barang->jumlah += $keluar->jumlah;
            $barang->save();
            $keluar->delete();
        } else {
            $input = [
                "nama" => $keluar->nama,
                "jumlah" => $keluar->jumlah,
                "kategori_id" => $keluar->kategori_id,
                "kode" => $keluar->kode,
                "berat" => $keluar->berat,
                "harga" => $keluar->harga,
                "supplier" => $keluar->supplier,
                "tanggal" => now()->toDateString()
            ];
            Barang::create($input);
            $keluar->delete();
        }
        return redirect("/dashboard/keluar")->with("success", "Barang berhasil dibatalkan");
    }
}
