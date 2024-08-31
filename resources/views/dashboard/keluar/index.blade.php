@extends('dashboard.layouts.main')
<style>
    .form-control {
        height: 2.5rem;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
    }

    .form-control::-ms-expand {
        display: none;
    }

    .form-control {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
</style>
@section('container')
    <div class="row">
        <div class="col-12">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show col-md-5" role="alert">
                    <strong>{{ session('success') }}!</strong>
                    <button type="button" class="btn-close btn-dark" data-bs-dismiss="alert" aria-label="Close"><i
                            class="material-icons opacity-10 text-s">close</i></button>
                </div>
            @endif
            @if (session()->has('gagal'))
                <div class="row">
                    <div class="alert alert-danger alert-dismissible fade show col-md-5" role="alert">
                        <strong>{{ session('gagal') }}!</strong>
                        <button type="button" class="btn-close btn-dark" data-bs-dismiss="alert" aria-label="Close"><i
                                class="material-icons opacity-10 text-s">close</i></button>
                    </div>
            @endif

            <form action="/dashboard/keluar" method="GET" class="mb-4 mx-auto mt-2">
                <div class="row">
                    <div class="col-md-12 col-sm-8 d-flex flex-column flex-sm-row mb-2 mb-sm-0">
                        <input type="text" name="cari" class="form-control mb-2 mb-sm-0 me-sm-2"
                            placeholder="Cari barang..." value="{{ request('cari') }}">
                            <input type="date" name="tanggal_awal" class="form-control me-sm-2 mb-2 mb-sm-0"
                            value="{{ request('tanggal_awal') }}" placeholder="Tanggal Awal">
                        <input type="date" name="tanggal_akhir" class="form-control me-sm-2 mb-2 mb-sm-0"
                            value="{{ request('tanggal_akhir') }}" placeholder="Tanggal Akhir">
                            <button type="submit" class="btn btn-dark w-100">
                                Cari
                            </button>
                    </div>
                    <div class="col-12 col-sm-8 offset-sm-2 d-flex align-items-center mb-1">
                        <select name="kategori" class="form-control" onchange="this.form.submit()">
                            <option value="" class="text-center">Semua Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" class="text-center"
                                    {{ request('kategori') == $item->id ? 'selected' : '' }}>{{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Tabel transaksi</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 align-middle text-center">
                                        No</th>
                                    <th
                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 align-middle text-center">
                                        Nama</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 align-middle text-center">
                                        Jumlah</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 align-middle text-center">
                                        Kategori</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 align-middle text-center">
                                        Harga</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 align-middle text-center">
                                        Tanggal</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 align-middle text-center">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barangKeluar as $keluar)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $keluar->nama }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $keluar->jumlah }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $keluar->kategori->nama }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">Rp.{{ $keluar->harga }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $keluar->tanggal }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex justify-content-center align-items-center ">
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="/dashboard/keluar/{{ $keluar->id }}/edit"
                                                        class="badge bg-success text-xs text-decoration-none mt-n3"><i
                                                            class="material-icons opacity-10 text-xs">edit</i> Edit</a>
                                                    <form action="/dashboard/keluar/batal/{{ $keluar->id }}" method="POST">
                                                        @csrf
                                                        <button type="button" onclick="confirmBatal(this)"
                                                            class="badge bg-primary border-0 d-inline text-xs text-decoration-none">
                                                            <i class="material-icons opacity-10 text-xs">archive</i> Kembali
                                                        </button>
                                                    </form>
                                                    <form action="/dashboard/keluar/{{ $keluar->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete(this)"
                                                            class="badge bg-danger border-0 d-inline text-xs text-decoration-none">
                                                            <i class="material-icons opacity-10 text-xs">delete</i> Hapus Transaksi
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-secondary text-xs font-weight-bold">
                                            Barang Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $barangKeluar->links() }}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Barang ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit(); 
                }
            });
        }

        function confirmBatal(button) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Proses ini akan dibatalkan!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batal!',
                cancelButtonText: 'Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit(); 
                }
            });
        }
    </script>
@endsection
