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
a {
    
}

</style>

<div class="mb-2">
    <h1 class="h3  text-gray-800 font-weight-bold" style="text-transform: uppercase;">
        <a href="<?= base_url('pengelolaRisiko'). '/'. $link ?>"><?= $title ?></a>
    </h1>
    <ol class="breadcrumb px-3 py-2 rounded mb-0">
        <li class="breadcrumb-item active">
            <a href="<?= base_url('pengelolaRisiko'). '/'. $link ?>"><?= $title ?></a>
        </li>
        <li class="breadcrumb-item">
            <?= $subtitle ?>
        </li>

    </ol>
</div>

<div id="flash"><?= session()->flash; ?></div>
                    
<!-- DataTales Example -->
<div class="card shadow  m-5">
    <div class="card-body">
        <div class="form-group">
             <div class="row">
                <div class="col">
                </div>
                <div class="col">
                    <a href="<?= base_url('pengelolaRisiko/inputSeleraRisiko'); ?>" class="btn float-right hijau" >Tambah Data</a>
                    <a href="<?= base_url('pengelolaRisiko/importSeleraRisiko'); ?>" class="btn float-right mr-3 hijau" >Import Excel</a>
                    <a href="<?= base_url('pengelolaRisiko/hapusSeleraRisiko'); ?>" class="btn btn-danger float-right mr-3" onclick="return confirm('Apakah Anda yakin untuk menghapus semua data ini?')">Hapus Semua Data</a>
                </div>
            </div>
        </div>
        <div class="table-responsive" id="tabel-seleraRisiko">
        </div>
    </div>
</div>

               
<?= $this->endSection(); ?>