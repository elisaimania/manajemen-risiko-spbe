<?= $this->extend('templates_pengelola_risiko/index'); ?>
<?= $this->section('content'); ?>

<style>
	.btn.float-right.tambah {
    background-color: #8CBA08; 
    border-color: #8CBA08; 
    color:#fff;
}
	.btn.float-right.tambah:hover{
    background-color:#A1D70A;
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
                        <label for="nama_unit">Nama Unit</label>
                        <input type="text" class="form-control" id="nama_unit" name="nama_unit" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="hubungan">Hubungan</label>
                        <textarea  class="form-control" id="hubungan" name="hubungan" required></textarea> 
                    </div>
                </div>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                	<a href="<?= base_url('pengelolaRisiko/pemangkuKepentingan'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
                	<button type="submit" class="btn tambah float-right m-3" name="tambah" style="width: 120px; height: 40px;">
                    Tambah
                	</button>
                </div>
                
            </form>                
        </div>
    </div>
</div>
</div>
 
<?= $this->endSection(); ?>