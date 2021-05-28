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
					<h6 class="panel-title">Edit Pegawai</h6>
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
						<form action="<?php echo base_url();?>pegawai_kementrian/update" class="form-horizontal" method="post">
							<input type="hidden" name="id" id="id" value="<?php echo $data[0]->id; ?>">

							<div class="form-group">
								<label class="col-lg-2 control-label">NIP</label>
								<div class="col-lg-6">
									<input type="number" class="form-control" 
										placeholder="NIP" 
										name="nip" readonly
										data-validation="required"
										value="<?php echo $data[0]->nip; ?>" 
										>
									<span class="help-block text-danger"></span>
								</div>
								<label class="col-lg-2 control-label">Status</label>
								<div class="col-lg-2">
									<select class="form-control" name="status" id="status" data-validation="required">
										<option value="<?= $data[0]->status; ?>"><?= $data[0]->status; ?></option>
										<option value="PNS">PNS</option>
										<option value="CPNS">CPNS</option>
									</select>
									<span class="help-block text-danger"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Nama</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" placeholder="Nama" 
										name="nama"
										data-validation="required"
										value="<?php echo $data[0]->nama; ?>" 
										>
									<span class="help-block text-danger"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Alamat</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" placeholder="Alamat" 
										name="alamat"
										data-validation="required"
										value="<?php echo $data[0]->alamat; ?>" 
										>
									<span class="help-block text-danger"></span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Jenis Kelamin</label>
								<div class="col-lg-5">				
									<select class="form-control" name="sex" id="sex" data-validation="required">
										<option value="L" <?php if ($data[0]->sex=="L") { ?> selected <?php } ?>  >Laki-Laki</option>
										<option value="P" <?php if ($data[0]->sex=="P") { ?> selected <?php } ?> >Perempuan</option>
									</select>				
									<span class="help-block text-danger"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Tempat Lahir</label>
								<div class="col-lg-5">
									<input type="text" class="form-control" placeholder="Tempat Lahir" 
										name="tempat_lahir"
										data-validation="required" 
										value="<?php echo $data[0]->tempat_lahir; ?>"
										>
								</div>
								<label class="col-lg-1 control-label">Tgl Lahir</label>
								<div class="col-lg-4">
									<input type="text" class="form-control" placeholder="Tanggal Lahir" 
										name="tgl_lahir" 
										data-validation="required"
										value="<?php echo $data[0]->tgl_lahir; ?>"
										id="tgl_lahir" readonly>
								</div>
							</div>

							<div class="form-group">
	                            <label class="col-lg-2 control-label">Pendidikan</label>
	                            <div class="col-lg-5">
	                            <select name="pendidikan"  id="pendidikan" class="form-control" required
	                                data-placeholder="Pilih Pendidikan">
	                                <?php foreach ($pend as $key => $value) { ?>
	                                    <option value="<?php echo $value->id?>"
	                                        <?php if($data[0]->pendidikan==$value->id){ echo "selected"; } ?> >
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
										 	<option value="<?php echo $value->id ?>"
										 		<?php if($value->id==$data[0]->pangkat_gol_id){ ?> selected <?php } ?> >
										 		
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
									<select class="form-control select-search" name="unit_kerja" id="unit_kerja"

										<?php 
										   if ($role_id==1 || $role_id==18){
										   }else{ 
										   	   echo "disabled";
										 } ?>

									>	
										<?php 
										 foreach ($units as $key => $value) { ?>
										 	<option value="<?php echo $value->id ?>"
										 		<?php if($value->id==$data[0]->unit_kerja_id){ ?> selected <?php } ?> >
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
									<select class="form-control select-search" name="jabatan" 
										id="jabatan" 
										<?php 
										   if ($role_id==1 || $role_id==18){
										   }else{ 
										   	   echo "disabled";
										 } ?>
										>	
										<?php 
										 foreach ($jabatans as $key => $value) { ?>
										 	<option value="<?php echo $value->id ?>"
										 		<?php if($value->id==$data[0]->jabatan_id){ ?> selected <?php } ?> >
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
										 	<option value="<?php echo $value->id ?>" <?=$value->id==$data[0]->role_id ? 'selected' : ''?>>
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
