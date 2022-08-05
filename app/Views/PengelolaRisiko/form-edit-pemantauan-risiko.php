<?= $this->extend('templates_pengelola_risiko/index'); ?>
<?= $this->section('content'); ?>
<?php 

$jenisLaporan = explode(' ', $pemantauan_risiko['jenis_laporan']);
$jenisLaporan = $jenisLaporan[0];


if ($jenisLaporan=='tahunan' OR $jenisLaporan=='bulanan') {
    $jenis_laporan = explode(" ",$pemantauan_risiko['jenis_laporan']);
    $periode_laporan = explode(" ",$pemantauan_risiko['periode_laporan']);
    $waktu_pelaksanaan_rencana = explode(' ', $pemantauan_risiko['waktu_pelaksanaan_rencana']);
    $pemantauan_risiko['jenis_laporan'] = $jenis_laporan[0];
    $pemantauan_risiko['periode_laporan'] = $periode_laporan[0];
    if (sizeof($waktu_pelaksanaan_rencana)>=1) {
        $pemantauan_risiko['waktu_pelaksanaan_rencana'] = $waktu_pelaksanaan_rencana[0];
    }
} elseif ($pemantauan_risiko['jenis_laporan']=='triwulan' OR $pemantauan_risiko['jenis_laporan']=='semesteran') {
    $periode_laporan = explode(" ",$pemantauan_risiko['periode_laporan']);
    $waktu_pelaksanaan_rencana = explode(' ', $pemantauan_risiko['waktu_pelaksanaan_rencana']);
    $pemantauan_risiko['periode_laporan'] = $periode_laporan[0] .' '. $periode_laporan[1];
    if (sizeof($waktu_pelaksanaan_rencana)>1) {
        $pemantauan_risiko['waktu_pelaksanaan_rencana'] = $waktu_pelaksanaan_rencana[0] .' '. $waktu_pelaksanaan_rencana[1];
    } 
}

if ($pemantauan_risiko['rencana_penanganan']!=null) {
    $required ='required';
} else {
    $required='';
}

switch ($pemantauan_risiko['jenis_laporan']) {
    case 'triwulan':
        $periode = 'triwulan';
        break;
    case 'bulanan':
        $periode = 'bulan';
        break;
    case 'semesteran':
        $periode = 'semester';
        break;
    default:
        $periode = '';
        break;
}

if ($besaranRisikoPemantauan >=$besaranRisikoMin) {
    $kalimat="Besaran risiko ini masih berada di atas selera risiko SPBE.";
} else{
    $kalimat="Besaran risiko ini sudah berada di bawah selera risiko SPBE.";
}


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
            <?= $subtitle ?>
        </li>
        
    </ol>
</div>

<div id="flash"><?= session()->flash; ?></div>
<div class="row justify-content-center">
<div class="card shadow  m-5  col-sm-8 ">
    <div class="card-body ">
        <br>
        <br>
        <div class="form-group">
            <form class="user" method="post" action="">
                <?php if ($ganti_besaran_risiko=='true'): ?>
                <div class="form-group">
                    <div class="col">
                        <label for="level_kemungkinan">Level Kemungkinan Risiko Saat Pemantauan
                        </label>
                        <div class="row">
                            <input type="text" class="form-control col-sm-10 " id="level_kemungkinan" name="level_kemungkinan" required value="<?= $levelKemungkinanPemantauan['level_kemungkinan']; ?>" readonly>
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col">
                        <label for="level_dampak">Level Dampak Risiko Saat Pemantauan
                        </label>
                        <div class="row">
                            <input type="text" class="form-control col-sm-10 " id="level_dampak" name="level_dampak" required value="<?= $levelDampakPemantauan['level_dampak']; ?>" readonly>
                            <a href="<?= base_url('pengelolaRisiko/penilaianLanjutan/'.$risiko[0]['id'].'/'.$pemantauan_risiko['jenis_laporan'].'/'.$tipe_halaman.'/'.$pemantauan_risiko['id']); ?>" type="button" class="btn btn-secondary cols-sm-3 ml-3" >Ganti</a>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="form-group">
                    <div class="col">
                        <label for="level_kemungkinan">Level Kemungkinan Risiko Saat Pemantauan
                        </label>
                        <div class="row">
                            <input type="text" class="form-control col-sm-10 " id="level_kemungkinan" name="level_kemungkinan" required value="<?= $levelKemungkinan['level_kemungkinan']; ?>" readonly>
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col">
                        <label for="level_dampak">Level Dampak Risiko Saat Pemantauan
                        </label>
                        <div class="row">
                            <input type="text" class="form-control col-sm-10 " id="level_dampak" name="level_dampak" required value="<?= $levelDampak['level_dampak']; ?>" readonly>
                            <a href="<?= base_url('pengelolaRisiko/penilaianLanjutan/'.$risiko[0]['id'].'/'.$pemantauan_risiko['jenis_laporan'].'/'.$tipe_halaman.'/'.$pemantauan_risiko['id']); ?>" type="button" class="btn btn-secondary cols-sm-3 ml-3" >Ganti</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($pemantauan_risiko['jenis_laporan']=='triwulan'): ?>
                <div class="form-group">
                    <label for="periode_laporan">Pilih Periode Laporan Pemantauan Risiko SPBE</label>
                    <select class="form-control" id="periode_laporan" name="periode_laporan" required>
                        <?php $str1=''; $str2='Triwulan I'; $str3='Triwulan II'; $str4='Triwulan III'; $str5='triwulan IV'; ?>
                        <option value="<?= $str1; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str1) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str2) ? 'selected' : ''; ?>>Triwulan I</option>
                        <option value="<?= $str3; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str3) ? 'selected' : ''; ?>>Triwulan II</option>
                        <option value="<?= $str4; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str4) ? 'selected' : ''; ?>>Triwulan III</option>
                        <option value="<?= $str5; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str5) ? 'selected' : ''; ?>>Triwulan IV</option>
                    </select>
                </div>
                <?php elseif($pemantauan_risiko['jenis_laporan']=='bulanan'): ?>
                <div class="form-group">
                    <label for="periode_laporan">Pilih Periode Laporan Pemantauan Risiko SPBE</label>
                    <select class="form-control" id="periode_laporan" name="periode_laporan" required>
                        <?php $str1=''; $str2='Januari'; $str3='Februari'; $str4='Maret'; $str5='April'; $str6='Mei'; $str7='Juni'; $str8='Juli'; $str9='Agustus'; $str10='September'; $str11='Oktober'; $str12='November'; $str13='Desember';?>
                        <option value="<?= $str1; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str1) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str2) ? 'selected' : ''; ?>>Januari</option>
                        <option value="<?= $str3; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str3) ? 'selected' : ''; ?>>Februari</option>
                        <option value="<?= $str4; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str4) ? 'selected' : ''; ?>>Maret</option>
                        <option value="<?= $str5; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str5) ? 'selected' : ''; ?>>April</option>
                        <option value="<?= $str6; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str6) ? 'selected' : ''; ?>>Mei</option>
                        <option value="<?= $str7; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str7) ? 'selected' : ''; ?>>Juni</option>
                        <option value="<?= $str8; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str8) ? 'selected' : ''; ?>>Juli</option>
                        <option value="<?= $str9; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str9) ? 'selected' : ''; ?>>Agustus</option>
                        <option value="<?= $str10; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str10) ? 'selected' : ''; ?>>September</option>
                        <option value="<?= $str11; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str11) ? 'selected' : ''; ?>>Oktober</option>
                        <option value="<?= $str12; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str12) ? 'selected' : ''; ?>>November</option>
                        <option value="<?= $str13; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str3) ? 'selected' : ''; ?>>Desember</option>
                    </select>
                </div>
                <?php elseif($pemantauan_risiko['jenis_laporan']=='semesteran'): ?>
                <div class="form-group">
                    <label for="periode_laporan">Pilih Periode Laporan Pemantauan Risiko SPBE</label>
                    <select class="form-control" id="periode_laporan" name="periode_laporan" required>
                        <?php $str1=''; $str2='Semester I'; $str3='Semester II'; ?>
                        <option value="<?= $str1; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str1) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str2) ? 'selected' : ''; ?>>Semester I</option>
                        <option value="<?= $str3; ?>" <?= ( $pemantauan_risiko['periode_laporan']==$str3) ? 'selected' : ''; ?>>Semester II</option>
                    </select>
                </div>
                <?php endif; ?>
                <?php if (($pemantauan_risiko['jenis_laporan']=='triwulan' AND $ganti_besaran_risiko=='true') OR ($pemantauan_risiko['jenis_laporan']=='bulanan' AND $ganti_besaran_risiko=='true') OR ($pemantauan_risiko['jenis_laporan']=='semesteran' AND $ganti_besaran_risiko=='true')): ?>
                <div class="form-group row">
                    <div class="col">
                        <label for="deskripsi">Besaran/Level Risiko SPBE Saat ini dan Proyeksi Risiko SPBE
                        </label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" style="width:100%;" required>Risiko SPBE pada awal tahun berada pada Level Risiko SPBE "<?= $risiko[0]['level_risiko']; ?>" dengan Besaran Risiko SPBE sebesar <?= $risiko[0]['besaran_risiko']; ?>.

Risiko SPBE tersebut pada <?= $periode; ?> ini  berada pada Level Risiko SPBE "<?= $levelRisikoPemantauan; ?>" dengan Besaran Risiko SPBE sebesar <?= $besaranRisikoPemantauan; ?>. <?= $kalimat; ?>

(lanjutkan...)

                        </textarea>
                    </div>
                </div>
                <?php elseif ($pemantauan_risiko['jenis_laporan']=='tahunan' AND $ganti_besaran_risiko=='true'): ?>
                <div class="form-group row">
                    <div class="col">
                        <label for="deskripsi">Besaran/Level Risiko SPBE Saat ini dan Proyeksi Risiko SPBE
                        </label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" style="width:100%;" required>Risiko SPBE pada awal tahun berada pada Level Risiko SPBE "<?= $risiko[0]['level_risiko']; ?>" dengan Besaran Risiko SPBE sebesar <?= $risiko[0]['besaran_risiko']; ?>.

Setelah dilakukan pemantauan selama satu tahun secara umum risiko SPBE berada pada  level risiko "<?= $levelRisikoPemantauan; ?>" dengan besaran risiko SPBE sebesar <?= $besaranRisikoPemantauan; ?>. <?= $kalimat; ?>


(lanjutkan...)

                        </textarea>
                    </div>
                </div>
                
                <?php else: ?>
                    <div class="form-group row">
                    <div class="col">
                        <label for="deskripsi">Besaran/Level Risiko SPBE Saat ini dan Proyeksi Risiko SPBE
                        </label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" style="width:100%;" required><?= $pemantauan_risiko['deskripsi_risiko_saat_ini']; ?></textarea>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($pemantauan_risiko['jenis_laporan']=='tahunan'): ?>
                <div class="form-group row">
                    <div class="col">
                        <label for="rekomendasi">Rekomendasi
                        </label>
                        <textarea class="form-control" id="rekomendasi" name="rekomendasi" > <?= $pemantauan_risiko['rekomendasi']; ?></textarea>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($pemantauan_risiko['jenis_laporan']=='triwulan' OR $pemantauan_risiko['jenis_laporan']=='bulanan' OR $pemantauan_risiko['jenis_laporan']=='semesteran'): ?>
                <div class="form-group row">
                    <div class="col">
                        <label for="rencana_penanganan">Rencana Penanganan Lanjutan
                        </label>
                        <textarea class="form-control" id="rencana_penanganan" name="rencana_penanganan" ><?= $pemantauan_risiko['rencana_penanganan']; ?></textarea>
                    </div>
                </div>
                <?php if($pemantauan_risiko['jenis_laporan']=='triwulan'): ?>
                <div class="form-group">
                    <label for="waktu_pelaksanaan_rencana">Pilih Periode Pelaksanaan Penanganan Lanjutan</label>
                    <select class="form-control" id="waktu_pelaksanaan_rencana" name="waktu_pelaksanaan_rencana" <?= $required; ?>>
                        <?php $str1=''; $str2='Triwulan I'; $str3='Triwulan II'; $str4='Triwulan III'; $str5='triwulan IV'; ?>
                        <option value="<?= $str1; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str1) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str2) ? 'selected' : ''; ?>>Triwulan I</option>
                        <option value="<?= $str3; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str3) ? 'selected' : ''; ?>>Triwulan II</option>
                        <option value="<?= $str4; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str4) ? 'selected' : ''; ?>>Triwulan III</option>
                        <option value="<?= $str5; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str5) ? 'selected' : ''; ?>>Triwulan IV</option>
                    </select>
                </div>
                <?php elseif($pemantauan_risiko['jenis_laporan']=='bulanan'): ?>
                <div class="form-group">
                    <label for="waktu_pelaksanaan_rencana">Pilih Periode Pelaksanaan Penanganan Lanjutan</label>
                    <select class="form-control" id="waktu_pelaksanaan_rencana" name="waktu_pelaksanaan_rencana" <?= $required; ?>>
                        <?php $str1=''; $str2='Januari'; $str3='Februari'; $str4='Maret'; $str5='April'; $str6='Mei'; $str7='Juni'; $str8='Juli'; $str9='Agustus'; $str10='September'; $str11='Oktober'; $str12='November'; $str13='Desember';?>
                        <option value="<?= $str1; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str1) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str2) ? 'selected' : ''; ?>>Januari</option>
                        <option value="<?= $str3; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str3) ? 'selected' : ''; ?>>Februari</option>
                        <option value="<?= $str4; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str4) ? 'selected' : ''; ?>>Maret</option>
                        <option value="<?= $str5; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str5) ? 'selected' : ''; ?>>April</option>
                        <option value="<?= $str6; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str6) ? 'selected' : ''; ?>>Mei</option>
                        <option value="<?= $str7; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str7) ? 'selected' : ''; ?>>Juni</option>
                        <option value="<?= $str8; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str8) ? 'selected' : ''; ?>>Juli</option>
                        <option value="<?= $str9; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str9) ? 'selected' : ''; ?>>Agustus</option>
                        <option value="<?= $str10; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str10) ? 'selected' : ''; ?>>September</option>
                        <option value="<?= $str11; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str11) ? 'selected' : ''; ?>>Oktober</option>
                        <option value="<?= $str12; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str12) ? 'selected' : ''; ?>>November</option>
                        <option value="<?= $str13; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str3) ? 'selected' : ''; ?>>Desember</option>
                    </select>
                </div>
                <?php elseif($pemantauan_risiko['jenis_laporan']=='semesteran'): ?>
                <div class="form-group">
                    <label for="waktu_pelaksanaan_rencana">Pilih Periode Pelaksanaan Penanganan Lanjutan</label>
                    <select class="form-control" id="waktu_pelaksanaan_rencana" name="waktu_pelaksanaan_rencana" <?= $required; ?>>
                        <?php $str1=''; $str2='Semester I'; $str3='Semester II'; ?>
                        <option value="<?= $str1; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str1) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str2) ? 'selected' : ''; ?>>Semester I</option>
                        <option value="<?= $str3; ?>" <?= ( $pemantauan_risiko['waktu_pelaksanaan_rencana']==$str3) ? 'selected' : ''; ?>>Semester II</option>
                    </select>
                </div>
                <?php endif; ?>
                <div class="form-group row">
                    <div class="col">
                        <label for="penanggungjawab">Penanggungjawab 
                        </label>
                        <input type="text" class="form-control" id="penanggungjawab" name="penanggungjawab" value="<?= $pemantauan_risiko['penanggungjawab']; ?>" >
                    </div>
                </div>
                <?php endif; ?>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/pemantauanRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
                    <button type="submit" class="btn tambah float-right m-3" name="submit" style="width: 120px; height: 40px;">
                    Ubah
                    </button>
                </div>
                
            </form>                
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    const tx = document.getElementsByTagName("textarea");
    for (let i = 0; i < tx.length; i++) {
        tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
        tx[i].addEventListener("input", OnInput, false);
    }

    function OnInput() {
        this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
    }
</script>


<?= $this->endSection(); ?>