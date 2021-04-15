<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<!-- /theme JS files -->
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>module/update" class="form-horizontal" method="post">
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
							<label class="col-lg-1 control-label">Modul Utama</label>
							<div class="col-lg-11">
								<select name="module" class="form-control">
									<option value="Master" <?= $data->module == 'Master' ? 'selected' : '' ?>>Master</option>
									<option value="Input" <?= $data->module == 'Input' ? 'selected' : '' ?>>Input</option>
									<option value="Laporan" <?= $data->module == 'Laporan' ? 'selected' : '' ?>>Laporan</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-1 control-label">Sub Modul 1</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="Sub Modul ke 1.." name="sub1" value="<?=$data->sub1?>">
							</div>
							<label class="col-lg-1 control-label">Sub Modul 2</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="Sub Modul ke 2.." name="sub2" value="<?=$data->sub2?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-1 control-label">Nama Modul</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="Nama Modul.." name="name" value="<?=$data->name?>">
							</div>
							<label class="col-lg-1 control-label">Kontroler / link modul</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="Kontroler..." name="controller" value="<?=$data->controller?>">
							</div>
						</div>
						
						<div class="text-left">
							<input type="hidden" name="id" value="<?=$data->id?>">
							<a href="<?php echo base_url();?>module" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>