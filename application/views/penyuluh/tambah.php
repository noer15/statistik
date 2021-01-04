<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>
<!-- Core JS files -->
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/pickers/datepicker.js"></script>

<script type="text/javascript">
    $(function () {
        $('#nip').hide();
        $('#pekerjaan').show();
        $('#tgl_lahir').datepicker({
            locale: 'id',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $('#penyuluhdari').change(function(){
            var dari  = $(this).val();
            if(dari=='PKSM'){
                $('#nip').hide();
                $('#pekerjaan').show();
            }else{
                $('#nip').show();
                $('#pekerjaan').hide();
            }
        });
    });
</script>


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
			<form action="<?php echo base_url();?>Penyuluh/store" class="form-horizontal" method="post">
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
					<div class="form-group">
							<label class="col-lg-2 control-label">Kabupaten</label>
							<div class="col-lg-10">
                            <select name="kab"  id="kab" class="select-search" required
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
							<label class="col-lg-2 control-label">Kecamatan</label>
							<div class="col-lg-10">
                            <select name="kec"  id="kec" class="select-search" required
                                data-placeholder="Pilih Kecamatan">
                                <?php foreach ($kecamatan as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
					</div>

					<!-- <div class="form-group">
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
					</div> -->

						<div class="form-group" id="nip">
							<label class="col-lg-2 control-label">NIP</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="NIP" name="nip">
							</div>
						</div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Penyuluh</label>
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
                            <label class="col-lg-2 control-label">Telp</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" placeholder="phone" name="phone">
                            </div>
                            <label class="col-lg-1 control-label">Email</label>
                            <div class="col-lg-5">
                                <input type="email" class="form-control" placeholder="email" name="email">
                            </div>
                        </div>
                        <div class="form-group" id="pekerjaan">
                            <label class="col-lg-2 control-label">Pekerjaan</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="pekerjaan" name="pekerjaan">
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Tempat, Tgl Lahir</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir">
							</div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control" name="tgl_lahir"  id="tgl_lahir"
                                    placeholder="yyyy-mm-dd">
                                </div>
                            </div>
                                    
						</div>
						<div class="form-group">
                            <label class="col-lg-2 control-label">Agama</label>
                            <div class="col-lg-5">
                            <select name="agama"  id="agama" class="form-control" required
                                data-placeholder="Pilih Pendidikan">
                                <?php foreach ($agama as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Jenis Kelamin</label>
                            <div class="col-lg-5">
                                <select id="jk" name="jk" class="form-control">
                                 <option value="L">Laki-Laki</option> 
                                 <option value="P">Perempuan</option> 
                                </select>
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
                            <label class="col-lg-2 control-label">Status</label>
                            <div class="col-lg-5">
                                <input type="text" name="penyuluhdari" value="PKSM" class="form-control" readonly>
                                <!-- <select id="penyuluhdari" name="penyuluhdari" class="form-control">
                                 <option value="PKSM">PKSM</option> 
                                 <option value="ASN">ASN</option> 
                                </select> -->
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">Jabatan Penyuluh</label>
                            <div class="col-lg-5">
                            <select name="jabatanpenyuluh"  id="jabatanpenyuluh" class="form-control select-search" required
                                data-placeholder="Pilih Jabatan Penyuluh">
                                <?php foreach ($jabpenyuluh as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                        </div>

                       
						<div class="text-left">
							<a  href="<?php echo base_url();?>Penyuluh" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>