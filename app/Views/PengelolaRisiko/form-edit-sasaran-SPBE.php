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
                    	<label for="sasaran_UPR_SPBE">Sasaran UPR SPBE</label>
                    	<textarea type="text" class="form-control" id="sasaran_UPR_SPBE" name="sasaran_UPR_SPBE" required ><?= $sasaranSPBEId['sasaran_UPR_SPBE'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="sasaran_SPBE">Sasaran SPBE</label>
                        <textarea  class="form-control" id="sasaran_SPBE" name="sasaran_SPBE" required><?= $sasaranSPBEId['sasaran_SPBE'] ?></textarea> 
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="indikator_kinerja_SPBE">Indikator Kinerja SPBE</label>
                        <input  class="form-control" id="indikator_kinerja_SPBE" name="indikator_kinerja_SPBE" required value="<?= $sasaranSPBEId['indikator_kinerja_SPBE'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="target_kinerja">Target Kierja SPBE</label>
                        <input  class="form-control" id="target_kinerja" name="target_kinerja" required value="<?= $sasaranSPBEId['target_kinerja'] ?>">
                    </div>
                </div>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                	<a href="<?= base_url('pengelolaRisiko/sasaranSPBE'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
                	<button type="submit" class="btn tambah float-right m-3" name="submit" style="width: 120px; height: 40px;">
                    Ubah
                	</button>
                </div>
                
            </form>                
        </div>
    </div>
</div>
</div>
 
<?= $this->endSection(); ?>