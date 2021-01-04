<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register - Statistik</title>

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

	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/components_modals.js"></script>

	<script type="text/javascript">
		$(function(){
			var url = "<?php echo base_url(); ?>";
			var notif = "<?php echo $notif; ?>";

			if (notif!=''){
				$('#modal_message').modal();
				
			}
			$('#modal_message').on('hidden.bs.modal', function (e) {
			    if(notif=='sukses'){
			  		window.location = url;
				}else{
					window.location = url+'signup';
				}
			});
			

		});
	</script>


</head>

<body class="bg-slate-800"">

	

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Registration form -->
					<form action="<?php echo base_url();?>Login/create" method="post">
						<div class="row">
							
							<div class="col-lg-6 col-lg-offset-3">
								<div class="panel registration-form">
									<div class="panel-body">
										<div class="text-center">
											<div class="text-default-300">
												<img src="<?php echo base_url();?>assets/images/logo.png" 
												 style="width: 12%;height: 12%;">
												 <h5 class="content-group-lg"> <strong>STATISTIK </strong>
													<small class="display-block text-default">
														<b>Dinas Kehutanan Provinsi Jawa Barat</b>
													</small>
													
												</h5>
											</div>
										</div>							
									
										<div class="text-left">
											<h5 class="content-group-lg">Registrasi account 
												<small class="display-block">All fields are required</small>
											</h5>
										</div>

										<div class="form-group has-feedback">
											<input type="email" class="form-control" placeholder="Username, isi dengan email" name="username" required >
											<div class="form-control-feedback">
												<i class="icon-mention text-muted"></i>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="NIP" name="nip" required>
													<div class="form-control-feedback">
														<i class="icon-user-check text-muted"></i>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Nama" name="nama" required>
													<div class="form-control-feedback">
														<i class="icon-user-check text-muted"></i>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group has-feedback">
					                            <select name="uk"  id="uk" class="select-search" required
					                                data-placeholder="Pilih Unit Kerja">
					                                <?php foreach ($unitkerja as $key => $value) { ?>
					                                    <option value="<?php echo $value->id?>">
					                                    	<?php echo $value->nama?>                                    		
					                                    </option>
					                                <?php }  ?>
					                                
					                            </select>
					                            </div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group has-feedback">
					                            <select name="jenis"  id="jenis" class="select-search" required
					                                data-placeholder="Pilih Kategori">
					                                    <option value="3">Penyuluh</option>					
					                                    <option value="2">Bukan Penyuluh</option>
					                            </select>
					                            </div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group has-feedback">
													<input type="password" class="form-control" placeholder="Create password" name="password" required>
													<div class="form-control-feedback">
														<i class="icon-user-lock text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback">
													<input type="password" class="form-control" placeholder="Repeat password" name="repassword" required>
													<div class="form-control-feedback">
														<i class="icon-user-lock text-muted"></i>
													</div>
												</div>
											</div>
										</div>
										
										<div class="text-right">
											<a href="<?php echo base_url();?>" class="btn btn-link">
												<i class="icon-arrow-left13 position-left"></i> 
												Back to login form </a>											
											<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Simpan account</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					<!-- /registration form -->


					
				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	 <!-- Basic modal -->
	<div id="modal_message" class="modal fade">
		<div class="modal-dialog text-default">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title"><strong>Register</strong></h5>
				</div>

				<div class="modal-body">
					<?php if ($notif=='sukses') { ?>
					  <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						Register Sukses, Silahkan Login ...
					  </div>
					 <?php }else { ?>
					 	<div class="alert alert-danger alert-styled-left text-blue-800 content-group">
							<?php echo $message;?>
					  	</div>
					 <?php } ?>
					
					<hr>
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>					
				</div>
			</div>
		</div>
	</div>
	<!-- /basic modal -->

</body>
</html>
