<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<script type="text/javascript">
	$(function () {
		var baseurl = "<?php echo base_url();?>"
		$('#kelompok').change(function(){
            var kelompok  = $(this).val();     

            //console.log(kab)

            $("#anggota").empty();                        
            $.ajax({                            
                url: baseurl+'/Pemiliklahan/getAnggota/'+kelompok,
                type:'GET',
                contentType: 'application/json',
                success: function (resp) { 

                	var dataArray = JSON.parse(resp);                 	
                	// console.log(dataArray);                	
                	for (var i in dataArray) {
                		console.log(dataArray[i]);
                    	$('#anggota').append($("<option></option>")
                        	.attr("value",dataArray[i].id)
                            .text(dataArray[i].nama));
                    }
                },
        	});                        
                             
            
        });
	});
</script>

<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Pemiliklahan/update" class="form-horizontal" method="post">
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
					<div class="panel-body">
						<input type="hidden" name="id"
								 value="<?php echo $data[0]->id;?>">

						<div class="form-group">
							<label class="col-lg-2 control-label">Kelompok
								<span class="text-danger">*</span>
							</label>
							<div class="col-lg-10">
                            <select name="kelompok"  id="kelompok" class="select-search" required disabled 
                                data-placeholder="Pilih Kelompok">
                                <?php foreach ($kelompok as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
					</div>

					<div class="form-group">
							<label class="col-lg-2 control-label">Anggota
								<span class="text-danger">*</span>
							</label>
							<div class="col-lg-10">
                            <select name="anggota"  id="anggota" class="select-search" required disabled
                                data-placeholder="Pilih Anggota">
                                <?php foreach ($anggota as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
					</div>

					<fieldset class="content-group">
                        <legend class="text-bold"></legend>
                    </fieldset>


						<div class="form-group">
							<label class="col-lg-2 control-label">Nama pada Bukti Kepemilikan
								<span class="text-danger">*</span>
							</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Nama pada Bukti Kepemilikan" name="nama" required
								 value="<?php echo $data[0]->nama_sertifikat?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Bukti Kepemilikan
								<span class="text-danger">*</span>
							</label>
							<div class="col-lg-10">
                            <select name="jenis"  id="jenis" class="select-search" required
                                data-placeholder="Pilih Bukti Kepemilikan">
                                <?php foreach ($jenis as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>"
                                    	<?php if($data[0]->jenis_sertifikat==$value->id){ echo "selected"; } ?>  >
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">No SPPT</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="No SPPT" name="nosppt"
								value="<?php echo $data[0]->no_sppt?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Blok</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Blok" name="blok"
								 value="<?php echo $data[0]->blok?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">No Blok</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="No Blok" name="noblok"
								 value="<?php echo $data[0]->no_blok;?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">No Bidang</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="No Bidang" name="nobidang"
								 value="<?php echo $data[0]->no_bidang?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Luas Lahan</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" placeholder="Luas Lahan" name="luaslahan"
								 value="<?php echo $data[0]->luas_lahan?>">
							</div>
							<?php if($this->session->userdata('role_id') == 21): ?>
                            <label class="col-lg-2 control-label">Status Validasi Data</label>
                            <div class="col-lg-4">
                                <select name="status"  id="status" class="select-search" required data-placeholder="Pilih Status">
                                    <option value="0" <?= $data[0]->status == 0 ? 'selected' : ''?>>Belum Disetujui</option>
                                    <option value="1" <?= $data[0]->status == 1 ? 'selected' : ''?>>Setujui</option>
                                </select>
                            </div>
                            <?php endif; ?>
                            <?php if($this->session->userdata('role_id') == 24): ?>
                            <label class="col-lg-2 control-label">Status Validasi Data</label>
                            <div class="col-lg-4">
                                <select name="status"  id="status" class="select-search" required data-placeholder="Pilih Status">
                                    <option value="1" <?= $data[0]->status == 1 ? 'selected' : ''?>>Belum Disetujui</option>
                                    <option value="2" <?= $data[0]->status == 2 ? 'selected' : ''?>>Setujui</option>
                                </select>
                            </div>
                            <?php endif; ?>
						</div>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>Pemiliklahan" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>