<?= $this->include('templates_admin/header'); ?>
<?= $this->include('templates_admin/sidebar'); ?>
<?= $this->include('templates_admin/navbar'); ?>

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
<?= $this->include('templates_admin/footer'); ?>