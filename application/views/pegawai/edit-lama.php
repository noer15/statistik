<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


<!-- /theme JS files -->
<div class="content">
	<!-- Highlighted tabs -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Tambah/Edit Pegawai &nbsp;&nbsp; <code> <?php echo $data[0]->nama; ?></code></h6>
					<div class="heading-elements">
						<ul class="icons-list">
					    	<li><a data-action="collapse"></a></li>
					        <li><a data-action="reload"></a></li>
					        <li><a data-action="close"></a></li>
					    </ul>
				    </div>
				</div>

				<div class="panel-body">
					<form action="<?php echo base_url();?>pegawai/updateProfile" class="form-horizontal" method="post">
						<input type="hidden" name="id" value="<?php echo $data[0]->id; ?>">
						<div class="form-group">
							<label class="col-lg-2 control-label">NIP</label>
							<div class="col-lg-10">
								<input type="number" class="form-control" readonly
									placeholder="NIP" 
									name="nip" value="<?php echo $data[0]->nip; ?>" 
									data-validation="required">
								<span class="help-block text-danger"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Nama</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Nama" 
									name="nama"  value="<?php echo $data[0]->nama; ?>" 
									data-validation="required">
								<span class="help-block text-danger"></span>
							</div>
						</div>
										
						<div class="text-left">
							<a  href="<?php echo base_url();?>pegawai" class="btn btn-danger">Batal</a>
							
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>				
					</form>
				</div>


			</div>
		</div>						
	</div>
	<!-- /highlighted tabs -->
	
</div>
