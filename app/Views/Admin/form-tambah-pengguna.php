<?= $this->extend('templates/index'); ?>
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
        	<form class="user" method="post" action="<?= base_url('admin/inputDataPengguna') ?>">
        		<?= ($val->hasError('nama_pengguna')) ? '<span class="text-sm text-danger" style="font-size:15px">' . $val->getError('nama_pengguna') .'*</span>' : ''; ?>
                <div class="form-group row">
                    <div class="col">
                    	<label for="nama_pengguna">Nama Pengguna</label>
                    	<input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?= old('nama_pengguna'); ?>" required>
                    </div>
                </div>
                <?= ($val->hasError('username')) ? '<span class="text-sm text-danger" style="font-size:15px">' . $val->getError('username') .'*</span>' : ''; ?>
                <div class="form-group row">
                    <div class="col">
                    	<label for="username">Username</label>
                    	<input type="text" class="form-control" id="username" name="username" value="<?= old('username'); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="upr">Pilih Unit Pemilik Risiko</label>
                    <select class="form-control" id="upr" name="upr" required>
                        <?php foreach ($upr as $r ) : ?>
                            <option value="<?= $r['id']; ?>"><?= $r['nama_role']; ?></option>
                        <?php endforeach; ?>
                </select>
                </div>
                <div class="form-group">
    				<label for="nama_role">Pilih Role Pengguna</label>
    				<select class="form-control" id="nama_role" name="nama_role" required>
    					<?php foreach ($role as $r ) : ?>
                            <option value="<?= $r['nama_role']; ?>"><?= $r['nama_role']; ?></option>
                        <?php endforeach; ?>
 				</select>
  				</div>
  				<?= ($val->hasError('email')) ? '<span class="text-sm text-danger" style="font-size:15px">' . $val->getError('email') .'*</span>' : ''; ?>
                <div class="form-group">
                	<label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email'); ?>" required>
                </div>
                <?= ($val->hasError('password')) ? '<span class="text-sm text-danger" style="font-size:15px">' . $val->getError('password') .'*</span>' : ''; ?>
                <?= ($val->hasError('konfirmasi_password')) ? '<br><span class="text-sm text-danger" style="font-size:15px">' . $val->getError('konfirmasi_password') .'*</span>' : ''; ?>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                    	<label for="password">Password</label>
                        <input type="password" class="form-control" id="password" value="<?= old('password'); ?>" name="password">
                    </div>
                    <div class="col-sm-6">
                    	<label for="konfimasi_password">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="konfimasi_password" name="konfirmasi_password" value="<?= old('konfirmasi_password'); ?>">
                    </div>
                </div>
                <div class="col">
                </div>
                <div class="col">
                	<a href="<?= base_url('admin/daftarPengguna'); ?>" class="btn  btn-secondary float-right m-3" style="border-radius: 30px; width: 120px; height: 40px;">Batal</a>
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