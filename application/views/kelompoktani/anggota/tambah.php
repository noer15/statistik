<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/pickers/datepicker.js"></script>
    <script type="text/javascript">
            $(function () {
                $('#tgl_lahir').datepicker({
                    locale: 'id',
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });

                $('#tgl_lahir').change(function(){
	                //var dob = new Date("15-05-2018".replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"))
	                var dob = new Date(this.value.replace(/(\d{2})[-/](\d{2})[-/](\d+)/, "$2/$1/$3"));
	                var today = new Date();
	                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
	                $('#umur').val(age);
            	});



            });
    </script>

<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Anggotakelompoktani/store" class="form-horizontal" method="post">
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
							<label class="col-lg-2 control-label">Kelompok Tani </label>
							<div class="col-lg-10">
                                <input type="hidden" name="kelompokId" value="<?php echo $kelompok[0]->id;?>">
								<input type="text" class="form-control" placeholder="Kelompok Tani" name="nama_kelompok" disabled value="<?php echo $kelompok[0]->nama;?>">
							</div>
						</div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">NIK</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="NIK" name="nik">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Nama" name="nama">
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Alamat</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Alamat" name="alamat">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-2 control-label">Tgl Lahir </label>
							<div class="col-lg-4">
							<div class="input-group">
								<span class="input-group-addon"><i class="icon-calendar22"></i></span>
									<input type="text" class="form-control" placeholder="dd/mm/yyyy" 
									 name="tgl_lahir" id="tgl_lahir" required readonly>
							</div>
							</div>

							<label class="col-lg-1 control-label">Umur</label>
							<div class="col-lg-5">
								<input type="number" class="form-control" placeholder="Umur" name="umur" id="umur" required readonly>
							</div>

						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jenis Kelamin</label>
							<div class="col-lg-10">
								<select id="jk" name="jk" class="form-control">
                                 <option value="L">Laki-Laki</option> 
                                 <option value="P">Perempuan</option> 
                                </select>
							</div>
						</div>


                    <div class="form-group">
                            <label class="col-lg-2 control-label">Pendidikan</label>
                            <div class="col-lg-10">
                            <select name="pendidikan"  id="pendidikan" class="form-control" required
                                data-placeholder="Pilih Pendidikan">
                                <?php foreach ($pend as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="col-lg-2 control-label">Jabatan</label>
                            <div class="col-lg-10">
                            <select name="jabatan"  id="jabatan" class="form-control" required
                                data-placeholder="Pilih Jabatan">
                                <?php foreach ($jabatan as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                    </div>

                        
						<div class="text-left">
							<a  href="<?php echo base_url();?>Anggotakelompoktani/index/<?php echo $kelompok[0]->id?>" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>