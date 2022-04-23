<?= $this->extend('templates_risiko/index'); ?>
<?= $this->section('content'); ?>
<?php $val = service('validation') ?>
<style>
	.btn.float-left.tambah {
    background-color: #8CBA08; 
    border-color: #8CBA08; 
    color:#fff;
}
	.btn.float-left.tambah:hover{
    background-color:#A1D70A;
}
	.form-control{
		border: 2px solid #d1d3e2;

	}
    .form-control[readonly]{
        background-color: #fff;
}


</style>

<div class="mb-2">
    <h1 class="h3  text-gray-800 font-weight-bold" style="text-transform: uppercase;">
        <a href="<?= base_url('pengelolaRisiko'). '/'. $link ?>"><?= $title ?></a>
    </h1>
    <ol class="breadcrumb px-3 py-2 rounded mb-0">
        <li class="breadcrumb-item ">
            <a href="<?= base_url('pengelolaRisiko'). '/'. $link ?>"><?= $title ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="<?= base_url('pengelolaRisiko'). '/'. $sublink ?>"><?= $subtitle ?></a>
        </li>
        <li class="breadcrumb-item active">
            <?= $subsubtitle ?>
        </li>
    </ol>
</div>
                    
<!-- DataTales Example -->
<div id="flash"><?= session()->flash; ?></div>
<div class="row justify-content-center">
<div class="card shadow  m-5  col-sm-8 ">
    <div class="card-body ">
    	<br>
    	<br>
        <div class="form-group">
        	<form class="user" method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col">
                        <a class="btn btn-secondary mb-3" href="<?= base_url('pengelolaRisiko/downloadTemplateExcel/'. $template); ?>" >Download Template</a>
                    </div>
                    <div class="col">
                    	<input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx">
                        <button type="submit" class="btn tambah float-left mt-3" name="tambah" style=" width: 120px; height: 40px;">
                            Import
                	    </button>
                    </div>
                </div>
            </form>                
        </div>
    </div>
</div>
</div>
 
<?= $this->endSection(); ?>