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
                <div class="form-group">
                    <label for="id_area_dampak" class=" font-weight-bold">Pilih Area Dampak Risiko SPBE</label>
                    <select class="form-control" id="id_area_dampak" name="id_area_dampak" required>
                        <option value=""></option>
                        <?php foreach ($daftarAreaDampak as $r ) : ?>
                            <option value="<?= $r['id']; ?>" <?= ( $kriteriaDampakId[0]['id_area_dampak']==$r['id']) ? 'selected' : ''; ?> ><?= $r['area_dampak']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?php $no=1 ?>
                <?php foreach($kriteriaDampakId as $k): ?>
                <?php $jenisRisiko= array_filter($daftarJenisRisiko, function ($var) use ($k) { return ($var['id'] == $k['id_jenis_risiko']);});
                $levelDampak = array_filter($daftarLevelDampak, function ($var) use ($k) { return ($var['id'] == $k['id_level_dampak']);});?>

                <?php foreach($jenisRisiko as $jenis): ?>
                <?php foreach($levelDampak as $dampak): ?>

                <label for="jenis_risiko1" class=" font-weight-bold">
                    Jenis Risiko SPBE "<?= $jenis['jenis_risiko']; ?>"
                </label>

                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak1">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak1" name="level_dampak1" value="<?= $dampak['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan<?= $no; ?>">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan<?= $no; ?>" name="penjelasan<?= $no; ?>" required value="<?= $k['penjelasan']; ?>">
                    </div>
                </div>
                <?php $no++ ?>
                <?php endforeach; ?>
                <?php endforeach; ?>
                <?php endforeach; ?>
                <!-- <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak2">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak2" name="level_dampak2" value="<?= $daftarLevelDampak[1]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan2">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan2" name="penjelasan2" required value="<?= $kriteriaDampakId[1]['penjelasan']; ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak3">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak3" name="level_dampak3" value="<?= $daftarLevelDampak[2]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan3">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan3" name="penjelasan3" required value="<?= $kriteriaDampakId[2]['penjelasan']; ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak4">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak4" name="level_dampak4" value="<?= $daftarLevelDampak[3]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan4">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan4" name="penjelasan4" required value="<?= $kriteriaDampakId[3]['penjelasan']; ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak5">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak5" name="level_dampak5" value="<?= $daftarLevelDampak[4]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan5">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan5" name="penjelasan5" required value="<?= $kriteriaDampakId[4]['penjelasan']; ?>">
                    </div>
                </div>
 -->
                <!-- <label for="jenis_risiko1" class=" font-weight-bold">
                    Jenis Risiko SPBE "<?= $daftarJenisRisiko[1]['jenis_risiko']; ?>"
                </label>

                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak1">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak1" name="level_dampak1" value="<?= $daftarLevelDampak[0]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan1">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan1" name="penjelasan6" required value="<?= $kriteriaDampakId[5]['penjelasan']; ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak2">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak2" name="level_dampak2" value="<?= $daftarLevelDampak[1]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan2">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan2" name="penjelasan7" required value="<?= $kriteriaDampakId[6]['penjelasan']; ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak3">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak3" name="level_dampak3" value="<?= $daftarLevelDampak[2]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan3">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan3" name="penjelasan8" required value="<?= $kriteriaDampakId[7]['penjelasan']; ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak4">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak4" name="level_dampak4" value="<?= $daftarLevelDampak[3]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan4">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan4" name="penjelasan9" required value="<?= $kriteriaDampakId[8]['penjelasan']; ?>">
                    </div>
                </div>
                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="level_dampak5">Level Dampak Risiko SPBE</label>
                        <input type="text" class="form-control" id="level_dampak5" name="level_dampak5" value="<?= $daftarLevelDampak[4]['level_dampak']; ?>" required readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="penjelasan5">Penjelasan</label>
                        <input type="text" class="form-control" id="penjelasan5" name="penjelasan10" required value="<?= $kriteriaDampakId[9]['penjelasan']; ?>">
                    </div>
                </div>
 -->
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/kriteriaRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
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