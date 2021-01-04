<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


<script type="text/javascript">
    $(function () {
        var baseurl = "<?php echo base_url();?>"
        $('#potensi').change(function(){
            var potensi  = $(this).val();     

            //console.log(kab)

            $("#jenis").empty();                        
            $.ajax({                            
                url: baseurl+'/Potensi/getJenis/'+potensi,
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
                             
            
        });
    });
</script>

<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Potensi/update" class="form-horizontal" method="post">
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

						<input type="hidden" name="id" value="<?php echo $data[0]->id;?>">
					
						<div class="form-group">
							<label class="col-lg-2 control-label">Pemilik Lahan </label>
							<div class="col-lg-10">
                                <input type="hidden" name="pemilikId" value="<?php echo $pemilik[0]->id;?>">
								<input type="text" class="form-control" placeholder="Pemilik Lahan" name="nama_pemilik" disabled value="<?php echo $pemilik[0]->nama_sertifikat;?>">
							</div>
						</div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Blok</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Blok" name="blok"
                                value="<?php echo $data[0]->blok;?>">
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Luas</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Luas" name="luas"
								 value="<?php echo $data[0]->luas;?>">
							</div>
						</div>

					<div class="form-group">
                            <label class="col-lg-2 control-label">Potensi</label>
                            <div class="col-lg-10">
                            <select name="potensi"  id="potensi" class="form-control" required
                                data-placeholder="Pilih Potensi">
                                    <option value="2" <?php if($potensi==2) {echo "selected";} ?> >Non Kayu</option>
                                    <option value="1" <?php if($potensi==1) {echo "selected";} ?>>Kayu</option>                                
                            </select>
                            </div>
                    </div>
						
                    <div class="form-group">
                            <label class="col-lg-2 control-label">Jenis Potensi</label>
                            <div class="col-lg-10">
                            <select name="jenis"  id="jenis" class="form-control" required
                                data-placeholder="Pilih Jenis Potensi">
                                <?php foreach ($jenis as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>"
                                    	<?php if($data[0]->jenis_potensi==$value->id){ echo "selected"; } ?> >
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                    </div>
                   		 <div class="form-group">
							<label class="col-lg-2 control-label">Jml Produksi</label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="Jml Produksi" name="jml_produksi"
								value="<?php echo $data[0]->jml_produksi;?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jml Panen</label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="Jml Panen" name="jml_panen"
								 value="<?php echo $data[0]->jml_dipanen;?>">
							</div>
						</div>

                        
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