<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home - Statistik</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/pickers/daterangepicker.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/pages/dashboard.js"></script>
	<!-- /theme JS files -->
	<style>
		.box-shadow {
			-webkit-box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .1), 0 2px 4px -1px rgba(0, 0, 0, .06);
			box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .1), 0 2px 4px -1px rgba(0, 0, 0, .06);
			background: #fff;
			padding: 1.5rem;
			border-radius: 4px;
			height: 100px;
		}
	</style>
</head>

<body>

	<!-- Main navbar -->
	<?php $this->load->view("header"); ?>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<?php $this->load->view("usermenu"); ?>
					<!-- /user menu -->


					<!-- Main navigation -->
					<?php $this->load->view("sidebar"); ?>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">


					<!-- Dashboard content -->
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-3">
								<div class="box-shadow">
									<p>
										<span class="data__">Data Pegawai</span>
									<h1><?= $this->db->get('tb_pegawai')->num_rows() ?></h1>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="box-shadow">
									<p>
									<h1>34</h1>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="box-shadow">
									<p>
									<h1>22</h1>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="box-shadow">
									<p>
									<h1>232</h1>
									</p>
								</div>
							</div>

						</div>
					</div>
					<!-- /dashboard content -->


					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2018 <a href="#">Statistik</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>

</html>