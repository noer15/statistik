<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $judul;?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
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

	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/app.js"></script>
    
	

</head>

<body>

	<!-- Main navbar -->
	<?php $this->load->view("header");?>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<?php $this->load->view("usermenu");?>
					<!-- /user menu -->


					<!-- Main navigation -->
					<?php $this->load->view("sidebar");?>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> 
								<span class="text-semibold"><?php echo $judul;?></span> 
							</h4>
						</div>						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo base_url();?>home"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active"><?php echo $judul;?></li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<?php
                    if ($subpage=='list'){
                        include "list.php";
                    }else
                    if ($subpage=='tambah'){
                        include "tambah.php";
                    }else
                    if ($subpage=='edit'){
                        include "edit.php";
                    }

                ?>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

<div id="modal-delete" class="modal fade" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="true"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete</h4>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus data ini?
            </div>
            <div class="modal-footer">
            	<input type="hidden" class="form-control" id="data-id" name="id" value="" />
                <button type="button" data-dismiss="modal" class="btn btn-danger">Tidak</button>
                <button type="button" class="btn btn-primary submit" name="submit" >Ya</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
