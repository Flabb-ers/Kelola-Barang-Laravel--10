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
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show col-md-5 mb-2-" role="alert">
                        <strong>{{ session('success') }}!</strong>
                        <button type="button" class="btn-close btn-dark" data-bs-dismiss="alert" aria-label="Close"><i
                                class="material-icons opacity-10 text-s">close</i></button>
                    </div>
                @endif
                @if (session()->has('gagal'))
                    <div class="alert alert-danger alert-dismissible fade show col-md-5" role="alert">
                        <strong>{{ session('gagal') }}!</strong>
                        <button type="button" class="btn-close btn-dark" data-bs-dismiss="alert" aria-label="Close"><i
                                class="material-icons opacity-10 text-s">close</i></button>
                    </div>
                @endif

                <form action="/dashboard/kelola" method="GET" class="mb-4 mx-auto mt-n3">
                    <div class="row">
                        <div class="col-md-12 col-sm-8 d-flex flex-column flex-sm-row mb-2 mb-sm-0">
                            <input type="text" name="cari" class="form-control mb-2 mb-sm-0 me-sm-2"
                                placeholder="Cari barang..." value="{{ request('cari') }}">
                                <input type="date" name="tanggal_awal" class="form-control me-sm-2 mb-2 mb-sm-0"
                                value="{{ request('tanggal_awal') }}" placeholder="Tanggal Awal">
                            <input type="date" name="tanggal_akhir" class="form-control me-sm-2 mb-2 mb-sm-0"
                                value="{{ request('tanggal_akhir') }}" placeholder="Tanggal Akhir">
                                <button type="submit" class="btn btn-dark w-100">
                                    <i class="material-icons opacity-10">search</i>
                                    Cari
                                </button>
                        </div>
                        <div class="col-12 col-sm-8 offset-sm-2 d-flex align-items-center mt-n1 mb-1">
                            <select name="kategori" class="form-control" onchange="this.form.submit()">
                                <option value="" class="text-center">Semua Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('kategori') == $item->id ? 'selected' : '' }}>{{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                <a href="/dashboard/kelola/create" class="badge bg-success text-decoration-none mb-2 mt-n3"><i
                        class="material-icons opacity-10 text-xs">archive</i>masuk</a>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tabel Barang</h6>
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
                                    @forelse ($barangs as $barang)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $barang->nama }} |
                                                    {{ $barang->kode }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold @if ($barang->jumlah == 0) text-danger @endif">
                                                    {{ $barang->jumlah }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><a
                                                        href="/dashboard/kelola?kategori={{ $barang->kategori->id }}">{{ $barang->kategori->nama }}</a></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">Rp.{{ $barang->harga }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $barang->tanggal }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="/dashboard/kelola/keluar/{{ $barang->id }}"
                                                        class="badge bg-dark me-2 text-xs text-decoration-none"><i
                                                            class="material-icons opacity-10 text-xs">unarchive</i> Barang
                                                        Keluar</a>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="/dashboard/kelola/{{ $barang->id }}/edit"
                                                            class="badge bg-warning me-2 text-xs text-decoration-none"><i
                                                                class="material-icons opacity-10 text-xs">edit</i> Edit</a>
                                                        <a href="{{ route('kelola.show', $barang->id) }}"
                                                            class="badge bg-info me-2 text-xs text-decoration-none">
                                                            <i class="material-icons opacity-10 text-xs">visibility</i>
                                                            Lihat
                                                        </a>
                                                        <form id="delete-form-{{ $barang->id }}"
                                                            action="{{ route('kelola.destroy', $barang->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <button type="button" onclick="confirmDelete({{ $barang->id }})"
                                                            class="badge bg-danger border-0 d-inline text-xs text-decoration-none">
                                                            <i class="material-icons opacity-10 text-xs">delete</i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-secondary text-xs font-weight-bold">
                                                Barang Kosong</td>
                                        </tr>
                                        </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $barangs->links() }}
            </div>
            <script>
                function confirmDelete(id) {
                    Swal.fire({
                        title: 'Anda yakin?',
                        text: "Data ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                }
            </script>
        @endsection
