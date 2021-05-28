<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>benih/store" class="form-horizontal" method="post">
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
                            <label class="col-lg-2 control-label">Kabupaten
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                            <select name="id_kab"  id="kab" class="select-search" required
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
							<label class="col-lg-2 control-label">TBT (Tegakan Benih Teridentifikasi) </label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="0" name="tbt">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">TBS (Tegakan Benih Terseleksi) </label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="0" name="tbs">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">APB (Areal Produksi Benih) </label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="0" name="apb">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">TBP (Tegakan Benih Provenan) </label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="0" name="tbp">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">KBS (Kebun Benih Semai) </label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="0" name="kbs">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">KBK (Kebun Benih Klon) </label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="0" name="kbk">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">KP (Kebun Pangkas) </label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="0" name="kp">
							</div>
						</div>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>benih" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>