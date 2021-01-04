<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/pickers/datepicker.js"></script>

<script type="text/javascript">
    $(function () {
        $('#tgl_sb').datepicker({
            locale: 'id',
            format: 'yyyy-mm-dd',
            autoclose: true
        });        
    });
</script>

<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>sertifikatbenih/store" class="form-horizontal" method="post">
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
							<label class="col-lg-2 control-label">No SB</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="No Sertifikat Benih" name="nosb">
							</div>
							<label class="col-lg-1 control-label">Tanggal</label>
							<div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                    <input type="text" class="form-control" name="tgl_sb"  id="tgl_sb"
                                    placeholder="yyyy-mm-dd">
                                </div>
                            </div>
						</div>
						<div class="form-group">
                            <label class="col-lg-2 control-label">Kelas</label>
                            <div class="col-lg-5">
                            <select name="kelas"  id="kelas" class="form-control" required
                                data-placeholder="Pilih Kelas">
                                    <option value="2">TBT</option>
                                    <option value="1">KBS</option>
                                    <option value="1">KP</option>
                            </select>
                            </div>
                    	</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Nama Pemilik</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Nama Pemilik" name="nama">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jenis Benih</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Jenis Benih" name="jenisbenih">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Jumlah Pohon</label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="Jumlah Pohon" name="jumlah">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Luas</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="Luas" name="luas">
							</div>
							<div class="col-lg-2">
								<input type="text" class="form-control" placeholder="Satuan" name="satuanluas">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Volume Produksi</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" placeholder="volume" name="volume">
							</div>
							<div class="col-lg-2">
								<input type="text" class="form-control" placeholder="Satuan" name="satuanproduksi">
							</div>
						</div>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>sertifikatbenih" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>