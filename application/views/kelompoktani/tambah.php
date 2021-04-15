<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/uploaders/fileinput.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/uploader_bootstrap.js"></script>

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
                		//console.log(dataArray[i]);
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
                	//console.log(dataArray);                	
                	for (var i in dataArray) {
                		//console.log(dataArray[i]);
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
                	//console.log(dataArray);                	
                    
                	for (var i in dataArray) {
                		//console.log(dataArray[i]);
                    	$('#desa').append($("<option></option>")
                        	.attr("value",dataArray[i].id)
                            .text(dataArray[i].nama));
                    }
                },
        	});                           
        }

        $('#cbmenkumham').change(function(){
            var cb  = $(this).val();            
            if(cb=='ada'){
                $('#menkumham').show();
                $('#filemenkumham').show();
                $("#menkumham").attr('required',true);
            }else{
                $('#filemenkumham').hide();
                $('#menkumham').val('');
                $("#menkumham").attr('required',false);
                $('#menkumham').hide();                
            }
        });

        $('#cbakta').change(function(){
            var cb  = $(this).val();            
            if(cb=='ada'){
                $('#akta').show();
                $('#file_akta').show();
                $("#akta").attr('required',true);
            }else{
                $('#akta').val('');
                $("#akta").attr('required',false);
                $('#akta').hide();
                $('#file_akta').hide();
            }
        });

        $('#cbsk').change(function(){
            var cb  = $(this).val();            
            if(cb=='ada'){
                $('#sk').show();
                $('#file_sk').show();
                $("#sk").attr('required',true);
            }else{
                $('#sk').val('');
                $("#sk").attr('required',false);
                $('#sk').hide();
                $('#file_sk').hide();
            }
        });

        $('#cbba').change(function(){
            var cb  = $(this).val();            
            if(cb=='ada'){
                $('#ba').show();
                $('#file_ba').show();
                $("#ba").attr('required',true);
            }else{
                $('#ba').val('');
                $("#ba").attr('required',false);
                $('#ba').hide();
                $('#file_ba').hide();
            }
        });



	});
</script>

<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Kelompoktani/store" class="form-horizontal" 
                method="post" enctype="multipart/form-data" >

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
    							<label class="col-lg-2 control-label">Kabupaten</label>
    							<div class="col-lg-10">
                                <select name="kab"  id="kab" class="select-search" required
                                    data-placeholder="Pilih Kabupaten" readonly>
                                    <?php foreach ($kabupaten as $key => $value) { ?>
                                        <option value="<?php echo $value->id?>" <?= $value->id == $this->session->userdata('wilayah_kab_id') ? 'selected' : '' ?>>
                                        	<?php echo $value->nama?>                                    		
                                        </option>
                                    <?php }  ?>
                                    
                                </select>
                                </div>
    					   </div>                        

        					<div class="form-group">
        							<label class="col-lg-2 control-label">Kecamatan </label>
        							<div class="col-lg-10">
                                    <select name="kec"  id="kec" class="select-search" required
                                        data-placeholder="Pilih Kecamatan" readonly>
                                        <?php foreach ($kecamatan as $key => $value) { ?>
                                            <option value="<?php echo $value->id?>" <?= $value->id == $this->session->userdata('wilayah_kec_id') ? 'selected' : '' ?>>
                                            	<?php echo $value->nama?>                                    		
                                            </option>
                                        <?php }  ?>
                                        
                                    </select>
                                    </div>
        					</div>
                            
                            <?php if($this->session->userdata('role_id') != 1) ?>
                            <script>
                                $('#kab,#kec').select2({  disabled: true })
                            </script>
                            </php endif; ?>

        					<div class="form-group">
        							<label class="col-lg-2 control-label">Desa</label>
        							<div class="col-lg-10">
                                        <select name="desa"  id="desa" class="select-search" required
                                            data-placeholder="Pilih Desa">
                                            <?php foreach ($desa as $key => $value) { ?>
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
							<label class="col-lg-2 control-label">No Register</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="automatic" name="noreg" disabled>
							</div>
						</div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Kategori</label>
                            <div class="col-lg-10">
                            <select name="kategori"  id="kategori" class="select-search" required
                                data-placeholder="Pilih Kategori">
                                <?php foreach ($kategori as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Kelompok</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="nama" name="nama" required>
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Alamat</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Phone</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Phone" name="phone">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Email</label>
							<div class="col-lg-10">
								<input type="email" class="form-control" placeholder="Email" name="email">
							</div>
						</div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tahun Berdiri</label>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" placeholder="Tahun Berdiri" name="tahun_berdiri" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">SK Menkumham</label>
                            <div class="col-lg-2">
                                <select class="form-control" id="cbmenkumham">
                                    <option value="ada">Ada</option>
                                    <option value="tidak">Tidak Ada</option>
                                </select>
                            
                            </div>                              
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="SK Menkumham" name="menkumham" id="menkumham">
                            </div>                            

                            <div class="col-lg-5" id="filemenkumham">
                                <input type="file" class="form-control" name="file_menkumham" data-show-preview="false"
                                 placeholder="File Menkumham">
                             </div>

                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Akta Notaris</label>
                            <div class="col-lg-2">
                                <select class="form-control" id="cbakta">
                                    <option value="ada">Ada</option>
                                    <option value="tidak">Tidak Ada</option>
                                </select>
                            
                            </div>  
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Akta Notaris" name="akta" id="akta">
                            </div>

                            <div class="col-lg-5" id="file_akta">
                                <input type="file" class="form-control" name="file_akta" data-show-preview="false">
                            </div>

                        </div>                        

                        <div class="form-group">
                            <label class="col-lg-2 control-label">SK Pengukuhan</label>
                            <div class="col-lg-2">
                                <select class="form-control" id="cbsk">
                                    <option value="ada">Ada</option>
                                    <option value="tidak">Tidak Ada</option>
                                </select>
                            
                            </div>  
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Sk Pendirian" name="sk" id="sk">
                            </div>

                            <div class="col-lg-5" id="file_sk">
                                <input type="file" class="form-control" name="file_sk" data-show-preview="false">
                            </div>

                        </div>                        

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Berita Acara</label>
                            <div class="col-lg-2">
                                <select class="form-control" id="cbba">
                                    <option value="ada">Ada</option>
                                    <option value="tidak">Tidak Ada</option>
                                </select>
                            
                            </div>  
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Berita Acara" name="ba" id="ba">
                            </div>

                            <div class="col-lg-5" id="file_ba">
                                <input type="file" class="form-control" name="file_ba" data-show-preview="false">
                            </div>
                        </div>                                                
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Kelas</label>
                            <div class="col-lg-10">
                            <select name="kelas"  id="kelas" class="select-search" required
                                data-placeholder="Pilih Kelas Kelompok">
                                <?php foreach ($kelas as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                        </div>

                       
						<div class="text-left">
							<a  href="<?php echo base_url();?>Kelompoktani" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>					
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>