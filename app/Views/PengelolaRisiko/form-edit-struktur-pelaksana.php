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
                <div class="form-group">
                    <label for="nama_role">Pilih Role</label>
                    <select class="form-control" id="nama_role" name="nama_role" required>
                        <?php foreach ($role as $r ) : ?>
                            <option value="<?= $r['nama_role']; ?>" <?= ($strukturPelaksanaId['id_role']==$r['id']) ? 'selected' : ''; ?>><?= $r['nama_role']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="pelaksana">Pelaksana</label>
                        <input type="text" class="form-control" id="pelaksana" name="pelaksana" required value="<?= $strukturPelaksanaId['pelaksana']; ?>">
                    </div>
                </div>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                	<a href="<?= base_url('pengelolaRisiko/strukturPelaksana'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
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