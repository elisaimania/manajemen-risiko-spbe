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

    .form-control:disabled{
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
            <a href="<?= base_url('pengelolaRisiko'). '/'. $subsublink ?>"><?= $subsubtitle ?></a>
        </li>
        <li class="breadcrumb-item active">
            <?= $subsubsubtitle ?>
        </li>
    </ol>
</div>
                    
<!-- DataTales Example -->
<div id="flash"><?= session()->flash; ?></div>
<div class="row justify-content-center">
<div class="card shadow  m-5  col-sm-8 ">
    <div class="card-body ">
        <div class="card-header py-3 mb-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #fff; color: black;">
            <?php if($jenis_laporan=='tahunan'): ?>
            <h6 class="m-0 font-weight-bold ">Pilih level kemungkinan dan level dampak risiko untuk memeriksa besaran dan level risiko secara Umum setelah dilakukan pemantauan secara bulanan/triwulanan/semesteran</h6>
            <?php else: ?>
            <h6 class="m-0 font-weight-bold ">Pilih level kemungkinan dan level dampak risiko untuk memeriksa besaran dan level risiko saat ini</h6>    
            <?php endif; ?>              
        </div>
        <br>
        <div class="form-group">
            <form class="user" method="post" action="">
                <?php if ($tipe_halaman=='edit'): ?>
                <div>
                </div>
                <?php else: ?>
                <div class="form-group">
                    <div class="col">
                        <label for="id_risiko">ID Risiko yang Akan Dipantau 
                        </label>
                        <div class="row">
                            <input type="text" class="form-control col-sm-10" id="id_risiko" name="id_risiko" required value="ID_<?= $id_risiko; ?>" disabled>
                            <a href="<?= base_url('pengelolaRisiko/pilihRisikoPemantauan'); ?>" type="button" class="btn btn-secondary cols-sm-3 ml-3" >Ganti</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="id_level_kemungkinan_pemantauan">Pilih Level Kemungkinan Risiko</label>
                    <select class="form-control" id="id_level_kemungkinan_pemantauan" name="id_level_kemungkinan_pemantauan" required>
                        <option value=""></option>
                        <?php foreach ($daftarLevelKemungkinan as $r ) : ?>
                            <option value="<?= $r['id']; ?>" ><?= $r['level_kemungkinan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_level_dampak_pemantauan">Pilih Level Dampak Risiko</label>
                    <select class="form-control" id="id_level_dampak_pemantauan" name="id_level_dampak_pemantauan" required>
                        <option value=""></option>
                        <?php foreach ($daftarLevelDampak as $r ) : ?>
                            <option value="<?= $r['id']; ?>" ><?= $r['level_dampak']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/pemantauanRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
                    <button type="submit" class="btn tambah float-right m-3" name="tambah" style="width: 120px; height: 40px;">
                    Lanjut
                    </button>
                </div>
                
            </form>                
        </div>
    </div>
</div>
</div>
 
<?= $this->endSection(); ?>