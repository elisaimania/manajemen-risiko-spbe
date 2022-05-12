<?= $this->extend('templates_koordinator_risiko/index'); ?>
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
        <a href="<?= base_url('KoordinatorRisiko'). '/'. $link ?>"><?= $title ?></a>
    </h1>
    <ol class="breadcrumb px-3 py-2 rounded mb-0">
        <li class="breadcrumb-item ">
            <a href="<?= base_url('KoordinatorRisiko'). '/'. $link ?>"><?= $title ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="<?= base_url('KoordinatorRisiko'). '/'. $sublink ?>"><?= $subtitle ?></a>
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
                    <label for="id_status_persetujuan">Pilih Status Persetujuan</label>
                    <select class="form-control" id="id_status_persetujuan" name="id_status_persetujuan" required>
                        <option value=""></option>
                        <?php foreach ($status as $r ) : ?>
                            <option value="<?= $r['id']; ?>" <?= ( $data['id_status_persetujuan']==$r['id']) ? 'selected' : ''; ?> ><?= $r['status']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group row">
                    <div class="col">
                        <label for="komentar">Komentar</label>
                        <textarea  class="form-control" id="komentar" name="komentar" ><?= $data['komentar']; ?></textarea>
                    </div>
                </div>
                

                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('KoordinatorRisiko/'.$sublink); ?>" class="btn  btn-secondary float-right m-3" style="border-radius: 30px; width: 120px; height: 40px;">Batal</a>
                    <button type="submit" class="btn tambah float-right m-3" name="submit" style="border-radius: 30px; width: 120px; height: 40px;">
                    Ubah
                    </button>
                </div>
                
            </form>                
        </div>
    </div>
</div>
</div>
 
<?= $this->endSection(); ?>