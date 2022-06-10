<?= $this->extend('templates_pengelola_risiko/index'); ?>
<?= $this->section('content'); ?>
<?php $val = service('validation'); 

if ($rencana_penanganan['jenis_periode_implementasi']=='Bulan') {
    $bulan = explode(" ",$rencana_penanganan['periode_implementasi']);
    $rencana_penanganan['periode_implementasi'] = $bulan[0];
} elseif ($rencana_penanganan['jenis_periode_implementasi']=='Triwulan' OR $rencana_penanganan['jenis_periode_implementasi']=='Semester') {
    $periode_implementasi = explode(" ",$rencana_penanganan['periode_implementasi']);
    $rencana_penanganan['periode_implementasi'] = $periode_implementasi[0] .' '. $periode_implementasi[1];
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

    .form-control:disabled{
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
                    <label for="opsi_penanganan">Pilih Opsi Penanganan Risiko SPBE</label>
                    <select class="form-control" id="opsi_penanganan" name="id_opsi_penanganan" required>
                        <option value=""></option>
                        <?php foreach ($daftarOpsiPenanganan as $r ) : ?>
                            <option value="<?= $r['id']; ?>" <?= ( $rencana_penanganan['id_opsi_penanganan']==$r['id']) ? 'selected' : ''; ?>><?= $r['opsi_penanganan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="rencana_aksi">Rencana Aksi Penanganan Risiko SPBE
                        </label>
                        <textarea class="form-control" id="rencana_aksi" name="rencana_aksi" required><?= $rencana_penanganan['rencana_aksi']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="keluaran">Keluaran
                        </label>
                        <textarea  class="form-control" id="keluaran" name="keluaran" required><?= $rencana_penanganan['keluaran']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="periode_implementasi">Pilih Jenis Periode Implementasi</label>
                    <select class="form-control" id="periode_implementasi" name="periode_implementasi" onchange="change_periode_implentasi()" required>
                        <?php $str1=''; $str2='Tanggal'; $str3='Bulan'; $str4='Triwulan'; $str5='Semester'; ?>
                        <option value="<?= $str1; ?>" <?= ( $rencana_penanganan['jenis_periode_implementasi']== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( $rencana_penanganan['jenis_periode_implementasi']== htmlspecialchars($str2)) ? 'selected' : ''; ?>>Tanggal</option>
                        <option value="<?= $str3; ?>" <?= ( $rencana_penanganan['jenis_periode_implementasi']== htmlspecialchars($str3)) ? 'selected' : ''; ?>>Bulan</option>
                        <option value="<?= $str4; ?>" <?= ( $rencana_penanganan['jenis_periode_implementasi']== htmlspecialchars($str4)) ? 'selected' : ''; ?>>Triwulan</option>
                        <option value="<?= $str5; ?>" <?= ( $rencana_penanganan['jenis_periode_implementasi']== htmlspecialchars($str5)) ? 'selected' : ''; ?>>Semester</option>
                    </select>
                </div>
                <?= ($val->hasError('tanggal_mulai')) ? '<span class="text-sm text-danger" style="font-size:15px">' . $val->getError('tanggal_mulai') .'*</span><br>' : ''; ?>
                <div class="form-group row" id="implementasi">
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="penanggungjawab">Penanggungjawab 
                        </label>
                        <input type="text" class="form-control" id="penanggungjawab" name="penanggungjawab" required value="<?= $rencana_penanganan['penanggungjawab']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="risiko_residual">Apakah Terdapat Risiko Residual?</label>
                    <select class="form-control" id="risiko_residual" name="risiko_residual" required>
                        <?php $str1=''; $str2='YA'; $str3='TIDAK' ?>
                        <option value="<?= $str1; ?>" <?= ( $rencana_penanganan['risiko_residual']== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( $rencana_penanganan['risiko_residual']== htmlspecialchars($str2)) ? 'selected' : ''; ?>>YA</option>
                        <option value="<?= $str3; ?>" <?= ( $rencana_penanganan['risiko_residual']== htmlspecialchars($str3)) ? 'selected' : ''; ?>>TIDAK</option>
                    </select>
                </div>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/penangananRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
                    <button type="submit" class="btn tambah float-right m-3" name="submit" style="width: 120px; height: 40px;">
                    Edit
                    </button>
                </div>
                
            </form>                
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function change_periode_implentasi(){
        var x = document.getElementById("periode_implementasi").value;

        if (x == "Tanggal") {
            document.getElementById("implementasi").innerHTML = '<div class="col-sm-5 mb-3 mb-sm-0"><label for="jadwal">Jadwal Implementasi</label><input type="date" class="form-control" id="jadwal" name="tanggal_mulai" required value="<?= $rencana_penanganan['tanggal_mulai']; ?>" ></div><div class="col-sm-2 text-center sampai" style="margin-top: 35px;">Sampai</div><div class="col-sm-5"><label for="jadwal" style="color: #fff;">Jadwal Implementasi</label><input type="date" class="form-control" id="jadwal" name="tanggal_selesai" required value="<?= $rencana_penanganan['tanggal_selesai']; ?>"></div>' ;
        } else if (x == "Bulan"){
            document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal Implementasi (Bulan)</label> <select class="form-control" id="jadwal" name="jadwal" required><?php $str1=''; $str2='Januari'; $str3='Februari'; $str4='Maret'; $str5='April'; $str6='Meil'; $str7='Juni'; $str8='Juli'; $str9='Agustus'; $str10='September'; $str11='Oktober'; $str12='November'; $str13='Desember' ?><option value="<?= $str1; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option><option value="<?= $str2; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str2)) ? 'selected' : ''; ?>>Januari</option><option value="<?= $str3; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str3)) ? 'selected' : ''; ?>>Februari</option><option value="<?= $str4; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str4)) ? 'selected' : ''; ?>>Maret</option><option value="<?= $str5; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str5)) ? 'selected' : ''; ?>>April</option><option value="<?= $str6; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str6)) ? 'selected' : ''; ?>>Mei</option><option value="<?= $str7; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str7)) ? 'selected' : ''; ?>>Juni</option><option value="<?= $str8; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str8)) ? 'selected' : ''; ?>>Juli</option><option value="<?= $str9; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str9)) ? 'selected' : ''; ?>>Agustus</option><option value="<?= $str10; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str10)) ? 'selected' : ''; ?>>September</option><option value="<?= $str11; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str11)) ? 'selected' : ''; ?>>Oktober</option><option value="<?= $str12; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str12)) ? 'selected' : ''; ?>>November</option><option value="<?= $str13; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str13)) ? 'selected' : ''; ?>>Desember</option></select></div>';
        } else if (x == "Triwulan"){
            document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal implementasi (Triwulan)</label><select class="form-control" id="jadwal" name="jadwal" required><?php $str1=""; $str2="Triwulan I"; $str3="Triwulan II"; $str4="Triwulan III"; $str5="Triwulan IV"; ?><option value="<?= $str1; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option><option value="<?= $str2; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str2)) ? 'selected' : ''; ?>>Triwulan I</option><option value="<?= $str3; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str3)) ? 'selected' : ''; ?>>Triwulan II</option><option value="<?= $str4; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str4)) ? 'selected' : ''; ?>>Triwulan III</option><option value="<?= $str5; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str5)) ? 'selected' : ''; ?>>Triwulan IV</option></select></div>';
        } else if (x == "Semester"){
            document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal implementasi (Semester)</label><select class="form-control" id="jadwal" name="jadwal" required><?php $str1=""; $str2="Semester I"; $str3="Semester II";  ?><option value="<?= $str1; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option><option value="<?= $str2; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str2)) ? 'selected' : ''; ?>>Semester I</option><option value="<?= $str3; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str3)) ? 'selected' : ''; ?>>Semester II</option></select></div>';
        }
    }
    var x = document.getElementById("periode_implementasi").value;
    if (x == "Tanggal") {
        document.getElementById("implementasi").innerHTML = '<div class="col-sm-5 mb-3 mb-sm-0"><label for="jadwal">Jadwal Implementasi</label><input type="date" class="form-control" id="jadwal" name="tanggal_mulai" required value="<?= $rencana_penanganan['tanggal_mulai']; ?>"></div><div class="col-sm-2 text-center sampai" style="margin-top: 35px;">Sampai</div><div class="col-sm-5"><label for="jadwal" style="color: #fff;">Jadwal Implementasi</label><input type="date" class="form-control" id="jadwal" name="tanggal_selesai" required value="<?= $rencana_penanganan['tanggal_selesai']; ?>"></div>' ;
    } else if (x == "Bulan"){
        document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal Implementasi (Bulan)</label> <select class="form-control" id="jadwal" name="jadwal" required><?php $str1=''; $str2='Januari'; $str3='Februari'; $str4='Maret'; $str5='April'; $str6='Meil'; $str7='Juni'; $str8='Juli'; $str9='Agustus'; $str10='September'; $str11='Oktober'; $str12='November'; $str13='Desember' ?><option value="<?= $str1; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option><option value="<?= $str2; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str2)) ? 'selected' : ''; ?>>Januari</option><option value="<?= $str3; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str3)) ? 'selected' : ''; ?>>Februari</option><option value="<?= $str4; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str4)) ? 'selected' : ''; ?>>Maret</option><option value="<?= $str5; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str5)) ? 'selected' : ''; ?>>April</option><option value="<?= $str6; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str6)) ? 'selected' : ''; ?>>Mei</option><option value="<?= $str7; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str7)) ? 'selected' : ''; ?>>Juni</option><option value="<?= $str8; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str8)) ? 'selected' : ''; ?>>Juli</option><option value="<?= $str9; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str9)) ? 'selected' : ''; ?>>Agustus</option><option value="<?= $str10; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str10)) ? 'selected' : ''; ?>>September</option><option value="<?= $str11; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str11)) ? 'selected' : ''; ?>>Oktober</option><option value="<?= $str12; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str12)) ? 'selected' : ''; ?>>November</option><option value="<?= $str13; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str13)) ? 'selected' : ''; ?>>Desember</option></select></div>';
    } else if (x == "Triwulan"){
        document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal implementasi (Triwulan)</label><select class="form-control" id="jadwal" name="jadwal" required><?php $str1=""; $str2="Triwulan I"; $str3="Triwulan II"; $str4="Triwulan III"; $str5="Triwulan IV"; ?><option value="<?= $str1; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option><option value="<?= $str2; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str2)) ? 'selected' : ''; ?>>Triwulan I</option><option value="<?= $str3; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str3)) ? 'selected' : ''; ?>>Triwulan II</option><option value="<?= $str4; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str4)) ? 'selected' : ''; ?>>Triwulan III</option><option value="<?= $str5; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str5)) ? 'selected' : ''; ?>>Triwulan IV</option></select></div>';
    } else if (x == "Semester"){
        document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal implementasi (Semester)</label><select class="form-control" id="jadwal" name="jadwal" required><?php $str1=""; $str2="Semester I"; $str3="Semester II";  ?><option value="<?= $str1; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option><option value="<?= $str2; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str2)) ? 'selected' : ''; ?>>Semester I</option><option value="<?= $str3; ?>" <?= ( $rencana_penanganan['periode_implementasi']== htmlspecialchars($str3)) ? 'selected' : ''; ?>>Semester II</option></select></div>';
    }
</script>
 
<?= $this->endSection(); ?>