@extends('dashboard.layouts.main')
@section('container')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">archive</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Barang Masuk</p>
                            <h4 class="mb-0">{{ $jumlahBarang }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-dark text-sm font-weight-bolder">{{ $tanggalFormat }}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">unarchive</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Barang Keluar</p>
                            <h4 class="mb-0">{{ $jumlahKeluar }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-dark text-sm font-weight-bolder">{{ $tanggalFormat }}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-danger shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">unarchive</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Barang Keluar</p>
                            <h4 class="mb-0">{{ $totalKeluar }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-dark text-sm font-weight-bolder">{{ $tanggalFormat }}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-warning shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">inventory_2</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Barang</p>
                            <h4 class="mb-0">{{ $totalBarang }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-dark text-sm font-weight-bolder">{{ $tanggalFormat }}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-4 mx-auto">
            <div class="p-3 mx-n4 my-3 bg-white rounded shadow">
                {!! $chart->container() !!}
            </div>
        </div>
    @section('js')
        <script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}
    @endsection
@endsection
