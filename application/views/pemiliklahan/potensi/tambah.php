<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<script type="text/javascript">
	$(function () {
		var baseurl = "<?php echo base_url();?>";
		var p = "<?php echo $_GET['p'];?>";

		console.log(p);

		//$('#potensi').change(function(){
          //  var potensi  = $(this).val();                 

            //console.log(kab)

            $("#jenis").empty();                        
            $.ajax({                            
                url: baseurl+'/Potensi/getJenis/'+p,
                type:'GET',
                contentType: 'application/json',
                success: function (resp) { 

                	var dataArray = JSON.parse(resp);                 	
                	// console.log(dataArray);                	
                	for (var i in dataArray) {
                		console.log(dataArray[i]);
                    	$('#jenis').append($("<option></option>")
                        	.attr("value",dataArray[i].id)
                            .text(dataArray[i].nama));
                    }
                },
        	});                        
                             
            
        //});
	});
</script>

<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Potensi/store" class="form-horizontal" method="post">
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

						<table class="table table-bordered">
							<tr>
								<td class="col-lg-2">Pemilik Lahan</td>
								<td><span class="text-primary">
									<strong><?php echo $pemilik[0]->nama_sertifikat;?></strong>		
									</span>
								</td>
							</tr>
							<tr>
								<td class="col-lg-2">Potensi</td>
								<td><span class="text-primary">
									<strong>
										<?php if($_GET['p']==1){
											echo "Kayu";
										}else { echo "Bukan Kayu"; }  ?>											
									</strong>		
									</span>
								</td>
							</tr>
							<?php if($_GET['p']==1){ ?>
							<tr>
								<td class="col-lg-2">Diameter</td>
								<td><span class="text-primary">
									<strong>
										<?php if($_GET['d']==1){
											echo "Diameter > 5 cm";
										}else { echo "Diameter < 5 cm"; }  ?>											
									</strong>		
									</span>
								</td>
							</tr>
							<?php } ?>
							
						</table>

						<input type="hidden" name="pemilikId" value="<?php echo $pemilik[0]->id;?>">				
						<input type="hidden" name="type_jenis" value="<?php echo$_GET['p'];?>" >
						<input type="hidden" name="type_diameter" value="
						<?php 
							echo isset($_GET['d']) ? $_GET['d'] : "" ;
						?>" >
					
                    
		            <fieldset class="content-group">
                        <legend class="text-bold"></legend>
                    </fieldset>

                    <div class="form-group">
                            <label class="col-lg-2 control-label">Jenis Potensi</label>
                            <div class="col-lg-10">
                            <select name="jenis"  id="jenis" class="form-control select-search" required
                                data-placeholder="Pilih Jenis Potensi">
                                <?php foreach ($jenis as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                    </div>
                   		 

						<?php if($_GET['p']==1){  ?>

						<div class="form-group">
							<label class="col-lg-2 control-label">Tahun Tanam</label>
							<div class="col-lg-10">
								<input type="number" class="form-control" 
								placeholder="Tahun Tanam" name="tahun_tanam">
							</div>
						</div>

						<?php if($_GET['d']==1){ ?>

						<div class="form-group">
							<label class="col-lg-2 control-label">Diameter</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" 
									placeholder="diameter" name="diameter">
							</div>
							<div class="col-lg-5">
								<select name="satuan_diameter"  
									id="satuan_diameter" 
									class="form-control select-search" required
	                                data-placeholder="Pilih Satuan">
	                                <option value=""></option>
	                                <?php foreach ($satuan as $key => $value) { ?>
	                                    <option value="<?php echo $value->id?>">
	                                        <?php echo $value->nama?>                                           
	                                    </option>
	                                <?php }  ?>
	                                
	                            </select>
							</div>
						</div>
						<?php }else{ ?>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jumlah Pohon</label>
							<div class="col-lg-5">
								<input type="number" class="form-control" 
									placeholder="Jumlah Pohon" name="jml_pohon">
							</div>
							<div class="col-lg-5">
								<select name="satuan_jml_pohon"  
									id="satuan_jml_pohon" 
									class="form-control select-search" required
	                                data-placeholder="Pilih Satuan">
	                                <option value=""></option>
	                                <?php foreach ($satuan as $key => $value) { ?>
	                                    <option value="<?php echo $value->id?>">
	                                        <?php echo $value->nama?>                                           
	                                    </option>
	                                <?php }  ?>
	                                
	                            </select>
							</div>							
						</div>
						<?php } ?>

						<div class="form-group">
							<label class="col-lg-2 control-label">Tinggi Pohon</label>
							<div class="col-lg-5">
								<input type="number" class="form-control" 
									placeholder="Tinggi Pohon" name="tinggi_pohon">
							</div>
							<div class="col-lg-5">
								<select name="satuan_tinggi_pohon"  
									id="satuan_tinggi_pohon" 
									class="form-control select-search" required
	                                data-placeholder="Pilih Satuan">
	                                <option value=""></option>
	                                <?php foreach ($satuan as $key => $value) { ?>
	                                    <option value="<?php echo $value->id?>">
	                                        <?php echo $value->nama?>                                           
	                                    </option>
	                                <?php }  ?>
	                                
	                            </select>
							</div>
						</div> 

						<?php }else { ?> <!-- potensi bukan kayu -->
						<div class="form-group">
							<label class="col-lg-2 control-label">Tahun</label>
							<div class="col-lg-10">
								<input type="number" class="form-control" 
									placeholder="Tahun" name="tahun">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jumlah Budidaya</label>
							<div class="col-lg-5">
								<input type="number" class="form-control" 
									placeholder="Jumlah Budidaya" name="jml_budidaya">
							</div>
							<div class="col-lg-5">
								<select name="satuan_budidaya"  
									id="satuan_budidaya" 
									class="form-control select-search" required
	                                data-placeholder="Pilih Satuan">
	                                <option value=""></option>
	                                <?php foreach ($satuan as $key => $value) { ?>
	                                    <option value="<?php echo $value->id?>">
	                                        <?php echo $value->nama?>                                           
	                                    </option>
	                                <?php }  ?>
	                                
	                            </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jumlah Produksi</label>
							<div class="col-lg-5">
								<input type="number" class="form-control" 
									placeholder="Jumlah Produksi" name="jml_produksi">
							</div>
							<div class="col-lg-5">
								<select name="satuan_produksi"  
									id="satuan_produksi" 
									class="form-control select-search" required
	                                data-placeholder="Pilih Satuan">
	                                <option value=""></option>
	                                <?php foreach ($satuan as $key => $value) { ?>
	                                    <option value="<?php echo $value->id?>">
	                                        <?php echo $value->nama?>                                           
	                                    </option>
	                                <?php }  ?>
	                                
	                            </select>
							</div>
						</div>

						<?php }  ?>

						
                   
                        
						<div class="text-left">
							<a  href="<?php echo base_url();?>Potensi/index/<?php echo $pemilik[0]->id?>" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>