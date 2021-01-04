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
			<form action="<?php echo base_url();?>Produksikph/store" class="form-horizontal" method="post">
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
							<label class="col-lg-2 control-label">Nama KPH</label>
							<div class="col-lg-10">
                            <select name="kph"  id="kph" class="select-search" required
                                data-placeholder="Pilih Nama KPH">
                                <?php foreach ($kph as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
					</div>

                    <div class="form-group">
                            <label class="col-lg-2 control-label">Potensi</label>
                            <div class="col-lg-10">
                            <select name="potensi"  id="potensi" class="form-control" required
                                data-placeholder="Pilih Potensi">
                                    <option value="2">Non Kayu</option>
                                    <option value="1">Kayu</option>                                
                            </select>
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="col-lg-2 control-label">Jenis Produksi</label>
                            <div class="col-lg-10">
                            <select name="jenis"  id="jenis" class="form-control" required
                                data-placeholder="Pilih Jenis Potensi">
                                <?php foreach ($jenis as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                    </div>


						<div class="form-group">
							<label class="col-lg-2 control-label">Jml Produksi</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="jml_produksi" name="jml_produksi">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Satuan</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Satuan" name="satuan">
							</div>
						</div>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>Produksikph" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>