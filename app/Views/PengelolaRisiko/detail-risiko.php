<?= $this->extend('templates_risiko/index'); ?>
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
    			<th>Sasaran SPBE</th>
    			<td><?= $risiko[0]['sasaran_SPBE'] ?></td>
    		</tr>
    		<tr>
    			<th>Indikator Kinerja SPBE</th>
    			<td><?= $risiko[0]['indikator_kinerja_SPBE'] ?></td>
    		</tr>
    		<tr>
    			<th colspan="2" class="text-center" style="background-color: #8CBA08; color: #fff">Identifikasi Risiko SPBE</th>
    		</tr> 
    		<tr>
    			<th>Jenis Risiko SPBE</th>
    			<td><?= $risiko[0]['jenis_risiko'] ?></td>
    		</tr>
    		<tr>
    			<th>Kejadian</th>
    			<td><?= $risiko[0]['kejadian'] ?></td>
    		</tr>
    		<tr>
    			<th>Penyebab</th>
    			<td><?= $risiko[0]['penyebab'] ?></td>
    		</tr>
    		<tr>
    			<th>Kategori Risiko SPBE</th>
    			<td><?= $risiko[0]['kategori_risiko'] ?></td>
    		</tr>
    		<tr>
    			<th>Dampak</th>
    			<td><?= $risiko[0]['dampak'] ?></td>
    		</tr>
    		<tr>
    			<th>Area Dampak Risiko SPBE</th>
    			<td><?= $risiko[0]['area_dampak'] ?></td>
    		</tr>
    		<tr>
    			<th colspan="2" class="text-center" style="background-color: #8CBA08; color: #fff">Analisis Risiko SPBE</th>
    		</tr>
    		<tr>
    			<th>Sistem Pengendalian</th>
    			<td><?= $risiko[0]['sistem_pengendalian'] ?></td>
    		</tr>
    		<tr>
    			<th>Level Kemungkinan Risiko SPBE</th>
    			<td><?= $risiko[0]['level_kemungkinan'] .' ('.$risiko[0]['id_level_kemungkinan'] .')' ?></td>
    		</tr>
            <tr>
                <th>Penjelasan Level Kemungkinan</th>
                <td id="penjelasan_kemungkinan"></td>
            </tr>
    		<tr>
    			<th>Level Dampak Risiko SPBE</th>
    			<td><?= $risiko[0]['level_dampak'] .' ('.$risiko[0]['id_level_dampak'] .')' ?></td>
    		</tr>
            <tr>
                <th>Penjelasan Level Dampak</th>
                <td><?= $risiko[0]['penjelasan'] ?></td>
            </tr>
    		<tr>
    			<th>Besaran Risiko SPBE</th>
    			<td><?= $risiko[0]['besaran_risiko'] ?></td>
    		</tr>
    		<tr>
    			<th>Level Risiko SPBE</th>
    			<td><?= $risiko[0]['level_risiko'] ?></td>
    		</tr>
    		<tr>
    			<th colspan="2" class="text-center" style="background-color: #8CBA08; color: #fff">Evaluasi Risiko SPBE</th>
    		</tr>
    		<tr>
    			<th>Keputusan Penanganan Risiko SPBE</th>
    			<td><?= $risiko[0]['keputusan'] ?></td>
    		</tr>
    		<tr>
    			<th>Prioritas Risiko</th>
    			<td><?= $risiko[0]['prioritas'] ?></td>
    		</tr>
    	</table>
    </div>
</div>
</div>

<script type="text/javascript">

    function ubahSimbol(simbol){
        switch (simbol) {
              case '&lt;': 
                  return '&gt;';
                  break;
              case '&gt;': 
                  return'&lt;';
                  break;
              case '&le;': 
                  return '&ge;';
                  break;
              case '&ge;': 
                  return '&le;';
                  break;
          }
    }
    //mengubah kalimat dalam presentase_kemungkinan
    presentase_kemungkinan = "<?= $risiko[0]['presentase_kemungkinan'] ?>";
    presentase_kemungkinan = presentase_kemungkinan.toLowerCase();
            if (presentase_kemungkinan.includes('x')){

                let result = presentase_kemungkinan.replace(/<=/g,"&le;").replace(/=</g,"&le;").replace(/≤/g,"&le;")
                .replace(/=>/g,"&ge;").replace(/>=/g,"&ge;").replace(/≥/g,"&ge;").replace(/</g, '&lt;')
                .replace(/>/g, '&gt;').replace(/ /g,'');

                if(result[0] == 'x'){
                    result = result.replace(/x/g,'');
                    presentase_kemungkinan = 'Presentase kemungkinan terjadi ' + result;
                } else {
                    simbol1 = result.substr(result.indexOf('x')-4, 4);
                    simbol1 = ubahSimbol(simbol1);
                    result = result.replace(result.substr(result.indexOf('x')-4, 4), ' dan ');
                    result = result.replace(/x/g,'');
                    presentase_kemungkinan = 'Presentase Kemungkinan terjadi ' + simbol1 + result ;
                } 
            } else{
                presentase_kemungkinan = 'Presentase Kemungkinan terjadi ' + presentase_kemungkinan;
            }
    document.getElementById("penjelasan_kemungkinan").innerHTML=presentase_kemungkinan;


</script>

<?= $this->endSection(); ?>