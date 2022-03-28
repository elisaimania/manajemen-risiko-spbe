<?= $this->extend('templates_risiko/index'); ?>
<?= $this->section('content'); ?>
<?php $val = service('validation') ?>
<style>
	.btn.float-right.tambah {
    background-color: #8CBA08; 
    border-color: #8CBA08; 
    color:#fff;
}
	.btn.float-right.tambah:hover{
    background-color:#A1D70A;
}
	.form-control{
		border: 2px solid #d1d3e2;
		border-radius: 20px;

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
        	<form class="user" method="post" action="">
                <div class="form-group row">
                    <div class="col">
                    	<label for="nama_UPR">Nama UPR SPBE</label>
                    	<input type="text" class="form-control" id="nama_UPR" name="nama_UPR" required value="<?= old('nama_UPR'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="tugas_UPR">Tugas UPR SPBE</label>
                        <textarea  class="form-control" id="tugas_UPR" name="tugas_UPR" required><?= old('tugas_UPR'); ?></textarea> 
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="fungsi_UPR">Fungsi UPR SPBE</label>
                        <textarea  class="form-control" id="fungsi_UPR" name="fungsi_UPR" required><?= old('fungsi_UPR'); ?></textarea> 
                    </div>
                </div>
                <?= ($val->hasError('tanggal_mulai')) ? '<br><span class="text-sm text-danger" style="font-size:15px">' . $val->getError('tanggal_mulai') .'*</span>' : ''; ?>
                <div class="form-group row">
                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <label for="periode">Periode Waktu</label>
                        <input type="date" class="form-control" id="periode" name="tanggal_mulai" required value="<?= old('tanggal_mulai'); ?>">
                    </div>
                    <div class="col-sm-2 text-center sampai" style="margin-top: 35px;">
                        Sampai
                    </div>
                    <div class="col-sm-5">
                        <label for="periode" style="color: #fff;">Periode Waktu</label>
                        <input type="date" class="form-control" id="periode" name="tanggal_selesai" required value="<?= old('tanggal_selesai'); ?>">
                    </div>
                </div>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                	<a href="<?= base_url('pengelolaRisiko/informasiUmum'); ?>" class="btn  btn-secondary float-right m-3" style="border-radius: 30px; width: 120px; height: 40px;">Batal</a>
                	<button type="submit" class="btn tambah float-right m-3" name="tambah" style="border-radius: 30px; width: 120px; height: 40px;">
                    Tambah
                	</button>
                </div>
                
            </form>                
        </div>
    </div>
</div>
</div>
 
<?= $this->endSection(); ?>