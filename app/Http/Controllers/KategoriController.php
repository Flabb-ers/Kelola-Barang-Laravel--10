<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $kategoris = Kategori::all();
        return view("dashboard.kategori.index", compact("kategoris"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.kategori.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nama" => "required|alpha",
        ], [
            'nama.required' => 'Nama harus diisi!',
            'nama.alpha' => 'Nama hanya boleh berisi huruf.',
        ]);

        Kategori::create($validatedData);
        return redirect("/dashboard/kategori")->with("success","Kategori baru berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view("dashboard.kategori.edit",compact("kategori"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = kategori::findOrFail($id);
        $validateData = $request->validate([
            "nama"=>"required|alpha"
        ],[
            "nama.required"=>"Nama kategori tidak boleh kosong !",
            "nama.alpha"=>"Nama kategori harus huruf"
        ]);

        $kategori->update($validateData);
        return redirect("/dashboard/kategori")->with("success","Kategori berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect("/dashboard/kategori")->with("success","Kategori dihapus");
    }
}
