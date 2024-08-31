@extends('dashboard.layouts.main')

@section('container')
    <div class="container mt-2 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-light" style="width: 100%;">
                    <img src="{{ asset('storage/' . $barang->gambar) }}" class="card-img-top" alt="{{ $barang->nama }}"
                        style="width: 100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $barang->nama }} | {{ $barang->kode }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Jumlah Barang:</strong> {{ $barang->jumlah }}</li>
                        <li class="list-group-item"><strong>Kategori Barang:</strong> {{ $barang->kategori->nama }}</li>
                        <li class="list-group-item"><strong>Supplier Barang:</strong> {{ $barang->supplier }}</li>
                        <li class="list-group-item"><strong>Harga Barang:</strong> {{ $barang->harga }}</li>
                        <li class="list-group-item"><strong>Berat Barang:</strong> {{ $barang->berat }}</li>
                        <li class="list-group-item"><strong>Tanggal Masuk:</strong> {{ $barang->tanggal }}</li>
                        <div class="card-body ">
                            <a href="/dashboard/kelola" class="badge bg-success text-decoration-none"><i
                                    class="material-icons opacity-10 text-xs">arrow_back</i> Kembali</a>
                            <a href="/dashboard/kelola/{{ $barang->id }}/edit"
                                class="badge bg-warning me-2 text-xs text-decoration-none"><i
                                    class="material-icons opacity-10 text-xs">edit</i> Edit</a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 15px;
        }

        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .list-group-item {
            font-size: 16px;
        }
    </style>
@endpush
