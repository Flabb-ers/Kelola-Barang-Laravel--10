@extends('dashboard.layouts.main')

@section('container')
<div class="row mb-4 container justify-content-center">
    <form action="{{ route('export.index') }}" method="GET" class="row g-3 align-items-center">
        <div class="col-md-3">
            <label for="tipe" class="form-label">Pilih Tipe Data:</label>
            <select name="tipe" id="tipe" class="form-select">
                <option value="barang_masuk" {{ request('tipe') == 'barang_masuk' ? 'selected' : '' }}>Barang Masuk</option>
                <option value="barang_keluar" {{ request('tipe') == 'barang_keluar' ? 'selected' : '' }}>Barang Keluar</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="start_date" class="form-label">Tanggal Mulai:</label>
            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">Tanggal Selesai:</label>
            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary mt-5"><i class="material-icons opacity-10">search</i>Tampilkan</button>
        </div>
    </form>
</div>

@if(isset($barangs) && count($barangs) > 0)
    <h5 class="mb-4">Daftar Data {{ $tipe === 'barang_masuk' ? 'Barang Masuk' : 'Barang Keluar' }}</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Stock</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Supplier</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->nama }}</td>
                        <td>{{ $barang->jumlah }}</td>
                        <td>{{ $barang->kategori->nama }}</td>
                        <td>{{ $barang->harga }}</td>
                        <td>{{ $barang->supplier }}</td>
                        <td>{{ $barang->tanggal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <form action="{{ route('export') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="type" value="{{ $tipe }}">
        <input type="hidden" name="start_date" value="{{ $tanggalMulai }}">
        <input type="hidden" name="end_date" value="{{ $tanggalSelesai }}">
        <button type="submit" class="btn btn-success"><i class="material-icons opacity-10">save</i> Ekspor ke Excel</button>
    </form>
@elseif(isset($data))
    <p class="mt-4 text-danger">Data tidak ditemukan untuk rentang tanggal yang dipilih.</p>
@endif

@endsection
