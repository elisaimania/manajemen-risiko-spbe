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
    .btn.btn-light{
        background-color: #C4C4C4;
        border-color: #C4C4C4;
        color: black;
}

    .btn.btn-light:hover{
        background-color: #D3D3D3;
        border-color: #D3D3D3;
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
                    <label for="id_kategori_risiko" class=" font-weight-bold">Pilih Kategori Risiko SPBE</label>
                    <select class="form-control" id="id_kategori_risiko" name="id_kategori_risiko" required>
                        <option value=""></option>
                        <?php foreach ($daftarKategoriRisiko as $r ) : ?>
                            <option value="<?= $r['id_kategori_risiko']; ?>" <?= ( old('id_kategori_risiko')==$r['id_kategori_risiko']) ? 'selected' : ''; ?> ><?= $r['kategori_risiko']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <label for="level_kemungkinan1" class=" font-weight-bold">
                    Level Kemungkinan Risiko SPBE "<?= $daftarLevelKemungkinan[0]['level_kemungkinan']; ?>"
                </label>

                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="presentase_kemungkinan1">Presentase Kemungkinan
                        </label> 
                        <div class="mb-2">
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','presentase_kemungkinan1')">&lt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','presentase_kemungkinan1')">&gt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','presentase_kemungkinan1')">&le;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','presentase_kemungkinan1')">&ge;</button>
                        </div> 
                        <input type="text" class="form-control" id="presentase_kemungkinan1" name="presentase_kemungkinan1" value="<?= old('presentase_kemungkinan1'); ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="jumlah_frekuensi1">Jumlah Frekuensi dalam Satu Tahun
                        </label>
                        <div class="mb-2">
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','jumlah_frekuensi1')">&lt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','jumlah_frekuensi1')">&gt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','jumlah_frekuensi1')">&le;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','jumlah_frekuensi1')">&ge;</button>
                        </div>
                        <input type="text" class="form-control" id="jumlah_frekuensi1" name="jumlah_frekuensi1" value="<?= old('jumlah_frekuensi1'); ?>" required>
                    </div>
                </div>

                <label for="level_kemungkinan2" class=" font-weight-bold">
                    Level Kemungkinan Risiko SPBE "<?= $daftarLevelKemungkinan[1]['level_kemungkinan']; ?>"
                </label>

                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="presentase_kemungkinan2">Presentase Kemungkinan
                        </label> 
                        <div class="mb-2">
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','presentase_kemungkinan2')">&lt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','presentase_kemungkinan2')">&gt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','presentase_kemungkinan2')">&le;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','presentase_kemungkinan2')">&ge;</button>
                        </div> 
                        <input type="text" class="form-control" id="presentase_kemungkinan2" name="presentase_kemungkinan2" value="<?= old('presentase_kemungkinan2'); ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="jumlah_frekuensi2">Jumlah Frekuensi dalam Satu Tahun
                        </label>
                        <div class="mb-2">
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','jumlah_frekuensi2')">&lt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','jumlah_frekuensi2')">&gt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','jumlah_frekuensi2')">&le;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','jumlah_frekuensi2')">&ge;</button>
                        </div>
                        <input type="text" class="form-control" id="jumlah_frekuensi2" name="jumlah_frekuensi2" value="<?= old('jumlah_frekuensi2'); ?>" required>
                    </div>
                </div>

                <label for="level_kemungkinan3" class=" font-weight-bold">
                    Level Kemungkinan Risiko SPBE "<?= $daftarLevelKemungkinan[2]['level_kemungkinan']; ?>"
                </label>

                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="presentase_kemungkinan3">Presentase Kemungkinan
                        </label> 
                        <div class="mb-2">
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','presentase_kemungkinan3')">&lt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','presentase_kemungkinan3')">&gt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','presentase_kemungkinan3')">&le;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','presentase_kemungkinan3')">&ge;</button>
                        </div> 
                        <input type="text" class="form-control" id="presentase_kemungkinan3" name="presentase_kemungkinan3" value="<?= old('presentase_kemungkinan3'); ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="jumlah_frekuensi3">Jumlah Frekuensi dalam Satu Tahun
                        </label>
                        <div class="mb-2">
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','jumlah_frekuensi3')">&lt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','jumlah_frekuensi3')">&gt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','jumlah_frekuensi3')">&le;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','jumlah_frekuensi3')">&ge;</button>
                        </div>
                        <input type="text" class="form-control" id="jumlah_frekuensi3" name="jumlah_frekuensi3" value="<?= old('jumlah_frekuensi3'); ?>" required>
                    </div>
                </div>

                <label for="level_kemungkinan4" class=" font-weight-bold">
                    Level Kemungkinan Risiko SPBE "<?= $daftarLevelKemungkinan[3]['level_kemungkinan']; ?>"
                </label>

                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="presentase_kemungkinan4">Presentase Kemungkinan
                        </label> 
                        <div class="mb-2">
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','presentase_kemungkinan4')">&lt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','presentase_kemungkinan4')">&gt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','presentase_kemungkinan4')">&le;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','presentase_kemungkinan4')">&ge;</button>
                        </div> 
                        <input type="text" class="form-control" id="presentase_kemungkinan4" name="presentase_kemungkinan4" value="<?= old('presentase_kemungkinan4'); ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="jumlah_frekuensi4">Jumlah Frekuensi dalam Satu Tahun
                        </label>
                        <div class="mb-2">
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','jumlah_frekuensi4')">&lt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','jumlah_frekuensi4')">&gt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','jumlah_frekuensi4')">&le;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','jumlah_frekuensi4')">&ge;</button>
                        </div>
                        <input type="text" class="form-control" id="jumlah_frekuensi4" name="jumlah_frekuensi4" value="<?= old('jumlah_frekuensi4'); ?>" required>
                    </div>
                </div>

                <label for="level_kemungkinan5" class=" font-weight-bold">
                    Level Kemungkinan Risiko SPBE "<?= $daftarLevelKemungkinan[4]['level_kemungkinan']; ?>"
                </label>

                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="presentase_kemungkinan5">Presentase Kemungkinan
                        </label> 
                        <div class="mb-2">
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','presentase_kemungkinan5')">&lt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','presentase_kemungkinan5')">&gt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','presentase_kemungkinan5')">&le;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','presentase_kemungkinan5')">&ge;</button>
                        </div> 
                        <input type="text" class="form-control" id="presentase_kemungkinan5" name="presentase_kemungkinan5" value="<?= old('presentase_kemungkinan5'); ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="jumlah_frekuensi5">Jumlah Frekuensi dalam Satu Tahun
                        </label>
                        <div class="mb-2">
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','jumlah_frekuensi5')">&lt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','jumlah_frekuensi5')">&gt;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','jumlah_frekuensi5')">&le;</button>
                            <button type="button" class="btn btn-light font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','jumlah_frekuensi5')">&ge;</button>
                        </div>
                        <input type="text" class="form-control" id="jumlah_frekuensi5" name="jumlah_frekuensi5" value="<?= old('jumlah_frekuensi5'); ?>" required>
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