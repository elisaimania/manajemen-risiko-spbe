<?= $this->include('templates_pemilik_risiko/header'); ?>
<?= $this->include('templates_pemilik_risiko/sidebar'); ?>
<?= $this->include('templates_pemilik_risiko/navbar'); ?>

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
<?php if ($link=='penetapanKonteks' && !empty($subtitle)) : ?>
   <div class="col-0 mx-auto mb-3">
      <a href="<?= base_url('PemilikRisiko/informasiUmum'); ?>" class="btn menu <?= ($subtitle==='Inventarisasi Informasi Umum (2.1)') ? 'active' : ''; ?>">2.1</a>
      <a href="<?= base_url('PemilikRisiko/sasaranSPBE'); ?>" class="btn menu  <?= ($subtitle==='Identifikasi Sasaran SPBE (2.2)') ? 'active' : ''; ?>">2.2</a>
      <a href="<?= base_url('PemilikRisiko/strukturPelaksana'); ?>" class="btn menu  <?= ($subtitle==='Penentuan Struktur Pelaksana (2.3)') ? 'active' : ''; ?>">2.3</a>
      <a href="<?= base_url('PemilikRisiko/pemangkuKepentingan'); ?>" class="btn menu <?= ($subtitle==='Identifikasi Pemangku Kepentingan (2.4)') ? 'active' : ''; ?>">2.4</a>
      <a href="<?= base_url('PemilikRisiko/peraturanPerundangan'); ?>" class="btn menu <?= ($subtitle==='Identifikasi Peraturan Perundang-undangan (2.5)') ? 'active' : ''; ?>">2.5</a>
      <a href="<?= base_url('PemilikRisiko/kategoriRisikoTerpilih'); ?>" class="btn menu <?= ($subtitle==='Penetapan Kategori Risiko SPBE (2.6)') ? 'active' : ''; ?>">2.6</a>
      <a href="<?= base_url('PemilikRisiko/areaDampakRisikoTerpilih'); ?>" class="btn menu <?= ($subtitle==='Penetapan Area Dampak Risiko SPBE (2.7)') ? 'active' : ''; ?>">2.7</a>
      <a href="<?= base_url('PemilikRisiko/kriteriaRisiko'); ?>" class="btn menu <?= ($subtitle==='Penetapan Kriteria Risiko SPBE (2.8)') ? 'active' : ''; ?>">2.8</a>
      <a href="<?= base_url('PemilikRisiko/matriksLevelRisiko'); ?>" class="btn menu <?= ($subtitle==='Matriks Analisis dan Level Risiko SPBE (2.9)') ? 'active' : ''; ?>">2.9</a>
      <a href="<?= base_url('PemilikRisiko/seleraRisiko'); ?>" class="btn menu <?= ($subtitle==='Penetapan Selera Risiko SPBE (2.10)') ? 'active' : ''; ?>">2.10</a>
    </div>
<?php endif ?>

<?= $this->include('templates_pemilik_risiko/footer'); ?>