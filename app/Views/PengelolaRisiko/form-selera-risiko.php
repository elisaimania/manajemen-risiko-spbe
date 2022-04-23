<?= $this->extend('templates_pengelola_risiko/index'); ?>
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
            <form class="user" method="post" action="">
                <?= ($val->hasError('id_kategori_risiko')) ? '<span class="text-sm text-danger" style="font-size:15px">' . $val->getError('id_kategori_risiko') .'*</span><br>' : ''; ?>
                <div class="form-group">
                    <label for="id_kategori_risiko">Pilih Kategori Risiko SPBE</label>
                    <select class="form-control" id="id_kategori_risiko" name="id_kategori_risiko" required>
                        <option value="" ></option>
                        <?php foreach ($daftarKategoriRisiko as $r ) : ?>
                            <option value="<?= $r['id_kategori_risiko']; ?>" <?= ( old('id_kategori_risiko')==$r['id_kategori_risiko']) ? 'selected' : ''; ?> ><?= $r['kategori_risiko']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="jenis_risiko1">Jenis Risiko SPBE</label>
                        <input type="text" class="form-control" id="jenis_risiko1" name="jenis_risiko1" required value="<?= $daftarJenisRisiko[0]['jenis_risiko']; ?>" readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="besaran_risiko_min1">Pilih Besaran Risiko Minimum </label>
                        <select class="form-control" id="besaran_risiko_min1" name="besaran_risiko_min1" required>
                            <option value="" ></option>
                            <?php foreach ($besaranRisiko as $r ) : ?>
                            <option value="<?= $r['besaran_risiko']; ?>" <?= ( old('besaran_risiko_min1')==$r['besaran_risiko']) ? 'selected' : ''; ?> ><?= $r['besaran_risiko']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="jenis_risiko2">Jenis Risiko SPBE</label>
                        <input type="text" class="form-control " id="jenis_risiko2" name="jenis_risiko2" required value="<?= $daftarJenisRisiko[1]['jenis_risiko']; ?>" readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="besaran_risiko_min2">Pilih Besaran Risiko Minimum </label>
                        <select class="form-control" id="besaran_risiko_min2" name="besaran_risiko_min2" required>
                            <option value="" ></option>
                            <?php foreach ($besaranRisiko as $r ) : ?>
                            <option value="<?= $r['besaran_risiko']; ?>" <?= ( old('besaran_risiko_min2')==$r['besaran_risiko']) ? 'selected' : ''; ?> ><?= $r['besaran_risiko']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/seleraRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="border-radius: 30px; width: 120px; height: 40px;">Batal</a>
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