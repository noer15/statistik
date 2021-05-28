<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/pickers/datepicker.js"></script>

<script type="text/javascript">
	$(function () {
		var baseurl = "<?php echo base_url();?>"
        $('#permohonan_date, #persetujuan_date, #izin_date').datepicker({
                locale: 'id',
                format: 'yyyy-mm-dd',
                autoclose: true
            });
	});

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
			<form action="<?php echo base_url();?>Pinjampakai/store" class="form-horizontal" method="post">
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

                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label">Tahun
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control" name="tahun" id="tahun">
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>                               
                        </div>
                    </div> -->

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
                        <label class="col-lg-2 control-label">Unit Kerja Pengelola</label>
                        <div class="col-lg-10">
                        <select name="kph"  id="kph" class="select-search" required
                            data-placeholder="Pilih Unit Kerja Pengelola">
                            <?php foreach ($kph as $key => $value) { ?>
                                <option value="<?php echo $value->id?>">
                                    <?php echo $value->nama?>                                           
                                </option>
                            <?php }  ?>
                            
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Kawasan Hutan</label>
                        <div class="col-lg-10">
                        <select name="kawasan"  id="kawasan" class="select-search" required
                            data-placeholder="Pilih Kawasan Hutan">
                            <?php foreach ($kawasan as $key => $value) { ?>
                                <option value="<?php echo $value->id?>">
                                    <?php echo $value->nama?>                                           
                                </option>
                            <?php }  ?>
                            
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Pengguna</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" 
                                    placeholder="Nama Pengguna" name="nama_perusahaan" required>
                         
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Peruntukan</label>
                        <div class="col-lg-10">
                            <select name="peruntukan_id"  
                                id="peruntukan_id" 
                                class="form-control select-search" required
                                data-placeholder="Pilih Peruntukan">
                                <option value=""></option>
                                <?php foreach ($peruntukan as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                         
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Luas
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" required 
                                placeholder="Luas" name="luas" id="luas">
                        </div>
                        
                        <label class="col-lg-1 control-label">Satuan
                            <span class="text-danger">*</span>
                        </label>

                        <div class="col-lg-4">
                            <select name="satuan"  
                                id="satuan" 
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

                    <!-- <fieldset class="content-group">
                        <legend class="text-bold">Permohonan : </legend>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nomor</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Nomor Permohonan " name="permohonan_no" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Tanggal Permohonan, Format : yyyy-mm-dd" 
                                    name="permohonan_date" id="permohonan_date" required>
                            </div>
                        </div>
                        
                    </fieldset>

                    <fieldset class="content-group">
                        <legend class="text-bold">Persetujuan : </legend>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nomor</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Nomor Persetujuan" name="persetujuan_no" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Tanggal Persetujuan, Format : yyyy-mm-dd" 
                                    name="persetujuan_date" id="persetujuan_date" >
                            </div>
                        </div>
                        
                    </fieldset> -->

                    <fieldset class="content-group">
                        <legend class="text-bold">Izin : </legend>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nomor</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Nomor Izin" name="izin_no">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Tanggal Izin, Format : yyyy-mm-dd" 
                                    name="izin_date" id="izin_date" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Masa Berlaku</label>
                            <div class="col-lg-10">
                            <input type="text" class="form-control" 
                                    placeholder="Tanggal Izin, Format : yyyy-mm-dd" 
                                    name="masa_berlaku" id="izin_date" >
                            </div>
                        </div>
                    </fieldset>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>Pinjampakai" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>