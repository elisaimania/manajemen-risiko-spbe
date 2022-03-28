<?= $this->include('templates/header'); ?>
<?= $this->include('templates/sidebar'); ?>
<?= $this->include('templates/navbar'); ?>

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
</style>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        	<!-- Page Heading -->

            <?= $this->renderSection('content'); ?>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?= $this->include('templates/footer'); ?>