<?= $this->extend('templates_pemilik_risiko/index'); ?>
<?= $this->section('content'); ?>

<style>

.btn.menu{
    width: 678px;
     border-radius: 30px;
}


</style>

<div class="mb-2">
    <h1 class="h3  text-gray-800 font-weight-bold" style="text-transform: uppercase;">
        <a href="<?= base_url('pemilikRisiko'). '/'. $link ?>"><?= $title ?></a>
    </h1>
    <ol class="breadcrumb px-3 py-2 rounded mb-0">
        <li class="breadcrumb-item active">
            <?= $title ?>
        </li>

    </ol>
</div>

<div id="flash"><?= session()->flash; ?></div>

<!-- Konten -->
<div class="card shadow  m-5">
    <div class="card-body mt-5">
        <div class="form-group">
            <div class="row justify-content-center">
				<a href="<?= base_url('pemilikRisiko/informasiUmum'); ?>" class="btn menu">Inventarisasi Informasi Umum (Formulir 2.1)</a>
				<a href="<?= base_url('pemilikRisiko/sasaranSPBE'); ?>" class="btn menu mt-3">Identifikasi Sasaran SPBE (Formulir 2.2)</a>
				<a href="<?= base_url('pemilikRisiko/strukturPelaksana'); ?>" class="btn menu mt-3">Penentuan Struktur Pelaksana Manajemen Risiko SPBE (Formulir 2.3)</a>
				<a href="<?= base_url('pemilikRisiko/pemangkuKepentingan'); ?>" class="btn menu mt-3">Identifikasi Pemangku Kepentingan (Formulir 2.4)</a>
				<a href="<?= base_url('pemilikRisiko/peraturanPerundangan'); ?>" class="btn menu mt-3">Identifikasi Peraturan Perundang-undangan (Formulir 2.5)</a>
				<a href="<?= base_url('pemilikRisiko/kategoriRisikoTerpilih'); ?>" class="btn menu mt-3">Penetapan Kategori Risiko (Formulir 2.6)</a>
				<a href="<?= base_url('pemilikRisiko/areaDampakRisikoTerpilih'); ?>" class="btn menu mt-3">Penetapan Area Dampak Risiko SPBE (Formulir 2.7)</a>
				<a href="<?= base_url('pemilikRisiko/kriteriaRisiko'); ?>" class="btn menu mt-3">Penetapan Kriteria Risiko SPBE (Formulir 2.8)</a>
				<a href="<?= base_url('pemilikRisiko/matriksLevelRisiko'); ?>" class="btn menu mt-3">Matriks Analisis dan Level Risiko SPBE (Formulir 2.9)</a>
				<a href="<?= base_url('pemilikRisiko/seleraRisiko'); ?>" class="btn menu mt-3 mb-5">Penetapan Selera Risiko SPBE (Formulir 2.10)</a>
            </div>

        </div>
        <div class="table-responsive" id="tabel-pengguna">
        </div>
    </div>
</div>

<?= $this->endSection(); ?>