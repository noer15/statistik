<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>

	<!-- Global stylesheets -->
	
	<link href="<?php echo base_url();?>assets/limitless/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/limitless/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/limitless/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/limitless/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/limitless/assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/login.js"></script>
	<!-- /theme JS files -->

</head>

<body class="login-container bg-slate-800">

	

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Advanced login -->
					<form action="<?php echo base_url()?>login/doLogin" method="post">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="text-slate-300">
									<img src="<?php echo base_url();?>assets/images/logo.png" 
									 style="width: 30%;height: 30%;">
								</div>
								<h5 class="content-group-lg"> <strong>STATISTIK </strong>
									<small class="display-block">
										<b>Dinas Kehutanan Provinsi Jawa Barat</b>
									</small>
									<small class="display-block text-green-800">									
									<p><b><br></b> </p></small>
								</h5>
							</div>
							
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" placeholder="Username: isi dengan NIP " name="username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn bg-teal-400 btn-block">Login <i class="icon-circle-right2 position-right"></i></button>
							</div>

							<!-- <div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
							<a href="<?php echo base_url()?>signup" class="btn bg-slate btn-block content-group">Register</a>
 -->
							<span class="help-block text-center no-margin">Jika terdapat kendala, SIlahkan hubungi admin, agar informasi lebih terpercaya</span>
						</div>
					</form>
					<!-- /advanced login -->


					
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
