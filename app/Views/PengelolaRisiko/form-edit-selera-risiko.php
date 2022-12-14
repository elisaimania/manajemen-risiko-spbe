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
                    <label for="id_kategori_risiko">Pilih Kategori Risiko SPBE</label>
                    <select class="form-control" id="id_kategori_risiko" name="id_kategori_risiko" required>
                        <option value="" ></option>
                        <?php foreach ($daftarKategoriRisiko as $r ) : ?>
                            <option value="<?= $r['id']; ?>" <?= ( $seleraRisikoId[0]['id_kategori_risiko']==$r['id']) ? 'selected' : ''; ?> ><?= $r['kategori_risiko']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?php $no=1 ?>
                <?php foreach($seleraRisikoId as $s): ?>
                <?php $jenisRisiko= array_filter($daftarJenisRisiko, function ($var) use ($s) { return ($var['id'] == $s['id_jenis_risiko']);}); ?>
                <?php foreach($jenisRisiko as $jenis): ?>
    
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="jenis_risiko1">Jenis Risiko SPBE</label>
                        <input type="text" class="form-control" id="jenis_risiko1" name="jenis_risiko1" required value="<?= $jenis['jenis_risiko']; ?>" readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="besaran_risiko_min<?= $no; ?>">Pilih Besaran Risiko Minimum </label>
                        <select class="form-control" id="besaran_risiko_min<?= $no; ?>" name="besaran_risiko_min<?= $no; ?>" required>
                            <option value="" ></option>
                            <?php foreach ($besaranRisiko as $r ) : ?>
                            <option value="<?= $r['besaran_risiko']; ?>" <?= ( $s['besaran_risiko_min']==$r['besaran_risiko']) ? 'selected' : ''; ?> ><?= $r['besaran_risiko']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <?php $no++ ?>
                <?php endforeach; ?>
                <?php endforeach; ?>

                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/seleraRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
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