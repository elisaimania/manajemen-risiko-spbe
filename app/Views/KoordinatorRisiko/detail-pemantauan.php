<?= $this->extend('templates_koordinator_risiko/index'); ?>
<?= $this->section('content'); 

$laporan = $pemantauan[0]['jenis_laporan'];
$jenisLaporan = explode(' ', $pemantauan[0]['jenis_laporan']);
$pemantauan[0]['jenis_laporan'] = $jenisLaporan[0];


?>

<div class="mb-2">
    <h1 class="h3  text-gray-800 font-weight-bold" style="text-transform: uppercase;">
        <a href="<?= base_url('koordinatorRisiko'). '/'. $link ?>"><?= $title ?></a>
    </h1>
    <ol class="breadcrumb px-3 py-2 rounded mb-0">
        <li class="breadcrumb-item active">
            <a href="<?= base_url('koordinatorRisiko'). '/'. $link ?>"><?= $title ?></a>
        </li>
        <li class="breadcrumb-item">
            <?= $subtitle ?>
        </li>

    </ol>
</div>


<div class="row justify-content-center">
<div class="card shadow  m-5  col-sm-8 ">
    <div class="card-body" >
        <div class="form-group">
             <div class="row">
                <div class="col">
                </div>
                <div class="col">
                    <input type="button" class="btn btn-secondary float-right mr-3" id="btnExport" value="Download PDF" onclick="generate()" />
                </div>
            </div>
        </div>

        <table class="table table-bordered" style="color: black" id="table-detail">
            <?php if($pemantauan[0]['jenis_laporan']=='tahunan'): ?>
            <tr>
                <th colspan="2" class="text-center" style="background-color: #8CBA08; color: #fff"><?=strtoupper('Laporan Pemantauan Risiko SPBE ' .$laporan) ?></th>
            </tr>
            <?php else: ?>
            <tr>
                <th colspan="2" class="text-center" style="background-color: #8CBA08; color: #fff"><?=strtoupper('Laporan Pemantauan Risiko SPBE ' .$pemantauan[0]['periode_laporan']) ?></th>
            </tr>
            <?php endif; ?>
            <tr>
                <th>Nama Unit</th>
                <td><?= $upr['upr_SPBE']?></td>    
            </tr>
            <tr>
                <th>Sasaran SPBE</th>
                <td><?= $risiko[0]['sasaran_SPBE'] ?></td>
            </tr>
            <tr>
                <th>Kejadian</th>
                <td><?= $risiko[0]['kejadian'] ?></td>
            </tr>
            <tr>
                <th colspan="2" class="text-center">Besaran/Level Risiko SPBE Saat ini dan Proyeksi Risiko SPBE</th>
            </tr> 
            <tr>
                <td colspan="2"><?= str_replace(["\r\n", "\r", "\n"], '<br>', $pemantauan[0]['deskripsi_risiko_saat_ini']) ?></td>
            </tr>
             <tr>
                <th colspan="2" class="text-center">Penanganan yang Telah dilakukan</th>
            </tr>
            <?php $no=1; ?>
            <tr>
                <td colspan="2"><?= $no.'. '. $pemantauan[0]['rencana_aksi'] ?></td>
            </tr>
            <?php foreach ($daftarPemantauan as $r ) : ?>
            <?php if($r['rencana_penanganan']!=''): ?>
            <tr>
                <td colspan="2"><?= ++$no.'. '. $r['rencana_penanganan'] ?></td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php  if ($pemantauan[0]['jenis_laporan']=='triwulan' OR $pemantauan[0]['jenis_laporan']=='bulanan' OR $pemantauan[0]['jenis_laporan']=='semesteran'): ?>
            <tr>
                <th colspan="2" class="text-center">Rencana Penanganan Lanjutan</th>
            </tr>
            <tr>
                <th>Rencana Penanganan</th>
                <td><?= $pemantauan[0]['rencana_penanganan'] ?></td>
            </tr>
            <tr>
                <th>Waktu Pelaksanaa</th>
                <td><?= $pemantauan[0]['waktu_pelaksanaan_rencana'] ?></td>
            </tr>
            <tr>
                <th>Penanggungjawab</th>
                <td><?= $pemantauan[0]['penanggungjawab'] ?></td>
            </tr>
            <?php endif ?>
            <?php if($pemantauan[0]['jenis_laporan']=='tahunan' AND $pemantauan[0]['rekomendasi']!=''): ?>
            <tr>
                <th colspan="2" class="text-center">Rekomendasi</th>
            </tr>
            <tr>
                <td colspan="2"><?= $pemantauan[0]['rekomendasi'] ?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <th colspan="2" class="text-center">Status Persetujuan</th>
            </tr>
            <tr>
                <td colspan="2" class="text-center"><?= $pemantauan[0]['status'] ?></td>
            </tr>
        </table>
    </div>
</div>
</div>

<script type="text/javascript">
    function generate() {  
    var doc = new jsPDF('p', 'pt', 'letter');  
    var htmlstring = '';  
    var tempVarToCheckPageHeight = 0;  
    var pageHeight = 0;  
    pageHeight = doc.internal.pageSize.height;  
    specialElementHandlers = {  
        // element with id of "bypass" - jQuery style selector  
        '#bypassme': function(element, renderer) {  
            // true = "handled elsewhere, bypass text extraction"  
            return true  
        }  
    };  
    margins = {  
        top: 150,  
        bottom: 60,  
        left: 40,  
        right: 40,  
        width: 600  
    };  
    var y = 20;  
    doc.setLineWidth(2);    
    doc.autoTable({html: '#table-detail', theme: 'grid', willDrawCell: data => {
        if (data.row.index ===0) {
            doc.setFontStyle("bold");
            data.cell.styles.halign = 'center';
            doc.setFillColor("#8CBA08");
            doc.setTextColor(255,255,255);
            console.log(data.cell);

        }else if(data.row.index ===1 || data.row.index ===2 || data.row.index ===3){
            if(data.column.index===0){
                doc.setFontStyle("bold");
                data.cell.styles.halign = 'left';
            }
        } else if(data.cell.text[0]=='Besaran/Level Risiko SPBE Saat ini dan Proyeksi Risiko SPBE' || data.cell.text[0]=='Rekomendasi' || data.cell.text[0]=='Status Persetujuan' || data.cell.text[0]=='Penanganan yang Telah dilakukan' || data.cell.text[0]=='Rencana Penanganan Lanjutan'){
            doc.setFontStyle("bold");
            data.cell.styles.halign = 'center';
        }
    }
});
    doc.save('Laporan-Pemantauan.pdf');  
}  
        
</script>


<?= $this->endSection(); ?>