<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Kabupaten/update" class="form-horizontal" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?php echo $header;?></h5>
						<div class="heading-elements">
							<ul class="icons-list">
						    	<li><a data-action="collapse"></a></li>
						        <li><a data-action="reload"></a></li>
						        <li><a data-action="close"></a></li>
						    </ul>
					    </div>
					</div>		
					<div class="panel-body">
						<div class="form-group">
							<label class="col-lg-2 control-label">Kode</label>
							<div class="col-lg-10">
								<input type="hidden" class="form-control" placeholder="id" name="id" readonly
									value="<?php echo $data[0]->id?>">
								<input type="number" class="form-control" placeholder="Kode" name="kode" readonly
									value="<?php echo $data[0]->kode?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Nama Kabupaten/Kota</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Nama Kabupaten/Kota" name="nama"
									value="<?php echo $data[0]->nama?>">
							</div>
						</div>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>Kabupaten" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>