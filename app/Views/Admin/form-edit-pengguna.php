<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>
<?php $val = service('validation') ?>
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
                    	<label for="nama">Nama Pengguna</label>
                    	<input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?= $pengguna['nama_pengguna']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                    	<label for="username">Username</label>
                    	<input type="text" class="form-control" id="username" name="username" value="<?= $pengguna['username'] ?>" required>
                    </div>
                </div>
                <div class="form-group">
    				<label for="nama_role">Pilih Role Pengguna</label>
    				<select class="form-control" id="nama_role" name="nama_role" required>
    					<?php foreach ($role as $r ) : ?>
                            <option value="<?= $r['nama_role']; ?>" <?php if ($r['id']==$pengguna['id_role']) {
                                echo "selected";
                            }  ?> ><?= $r['nama_role']; ?></option>
                        <?php endforeach; ?>
 				</select>
  				</div>
                <div class="form-group">
                	<label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $pengguna['email']; ?>" required>
                </div>
                <div class="col">
                </div>
                <div class="col">
                	<a href="<?= base_url('admin/daftarPengguna'); ?>" class="btn  btn-secondary float-right m-3" style="border-radius: 30px; width: 120px; height: 40px;">Batal</a>
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