<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Keluar;
use App\Models\Kategori;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use App\Rules\UniqueKodeAcrossKeluarAndBarang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
      
        return view("dashboard.kelolabarang",[
            "barangs"=>Barang::latest()->filter(request(["cari","kategori","tanggal_awal","tanggal_akhir"]))->paginate(5),
            "kategori"=>Kategori::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): view
    {
        return view("dashboard.kelolaBarang_masuk", [
            "kategoris" => Kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validate = $request->validate([
            "gambar" => "required|image|mimes:jpg,jpeg,png",
            "nama" => "required|string",
            "jumlah" => "required|integer",
            "kategori_id" => "required",
            "kode" => [
                'required',
                new UniqueKodeAcrossKeluarAndBarang(),
            ],
            "berat" => "required",
            "harga" => "required|integer",
            "supplier" => "required|string",
            "tanggal" => "required|date"
        ], [
            'gambar.required' => 'Gambar harus diunggah.',
            'gambar.image' => 'File gambar harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat jpg, jpeg, atau png.',
            'nama.required' => 'Nama barang harus diisi.',
            'nama.string' => 'Nama barang harus berupa teks.',
            'jumlah.required' => 'Jumlah barang harus diisi.',
            'jumlah.integer' => 'Jumlah barang harus berupa angka.',
            'kategori_id.required' => 'Kategori barang harus diisi.',
            'kode.required' => 'Kode barang harus diisi.',
            'kode.unique' => 'Kode barang harus unik di antara data barang dan keluar.',
            'berat.required' => 'Berat barang harus diisi.',
            'harga.required' => 'Harga barang harus diisi.',
            'harga.integer' => 'Harga barang harus berupa angka.',
            'supplier.required' => 'Supplier barang harus diisi.',
            'supplier.string' => 'Supplier barang harus berupa teks.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Tanggal harus berupa tanggal yang valid.',
        ]);
        
        $gambar = $request->file("gambar");

        $hashGambar =md5(time() . $gambar->getClientOriginalName()) . '.' . $gambar->getClientOriginalExtension();
        $validate["gambar"] = $gambar->storeAs('images', $hashGambar, 'public');

        Barang::create($validate);

        return redirect("/dashboard/kelola")->with("success", "Barang berhasil masuk");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): view
    {
        return view("dashboard.kelolaBarang_lihat", [
            "barang" => Barang::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): view
    {
        $barangs = Barang::findOrFail($id);
        return view("dashboard.kelolaBarang_edit", [
            "barangs" => $barangs,
            "kategoris" => Kategori::all()
        ]);
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
    $barang = Barang::findOrFail($id);

    // Aturan validasi dasar
    $rules = [
        'nama' => 'required|string',
        'jumlah' => 'required|integer',
        'kategori_id' => 'required',
        'berat' => 'required',
        'harga' => 'required|integer',
        'supplier' => 'required|string',
        'tanggal' => 'required|date',
    ];


    if ($request->kode != $barang->kode) {
        $rules['kode'] = 'required|unique:barangs,kode';
    }

    $rules['gambar'] = 'image|mimes:jpeg,png,jpg|file|max:2048';

    $messages = [
        'nama.required' => 'Nama barang harus diisi.',
        'jumlah.required' => 'Jumlah barang harus diisi.',
        'jumlah.integer' => 'Jumlah barang harus berupa angka.',
        'kategori_id.required' => 'Kategori barang harus diisi.',
        'berat.required' => 'Berat barang harus diisi.',
        'harga.required' => 'Harga barang harus diisi.',
        'harga.integer' => 'Harga barang harus berupa angka.',
        'supplier.required' => 'Supplier barang harus diisi.',
        'tanggal.required' => 'Tanggal harus diisi.',
        'tanggal.date' => 'Tanggal harus berupa tanggal yang valid.',
        'kode.required' => 'Kode barang harus diisi.',
        'kode.unique' => 'Kode barang sudah terdaftar, gunakan kode lain.',
        'gambar.image' => 'File gambar harus berupa gambar.',
        'gambar.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
        'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
    ];

    $validateData = $request->validate($rules,$messages);

    if ($request->hasFile('gambar')) {
        if ($barang->gambar) {
            Storage::delete('public/' . $barang->gambar);
        }
        $filePath = $request->file('gambar')->store('images', 'public');
        $validateData['gambar'] = $filePath;
    } else {
        $validateData['gambar'] = $barang->gambar;
    }
    Barang::where('id', $id)->update($validateData);
    return redirect('/dashboard/kelola')->with('success', 'Barang berhasil diupdate');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect("/dashboard/kelola")->with("success", "Barang berhasil dihapus");
    }


    public function keluar($id)
    {
        $barang = Barang::findOrFail($id);
        return view("dashboard.kelolaBarang_keluar", compact("barang"));
    }
    public function keluarStore(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validatedData = $request->validate([
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'nullable|date',
        ],[
            "jumlah.integer"=>"Jumlah harus angka",
            "jumlah.min"=>"Minimal 1"
        ]);

        $validatedData['kategori_id'] = $barang->kategori_id;
        $validatedData['gambar'] = $barang->gambar;
        $validatedData['barang_id'] = $barang->id;
        $validatedData['berat'] = $barang->berat;
        $validatedData['nama'] = $barang->nama;
        $validatedData['kode'] = $barang->kode;
        $validatedData['harga'] = $barang->harga;
        $validatedData['supplier'] = $barang->supplier;
        $validatedData['tanggal'] = $validatedData['tanggal'] ?? now()->toDateString();



        if ($barang->jumlah > $validatedData['jumlah']) {
            $barang->jumlah -= $validatedData['jumlah'];
            $barang->save();
            Keluar::create($validatedData);
        } 
        elseif ($barang->jumlah == $validatedData["jumlah"]){
            $barang->jumlah -=$validatedData["jumlah"];
            $barang->save();
            Keluar::create($validatedData);
        } 
        elseif ($barang->jumlah < $validatedData["jumlah"]) {
            return redirect("/dashboard/kelola")->with('gagal', 'Jumlah barang yang tersedia tidak mencukupi');
        }
        return redirect("/dashboard/keluar")->with("success", "Barang berhasil keluar");
    }
}
