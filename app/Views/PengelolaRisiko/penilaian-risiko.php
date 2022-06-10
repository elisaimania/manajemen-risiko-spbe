<?= $this->extend('templates_pengelola_risiko/index'); ?>
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
.btn.float-right.hijau{
    background-color: #8CBA08; 
    border-color: #8CBA08; 
    color:#fff;
}
.btn.float-right.hijau:hover{
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
        <h6 class="m-0 font-weight-bold ">Penilaian Risiko SPBE (3.0)</h6>                  
    </div>
    <div class="card-body">
        <div class="form-group">
             <div class="row">
                <div class="col">
                </div>
                <div class="col">
                    <a href="<?= base_url('pengelolaRisiko/inputPenilaianRisiko'); ?>" class="btn float-right hijau" >Tambah</a>
                    <a href="<?= base_url('pengelolaRisiko/importPenilaianRisiko'); ?>" class="btn float-right mr-3 hijau" >Import Excel</a>
                    <a href="<?= base_url('pengelolaRisiko/hapusPenilaianRisiko'); ?>" class="btn btn-danger float-right mr-3" onclick="return confirm('Apakah Anda yakin untuk menghapus semua data ini?')">Hapus Semua Data</a>
                </div>
            </div>
        </div>
        <div class="table-responsive" id="tabel-penilaianRisiko">
        </div>
    </div>
</div>


<?= $this->endSection(); ?>