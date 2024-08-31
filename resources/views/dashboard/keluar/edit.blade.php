@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/dashboard/keluar/{{ $barangKeluar->id }}" method="POST" class="p-4 border rounded">
                @csrf
                @method("put")
                
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama Barang</label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror disabled" 
                           id="nama" 
                           name="nama" 
                           placeholder="Masukkan nama barang" 
                           value="{{ old('nama', $barangKeluar->nama) }}" disabled>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label fw-bold">Jumlah</label>
                    <input type="number" 
                           class="form-control @error('jumlah') is-invalid @enderror" 
                           id="jumlah" 
                           name="jumlah" 
                           placeholder="Masukkan jumlah barang" 
                           value="{{ old('jumlah', $barangKeluar->jumlah) }}">
                    @error('jumlah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
