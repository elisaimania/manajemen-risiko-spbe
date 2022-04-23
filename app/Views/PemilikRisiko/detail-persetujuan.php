<?= $this->extend('templates_pemilik_risiko/index'); ?>
<?= $this->section('content'); ?>

<div class="mb-2">
    <h1 class="h3  text-gray-800 font-weight-bold" style="text-transform: uppercase;">
        <a href="<?= base_url('PemilikRisiko'). '/'. $link ?>"><?= $title ?></a>
    </h1>
    <ol class="breadcrumb px-3 py-2 rounded mb-0">
        <li class="breadcrumb-item active">
            <a href="<?= base_url('PemilikRisiko'). '/'. $link ?>"><?= $title ?></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?= base_url('PemilikRisiko'). '/'. $sublink ?>"><?= $subtitle ?></a>
        </li>
        <li class="breadcrumb-item">
            <?= $subsubtitle ?>
        </li>

    </ol>
</div>


<div class="row justify-content-center">
<div class="card shadow  m-5  col-sm-8 ">
    <div class="card-body" >
    	<table class="table table-bordered" style="color: black">
    		<tr>
    			<th>Status Persetujuan</th>
    			<td><?= $status['status'] ?></td>
    		</tr>
    		<tr>
    			<th>Komentar</th>
    			<td><?= $data['komentar'] ?></td>
    		</tr>
    	</table>
    </div>
</div>
</div>


<?= $this->endSection(); ?>