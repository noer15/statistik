<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<script type="text/javascript">
	$(function () {
		var baseurl = "<?php echo base_url();?>"
		$('#kab').change(function(){
            var kab  = $(this).val();     
            //console.log(kab)
        });
	});
</script>

<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>unitkerjawilayah/store" class="form-horizontal" method="post">
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
							<label class="col-lg-2 control-label">Nama Unit Kerja</label>
							<div class="col-lg-10">
							  <input type="hidden" name="unit_kerja_id" value="<?php echo $unitkerja[0]->id;?>">
                              <input type="text" disabled class="form-control" name="namauk" value="<?php echo $unitkerja[0]->nama;?>" >
                            </div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Kabupaten</label>
							<div class="col-lg-10">
                            <select name="kab"  id="kab" class="select-search" required
                                data-placeholder="Pilih Kabupaten">
                                <?php foreach ($kab as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
						</div>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>unitkerja/wilayah/<?php echo $unitkerja[0]->id; ?> " class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>