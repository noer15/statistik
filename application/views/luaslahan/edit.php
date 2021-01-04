<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>luaslahan/update" class="form-horizontal" method="post">
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

						<input type="hidden" name="id"
								value="<?php echo $data[0]->id;?>">

						<div class="form-group">
							<label class="col-lg-2 control-label">Tahun
								<span class="text-danger">*</span>
							</label>
							<div class="col-lg-5">
								<select class="form-control" name="tahun" id="tahun">
									<option value="2013" <?php if($data[0]->tahun=="2013") { echo "selected";  } ?> >2018</option>
									<option value="2014" <?php if($data[0]->tahun=="2014") { echo "selected";  } ?> >2018</option>
									<option value="2015" <?php if($data[0]->tahun=="2015") { echo "selected";  } ?> >2018</option>
									<option value="2016" <?php if($data[0]->tahun=="2016") { echo "selected";  } ?> >2018</option>
									<option value="2017" <?php if($data[0]->tahun=="2017") { echo "selected";  } ?> >2018</option>
									<option value="2018" <?php if($data[0]->tahun=="2018") { echo "selected";  } ?> >2018</option>
									<option value="2019" <?php if($data[0]->tahun=="2019") { echo "selected";  } ?> >2019</option>
									<option value="2020" <?php if($data[0]->tahun=="2020") { echo "selected";  } ?> >2020</option>
									<option value="2021" <?php if($data[0]->tahun=="2021") { echo "selected";  } ?> >2021</option>
									<option value="2022" <?php if($data[0]->tahun=="2022") { echo "selected";  } ?> >2022</option>
								</select>                            	
                            </div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Unit Kerja Pengelola
								<span class="text-danger">*</span>
							</label>
							<div class="col-lg-10">
                            <select name="kph"  id="kph" class="select-search" required disabled 
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
                            <label class="col-lg-2 control-label">Nama Kawasan
                            	<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                            <select name="kawasanhutan"  id="kawasanhutan" class="form-control select-search" required
                                data-placeholder="Pilih Kawasan Hutan">
                                <?php foreach ($kawasanhutan as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>"
                                    	<?php if($data[0]->fungsi_kawasan==$value->id){ echo "selected"; } ?> >
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                    </div>		

                    <div class="form-group">
                            <label class="col-lg-2 control-label">Fungsi Hutan
                            	<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                            <select name="fungsikawasan"  id="fungsikawasan" class="form-control select-search" required
                                data-placeholder="Pilih Fungsi Kawasan">
                                <?php foreach ($kawasan as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>"
                                    	<?php if($data[0]->fungsi_kawasan==$value->id){ echo "selected"; } ?> >
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                    </div>


						<div class="form-group">
							<label class="col-lg-2 control-label">Luas
								<span class="text-danger">*</span>
							</label>
							<div class="col-lg-5">
								<input type="text" class="form-control"  required
									placeholder="Luas" name="luas"
									 value="<?php echo $data[0]->luas;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Satuan
								<span class="text-danger">*</span>
							</label>
							<div class="col-lg-5">
								<select name="satuan"  
									id="satuan" 
									class="form-control select-search" required
	                                data-placeholder="Pilih Satuan">
	                                <option value=""></option>
	                                <?php foreach ($satuan as $key => $value) { ?>
	                                    <option value="<?php echo $value->id?>"
	                                    	<?php if($data[0]->satuan==$value->id){ echo "selected"; } ?> >
	                                        <?php echo $value->nama?>                                           
	                                    </option>
	                                <?php }  ?>
	                                
	                            </select>
								<!-- <input type="text" class="form-control" required
									placeholder="Satuan" name="satuan"
								value="<?php echo $data[0]->satuan;?>"> -->
							</div>
						</div>						
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>luaslahan" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>