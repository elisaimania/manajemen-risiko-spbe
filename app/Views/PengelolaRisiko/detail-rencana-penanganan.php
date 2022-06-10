<?= $this->extend('templates_pengelola_risiko/index'); ?>
<?= $this->section('content'); ?>

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


<div class="row justify-content-center">
<div class="card shadow  m-5  col-sm-8 ">
    <div class="card-body" >
    	<table class="table table-bordered" style="color: black">
    		<tr>
    			<th>ID Risiko</th>
    			<td><?='ID_'. $rencana_penanganan['id_risiko'] ?></td>
    		</tr>
    		<tr>
    			<th>Opsi Penanganan Risiko SPBE</th>
    			<td><?= $opsi_penanganan['opsi_penanganan'] ?></td>
    		</tr>
            <tr>
                <th>Rencana Aksi Penanganan Risiko</th>
                <td><?= $rencana_penanganan['rencana_aksi'] ?></td>
            </tr>
    		<tr>
                <th>Keluaran</th>
                <td><?= $rencana_penanganan['keluaran'] ?></td>
            </tr>
            <?php if($rencana_penanganan['jenis_periode_implementasi']=='Tanggal'): ?>
            <?php $tanggal_mulai= DateTime::createFromFormat('Y-m-d',$rencana_penanganan['tanggal_mulai']);
            $tanggal_selesai = DateTime::createFromFormat('Y-m-d',$rencana_penanganan['tanggal_selesai']);
            ?>
            <tr>
                <th>Jadwal Implementasi</th>
                <td><?= strftime('%d %B %Y', $tanggal_mulai->getTimestamp()).' - '. strftime('%d %B %Y', $tanggal_selesai->getTimestamp())?></td>
            </tr>
            <?php else: ?>
            <tr>
                <th>Jadwal Implementasi</th>
                <td><?= $rencana_penanganan['periode_implementasi'] ?></td>
            </tr>
            <?php endif ?>
            <tr>
                <th>Status Persetujuan</th>
                <td><?= $status_persetujuan['status'] ?></td>
            </tr>
    	</table>
    </div>
</div>
</div>



<?= $this->endSection(); ?>