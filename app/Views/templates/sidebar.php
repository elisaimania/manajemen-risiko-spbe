<style>
.sidebar-dark .nav-item .nav-link:focus, .sidebar-dark .nav-item .nav-link:focus i, .sidebar-dark .nav-item .nav-link:hover, .sidebar-dark .nav-item .nav-link:hover i{
  background-color: rgba(255, 255, 255, 0.3);
  border-radius: 0;
}

.sidebar-dark .nav-item .nav-link, .sidebar-dark .nav-item .nav-link i{
  color: #fff;
}

.sidebar-dark .nav-item.active .nav-link {
  color: #fff;
}

.sidebar-dark .nav-item.active .nav-link i{
  color: #fff;
}

.nav-pills .nav-item.active,
.nav-pills .show > .nav-item {
  background-color:rgba(255, 255, 255, 0.3);;
  border-radius: 0;
  font-weight: bold;
}

.sidebar-dark #sidebarToggle {
  background-color: rgba(255, 255, 255, 0.4);
}

.sidebar-dark #sidebarToggle:hover {
  background-color: rgba(255, 255, 255, 0.7);
}


</style> 
 


 <!-- Sidebar -->
 <ul class="navbar-nav  sidebar sidebar-dark accordion nav-pills" id="accordionSidebar" style="background-color: #8CBA08;" >

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-4" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class=" fas fa-solid fa-book"></i>
        </div>
        <div class="sidebar-brand-text my-5">MANAJEMEN RISIKO SPBE</div>
    </a>





    <!-- Heading -->
    <div class="sidebar-heading text-light">
        Menu
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider border-light">

    <!-- Nav Item - Pages  Menu -->
    <li class="nav-item <?= ($active==='Daftar Pengguna') ? 'active' : ''; ?>">
        <a class="nav-link " href="<?= base_url('admin/daftarPengguna'); ?>" >
            <i class="fas fa-fw fa-table "></i>
            <span>Daftar Pengguna</span>
        </a>
    </li>

    <!-- Nav Item - Utilities  Menu -->
    <li class="nav-item <?= ($active==='Daftar Kategori') ? 'active' : ''; ?>">
        <a class="nav-link " href="<?= base_url('admin/daftarKategori'); ?>">
            <i class="fas fa-fw fa-table "></i>
            <span >Daftar Kategori Risiko</span>
        </a>
    </li>

    <!-- Nav Item - Pages  Menu -->
    <li class="nav-item <?= ($active==='Daftar Dampak') ? 'active' : ''; ?>">
        <a class="nav-link " href="<?= base_url('admin/daftarDampak'); ?>" >
            <i class="fas fa-fw fa-table "></i>
            <span>Daftar Area Dampak Risiko</span>
        </a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= ($active==='Daftar Penanganan') ? 'active' : ''; ?>">
        <a class="nav-link " href="<?= base_url('admin/daftarPenanganan'); ?>" >
            <i class="fas fa-fw fa-table"></i>
            <span>Daftar Opsi Penanganan Risiko</span></a>
    </li>



    <!-- Divider -->
    <br>
    <br>
    <hr class="sidebar-divider d-none d-md-block border-light">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->