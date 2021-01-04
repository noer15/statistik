<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>


<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Lsm/update" class="form-horizontal" method="post">
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
                            <select name="kab"  id="kab" class="select-search" required disabled 
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
                            <select name="kec"  id="kec" class="select-search" required disabled
                                data-placeholder="Pilih Kecamatan">
                                <?php foreach ($kecamatan as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>" >
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Desa</label>
							<div class="col-lg-10">
                            <select name="desa"  id="desa" class="select-search" required disabled
                                data-placeholder="Pilih Desa">
                                <?php foreach ($desa as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>" >                                    	
                                    	<?php echo $value->nama?>                                    		
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Nama LSM</label>
							<div class="col-lg-10">
								<input type="hidden" class="form-control" placeholder="id" name="id" readonly
									value="<?php echo $data[0]->id?>">
								<input type="text" class="form-control" placeholder="nama" name="nama" required
									value="<?php echo $data[0]->nama_lsm?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Alamat</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Alamat" name="alamat" required
									value="<?php echo $data[0]->alamat?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Phone</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Phone" name="phone" required
									value="<?php echo $data[0]->phone?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Email</label>
							<div class="col-lg-10">
								<input type="email" class="form-control" placeholder="Email" name="email" required
									value="<?php echo $data[0]->email?>">
							</div>
						</div>

						 <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Ketua</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Nama Ketua" name="ketua"
                                value="<?php echo $data[0]->ketua?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">Jumlah Anggota</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" placeholder="Jumlah Anggota" name="jmlanggota"
                                value="<?php echo $data[0]->jml_anggota?>">
                            </div>
                        </div>

						<div class="text-left">
							<a  href="<?php echo base_url();?>Lsm" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>