<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>sarpras/update" class="form-horizontal" method="post">
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
							<label class="col-lg-2 control-label">Sarana dan prasarana</label>
							<div class="col-lg-10">
								<select name="id_sdm" class="form-control" id="">
								<?php foreach ($this->db->get('m_sdm_sarpras')->result() as $item): ?>
									<option value="<?=$item->id ?>" <?= $data->id_sdm == $item->id ? 'selected' : '' ?>><?=$item->nama?></option>
								<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Jumlah</label>
							<div class="col-lg-4">
								<input type="number" class="form-control" placeholder="Jumlah SDM dan Sarana Prasarana" name="jumlah_sarpras" value="<?=$data->jumlah_sarpras?>">
							</div>

							<label class="col-lg-2 control-label">Satuan</label>
							<div class="col-lg-4">
							<select name="id_satuan" class="form-control" id="">
								<?php foreach ($this->db->get('m_satuan')->result() as $item): ?>
									<option value="<?=$item->id ?>" <?= $data->id_satuan == $item->id ? 'selected' : '' ?>><?=$item->nama?></option>
								<?php endforeach; ?>
								</select>
							</div>
						</div>
						
						<div class="text-left">
							<input type="hidden" name="id" value="<?=$data->id?>">
							<a  href="<?php echo base_url();?>Sdmsarpras" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>