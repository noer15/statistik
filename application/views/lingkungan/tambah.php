<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


<!-- /theme JS files -->
<script type="text/javascript">
	$(function () {
		var baseurl = "<?php echo base_url();?>"
		$('#kab').change(function(){
            var kab  = $(this).val();     
            var kec  = $(this).val();     
            console.log(kab+" "+kec);
            $("#kec").empty();
            $("#desa").empty();
            $.ajax({                            
                url: baseurl+'/Desa/getKecamatan/'+kab,
                type:'GET',
                contentType: 'application/json',
                success: function (resp) { 

                	var dataArray = JSON.parse(resp);                 	
                	// console.log(dataArray);                	
                	for (var i in dataArray) {
                		console.log(dataArray[i]);
                    	$('#kec').append($("<option></option>")
                        	.attr("value",dataArray[i].id)
                            .text(dataArray[i].nama));
                    }
                    //console.log(dataArray[0].id);                	
                    desa(dataArray[0].id)
                },
        	});                           
        });

        $('#kec').change(function(){
            var kec  = $(this).val();     
            //console.log(kab)
            $("#desa").empty();                        
            $.ajax({                            
                url: baseurl+'/Desa/getDesa/'+kec,
                type:'GET',
                contentType: 'application/json',
                success: function (resp) { 

                	var dataArray = JSON.parse(resp);                 	
                	console.log(dataArray);                	
                	for (var i in dataArray) {
                		console.log(dataArray[i]);
                    	$('#desa').append($("<option></option>")
                        	.attr("value",dataArray[i].id)
                            .text(dataArray[i].nama));
                    }
                },
        	});                           
        });

        function desa($kec){
            var kec  = $kec;
            //console.log(kab)
            $("#desa").empty();                        
            $.ajax({                            
                url: baseurl+'/Desa/getDesa/'+kec,
                type:'GET',
                contentType: 'application/json',
                success: function (resp) { 

                	var dataArray = JSON.parse(resp);                 	
                	console.log(dataArray);                	
                	for (var i in dataArray) {
                		console.log(dataArray[i]);
                    	$('#desa').append($("<option></option>")
                        	.attr("value",dataArray[i].id)
                            .text(dataArray[i].nama));
                    }
                },
        	});                           
        }



	});
</script>


<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>jasa_lingkungan/store" class="form-horizontal" method="post">
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
							<label class="col-lg-2 control-label">Kabupaten
                                <span class="text-danger">*</span>
                            </label>
							<div class="col-lg-10">
                            <select  id="kab" class="select-search" required
                                data-placeholder="Pilih Kabupaten">
                                <?php foreach ($kabupaten as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
					</div>


					<div class="form-group">
							<label class="col-lg-2 control-label">Kecamatan
                                <span class="text-danger">*</span>
                            </label>
							<div class="col-lg-10">
                            <select  id="kec" class="select-search" required
                                data-placeholder="Pilih Kecamatan">
                                <?php foreach ($kecamatan as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
					</div>

					<div class="form-group">
							<label class="col-lg-2 control-label">Desa
                                <span class="text-danger">*</span>
                            </label>
							<div class="col-lg-10">
                            <select name="id_desa"  id="desa" class="select-search" required
                                data-placeholder="Pilih Desa">
                                <?php foreach ($desa as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
					</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jenis </label>
							<div class="col-lg-10">
								<select name="id_jasa" id="" class="form-control">
                                    <?php foreach($this->db->get('pemanfaatan_jasa')->result() as $data) : ?>
                                    <option value="<?=$data->id ?>"><?=$data->nama_jasa ?></option>
                                    <?php endforeach; ?>
                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Nama Lingkungan </label>
							<div class="col-lg-10">
								<input type="text" name="nama_lingkungan" class="form-control" placeholder="Nama Lingkungan">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Pengelola </label>
							<div class="col-lg-10">
								<select name="id_konservasi" id="" class="form-control">
                                    <?php foreach($this->db->get('m_kawasan_konservasi')->result() as $data) : ?>
                                    <option value="<?=$data->id ?>"><?=$data->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">SK/No Perjanjian</label>
							<div class="col-lg-10">
								<input type="text" name="no_perjanjian" class="form-control" placeholder="No Perjanjian">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Berlaku Sampai Dengan</label>
							<div class="col-lg-10">
								<input type="date" name="batas_akhir" class="form-control" placeholder="Batas Akhir">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Titik Kordinat</label>
							<div class="col-lg-10">
								<input type="text" name="kordinat" class="form-control" placeholder="Batas Akhir">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Luas (Ha)</label>
							<div class="col-lg-10">
								<input type="number" name="luas" class="form-control" placeholder="Luas">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jumlah</label>
							<div class="col-lg-4">
								<input type="number" name="jumlah" class="form-control" placeholder="Jumlah">
							</div>

							<label class="col-lg-2 control-label">Satuan</label>
							<div class="col-lg-4">
								<select name="id_satuan" id="" class="form-control">
                                    <?php foreach($this->db->get('m_satuan')->result() as $data) : ?>
                                    <option value="<?=$data->id ?>"><?=$data->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Pendapatan</label>
							<div class="col-lg-4">
								<input type="number" name="pnbp" class="form-control" placeholder="PNBP">
							</div>

							<div class="col-lg-4">
								<input type="number" name="non_pnbp" class="form-control" placeholder="Non PNBP">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jumlah Tenaga Kerja</label>
							<div class="col-lg-10">
								<input type="number" name="tenaga_kerja" class="form-control" placeholder="Jumlah">
							</div>
						</div>

						
						<div class="text-left">
							<a  href="<?php echo base_url();?>jasa" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>