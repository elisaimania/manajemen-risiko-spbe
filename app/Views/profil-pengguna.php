<?= $this->extend($template.'/index'); ?>
<?= $this->section('content'); ?>

<div class="mb-2">
    <h1 class="h3  text-gray-800 font-weight-bold" style="text-transform: uppercase;">
        <?= $title ?>
    </h1>
    
</div>


<div class="row justify-content-center">
<div class="card shadow  m-5  col-sm-8 ">
    <div class="card-body" >
    	<div class="row m-5">
            <div class="col-sm-4 text-center">
                <img src="<?= session()->img ?>" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            </div>
            <div class="col-sm-8 ">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Nama</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?= session()->nama ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Usernama</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?= session()->username ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?= session()->email ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Role</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?= session()->nama_role ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">UPR</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0"><?= session()->nama_upr ?></p>
                    </div>
                </div>
                <hr>
            </div>
        </div>

    </div>
</div>
</div>



<?= $this->endSection(); ?>