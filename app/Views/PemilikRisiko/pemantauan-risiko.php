<?= $this->extend('templates_pemilik_risiko/index'); ?>
<?= $this->section('content'); ?>

<style>
  .page-item.active .page-link {
    color: #fff;
    background-color: #8CBA08;
    border-color: #8CBA08;
}

.page-link:hover {
    color:  #8CBA08;
    background-color: #F6FFDD;

}

.page-link {
    color: #8CBA08;
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
        <a href="<?= base_url('pengelolaRisiko'). '/'. $link ?>"><?= $title ?></a>
    </h1>
    <ol class="breadcrumb px-3 py-2 rounded mb-0">
        <li class="breadcrumb-item active">
            <?= $title ?>
        </li>
        <li class="breadcrumb-item"></li>
    </ol>
</div>

<div id="flash"><?= session()->flash; ?></div>

<!-- DataTales Example -->
<div class="card shadow  mt-5 mx-2 mb-2">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #fff; color: black;">
        <h6 class="m-0 font-weight-bold ">Laporan Pemantauan Risiko SPBE (5.0)</h6>                  
    </div>
    <div class="card-body">
        <div class="table-responsive" id="tabel-pemantauanRisiko">
        </div>
    </div>
</div>


<?= $this->endSection(); ?>