<?= $this->extend('templates_admin/index'); ?>
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
        <a href="<?= base_url('admin'). '/'. $link ?>"><?= $title ?></a>
    </h1>
    <ol class="breadcrumb px-3 py-2 rounded mb-0">
        <li class="breadcrumb-item ">
            <a href="<?= base_url('admin'). '/'. $link ?>"><?= $title ?></a>
        </li>
        <li class="breadcrumb-item active">
            <?= $subtitle ?>
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
                    	<label for="opsi_penanganan">Opsi Penanganan Risiko SPBE</label>
                    	<input type="text" class="form-control" id="opsi_penanganan" name="opsi_penanganan" value="<?=$penanganan['opsi_penanganan']?>" required>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="jenis_risiko">Pilih Jenis Risiko SPBE</label>
                    <select class="form-control" id="jenis_risiko" name="jenis_risiko" required>
                        <option value="" ></option>
                        <?php foreach ($daftarJenisRisiko as $r ) : ?>
                            <option value="<?= $r['jenis_risiko']; ?>" <?= ($penanganan['id_jenis_risiko']==$r['id']) ? 'selected' : ''; ?> ><?= $r['jenis_risiko']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                </div>
                <div class="col">
                	<a href="<?= base_url('admin/daftarPenanganan'); ?>" class="btn  btn-secondary float-right m-3" style=" width: 120px; height: 40px;">Batal</a>
                	<button type="submit" class="btn tambah float-right m-3" name="submit" style="width: 120px; height: 40px;">
                    Edit
                	</button>
                </div>
                
            </form>                
        </div>
    </div>
</div>
</div>
 
<?= $this->endSection(); ?>