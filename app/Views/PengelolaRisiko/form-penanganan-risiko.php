<?= $this->extend('templates_pengelola_risiko/index'); ?>
<?= $this->section('content'); ?>
<?php $val = service('validation') ?>
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
                    <div class="col">
                        <label for="id_risiko">ID Risiko yang Akan Ditangani 
                        </label>
                        <div class="row">
                            <input type="text" class="form-control col-sm-7 text-center" id="id_risiko" name="id_risiko" required value="ID_<?= $id; ?>" disabled>
                            <a href="<?= base_url('pengelolaRisiko/pilihRisiko'); ?>" type="button" class="btn btn-secondary cols-sm-3 ml-3" >Ganti</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_opsi_penanganan">Pilih Opsi Penanganan Risiko SPBE</label>
                    <select class="form-control" id="id_opsi_penanganan" name="id_opsi_penanganan" required>
                        <option value=""></option>
                        <?php foreach ($daftarOpsiPenanganan as $r ) : ?>
                            <option value="<?= $r['id']; ?>" <?= ( old('id_opsi_penanganan')==$r['id']) ? 'selected' : ''; ?>><?= $r['opsi_penanganan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="rencana_aksi">Rencana Aksi Penanganan Risiko SPBE
                        </label>
                        <textarea class="form-control" id="rencana_aksi" name="rencana_aksi" required><?= old('rencana_aksi'); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="keluaran">Keluaran
                        </label>
                        <textarea  class="form-control" id="keluaran" name="keluaran" required><?= old('keluaran'); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="periode_implementasi">Pilih Jenis Periode Implementasi</label>
                    <select class="form-control" id="periode_implementasi" name="periode_implementasi" onchange="change_periode_implentasi()" required>
                        <?php $str1=''; $str2='Tanggal'; $str3='Bulan'; $str4='Triwulan'; $str5='Semester'; ?>
                        <option value="<?= $str1; ?>" <?= ( old('periode_implementasi')== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( old('periode_implementasi')== htmlspecialchars($str2)) ? 'selected' : ''; ?>>Tanggal</option>
                        <option value="<?= $str3; ?>" <?= ( old('periode_implementasi')== htmlspecialchars($str3)) ? 'selected' : ''; ?>>Bulan</option>
                        <option value="<?= $str4; ?>" <?= ( old('periode_implementasi')== htmlspecialchars($str4)) ? 'selected' : ''; ?>>Triwulan</option>
                        <option value="<?= $str5; ?>" <?= ( old('periode_implementasi')== htmlspecialchars($str5)) ? 'selected' : ''; ?>>Semester</option>
                    </select>
                </div>
                <?= ($val->hasError('tanggal_mulai')) ? '<span class="text-sm text-danger" style="font-size:15px">' . $val->getError('tanggal_mulai') .'*</span><br>' : ''; ?>
                <div class="form-group row" id="implementasi" >
                    
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="penanggungjawab">Penanggungjawab 
                        </label>
                        <input type="text" class="form-control" id="penanggungjawab" name="penanggungjawab" required value="<?= old('penanggungjawab'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="risiko_residual">Apakah Terdapat Risiko Residual?</label>
                    <select class="form-control" id="risiko_residual" name="risiko_residual" required>
                        <?php $str1=''; $str2='YA'; $str3='TIDAK' ?>
                        <option value="<?= $str1; ?>" <?= ( old('risiko_residual')== htmlspecialchars($str1)) ? 'selected' : ''; ?>></option>
                        <option value="<?= $str2; ?>" <?= ( old('risiko_residual')== htmlspecialchars($str2)) ? 'selected' : ''; ?>>YA</option>
                        <option value="<?= $str3; ?>" <?= ( old('risiko_residual')== htmlspecialchars($str3)) ? 'selected' : ''; ?>>TIDAK</option>
                    </select>
                </div>
                <div class="col mt-5">
                </div>
                <div class="col mt-5">
                    <a href="<?= base_url('pengelolaRisiko/penangananRisiko'); ?>" class="btn  btn-secondary float-right m-3" style="width: 120px; height: 40px;">Batal</a>
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
    function change_periode_implentasi(){
        var x = document.getElementById("periode_implementasi").value;

        if (x == "Tanggal") {
            document.getElementById("implementasi").innerHTML = '<div class="col-sm-5 mb-3 mb-sm-0"><label for="jadwal">Jadwal Implementasi</label><input type="date" class="form-control" id="jadwal" name="tanggal_mulai" required value="<?= old('tanggal_mulai'); ?>"></div><div class="col-sm-2 text-center sampai" style="margin-top: 35px;">Sampai</div><div class="col-sm-5"><label for="jadwal" style="color: #fff;">Jadwal Implementasi</label><input type="date" class="form-control" id="jadwal" name="tanggal_selesai" required value="<?= old('tanggal_selesai'); ?>"></div>' ;
        } else if (x == "Bulan"){
            document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal Implementasi (Bulan)</label> <select class="form-control" id="jadwal" name="jadwal" required><?php $str1=''; $str2='Januari'; $str3='Februari'; $str4='Maret'; $str5='April'; $str6='Meil'; $str7='Juni'; $str8='Juli'; $str9='Agustus'; $str10='September'; $str11='Oktober'; $str12='November'; $str13='Desember' ?><option value="<?= $str1; ?>"></option><option value="<?= $str2; ?>">Januari</option><option value="<?= $str3; ?>">Februari</option><option value="<?= $str4; ?>">Maret</option><option value="<?= $str5; ?>">April</option><option value="<?= $str6; ?>">Mei</option><option value="<?= $str7; ?>">Juni</option><option value="<?= $str8; ?>">Juli</option><option value="<?= $str9; ?>">Agustus</option><option value="<?= $str10; ?>">September</option><option value="<?= $str11; ?>">Oktober</option><option value="<?= $str12; ?>">November</option><option value="<?= $str13; ?>">Desember</option></select></div>';
        } else if (x == "Triwulan"){
            document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal implementasi (Triwulan)</label><select class="form-control" id="jadwal" name="jadwal" required><?php $str1=""; $str2="Triwulan I"; $str3="Triwulan II"; $str4="Triwulan III"; $str5="Triwulan IV"; ?><option value="<?= $str1; ?>"></option><option value="<?= $str2; ?>">Triwulan I</option><option value="<?= $str3; ?>">Triwulan II</option><option value="<?= $str4; ?>">Triwulan III</option><option value="<?= $str5; ?>">Triwulan IV</option></select></div>';
        } else if (x == "Semester"){
            document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal implementasi (Semester)</label><select class="form-control" id="jadwal" name="jadwal" required><?php $str1=""; $str2="Semester I"; $str3="Semester II";  ?><option value="<?= $str1; ?>"></option><option value="<?= $str2; ?>">Semester I</option><option value="<?= $str3; ?>">Semester II</option></select></div>';
        }
    }
    var x = document.getElementById("periode_implementasi").value;
    if (x == "Tanggal") {
        document.getElementById("implementasi").innerHTML = '<div class="col-sm-5 mb-3 mb-sm-0"><label for="jadwal">Jadwal Implementasi</label><input type="date" class="form-control" id="jadwal" name="tanggal_mulai" required value="<?= old('tanggal_mulai'); ?>"></div><div class="col-sm-2 text-center sampai" style="margin-top: 35px;">Sampai</div><div class="col-sm-5"><label for="jadwal" style="color: #fff;">Jadwal Implementasi</label><input type="date" class="form-control" id="jadwal" name="tanggal_selesai" required value="<?= old('tanggal_selesai'); ?>"></div>' ;
    } else if (x == "Bulan"){
        document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal Implementasi (Bulan)</label> <select class="form-control" id="jadwal" name="jadwal" required><?php $str1=''; $str2='Januari'; $str3='Februari'; $str4='Maret'; $str5='April'; $str6='Meil'; $str7='Juni'; $str8='Juli'; $str9='Agustus'; $str10='September'; $str11='Oktober'; $str12='November'; $str13='Desember' ?><option value="<?= $str1; ?>"></option><option value="<?= $str2; ?>">Januari</option><option value="<?= $str3; ?>">Februari</option><option value="<?= $str4; ?>">Maret</option><option value="<?= $str5; ?>">April</option><option value="<?= $str6; ?>">Mei</option><option value="<?= $str7; ?>">Juni</option><option value="<?= $str8; ?>">Juli</option><option value="<?= $str9; ?>">Agustus</option><option value="<?= $str10; ?>">September</option><option value="<?= $str11; ?>">Oktober</option><option value="<?= $str12; ?>">November</option><option value="<?= $str13; ?>">Desember</option></select></div>';
    } else if (x == "Triwulan"){
        document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal implementasi (Triwulan)</label><select class="form-control" id="jadwal" name="jadwal" required><?php $str1=""; $str2="Triwulan I"; $str3="Triwulan II"; $str4="Triwulan III"; $str5="Triwulan IV"; ?><option value="<?= $str1; ?>"></option><option value="<?= $str2; ?>">Triwulan I</option><option value="<?= $str3; ?>">Triwulan II</option><option value="<?= $str4; ?>">Triwulan III</option><option value="<?= $str5; ?>">Triwulan IV</option></select></div>';
    } else if (x == "Semester"){
        document.getElementById("implementasi").innerHTML = '<div class="col"><label for="jadwal">Pilih Jadwal implementasi (Semester)</label><select class="form-control" id="jadwal" name="jadwal" required><?php $str1=""; $str2="Semester I"; $str3="Semester II";  ?><option value="<?= $str1; ?>"></option><option value="<?= $str2; ?>">Semester I</option><option value="<?= $str3; ?>">Semester II</option></select></div>';
    }
</script>
 
<?= $this->endSection(); ?>