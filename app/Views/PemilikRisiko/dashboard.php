<?= $this->extend('templates_pemilik_risiko/index'); ?>
<?= $this->section('content'); ?>

<style>
  .page-item.active .page-link {
    color: black;
    background-color: #fff;
    border-color: black;
    font-weight: bold;
}

.page-link:hover {
    color:  black;
    background-color: #F6FFDD;

}

.page-link {
    color: black;
    background-color: #fff;
 
}
.table{
    color: black;
}

.btn.float-right{
    background-color: #8CBA08; 
    border-color: #8CBA08; 
    color:#fff;
}
.btn.float-right:hover{
    background-color:#A1D70A;
}


table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before,
table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control:before {
    background-color: #8CBA08;

}

table.dataTable.dtr-inline.collapsed > tbody > tr.parent > td.dtr-control:before,
table.dataTable.dtr-inline.collapsed > tbody > tr.parent > th.dtr-control:before{
    background-color:#858796;
}

.dropdown-item.active, .dropdown-item:active {
  color: #fff;
  text-decoration: none;
  background-color: #858796;
}

a:hover {
  		color: #858796;
  		text-decoration: underline;

}

</style>

<div class="mb-2">
    <h1 class="h3  text-gray-800 font-weight-bold" style="text-transform: uppercase;">
        <a href="<?= base_url('pemilikRisiko'). '/'. $link ?>"><?= $title ?></a>
    </h1>
    <ol class="breadcrumb px-3 py-2 rounded mb-0">
        <li class="breadcrumb-item active">
            <?= $title ?>
        </li>
    </ol>
</div>

<div id="flash"><?= session()->flash; ?></div>

<!-- DataTales Example -->
<div class="row">
    <div class="col-sm-7">
        <div class="card shadow  my-5 mx-2">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #fff; color: black;">
            <h6 class="m-0 font-weight-bold ">Daftar Risiko</h6>          
        </div>
        <div class="card-body">
            <div class="table-responsive" id="tabel-risikoDashboard">
            </div>
        </div>
    </div>
    </div>
    <div class="col-sm-5">
        <div class="card shadow  my-5 mx-2">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #fff; color: black;">
            <h6 class="m-0 font-weight-bold ">Jumlah Risiko Berdasarkan Level Risikonya</h6>                
        </div>
        <div class="card-body">
            <div class="chart-bar">
        		<canvas id="myBarChart"></canvas>
        	</div>
        </div>
    </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <div class="card shadow  my-2 mx-2">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #fff; color: black;">
            <h6 class="m-0 font-weight-bold ">Jumlah Risiko Berdasarkan Kategori Risiko</h6>          
        </div>
        <div class="card-body">
            <div class="chart-bar">
        		<canvas id="myBarChart1"></canvas>
        	</div>
        </div>
    </div>
    </div>
    <div class="col-sm-5">
        <div class="card shadow  my-2 mx-2">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #fff; color: black;">
            <h6 class="m-0 font-weight-bold ">Jumlah Risiko Berdasarkan Area Dampak Risiko</h6>                
        </div>
        <div class="card-body">
            <div class="chart-bar">
        		<canvas id="myBarChart2"></canvas>
        	</div>
        </div>
    </div>
    </div>
</div>



<?= $this->endSection(); ?>
