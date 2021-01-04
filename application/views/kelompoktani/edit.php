<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<script type="text/javascript">
    $(function () {
        var baseurl = "<?php echo base_url();?>"       
        //console.log($('#menkumham').val());

        if ($('#menkumham').val()!=""){
            $('#menkumham').show();
            $('#filemenkumham').show();
        }else{
            $('#menkumham').hide();
            $('#filemenkumham').hide();
        }

        $('#cbmenkumham').change(function(){
            var cb  = $(this).val();            
            if(cb=='ada'){
                $('#menkumham').show();
                $('#filemenkumham').show();
                $("#menkumham").attr('required',true);
            }else{
                $('#filemenkumham').hide();
                $('#menkumham').val('');
                $("#menkumham").attr('required',false);
                $('#menkumham').hide();                
            }
        });

        if ($('#akta').val()!=""){
            $('#akta').show();
            $('#file_akta').show();
        }else{
            $('#akta').hide();
            $('#file_akta').hide();
        }

        $('#cbakta').change(function(){
            var cb  = $(this).val();            
            if(cb=='ada'){
                $('#akta').show();
                $('#file_akta').show();
                $("#akta").attr('required',true);
            }else{
                $('#akta').val('');
                $("#akta").attr('required',false);
                $('#akta').hide();
                $('#file_akta').hide();
            }
        });

        if ($('#sk').val()!=""){
            $('#sk').show();
            $('#file_sk').show();
        }else{
            $('#sk').hide();
            $('#file_sk').hide();
        }

        $('#cbsk').change(function(){
            var cb  = $(this).val();            
            if(cb=='ada'){
                $('#sk').show();
                $('#file_sk').show();
                $("#sk").attr('required',true);
            }else{
                $('#sk').val('');
                $("#sk").attr('required',false);
                $('#sk').hide();
                $('#file_sk').hide();
            }
        });

        if ($('#ba').val()!=""){
            $('#ba').show();
            $('#file_ba').show();
        }else{
            $('#ba').hide();
            $('#file_ba').hide();
        }

        $('#cbba').change(function(){
            var cb  = $(this).val();            
            if(cb=='ada'){
                $('#ba').show();
                $('#file_ba').show();
                $("#ba").attr('required',true);
            }else{
                $('#ba').val('');
                $("#ba").attr('required',false);
                $('#ba').hide();
                $('#file_ba').hide();
            }
        });



    });
</script>


<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Kelompoktani/update" class="form-horizontal" method="post"
                enctype="multipart/form-data">
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

					<fieldset class="content-group">
                        <legend class="text-bold"></legend>
                    </fieldset>

						<div class="form-group">
							<label class="col-lg-2 control-label">No Register</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="noreg" name="noreg" disabled
								value="<?php echo $data[0]->no_register?>">
							</div>
						</div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Kategori</label>
                            <div class="col-lg-10">
                            <select name="kategori"  id="kategori" class="select-search" required
                                data-placeholder="Pilih Kategori">
                                <?php foreach ($kategori as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>"
                                    	<?php if($data[0]->kategori==$value->id) { ?> selected <?php } ?> >
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                        </div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Nama Kelompok</label>
							<div class="col-lg-10">
								<input type="hidden" class="form-control" placeholder="id" name="id" readonly
									value="<?php echo $data[0]->id?>">
								<input type="text" class="form-control" placeholder="nama" name="nama" required
									value="<?php echo $data[0]->nama?>">
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
                            <label class="col-lg-2 control-label">Tahun Berdiri</label>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" placeholder="Tahun Berdiri" name="tahun_berdiri" value="<?php echo $data[0]->tahun_berdiri?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">SK Menkumham</label>
                            <div class="col-lg-2">
                                <select class="form-control" id="cbmenkumham">
                                    <option value="ada" <?php if($data[0]->sk_menkumham!="") { ?> selected <?php } ?> >Ada</option>
                                    <option value="tidak" <?php if($data[0]->sk_menkumham=="") { ?> selected <?php } ?>>Tidak Ada</option>
                                </select>
                            
                            </div>                                          
                            
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="SK Menkumham" name="menkumham" id="menkumham" value="<?php echo $data[0]->sk_menkumham?>">
                            </div>                            

                            <div class="col-lg-5" id="filemenkumham">
                                <input type="file" class="form-control" name="file_menkumham" data-show-preview="false"
                                 placeholder="File Menkumham" value="<?php echo $data[0]->sk_menkumham?>">
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Akta Notaris</label>
                            <div class="col-lg-2">
                                <select class="form-control" id="cbakta">
                                    <option value="ada" <?php if($data[0]->akta_notaris!="") { ?> selected <?php } ?>>Ada</option>
                                    <option value="tidak" <?php if($data[0]->akta_notaris=="") { ?> selected <?php } ?>>Tidak Ada</option>
                                </select>
                            
                            </div>  
                            
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Akta Notaris" name="akta" id="akta" value="<?php echo $data[0]->akta_notaris?>">
                            </div>

                            <div class="col-lg-5" id="file_akta">
                                <input type="file" class="form-control" name="file_akta" data-show-preview="false">
                            </div>
                        	
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">SK Pengukuhan</label>
                            <div class="col-lg-2">
                                <select class="form-control" id="cbsk">
                                    <option value="ada" <?php if($data[0]->sk_berdiri!="") { ?> selected <?php } ?> >Ada</option>
                                    <option value="tidak" <?php if($data[0]->sk_berdiri=="") { ?> selected <?php } ?>>Tidak Ada</option>
                                </select>
                            
                            </div>  

                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Sk Pendirian" name="sk" id="sk" value="<?php echo $data[0]->sk_berdiri?>">
                            </div>

                            <div class="col-lg-5" id="file_sk">
                                <input type="file" class="form-control" name="file_sk" data-show-preview="false">
                            </div>
                        	
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Berita Acara</label>
                            <div class="col-lg-2">
                                <select class="form-control" id="cbba">
                                    <option value="ada" <?php if($data[0]->berita_acara!="") { ?> selected <?php } ?>>Ada</option>
                                    <option value="tidak" <?php if($data[0]->berita_acara=="") { ?> selected <?php } ?>>Tidak Ada</option>
                                </select>
                            
                            </div>  

                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Berita Acara" name="ba" id="ba" value="<?php echo $data[0]->berita_acara?>">
                            </div>

                            <div class="col-lg-5" id="file_ba">
                                <input type="file" class="form-control" name="file_ba" data-show-preview="false">
                            </div>
                        	
                        </div>
						
                        

						<div class="form-group">
                            <label class="col-lg-2 control-label">Kelas</label>
                            <div class="col-lg-10">
                            <select name="kelas"  id="kelas" class="select-search" required
                                data-placeholder="Pilih Kelas Kelompok">
                                <?php foreach ($kelas as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>"
                                    	<?php if($data[0]->kelas==$value->id) { ?> selected <?php } ?> >
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                        </div>
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>Kelompoktani" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>