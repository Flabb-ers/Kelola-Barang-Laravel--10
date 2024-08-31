@extends('dashboard.layouts.main')

@section('container')
    <div class="container mt-5">
        <form action="/dashboard/kelola/{{ $barangs->id }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <img src="{{ asset('storage/'.$barangs->gambar) }}" class="img-thumbnail mb-3" alt="{{ $barangs->nama }}">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label for="gambar" class="form-label fw-bolder">Gambar</label>
                    <input type="file" id="gambar"
                        class="form-control border border-dark @error('gambar') is-invalid @enderror"
                        placeholder="Gambar Barang" value="{{ old('gambar') }}" name="gambar">
                    @error('gambar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="nama" class="form-label fw-bolder">Nama Barang</label>
                        <input type="text" id="nama"
                            class="form-control border border-dark @error('nama') is-invalid @enderror"
                            placeholder="Nama Barang" value="{{ old('nama', $barangs->nama) }}" name="nama">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label for="jumlah" class="form-label fw-bolder">Jumlah</label>
                        <input type="number" id="jumlah"
                            class="form-control border border-dark @error('jumlah') is-invalid @enderror"
                            placeholder="Jumlah Barang" value="{{ old('jumlah', $barangs->jumlah) }}" name="jumlah">
                        @error('jumlah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="kategori_id" class="form-label fw-bolder">Kategori</label>
                        <select id="kategori_id"
                            class="form-select border border-dark @error('kategori_id') is-invalid @enderror"
                            name="kategori_id">
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $barangs->kategori->id) == $kategori->id ? 'selected' : '' }}>
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

                    <div class="col-lg-6">
                        <label for="berat" class="form-label fw-bolder">Berat</label>
                        <input type="text" id="berat"
                            class="form-control border border-dark @error('berat') is-invalid @enderror"
                            placeholder="Berat Barang (Gram)" value="{{ old('berat', $barangs->berat) }}" name="berat">
                        @error('berat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="kode" class="form-label fw-bolder">Kode Barang</label>
                        <input type="text" id="kode"
                            class="form-control border border-dark @error('kode') is-invalid @enderror"
                            placeholder="Kode Barang" value="{{ old('kode', $barangs->kode) }}" name="kode">
                        @error('kode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label for="harga" class="form-label fw-bolder">Harga Barang</label>
                        <input type="number" id="harga"
                            class="form-control border border-dark @error('harga') is-invalid @enderror"
                            placeholder="Harga Barang" value="{{ old('harga', $barangs->harga) }}" name="harga">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="supplier" class="form-label fw-bolder">Supplier Barang</label>
                        <input type="text" id="supplier"
                            class="form-control border border-dark @error('supplier') is-invalid @enderror"
                            placeholder="Supplier Barang" value="{{ old('supplier', $barangs->supplier) }}"
                            name="supplier">
                        @error('supplier')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label for="tanggal" class="form-label fw-bolder">Tanggal Masuk</label>
                        <input type="date" id="tanggal"
                            class="form-control border border-dark @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal', $barangs->tanggal) }}" name="tanggal">
                        @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <button type="submit" name="submit" class="btn btn-primary w-100">Simpan</button>
                </div>
        </form>
    </div>
@endsection
