<?= $this->extend('templates_koordinator_risiko/index'); ?>
<?= $this->section('content'); ?>

<style>

.btn.menu{
    width: 678px;
     border-radius: 30px;
}



</style>

<div class="mb-2">
    <h1 class="h3  text-gray-800 font-weight-bold" style="text-transform: uppercase;">
        <a href="<?= base_url('KoordinatorRisiko'). '/'. $link ?>"><?= $title ?></a>
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
				<a href="<?= base_url('KoordinatorRisiko/informasiUmum'); ?>" class="btn menu ">Inventarisasi Informasi Umum (Formulir 2.1)</a>
				<a href="<?= base_url('KoordinatorRisiko/sasaranSPBE'); ?>" class="btn menu mt-3 <?= !(empty($informasiUmum)) ? 'disabled' : ''; ?>">Identifikasi Sasaran SPBE (Formulir 2.2)</a>
				<a href="<?= base_url('KoordinatorRisiko/strukturPelaksana'); ?>" class="btn menu mt-3 <?= (!empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?>">Penentuan Struktur Pelaksana Manajemen Risiko SPBE (Formulir 2.3)</a>
				<a href="<?= base_url('KoordinatorRisiko/pemangkuKepentingan'); ?>" class="btn menu mt-3 <?= (!empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?>">Identifikasi Pemangku Kepentingan (Formulir 2.4)</a>
				<a href="<?= base_url('KoordinatorRisiko/peraturanPerundangan'); ?>" class="btn menu mt-3 <?= (!empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?>">Identifikasi Peraturan Perundang-undangan (Formulir 2.5)</a>
				<a href="<?= base_url('KoordinatorRisiko/kategoriRisikoTerpilih'); ?>" class="btn menu mt-3 <?= (!empty($peraturanPerundangan) || !empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?>">Penetapan Kategori Risiko (Formulir 2.6)</a>
				<a href="<?= base_url('KoordinatorRisiko/areaDampakRisikoTerpilih'); ?>" class="btn menu mt-3 <?= (!empty($kategoriRisikoTerpilih) || !empty($peraturanPerundangan) || !empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?>">Penetapan Area Dampak Risiko SPBE (Formulir 2.7)</a>
				<a href="<?= base_url('KoordinatorRisiko/kriteriaRisiko'); ?>" class="btn menu mt-3 <?= (!empty($areaDampakTerpilih) || !empty($kategoriRisikoTerpilih) || !empty($peraturanPerundangan) || !empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?>">Penetapan Kriteria Risiko SPBE (Formulir 2.8)</a>
				<a href="<?= base_url('KoordinatorRisiko/matriksLevelRisiko'); ?>" class="btn menu mt-3 <?= (!empty($kriteriaKemungkinan) || !empty($kriteriaDampak) ||  !empty($areaDampakTerpilih) || !empty($kategoriRisikoTerpilih) || !empty($peraturanPerundangan) || !empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?>">Matriks Analisis dan Level Risiko SPBE (Formulir 2.9)</a>
				<a href="<?= base_url('KoordinatorRisiko/seleraRisiko'); ?>" class="btn menu mt-3 mb-5 <?= (!empty($kriteriaKemungkinan) || !empty($kriteriaDampak) ||  !empty($areaDampakTerpilih) || !empty($kategoriRisikoTerpilih) || !empty($peraturanPerundangan) || !empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?>">Penetapan Selera Risiko SPBE (Formulir 2.10)</a>
            </div>

        </div>
        <div class="table-responsive" id="tabel-pengguna">
        </div>
    </div>
</div>

<?= $this->endSection(); ?>