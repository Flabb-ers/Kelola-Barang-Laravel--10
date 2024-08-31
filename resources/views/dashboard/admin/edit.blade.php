@extends('dashboard.layouts.main');
@section('container')
<h5 class="d-flex mx-auto justify-content-center">Edit Admin</h5>
<div class="mt-1 d-flex mx-auto justify-content-center">
    <form action="/dashboard/addadmin/{{ $user->id }}" method="POST">
        @method("put")
        @csrf
            <div>
                <label for="name" class="form-label fw-bolder">Nama</label>
                <input type="text" id="name" class="form-control border border-dark @error('name') is-invalid @enderror"
                    placeholder="name Barang" value="{{ old('name',$user->name) }}" name="name">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="email" class="form-label fw-bolder">Email</label>
                <input type="text" id="email" class="form-control border border-dark @error('email') is-invalid @enderror"
                    placeholder="email Barang" value="{{ old('email',$user->email) }}" name="email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="password" class="form-label fw-bolder">Password</label>
                <input type="text" id="password" class="form-control border border-dark @error('password') is-invalid @enderror"
                    placeholder="password Barang" value="{{ old('password') }}" name="password">
                @error('password')
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