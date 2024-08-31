<style>
    .dropdown-item.dropdown-toggle::after {
        content: "\25bc";
        /* Unicode for down arrow */
        font-size: 0.8em;
        margin-left: 0.5em;
        display: inline-block;
        vertical-align: middle;
    }
</style>
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
            target="_blank">
            <img src={{ asset('img/logo-ct.png') }} class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Kelola Barang | Dhimas</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard/home') ? 'active' : '' }}"
                    href="/dashboard/home">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard/kelola*') ? 'active' : '' }}"
                    href="/dashboard/kelola">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">inventory</i>
                    </div>
                    <span class="nav-link-text ms-1">Kelola Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard/keluar*') ? 'active' : '' }} "
                    href="/dashboard/keluar">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">unarchive</i>
                    </div>
                    <span class="nav-link-text ms-1">Barang Keluar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard/kategori*') ? 'active' : '' }}"
                    href="/dashboard/kategori">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">category</i>
                    </div>
                    <span class="nav-link-text ms-1">Kategori</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard/addadmin*') ? 'active' : '' }}"
                    href="/dashboard/addadmin">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">admin_panel_settings</i>
                    </div>
                    <span class="nav-link-text ms-1">Tambah Admin</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Request::is('dashboard/export*') ? 'active' : '' }}"
                    href="/dashboard/export">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>
            <hr class="horizontal light mt-0 mb-2">    
            <li class="nav-item mt-3">
                <form action="/logout" method="POST" class="nav-link text-white p-0 d-flex align-items-center justify-content-between" style="background: none; border: none;">
                    @csrf
                    <button type="submit" class="btn text-white d-flex align-items-center justify-content-start w-100" style="background: none; border: none; padding-left: 16px;">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">logout</i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </button>
                </form>
            </li>              
        </ul>
    </div>
</aside>
