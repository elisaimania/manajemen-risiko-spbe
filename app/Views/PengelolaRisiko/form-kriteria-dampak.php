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
                    <label for="id_area_dampak" class=" font-weight-bold">Pilih Area Dampak Risiko SPBE</label>
                    <select class="form-control" id="id_area_dampak" name="id_area_dampak" required>
                        <option value=""></option>
                        <?php foreach ($daftarAreaDampak as $r ) : ?>
                            <option value="<?= $r['id']; ?>" <?= ( old('id_area_dampak')==$r['id']) ? 'selected' : ''; ?> ><?= $r['area_dampak']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <label for="jenis_risiko1" class=" font-weight-bold">
                    Jenis Risiko SPBE "<?= $daftarJenisRisiko[0]['jenis_risiko']; ?>"
                </label>

                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak1">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak1" name="level_dampak1" value="<?= $daftarLevelDampak[0]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan1">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan1" name="penjelasan1" required value="<?= old('penjelasan1'); ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak2">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak2" name="level_dampak2" value="<?= $daftarLevelDampak[1]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan2">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan2" name="penjelasan2" required value="<?= old('penjelasan2'); ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak3">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak3" name="level_dampak3" value="<?= $daftarLevelDampak[2]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan3">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan3" name="penjelasan3" required value="<?= old('penjelasan3'); ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak4">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak4" name="level_dampak4" value="<?= $daftarLevelDampak[3]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan4">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan4" name="penjelasan4" required value="<?= old('penjelasan4'); ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak5">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak5" name="level_dampak5" value="<?= $daftarLevelDampak[4]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan5">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan5" name="penjelasan5" required value="<?= old('penjelasan5'); ?>">
                    </div>
                </div>

                <label for="jenis_risiko1" class=" font-weight-bold">
                    Jenis Risiko SPBE "<?= $daftarJenisRisiko[1]['jenis_risiko']; ?>"
                </label>

                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak1">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak1" name="level_dampak1" value="<?= $daftarLevelDampak[0]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan1">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan1" name="penjelasan6" required value="<?= old('penjelasan6'); ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak2">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak2" name="level_dampak2" value="<?= $daftarLevelDampak[1]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan2">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan2" name="penjelasan7" required value="<?= old('penjelasan7'); ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak3">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak3" name="level_dampak3" value="<?= $daftarLevelDampak[2]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan3">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan3" name="penjelasan8" required value="<?= old('penjelasan8'); ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak4">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak4" name="level_dampak4" value="<?= $daftarLevelDampak[3]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan4">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan4" name="penjelasan9" required value="<?= old('penjelasan9'); ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak5">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak5" name="level_dampak5" value="<?= $daftarLevelDampak[4]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan5">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan5" name="penjelasan10" required value="<?= old('penjelasan10'); ?>">
                    </div>
                </div>

                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/kriteriaRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="border-radius: 30px; width: 120px; height: 40px;">Batal</a>
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