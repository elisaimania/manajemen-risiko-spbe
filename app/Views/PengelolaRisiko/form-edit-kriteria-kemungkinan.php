<?= $this->extend('templates_pengelola_risiko/index'); ?>
<?= $this->section('content'); 


?>

<style>
    .btn.float-right.tambah {
        background-color: #8CBA08; 
        border-color: #8CBA08; 
        color:#fff;
}
    .btn.float-right.tambah:hover{
        background-color:#A1D70A;
}

    .btn.btn-dark{
        background-color: #C4C4C4;
        border-color: #C4C4C4;
        color: black;
}

    .btn.btn-dark:hover{
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
                <div class="form-group">
                    <label for="id_kategori_risiko" class=" font-weight-bold">Pilih Kategori Risiko SPBE</label>
                    <select class="form-control" id="id_kategori_risiko" name="id_kategori_risiko" required>
                        <?php foreach ($daftarKategoriRisiko as $r ) : ?>
                            <option value="<?= $r['id']; ?>" <?= ( $kriteriaKemungkinanId[0]['id_kategori_risiko']==$r['id']) ? 'selected' : ''; ?> ><?= $r['kategori_risiko']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?php $no=1; ?>
                <?php foreach ($kriteriaKemungkinanId as $k ) : ?>
                <?php $levelKemungkinan= array_filter($daftarLevelKemungkinan, function ($var) use ($k) { return ($var['id'] == $k['id_level_kemungkinan']);});?>
                <?php foreach($levelKemungkinan as $level): ?>

                <label for="level_kemungkinan<?= $no; ?>" class=" font-weight-bold">
                    Level Kemungkinan Risiko SPBE "<?= $level['level_kemungkinan'].' ('.$level['id'].')'; ?>"
                </label>

                <div class="form-group row m-3">
                    <div class="col-sm-6">
                        <label for="presentase_kemungkinan<?= $no; ?>">Presentase Kemungkinan
                        </label> 
                        <!-- <div class="mb-2">
                            <button type="button" class="btn btn-dark font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','presentase_kemungkinan1')">&lt;</button>
                            <button type="button" class="btn btn-dark font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','presentase_kemungkinan1')">&gt;</button>
                            <button type="button" class="btn btn-dark font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','presentase_kemungkinan1')">&le;</button>
                            <button type="button" class="btn btn-dark font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','presentase_kemungkinan1')">&ge;</button>
                        </div>  -->
                        <input type="text" class="form-control" id="presentase_kemungkinan<?= $no; ?>" name="presentase_kemungkinan<?= $no; ?>" value="<?= $k['presentase_kemungkinan']; ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="jumlah_frekuensi<?= $no; ?>">Jumlah Frekuensi dalam Satu Tahun
                        </label>
                        <!-- <div class="mb-2">
                            <button type="button" class="btn btn-dark font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('<','jumlah_frekuensi1')">&lt;</button>
                            <button type="button" class="btn btn-dark font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('>','jumlah_frekuensi1')">&gt;</button>
                            <button type="button" class="btn btn-dark font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≤','jumlah_frekuensi1')">&le;</button>
                            <button type="button" class="btn btn-dark font-weight-bold text-center" style="border-radius: 10px;" onclick="insertInto('≥','jumlah_frekuensi1')">&ge;</button>
                        </div> -->
                        <input type="text" class="form-control" id="jumlah_frekuensi<?= $no; ?>" name="jumlah_frekuensi<?= $no; ?>" value="<?= $k['jumlah_frekuensi']; ?>" required>
                    </div>
                </div>
                <?php $no++ ?>
                <?php endforeach; ?>
                <?php endforeach; ?>
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