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
                <div class="form-group">
                    <label for="id_kategori_risiko">Pilih Kategori Risiko</label>
                    <select class="form-control selectpicker" id="id_kategori_risiko" name="id_kategori_risiko[]" multiple required data-live-search="true">
                        <option value=""></option>
                        <?php foreach ($kategoriRisiko as $r ) : ?>
                            <option value="<?= $r['id']; ?>"><?= $r['kategori_risiko']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col mt-3">
                </div>
                <div class="col mt-3">
                	<a href="<?= base_url('pengelolaRisiko/kategoriRisikoTerpilih'); ?>" class="btn  btn-secondary float-right m-3" style="border-radius: 30px; width: 120px; height: 40px;">Batal</a>
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