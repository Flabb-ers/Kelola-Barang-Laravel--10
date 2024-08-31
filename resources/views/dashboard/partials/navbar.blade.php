<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <div class="row"></div>
            @if (request()->is('dashboard/home'))
                <h6 class="font-weight-bolder mb-0 text-lg text-dark">Dashboard</h6>
            @elseif(request()->is('dashboard/kelola*'))
                <h6 class="font-weight-bolder text-lg text-dark">Kelola Barang</h6>
            @elseif(Request::is('dashboard/keluar*'))
                <h6 class="font-weight-bolder text-lg text-dark">Barang Keluar</h6>
            @elseif(Request::is('dashboard/export'))
                <h6 class="font-weight-bolder text-lg text-dark">Cetak Laporan</h6>
            @elseif(Request::is('dashboard/kategori*'))
                <h6 class="font-weight-bolder text-lg text-dark">Kategori</h6>
            @elseif(Request::is('dashboard/addadmin*'))
                <h6 class="font-weight-bolder text-lg text-dark">Admin</h6>
            @endif
        </nav>
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
            </a>
        </li>
    </div>
</nav>
