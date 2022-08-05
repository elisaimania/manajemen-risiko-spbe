<?= $this->extend('templates_pengelola_risiko/index'); ?>
<?= $this->section('content'); 


switch ($jenis_laporan) {
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

if ($besaranRisiko >=$besaranRisikoMin) {
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

    .form-control:disabled, .form-control[readonly]{
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
            <a href="<?= base_url('pengelolaRisiko'). '/'. $subsublink ?>"><?= $subsubtitle ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="<?= base_url('pengelolaRisiko'). '/'. $subsubsublink ?>"><?= $subsubsubtitle ?></a>
        </li>
        <li class="breadcrumb-item active">
            <?= $subsubsubsubtitle ?>
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
                <div class="form-group">
                    <div class="col">
                        <label for="id_risiko">ID Risiko yang Dipantau 
                        </label>
                        <div class="row">
                            <input type="text" class="form-control col-sm-10" id="id_risiko" name="id_risiko" required value="ID_<?= $risiko[0]['id']; ?>" disabled>
                            <a href="<?= base_url('pengelolaRisiko/pilihRisikoPemantauan'); ?>" type="button" class="btn btn-secondary cols-sm-3 ml-3" >Ganti</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col">
                        <label for="level_kemungkinan">Level Kemungkinan Risiko Saat Pemantauan
                        </label>
                        <div class="row">
                            <input type="text" class="form-control col-sm-10 " id="level_kemungkinan" name="level_kemungkinan" required value="<?= $levelKemungkinan['level_kemungkinan']; ?>" disabled>
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col">
                        <label for="level_dampak">Level Dampak Risiko Saat Pemantauan
                        </label>
                        <div class="row">
                            <input type="text" class="form-control col-sm-10 " id="level_dampak" name="level_dampak" required value="<?= $levelDampak['level_dampak']; ?>" disabled>
                            <a href="<?= base_url('pengelolaRisiko/penilaianLanjutan/'.$risiko[0]['id'].'/'.$jenis_laporan.'/'.$tipe_halaman); ?>" type="button" class="btn btn-secondary cols-sm-3 ml-3" >Ganti</a>
                        </div>
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="col">
                        <label for="id_risiko">Jenis Laporan Pemantauan Risiko SPBE
                        </label>
                        <div class="row">
                            <input type="text" class="form-control col-sm-10 " id="id_risiko" name="id_risiko" required value="<?= ucfirst($jenis_laporan); ?>" disabled>
                            <a href="<?= base_url('pengelolaRisiko/pilihJenisLaporanPemantauan/'.$risiko[0]['id']); ?>" type="button" class="btn btn-secondary cols-sm-3 ml-3" >Ganti</a>
                        </div>
                    </div>
                </div>
                <?php if ($jenis_laporan=='triwulan'): ?>
                <div class="form-group">
                    <label for="periode_laporan">Pilih Periode Laporan Pemantauan Risiko SPBE</label>
                    <select class="form-control" id="periode_laporan" name="periode_laporan" required>
                        <?php $str1=''; $str2='Triwulan I'; $str3='Triwulan II'; $str4='Triwulan III'; $str5='Triwulan IV'; ?>
                        <option value="<?= $str1; ?>"></option>
                        <option value="<?= $str2; ?>" >Triwulan I</option>
                        <option value="<?= $str3; ?>" >Triwulan II</option>
                        <option value="<?= $str4; ?>" >Triwulan III</option>
                        <option value="<?= $str5; ?>" >Triwulan IV</option>
                    </select>
                </div>
                <?php elseif($jenis_laporan=='bulanan'): ?>
                <div class="form-group">
                    <label for="periode_laporan">Pilih Periode Laporan Pemantauan Risiko SPBE</label>
                    <select class="form-control" id="periode_laporan" name="periode_laporan" required>
                        <?php $str1=''; $str2='Januari'; $str3='Februari'; $str4='Maret'; $str5='April'; $str6='Mei'; $str7='Juni'; $str8='Juli'; $str9='Agustus'; $str10='September'; $str11='Oktober'; $str12='November'; $str13='Desember';?>
                        <option value="<?= $str1; ?>"></option>
                        <option value="<?= $str2; ?>" >Januari</option>
                        <option value="<?= $str3; ?>" >Februari</option>
                        <option value="<?= $str4; ?>" >Maret</option>
                        <option value="<?= $str5; ?>" >April</option>
                        <option value="<?= $str6; ?>" >Mei</option>
                        <option value="<?= $str7; ?>" >Juni</option>
                        <option value="<?= $str8; ?>" >Juli</option>
                        <option value="<?= $str9; ?>" >Agustus</option>
                        <option value="<?= $str10; ?>" >September</option>
                        <option value="<?= $str11; ?>" >Oktober</option>
                        <option value="<?= $str12; ?>" >November</option>
                        <option value="<?= $str13; ?>" >Desember</option>
                    </select>
                </div>
                <?php elseif($jenis_laporan=='semesteran'): ?>
                <div class="form-group">
                    <label for="periode_laporan">Pilih Periode Laporan Pemantauan Risiko SPBE</label>
                    <select class="form-control" id="periode_laporan" name="periode_laporan" required>
                        <?php $str1=''; $str2='Semester I'; $str3='Semester II'; ?>
                        <option value="<?= $str1; ?>"></option>
                        <option value="<?= $str2; ?>" >Semester I</option>
                        <option value="<?= $str3; ?>" >Semester II</option>
                    </select>
                </div>
                <?php endif; ?>
                <?php if ($jenis_laporan=='triwulan' || $jenis_laporan=='bulanan' || $jenis_laporan=='semesteran'): ?>
                <div class="form-group row">
                    <div class="col">
                        <label for="deskripsi">Besaran/Level Risiko SPBE Saat ini dan Proyeksi Risiko SPBE
                        </label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" style="width:100%;" required>Risiko SPBE pada awal tahun berada pada Level Risiko SPBE "<?= $risiko[0]['level_risiko']; ?>" dengan Besaran Risiko SPBE sebesar <?= $risiko[0]['besaran_risiko']; ?>. 

Risiko SPBE tersebut pada <?= $periode; ?> ini  berada pada Level Risiko SPBE "<?= $levelRisiko; ?>" dengan Besaran Risiko SPBE sebesar <?= $besaranRisiko; ?>. <?= $kalimat; ?>

(lanjutkan...)

                        </textarea>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($jenis_laporan=='tahunan'): ?>
                <div class="form-group row">
                    <div class="col">
                        <label for="deskripsi">Besaran/Level Risiko SPBE Saat ini dan Proyeksi Risiko SPBE
                        </label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" style="width:100%;" required>Risiko SPBE pada awal tahun berada pada Level Risiko SPBE "<?= $risiko[0]['level_risiko']; ?>" dengan Besaran Risiko SPBE sebesar <?= $risiko[0]['besaran_risiko']; ?>.

Setelah dilakukan pemantauan selama satu tahun secara umum risiko SPBE  berada pada  level risiko "<?= $levelRisiko; ?>" dengan besaran risiko SPBE sebesar <?= $besaranRisiko; ?>. <?= $kalimat; ?>


(lanjutkan...)

                        </textarea>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($jenis_laporan=='tahunan'): ?>
                <div class="form-group row">
                    <div class="col">
                        <label for="rekomendasi">Rekomendasi
                        </label>
                        <textarea class="form-control" id="rekomendasi" name="rekomendasi" ></textarea>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($jenis_laporan=='triwulan' OR $jenis_laporan=='bulanan' OR $jenis_laporan=='semesteran'): ?>
                <div class="form-group row">
                    <div class="col">
                        <label for="rencana_penanganan">Rencana Penanganan Lanjutan
                        </label>
                        <textarea class="form-control" id="rencana_penanganan" name="rencana_penanganan" ></textarea>
                    </div>
                </div>
                <?php if($jenis_laporan=='triwulan'): ?>
                <div class="form-group">
                    <label for="waktu_pelaksanaan_rencana">Pilih Periode Pelaksanaan Penanganan Lanjutan</label>
                    <select class="form-control" id="waktu_pelaksanaan_rencana" name="waktu_pelaksanaan_rencana" >
                        <?php $str1=''; $str2='Triwulan I'; $str3='Triwulan II'; $str4='Triwulan III'; $str5='Triwulan IV'; ?>
                        <option value="<?= $str1; ?>"></option>
                        <option value="<?= $str2; ?>" >Triwulan I</option>
                        <option value="<?= $str3; ?>" >Triwulan II</option>
                        <option value="<?= $str4; ?>" >Triwulan III</option>
                        <option value="<?= $str5; ?>" >Triwulan IV</option>
                    </select>
                </div>
                <?php elseif($jenis_laporan=='bulanan'): ?>
                <div class="form-group">
                    <label for="waktu_pelaksanaan_rencana">Pilih Periode Pelaksanaan Penanganan Lanjutan</label>
                    <select class="form-control" id="waktu_pelaksanaan_rencana" name="waktu_pelaksanaan_rencana" >
                        <?php $str1=''; $str2='Januari'; $str3='Februari'; $str4='Maret'; $str5='April'; $str6='Mei'; $str7='Juni'; $str8='Juli'; $str9='Agustus'; $str10='September'; $str11='Oktober'; $str12='November'; $str13='Desember';?>
                        <option value="<?= $str1; ?>"></option>
                        <option value="<?= $str2; ?>" >Januari</option>
                        <option value="<?= $str3; ?>" >Februari</option>
                        <option value="<?= $str4; ?>" >Maret</option>
                        <option value="<?= $str5; ?>" >April</option>
                        <option value="<?= $str6; ?>" >Mei</option>
                        <option value="<?= $str7; ?>" >Juni</option>
                        <option value="<?= $str8; ?>" >Juli</option>
                        <option value="<?= $str9; ?>" >Agustus</option>
                        <option value="<?= $str10; ?>" >September</option>
                        <option value="<?= $str11; ?>" >Oktober</option>
                        <option value="<?= $str12; ?>" >November</option>
                        <option value="<?= $str13; ?>" >Desember</option>
                    </select>
                </div>
                <?php elseif($jenis_laporan=='semesteran'): ?>
                <div class="form-group">
                    <label for="waktu_pelaksanaan_rencana">Pilih Periode Pelaksanaan Penanganan Lanjutan</label>
                    <select class="form-control" id="waktu_pelaksanaan_rencana" name="waktu_pelaksanaan_rencana" >
                        <?php $str1=''; $str2='Semester I'; $str3='Semester II'; ?>
                        <option value="<?= $str1; ?>"></option>
                        <option value="<?= $str2; ?>" >Semester I</option>
                        <option value="<?= $str3; ?>" >Semester II</option>
                    </select>
                </div>
                <?php endif; ?>
               <div class="form-group row">
                    <div class="col">
                        <label for="penanggungjawab">Penanggungjawab 
                        </label>
                        <input type="text" class="form-control" id="penanggungjawab" name="penanggungjawab">
                    </div>
                </div>
                <?php endif; ?>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/pemantauanRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
                    <button type="submit" class="btn tambah float-right m-3" name="tambah" style="width: 120px; height: 40px;">
                    Tambah
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