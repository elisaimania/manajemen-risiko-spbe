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
        <li class="breadcrumb-item active">
            <a href="<?= base_url('pengelolaRisiko'). '/'. $link ?>"><?= $title ?></a>
        </li>
        <li class="breadcrumb-item">
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
                <h3 class="font-weight-bold" style="font-size: 0.9rem;">IDENTIFIKASI RISIKO SPBE</h3>
                <div class="form-group m-3">
                    <label for="id_sasaran_SPBE">Pilih Indikator Kinerja SPBE</label>
                    <select class="form-control" id="id_sasaran_SPBE" name="id_sasaran_SPBE" required>
                        <option value="" ></option>
                        <?php foreach ($daftarIndikatorKinerja as $r ) : ?>
                            <option value="<?= $r['id']; ?>" <?= ($risiko['id_sasaran_SPBE']==$r['id']) ? 'selected' : ''; ?> ><?= $r['indikator_kinerja_SPBE']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group m-3">
                    <label for="jenis_risiko">Pilih Jenis Risiko SPBE</label>
                    <select class="form-control" id="jenis_risiko" name="jenis_risiko" required>
                        <option value="" ></option>
                        <?php foreach ($daftarJenisRisiko as $r ) : ?>
                            <option value="<?= $r['jenis_risiko']; ?>" <?= ($risiko['id_jenis_risiko']==$r['id']) ? 'selected' : ''; ?> ><?= $r['jenis_risiko']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group m-3">
                    <label for="kejadian">Kejadian</label>
                    <input type="text" class="form-control" id="kejadian" name="kejadian" required value="<?= $risiko['kejadian'] ?>">
                </div>
                <div class="form-group m-3">
                    <label for="penyebab">Penyebab</label>
                    <input type="text" class="form-control" id="penyebab" name="penyebab" required value="<?= $risiko['penyebab'] ?>">
                </div>
                <div class="form-group m-3">
                    <label for="id_kategori_risiko">Pilih Kategori Risiko SPBE</label>
                    <select class="form-control" id="id_kategori_risiko" name="id_kategori_risiko" required>
                        <option value="" ></option>
                        <?php foreach ($daftarKategoriRisiko as $r ) : ?>
                            <option value="<?= $r['id']; ?>" <?= ($risiko['id_kategori_risiko']==$r['id']) ? 'selected' : ''; ?> ><?= $r['kategori_risiko']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group m-3">
                    <label for="id_area_dampak">Pilih Area Dampak Risiko SPBE</label>
                    <select class="form-control" id="id_area_dampak" name="id_area_dampak" required>
                        <option value="" ></option>
                        <?php foreach ($daftarAreaDampak as $r ) : ?>
                            <option value="<?= $r['id']; ?>" <?= ($risiko['id_area_dampak']==$r['id']) ? 'selected' : ''; ?> ><?= $r['area_dampak']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group m-3">
                    <label for="dampak">Dampak</label>
                    <input type="text" class="form-control" id="dampak" name="dampak" required value="<?= $risiko['dampak'] ?>">
                </div>
                <h3 class="font-weight-bold" style="font-size: 0.9rem;">ANALISIS RISIKO SPBE</h3>
                <div class="form-group m-3">
                    <label for="sistem_pengendalian">Sistem Pengendalian</label>
                    <input type="text" class="form-control" id="sistem_pengendalian" name="sistem_pengendalian" required value="<?= $risiko['sistem_pengendalian'] ?>">
                </div>
                <div class="form-group m-3">
                    <label for="level_kemungkinan">Pilih Level Kemungkinan Risiko SPBE</label>
                    <select class="form-control" id="level_kemungkinan" name="level_kemungkinan" required>
                        <option value="" ></option>
                        <?php foreach ($daftarLevelKemungkinan as $r ) : ?>
                            <option value="<?= $r['level_kemungkinan']; ?>" <?= ($risiko['id_level_kemungkinan']==$r['id']) ? 'selected' : ''; ?> ><?= $r['level_kemungkinan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group m-3">
                    <label for="level_dampak">Pilih Level Dampak Risiko SPBE</label>
                    <select class="form-control" id="level_dampak" name="level_dampak" required>
                        <option value="" ></option>
                        <?php foreach ($daftarLevelDampak as $r ) : ?>
                            <option value="<?= $r['level_dampak']; ?>" <?= ($risiko['id_level_dampak']==$r['id']) ? 'selected' : ''; ?> ><?= $r['level_dampak']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/penilaianRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
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