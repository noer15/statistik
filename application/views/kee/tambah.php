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
			<form action="<?php echo base_url();?>Ekosistem/store" class="form-horizontal" method="post">
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
                        <label class="col-lg-2 control-label">Nama Lokasi
                        </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" required 
                                placeholder="Nama Lokasi" name="nama_lokasi" required>
                        </div>
                    </div>
					<div class="form-group">
							<label class="col-lg-2 control-label">Kabupaten
                                <span class="text-danger">*</span>
                            </label>
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
							<label class="col-lg-2 control-label">Kecamatan
                                <span class="text-danger">*</span>
                            </label>
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

					<div class="form-group">
							<label class="col-lg-2 control-label">Desa
                                <span class="text-danger">*</span>
                            </label>
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

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Latitude</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="lat" placeholder="Latitude">
                        </div>

                        <label class="col-lg-2 control-label">Longitude</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="long" placeholder="Longitude">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Luas</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="luas" placeholder="Luas Lahan">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Status Lahan</label>
                        <div class="col-lg-10">
                        <select name="status_lahan"  id="kawasan" class="select-search" required
                            data-placeholder="Pilih Kawasan">
                            <option value="Lahan Milik">Lahan Milik</option>
                            <option value="Kawasan Hutan">Kawasan Hutan</option>
                            <option value="Lahan Desa">Lahan Desa</option>
                            <option value="Lahan Pemerintah">Lahan Pemerintah</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Jenis KEE
                        </label>
                        <div class="col-lg-10">
                                <select name="jenis" class="form-control" id="" required>
                                    <option value="Ekosistem Lahan Basah">Ekosistem Lahan Basah</option>
                                    <option value="Koridor Hidaupan Liar">Koridor Hidaupan Liar</option>
                                    <option value="Taman Keanekaragaman Hayati">Taman Keanekaragaman Hayati</option>
                                    <option value="Areal Bernilai Konservasi Tinggi">Areal Bernilai Konservasi Tinggi</option>
                                </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 control-label">Progress Kegiatan
                        </label>
                        <div class="col-lg-10">
                            <select name="progres_kegiatan" id="" class="form-control" required>
                                <option value="Identifikasi">Identifikasi</option>
                                <option value="Inventarisasi">Inventarisasi</option>
                                <option value="Diliniasi Hasil Pengusulan KEE">Diliniasi Hasil Pengusulan KEE</option>
                                <option value="Sudah Ditetapkan">Sudah Ditetapkan</option>
                            </select>
                        </div>
                    </div>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>Ekosistem" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>