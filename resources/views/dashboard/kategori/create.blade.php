@extends('dashboard.layouts.main')

@section('container')
    <div class="mt-5 d-flex mx-auto justify-content-center">
        <form action="/dashboard/kategori" method="POST">
            @csrf
                <div>
                    <label for="nama" class="form-label fw-bolder">Nama Kategori</label>
                    <input type="text" id="nama" class="form-control border border-dark @error('nama') is-invalid @enderror"
                        placeholder="Nama Barang" value="{{ old('nama') }}" name="nama">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary d-flex mx-auto mt-3 ">Simpan</button>
        </form>
    </div>
@endsection
