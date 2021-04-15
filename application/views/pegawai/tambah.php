<!-- Theme JS files -->

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
                format: 'yyyy-mm-dd',
                autoclose: true
            });
    });
</script>




<!-- /theme JS files -->
<div class="content">
	<!-- Highlighted tabs -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Tambah Pegawai</h6>
					<div class="heading-elements">
						<ul class="icons-list">
					    	<li><a data-action="collapse"></a></li>
					        <li><a data-action="reload"></a></li>
					        <li><a data-action="close"></a></li>
					    </ul>
				    </div>
				</div>

				<div class="panel-body">
					<!-- Basic layout-->
					<div class="panel-body">
						<form action="<?php echo base_url();?>pegawai/store" class="form-horizontal" method="post">
							<div class="form-group">
								<label class="col-lg-2 control-label">NIP</label>
								<div class="col-lg-6">
									<input type="number" class="form-control" 
										placeholder="NIP" 
										name="nip"
										data-validation="required">
									<span class="help-block text-danger"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Nama</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" placeholder="Nama" 
										name="nama"
										data-validation="required">
									<span class="help-block text-danger"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Alamat</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" placeholder="Alamat" 
										name="alamat"
										data-validation="required">
									<span class="help-block text-danger"></span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Jenis Kelamin</label>
								<div class="col-lg-5">				
									<select class="form-control" name="sex" id="sex" data-validation="required">
										<option value="L">Laki-Laki</option>
										<option value="P">Perempuan</option>
									</select>				
									<span class="help-block text-danger"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Tempat Lahir</label>
								<div class="col-lg-5">
									<input type="text" class="form-control" placeholder="Tempat Lahir" 
										name="tempat_lahir"
										data-validation="required" >
								</div>
								<label class="col-lg-1 control-label">Tgl Lahir</label>
								<div class="col-lg-4">
									<input type="text" class="form-control" placeholder="Tanggal Lahir" 
										name="tgl_lahir" 
										data-validation="required"
										id="tgl_lahir" readonly>
								</div>
							</div>

							<div class="form-group">
	                            <label class="col-lg-2 control-label">Pendidikan</label>
	                            <div class="col-lg-5">
	                            <select name="pendidikan"  id="pendidikan" class="form-control" required
	                                data-placeholder="Pilih Pendidikan">
	                                <?php foreach ($pend as $key => $value) { ?>
	                                    <option value="<?php echo $value->id?>">
	                                        <?php echo $value->nama?>                                           
	                                    </option>
	                                <?php }  ?>
	                                
	                            </select>
	                            </div>
	                        </div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Pangkat/Golongan</label>
								<div class="col-lg-5">
									<select class="form-control select-search" name="gol_pangkat" id="gol_pangkat">							
										<?php 
										 foreach ($golongans as $key => $value) { ?>
										 	<option value="<?php echo $value->id ?>">
										 		<?php echo $value->pangkat.", ".$value->golongan."/".strtolower($value->ruang); ?>
										 	</option>
										<?php }
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Unit Kerja</label>
								<div class="col-lg-5">
									<select class="form-control select-search" name="unit_kerja" id="unit_kerja">	
										<?php 
										 foreach ($units as $key => $value) { ?>
										 	<option value="<?php echo $value->id ?>">
										 		<?php echo $value->nama; ?>
										 	</option>
										<?php }
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Jabatan</label>
								<div class="col-lg-5">
									<select class="form-control select-search" name="jabatan" id="jabatan">	
										<?php 
										 foreach ($jabatans as $key => $value) { ?>
										 	<option value="<?php echo $value->id ?>">
										 		<?php echo $value->nama; ?>
										 	</option>
										<?php }
										?>
									</select>
								</div>
								<label class="col-lg-1 control-label">Role</label>
								<div class="col-lg-4">
									<select class="form-control select-search" name="role" id="role">	
										<?php 
										 foreach ($this->db->get('role')->result() as $key => $value) { ?>
										 	<option value="<?php echo $value->id ?>">
										 		<?php echo $value->nama; ?>
										 	</option>
										<?php }
										?>
									</select>
								</div>
							</div>
											
							<div class="text-left">
								<a  href="<?php echo base_url();?>pegawai" class="btn btn-danger">Batal</a>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>				
						</form>
					</div>
					<!-- /basic layout -->
				</div>
			</div>
		</div>						
	</div>
	<!-- /highlighted tabs -->
	
</div>
