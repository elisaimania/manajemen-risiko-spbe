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
                <div class="form-group">
                    <label for="opsi_penanganan">Pilih Opsi Penanganan Risiko SPBE</label>
                    <select class="form-control" id="opsi_penanganan" name="opsi_penanganan" required>
                        <option value=""></option>
                        <?php foreach ($daftarOpsiPenanganan as $r ) : ?>
                            <option value="<?= $r['opsi_penanganan']; ?>" <?= ( $rencana_penanganan['id_opsi_penanganan']==$r['id']) ? 'selected' : ''; ?>><?= $r['opsi_penanganan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="rencana_aksi">Rencana Aksi Penanganan Risiko SPBE
                        </label>
                        <textarea class="form-control" id="rencana_aksi" name="rencana_aksi" required><?= $rencana_penanganan['rencana_aksi']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="keluaran">Keluaran
                        </label>
                        <textarea  class="form-control" id="keluaran" name="keluaran" required><?= $rencana_penanganan['keluaran']; ?></textarea>
                    </div>
                </div>
                <?= ($val->hasError('jadwal_mulai')) ? '<span class="text-sm text-danger" style="font-size:15px">' . $val->getError('jadwal_mulai') .'*</span><br>' : ''; ?>
                <div class="form-group row">
                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <label for="jadwal">Jadwal Implementasi</label>
                        <input type="date" class="form-control" id="jadwal" name="jadwal_mulai" required value="<?= $rencana_penanganan['jadwal_mulai']; ?>">
                    </div>
                    <div class="col-sm-2 text-center sampai" style="margin-top: 35px;">
                        Sampai
                    </div>
                    <div class="col-sm-5">
                        <label for="jadwal" style="color: #fff;">Jadwal Implementasi</label>
                        <input type="date" class="form-control" id="jadwal" name="jadwal_selesai" required value="<?= $rencana_penanganan['jadwal_selesai']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="penanggungjawab">Penanggungjawab 
                        </label>
                        <input type="text" class="form-control" id="penanggungjawab" name="penanggungjawab" required value="<?= $rencana_penanganan['penanggungjawab']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="risiko_residual">Apakah Terdapat Risiko Residual?</label>
                    <select class="form-control" id="risiko_residual" name="risiko_residual" required>
                        <?php $str1=''; $str2='YA'; $str3='TIDAK' ?>
                        <option value="<?= $str1; ?>" <?= ( $rencana_penanganan['risiko_residual']== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( $rencana_penanganan['risiko_residual']== htmlspecialchars($str2)) ? 'selected' : ''; ?>>YA</option>
                        <option value="<?= $str3; ?>" <?= ( $rencana_penanganan['risiko_residual']== htmlspecialchars($str3)) ? 'selected' : ''; ?>>TIDAK</option>
                    </select>
                </div>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/penangananRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="border-radius: 30px; width: 120px; height: 40px;">Batal</a>
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