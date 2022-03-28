<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<style>
	.btn.float-right.tambah, .btn.float-right.edit{
    background-color: #8CBA08; 
    border-color: #8CBA08; 
    color:#fff;
}
	.btn.float-right.tambah:hover, .btn.float-right.edit:hover{
    background-color:#A1D70A;
}
	.form-control{
		border: 2px solid #d1d3e2;
		border-radius: 20px;

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
        <div class="col"></div>
        <div class="col">
            <a href="<?= base_url('admin/editPassword'). '/'. $id; ?>" class="btn float-right edit" style="border-radius: 30px; width: 200px; height: 40px;">Ubah Password</a>
        </div>
    	<br>
    	<br>
        <div class="form-group">
        	<form class="user" method="post" action="">
                <div class="form-group row">
                    <div class="col">
                        <label for="kategori_risiko">Kategori Risiko SPBE</label>
                        <input type="text" class="form-control" id="kategori_risiko" name="kategori_risiko" value="<?= $kategori['kategori_risiko']; ?>" required>
                    </div>
                </div>
                <div class="col">
                </div>
                <div class="col">
                	<a href="<?= base_url('admin/daftarKategori'); ?>" class="btn  btn-secondary float-right m-3" style="border-radius: 30px; width: 120px; height: 40px;">Batal</a>
                	<button type="submit" class="btn tambah float-right m-3" name="submit" style="border-radius: 30px; width: 120px; height: 40px;">
                    Edit
                	</button>
                </div>
                
            </form>                
        </div>
    </div>
</div>
</div>
 
<?= $this->endSection(); ?>