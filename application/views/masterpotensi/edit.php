<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Jenispotensi/store" class="form-horizontal" method="post">
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
                            <label class="col-lg-2 control-label">Jenis</label>
                            <div class="col-lg-10">
                            <select name="jenis"  id="jenis" class="form-control" required
                                data-placeholder="Pilih Jenis">                                	
                                	<option value="1" <?php if($data[0]->jenis==1){ echo "selected"; } ?> >Kayu</option>                                
                                	<option value="2" <?php if($data[0]->jenis==2){ echo "selected"; } ?>>Bukan Kayu</option>
                            </select>
                            </div>
                    </div>
						
						<div class="form-group">
							<label class="col-lg-2 control-label">Nama</label>
							<div class="col-lg-10">
								<input type="hidden" name="id" value="<?php echo $data[0]->id?>">
								<input type="text" class="form-control" placeholder="Nama Potensi" name="nama"
								value="<?php echo $data[0]->nama?>">
							</div>
						</div>

												
						<div class="text-left">
							<a  href="<?php echo base_url();?>Jenispotensi" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>