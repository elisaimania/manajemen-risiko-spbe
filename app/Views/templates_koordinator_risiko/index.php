<?= $this->include('templates_koordinator_risiko/header'); ?>
<?= $this->include('templates_koordinator_risiko/sidebar'); ?>
<?= $this->include('templates_koordinator_risiko/navbar'); ?>

<style type="text/css">
	.breadcrumb {
		background-color: #fff;
	}
	a {
  		color: #5a5c69;
  		text-decoration: none;
  		background-color: transparent;
}

a:hover {
  		color: #858796;
  		text-decoration: none;

}
.btn.menu{
    background-color: #8CBA08; 
    border-color: #8CBA08; 
    color:#fff;
   
}
.btn.menu:hover{
    background-color:#A1D70A;
    color: #fff;
}
.btn.menu.active{
    border-color: #6C8624;
    border-width: 3px;
}
</style>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        	<!-- Page Heading -->

            <?= $this->renderSection('content'); ?>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php if ($link=='penetapanKonteks'  && !empty($subtitle)) : ?>
   <div class="col-0 mx-auto mb-3">
      <a href="<?= base_url('KoordinatorRisiko/informasiUmum'); ?>" class="btn menu <?= ($subtitle==='Inventarisasi Informasi Umum (2.1)') ? 'active' : ''; ?>">2.1</a>
      <a href="<?= base_url('KoordinatorRisiko/sasaranSPBE'); ?>" class="btn menu  <?= (!empty($informasiUmum)) ? 'disabled' : ''; ?>  <?= ($subtitle==='Identifikasi Sasaran SPBE (2.2)') ? 'active' : ''; ?>">2.2</a>
      <a href="<?= base_url('KoordinatorRisiko/strukturPelaksana'); ?>" class="btn menu  <?= (!empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?> <?= ($subtitle==='Penentuan Struktur Pelaksana (2.3)') ? 'active' : ''; ?>">2.3</a>
      <a href="<?= base_url('KoordinatorRisiko/pemangkuKepentingan'); ?>" class="btn menu <?= (!empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?> <?= ($subtitle==='Identifikasi Pemangku Kepentingan (2.4)') ? 'active' : ''; ?>">2.4</a>
      <a href="<?= base_url('KoordinatorRisiko/peraturanPerundangan'); ?>" class="btn menu <?= (!empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?> <?= ($subtitle==='Identifikasi Peraturan Perundang-undangan (2.5)') ? 'active' : ''; ?>">2.5</a>
      <a href="<?= base_url('KoordinatorRisiko/kategoriRisikoTerpilih'); ?>" class="btn menu <?= (!empty($peraturanPerundangan) || !empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?> <?= ($subtitle==='Penetapan Kategori Risiko SPBE (2.6)') ? 'active' : ''; ?>">2.6</a>
      <a href="<?= base_url('KoordinatorRisiko/areaDampakRisikoTerpilih'); ?>" class="btn menu  <?= (!empty($kategoriRisikoTerpilih) || !empty($peraturanPerundangan) || !empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?> <?= ($subtitle==='Penetapan Area Dampak Risiko SPBE (2.7)') ? 'active' : ''; ?>">2.7</a>
      <a href="<?= base_url('KoordinatorRisiko/kriteriaRisiko'); ?>" class="btn menu <?= (!empty($areaDampakTerpilih) || !empty($kategoriRisikoTerpilih) || !empty($peraturanPerundangan) || !empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?> <?= ($subtitle==='Penetapan Kriteria Risiko SPBE (2.8)') ? 'active' : ''; ?>">2.8</a>
      <a href="<?= base_url('KoordinatorRisiko/matriksLevelRisiko'); ?>" class="btn menu <?= (!empty($kriteriaKemungkinan) || !empty($kriteriaDampak)  || !empty($areaDampakTerpilih) || !empty($kategoriRisikoTerpilih) || !empty($peraturanPerundangan) || !empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?> <?= ($subtitle==='Matriks Analisis dan Level Risiko SPBE (2.9)') ? 'active' : ''; ?>">2.9</a>
      <a href="<?= base_url('KoordinatorRisiko/seleraRisiko'); ?>" class="btn menu <?= (!empty($kriteriaKemungkinan) || !empty($kriteriaDampak)  || !empty($areaDampakTerpilih) || !empty($kategoriRisikoTerpilih) || !empty($peraturanPerundangan) || !empty($pemangkuKepentingan) || !empty($strukturPelaksana) || !empty($sasaranSPBE) || !empty($informasiUmum)) ? 'disabled' : ''; ?> <?= ($subtitle==='Penetapan Selera Risiko SPBE (2.10)') ? 'active' : ''; ?>">2.10</a>
    </div>
<?php endif ?>

<?= $this->include('templates_koordinator_risiko/footer'); ?>