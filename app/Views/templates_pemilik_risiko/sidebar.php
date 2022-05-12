<style>
.sidebar-dark .nav-item .nav-link:focus, .sidebar-dark .nav-item .nav-link:focus i, .sidebar-dark .nav-item .nav-link:hover, .sidebar-dark .nav-item .nav-link:hover i{
  background-color: rgba(255, 255, 255, 0.3);
  border-radius: 0;
}

.sidebar-dark .nav-item .nav-link, .sidebar-dark .nav-item .nav-link i{
  color: #fff;
  border-color: #fff;
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

.sidebar-dark .nav-item .nav-link.disabled, .sidebar-dark .nav-item .nav-link.disabled i{
    color: rgba(255, 255, 255, 0.5);
}

.bs-stepper-line{
    background-color: #fff; 
    max-height: 30px; 
    min-width:2px;
    max-width:2px;
    margin-left: 1.5rem;
    margin-bottom: 0px;
    margin-top: 0px;
}

.sidebar.toggled .bs-stepper-line{
    margin-left: auto;
    margin-right: auto;
    margin-top: 0px;
    margin-bottom: 0px;
}

@media (max-width: 768px){
    .bs-stepper-line{
    margin-left: auto;
    margin-right: auto;
    margin-top: 0px;
    margin-bottom: 0px;
    }
    .sampai{
        font-size: 0.5rem;
    }
}

</style> 
 


 <!-- Sidebar -->
 <ul class="navbar-nav  sidebar sidebar-dark accordion nav-pills" id="accordionSidebar" style="background-color: #8CBA08;" >

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-4" href="<?= base_url('pemilikRisiko/dashboard'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class=" fas fa-solid fa-book"></i>
        </div>
        <div class="sidebar-brand-text my-5">MANAJEMEN RISIKO SPBE</div>
    </a>


    <!-- Divider -->
    <hr class="sidebar-divider border-light my-0">

    <!-- Nav Item - Pages  Menu -->
    <li class="nav-item <?= ($active==='Dashboard') ? 'active' : ''; ?>">
        <a class="nav-link " href="<?= base_url('pemilikRisiko/dashboard'); ?>" >
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <br>

        <!-- Heading -->
    <div class="sidebar-heading" style="color: #fff;">
        Tahapan Manajemen Risiko
    </div>

       <!-- Divider -->
    <hr class="sidebar-divider border-light my-0">

    <!-- Nav Item - Utilities  Menu -->
    <li class="nav-item <?= ($active==='Penetapan Konteks Risiko SPBE') ? 'active' : ''; ?>">
        <a class="nav-link " href="<?= base_url('pemilikRisiko/penetapanKonteks'); ?>">
            <i class="fas fa-solid fa-database"></i>
            <span >Penetapan Konteks (2.0)</span>
        </a>
    </li>

    <div class="bs-stepper-line" ></div>

    <!-- Nav Item - Pages  Menu -->
    <li class="nav-item <?= ($active==='Penilaian Risiko SPBE') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('pemilikRisiko/penilaianRisiko'); ?>" >
            <i class="fas fa-solid fa-database"></i>
            <span>Penilaian Risiko (3.0)</span>
        </a>
    </li>

    <div class="bs-stepper-line"></div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= ($active==='Penanganan Risiko SPBE') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('pemilikRisiko/penangananRisiko'); ?>" >
            <i class="fas fa-solid fa-database"></i>
            <span>Penanganan Risiko (4.0)</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block border-light">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->