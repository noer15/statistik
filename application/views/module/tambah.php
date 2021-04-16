<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<!-- /theme JS files -->
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>module/store" class="form-horizontal" method="post">
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
									<option value="Master">Master</option>
									<option value="Input">Input</option>
									<option value="Laporan">Laporan</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-1 control-label">Sub Modul 1</label>
							<div class="col-lg-5">
								<select name="sub1" class="form-control" id="">
									<option value="">--Pilih Sub Menu--</option>
									<?php foreach($this->db->query('SELECT sub1 FROM module GROUP BY sub1')->result() as $data): ?>
										<option value="<?=$data->sub1?>"><?=$data->sub1 ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<label class="col-lg-1 control-label">Sub Modul 2</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="Sub Modul ke 2.." name="sub2">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-1 control-label">Nama Modul</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="Nama Modul.." name="name">
							</div>
							<label class="col-lg-1 control-label">Kontroler</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="Kontroler..." name="controller">
							</div>
						</div>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>module" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>