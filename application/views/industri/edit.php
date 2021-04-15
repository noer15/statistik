<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


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

<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Industri/update" class="form-horizontal" method="post">
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
						<input type="hidden" name="id"
								value="<?php echo $data[0]->id;?>">
								
						<div class="form-group">
							<label class="col-lg-2 control-label">Kabupaten</label>
							<div class="col-lg-10">
                            <select name="kab"  id="kab" class="select-search" required
                                data-placeholder="Pilih Kabupaten">
                                <?php foreach ($kabupaten as $key => $value) { ?>

                                 <?php if($value->id==$kabId) { ?>
                                 	<option value="<?php echo $value->id?>" selected=true>
                                    	<?php echo $value->nama; ?>                                    		
                                    </option>
                                 <?php }else { ?>
                                    <option value="<?php echo $value->id?>">
                                    	<?php echo $value->nama; ?>                                    		
                                    </option>
                                <?php } }  ?>
                                
                            </select>
                            </div>
						</div>


						<div class="form-group">
								<label class="col-lg-2 control-label">Kecamatan</label>
								<div class="col-lg-10">
								<select name="kec"  id="kec" class="select-search" required 
									data-placeholder="Pilih Kecamatan">
									<?php foreach ($kecamatan as $key => $value) { ?>

									<?php if($value->id==$kecId) { ?>
										<option value="<?php echo $value->id?>" selected=true>
											<?php 
											echo $value->nama;?>                                    		
										</option>
									<?php } else { ?>

										<option value="<?php echo $value->id?>">
											<?php echo $value->nama?>                                    		
										</option>

									<?php } } ?>
									
								</select>
								</div>
						</div>
					
						<div class="form-group">
							<label class="col-lg-2 control-label">Nama Industri</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Nama Industri" name="nama"
								 value="<?php echo $data[0]->nama_industri;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Alamat</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Alamat" name="alamat" 
								value="<?php echo $data[0]->alamat;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Telp</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Telp" name="phone"
								value="<?php echo $data[0]->phone;?>">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-2 control-label">Email</label>
							<div class="col-lg-10">
								<input type="email" class="form-control" placeholder="Email" name="email"
								value="<?php echo $data[0]->email;?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Perizinan</label>
							<div class="col-lg-4">
								<input type="text" class="form-control" placeholder="Perizinan Industri" name="perizinan" value="<?php echo $data[0]->perizinan;?>">
							</div>
							<label class="col-lg-2 control-label">Tanggal</label>
							<div class="col-lg-4">
								<input type="date" class="form-control" placeholder="Tanggal Perizinan" name="tgl_perizinan" value="<?php echo $data[0]->tgl_perizinan;?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Kapasitas Izin Produksi</label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="Kapasitas" name="kapasitas"
								value="<?php echo $data[0]->kapasitas_izin;?>">
							</div>
						</div>

						<div class="text-left">
							<a  href="<?php echo base_url();?>Industri" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>