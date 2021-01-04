<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/loaders/blockui.min.js"></script>
	
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>
<script src="<?php echo base_url();?>assets/limitless/assets/js/form-validator/jquery.form-validator.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/pickers/datepicker.js"></script>


<script type="text/javascript">
		var config = {
			form : 'form',
			validate : {				 
				'nip' : { validation : 'required' }
			}
		};
		$.validate({
			modules : 'jsconf, security',
			onModulesLoaded : function() {
				$.setupValidation(config);
			}
		});
	$(function () {
            $('#tgl_lahir').datepicker({
                locale: 'id',
                format: 'dd-mm-yyyy',
                autoclose: true
            });
    });
</script>

<!-- Basic layout-->
<div class="panel-body">
	<form action="<?php echo base_url();?>pegawai/updateKeluarga" class="form-horizontal" method="post">

		<input type="hidden" name="id" value="<?php echo $data[0]->id; ?>">


		<div class="form-group">
			<label class="col-lg-2 control-label">Status Perkawinan</label>
			<div class="col-lg-10">
				<select class="form-control select-search" name="agama" required>
					<option value="Belum Menikah" <?php if($data[0]->marital=="Belum Menikah"){ ?> selected <?php } ?> >Belum Menikah</option>
					<option value="Menikah" <?php if($data[0]->marital=="Menikah"){ ?> selected <?php } ?> >Menikah</option>
					<option value="Janda" <?php if($data[0]->marital=="Janda"){ ?> selected <?php } ?> >Janda</option>
					<option value="Duda" <?php if($data[0]->marital=="Duda"){ ?> selected <?php } ?> >Duda</option>
				</select>				
				<span class="help-block text-danger"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">Nama Suami/Istri</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" placeholder="Nama Suami/Istri" 
					name="nama_pasangan" value="<?php echo $data[0]->nama_pasangan; ?>"
					>
				<span class="help-block text-danger"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">NIP Suami/Istri</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" placeholder="NIP Suami/Istri" 
					name="nip_pasangan" value="<?php echo $data[0]->nip_pasangan; ?>"
					>
				<span class="help-block text-danger"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">Pekerjaan Suami/Istri</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" placeholder="Pekerjaan Suami/Istri" 
					name="pekerjaan_pasangan" value="<?php echo $data[0]->pekerjaan_pasangan; ?>"
					>
				<span class="help-block text-danger"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">TMT Suami/Istri</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" placeholder="TMT Suami/Istri" 
					name="tmt_pasangan" value="<?php echo $data[0]->tmt_pasangan; ?>"
					>
				<span class="help-block text-danger"></span>
			</div>
		</div>
			
		<div class="text-left">
			<a  href="<?php echo base_url();?>pegawai" class="btn btn-danger">Batal</a>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>				
	</form>
</div>
<!-- /basic layout -->