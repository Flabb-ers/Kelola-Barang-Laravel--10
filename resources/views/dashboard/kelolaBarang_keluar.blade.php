@extends('dashboard.layouts.main')

@section('container')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form id="keluarBarangForm" action="/dashboard/kelola/keluar/{{ $barang->id }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Nama Barang</label>
                        <input type="text" id="disabledTextInput" class="form-control border-dark" value="{{ $barang->nama }}" disabled>
                    </div>
                    <input type="hidden" value="{{ $barang->gambar }}" name="gambar">
                    <p class="text-xs fw-bold">Jumlah barang saat ini {{ $barang->jumlah }}</p>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Barang Keluar</label>
                        <input type="number" class="form-control border-dark" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Barang keluar" required>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="button" id="submitButton">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('submitButton').addEventListener('click', function() {
            // Validate if the jumlah field is filled
            const jumlahInput = document.getElementById('jumlah').value;
            if (jumlahInput === '') {
                Swal.fire({
                    title: 'Error',
                    text: 'Jumlah barang keluar harus diisi!',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return; // Prevent form submission if validation fails
            }

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Barang ini akan dikeluarkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, keluarkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('keluarBarangForm').submit(); // Submit the form if confirmed
                }
            });
        });
    </script>
@endsection
