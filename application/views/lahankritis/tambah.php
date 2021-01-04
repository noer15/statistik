<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>lahankritis/store" class="form-horizontal" method="post">
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
							<label class="col-lg-2 control-label">Katgori</label>
							<div class="col-lg-5">
                            <select name="kategori"  id="kategori" class="select-search" required
                                data-placeholder="Pilih Kategori">
                                 <option value="1">Sangat Kritis</option>
                                 <option value="2">Kritis</option>                                
                            </select>
                            </div>
					</div>


						<div class="form-group">
							<label class="col-lg-2 control-label">Luas</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="Luas" name="luas">
							</div>
							<div class="col-lg-3">
								<input type="text" class="form-control" placeholder="Satuan" name="satuan">
							</div>
						</div>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>lahankritis" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>