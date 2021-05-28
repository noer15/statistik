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
			<form action="<?php echo base_url();?>Penangkaran/update" class="form-horizontal" method="post">
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
                        <label class="col-lg-2 control-label">Nama Perusahaan
                        </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" required 
                                placeholder="Nama Perusahaan" name="nama" required value="<?=$data->nama ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">No Telepon
                        </label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" required 
                                placeholder="No Telepon" name="no_tlp" required value="<?=$data->no_tlp ?>">
                        </div>
                    </div>
					

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Titik Kordinat</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="kordinat" placeholder="Latitude" value="<?=$data->kordinat ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">No dan Tanggal</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="no_tanggal" placeholder="No Tanggal" value="<?=$data->no_tanggal ?>">
                        </div>

                        <label class="col-lg-2 control-label">Masa Berlaku</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="masa_berlaku" placeholder="Masa Berlaku" value="<?=$data->masa_berlaku ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Daerah</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="daerah" placeholder="Nama Daerah" value="<?=$data->daerah?>">
                        </div>

                        <label class="col-lg-2 control-label">Nama Ilmiah</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="nama_ilmiah" placeholder="Nama Ilmiah" value="<?=$data->nama_ilmiah?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Jumlah Indukan</label>
                        <div class="col-lg-10">
                        <select name="indukan"  id="kawasan" class="select-search" required
                            data-placeholder="Pilih Kawasan">
                            <option value="Jantan" <?=$data->indukan == 'Jantan' ? 'selected' : ''?>>Jantan</option>
                            <option value="Betina" <?=$data->indukan == 'Betina' ? 'selected' : ''?>>Betina</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Hasil Penangkaran
                        </label>
                        <div class="col-lg-3">
                            <input type="text" name="bulan_lalu" class="form-control" placeholder="s/d Bulan lalu" value="<?=$data->bulan_lalu?>">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" name="bulan_sekarang" class="form-control" placeholder="Bulan ini" value="<?=$data->bulan_sekarang?>">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" name="sampai_bulan_ini" class="form-control" placeholder="s/d Bulan ini" value="<?=$data->sampai_bulan_ini?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 control-label">Investasi
                        </label>
                        <div class="col-lg-4">
                            <input type="number" class="form-control" name="investasi" placeholder="Rp. xxx" value="<?=$data->investasi?>">
                        </div>

                        <label class="col-lg-2 control-label">Jumlah Tenaga Kerja
                        </label>
                        <div class="col-lg-4">
                            <input type="number" class="form-control" name="tenaga_kerja" placeholder="Orang" value="<?=$data->tenaga_kerja?>">
                        </div>
                    </div>
						
						<div class="text-left">
                            <input type="hidden" name="id" value="<?=$data->id?>">
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