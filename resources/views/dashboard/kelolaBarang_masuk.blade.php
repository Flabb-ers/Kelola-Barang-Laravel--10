@extends('dashboard.layouts.main')

@section('container')
    <div class="container mt-5">
        <form action="/dashboard/kelola" method="POST" class="mx-5" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="gambar" class="form-label fw-bolder">Gambar</label>
                    <input type="file" id="gambar" class="form-control border border-dark @error('gambar') is-invalid @enderror"
                        placeholder="Gambar Barang" value="{{ old('gambar') }}" name="gambar">
                    @error('gambar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nama" class="form-label fw-bolder">Nama Barang</label>
                    <input type="text" id="nama" class="form-control border border-dark @error('nama') is-invalid @enderror"
                        placeholder="Nama Barang" value="{{ old('nama') }}" name="nama">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="jumlah" class="form-label fw-bolder">Jumlah</label>
                    <input type="number" id="jumlah" class="form-control border border-dark @error('jumlah') is-invalid @enderror"
                        placeholder="Jumlah Barang" value="{{ old('jumlah') }}" name="jumlah">
                    @error('jumlah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="kategori_id" class="form-label fw-bolder">Kategori</label>
                    <select id="kategori_id" class="form-select border border-dark @error('kategori_id') is-invalid @enderror"
                        name="kategori_id">
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="berat" class="form-label fw-bolder">Berat</label>
                    <input type="text" id="berat" class="form-control border border-dark @error('berat') is-invalid @enderror"
                        placeholder="Berat Barang (Gram)" value="{{ old('berat') }}" name="berat">
                    @error('berat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="kode" class="form-label fw-bolder">Kode Barang</label>
                    <input type="text" id="kode" class="form-control border border-dark @error('kode') is-invalid @enderror"
                        placeholder="Kode Barang" value="{{ old('kode') }}" name="kode">
                    @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="harga" class="form-label fw-bolder">Harga Barang</label>
                    <input type="number" id="harga" class="form-control border border-dark @error('harga') is-invalid @enderror"
                        placeholder="Harga Barang" value="{{ old('harga') }}" name="harga">
                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="supplier" class="form-label fw-bolder">Supplier Barang</label>
                    <input type="text" id="supplier" class="form-control border border-dark @error('supplier') is-invalid @enderror"
                        placeholder="Supplier Barang" value="{{ old('supplier') }}" name="supplier">
                    @error('supplier')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tanggal" class="form-label fw-bolder">Tanggal Masuk</label>
                    <input type="date" id="tanggal" class="form-control border border-dark @error('tanggal') is-invalid @enderror"
                        value="{{ old('tanggal') }}" name="tanggal">
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
