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
            <?= $subsubtitle ?>
        </li>
    </ol>
</div>
                    
<!-- DataTales Example -->
<div id="flash"><?= session()->flash; ?></div>
<div class="row justify-content-center">
<div class="card shadow  m-5  col-sm-8 ">
    <div class="card-body ">
        <div class="card-header py-3 mb-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #fff; color: black;">
            <h6 class="m-0 font-weight-bold ">Pilih Jenis Laporan Pemantauan Risiko SPBE</h6>                  
        </div>
        <br>
        <div class="form-group">
            <form class="user" method="post" action="">
                <div class="form-group">
                    <label for="jenis_laporan">Pilih Jenis Laporan Pemantauan Risiko SPBE</label>
                    <select class="form-control" id="jenis_laporan" name="jenis_laporan" required>
                        <?php $str1=''; $str2='tahunan'; $str3='triwulan'; $str4='bulanan'; $str5='semesteran' ?>
                        <option value="<?= $str1; ?>" ></option>
                        <option value="<?= $str4; ?>" >Bulanan</option>
                        <option value="<?= $str3; ?>" >Triwulan</option>
                        <option value="<?= $str5; ?>" >Semesteran</option>
                        <option value="<?= $str2; ?>" >Tahunan</option>
                        
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