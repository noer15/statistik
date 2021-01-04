<!-- Theme JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/pickers/datepicker.js"></script>

<script type="text/javascript">
	$(function () {
		var baseurl = "<?php echo base_url();?>"
        $('#penunjukan_date, #batb_date, #tetap_date').datepicker({
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
			<form action="<?php echo base_url();?>Pengukuhankh/store" class="form-horizontal" method="post">
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

                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label">Tahun
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control" name="tahun" id="tahun">
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>                               
                        </div>
                    </div> -->

                    <div class="form-group">
                            <label class="col-lg-2 control-label">Kawasan Hutan</label>
                            <div class="col-lg-10">
                            <select name="kawasan"  id="kawasan" class="select-search" required
                                data-placeholder="Pilih Kawasan Hutan">
                                <?php foreach ($kawasan as $key => $value) { ?>
                                    <option value="<?php echo $value->id?>">
                                        <?php echo $value->nama?>                                           
                                    </option>
                                <?php }  ?>
                                
                            </select>
                            </div>
                    </div>

                    <fieldset class="content-group">
                        <legend class="text-bold">SK Penunjukan : </legend>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nomor</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Nomor SK Penunjukan" name="penunjukan_no" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Tanggal SK Penunjukan, Format : yyyy-mm-dd" 
                                    name="penunjukan_date" id="penunjukan_date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Wilayah</label>
                            <div class="col-lg-5">
                                <select class="form-control" name="penunjukan_pilihan" id="penunjukan_pilihan">
                                    <option value="Darat">Darat</option>
                                    <option value="Laut">Laut</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Panjang</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" 
                                    placeholder="Panjang" name="penunjukan_panjang" required>
                            </div>
                            <div class="col-lg-5">
                                <select name="penunjukan_satuan_panjang"  
                                    id="penunjukan_satuan_panjang" 
                                    class="form-control select-search" required
                                    data-placeholder="Pilih Satuan">
                                    <option value=""></option>
                                    <?php foreach ($satuan as $key => $value) { ?>
                                        <option value="<?php echo $value->id?>">
                                            <?php echo $value->nama?>                                           
                                        </option>
                                    <?php }  ?>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Luas</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" 
                                    placeholder="Luas" name="penunjukan_luas" required>
                            </div>
                            <div class="col-lg-5">
                                <select name="penunjukan_satuan_luas"  
                                    id="penunjukan_satuan_luas" 
                                    class="form-control select-search" required
                                    data-placeholder="Pilih Satuan">
                                    <option value=""></option>
                                    <?php foreach ($satuan as $key => $value) { ?>
                                        <option value="<?php echo $value->id?>">
                                            <?php echo $value->nama?>                                           
                                        </option>
                                    <?php }  ?>
                                    
                                </select>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="content-group">
                        <legend class="text-bold">Penataan Batas (BATB) : </legend>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nomor</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Nomor SK Penataan Batas" name="batb_no" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Tanggal SK Penataan Batas, Format : yyyy-mm-dd" 
                                    name="batb_date" id="batb_date" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Wilayah</label>
                            <div class="col-lg-5">
                                <select class="form-control" name="batb_pilihan" id="batb_pilihan">
                                    <option value="Darat">Darat</option>
                                    <option value="Laut">Laut</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Panjang</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" 
                                    placeholder="Panjang" name="batb_panjang" >
                            </div>
                            <div class="col-lg-5">
                                <select name="batb_satuan_panjang"  
                                    id="batb_satuan_panjang" 
                                    class="form-control select-search" 
                                    data-placeholder="Pilih Satuan">
                                    <option value=""></option>
                                    <?php foreach ($satuan as $key => $value) { ?>
                                        <option value="<?php echo $value->id?>">
                                            <?php echo $value->nama?>                                           
                                        </option>
                                    <?php }  ?>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Luas</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" 
                                    placeholder="Luas" name="batb_luas" >
                            </div>
                            <div class="col-lg-5">
                                <select name="batb_satuan_luas"  
                                    id="batb_satuan_luas" 
                                    class="form-control select-search" 
                                    data-placeholder="Pilih Satuan">
                                    <option value=""></option>
                                    <?php foreach ($satuan as $key => $value) { ?>
                                        <option value="<?php echo $value->id?>">
                                            <?php echo $value->nama?>                                           
                                        </option>
                                    <?php }  ?>
                                    
                                </select>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="content-group">
                        <legend class="text-bold">SK Penetapan : </legend>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nomor</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Nomor SK Penetapan" name="tetap_no">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" 
                                    placeholder="Tanggal SK Penetapan, Format : yyyy-mm-dd" 
                                    name="tetap_date" id="tetap_date" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Wilayah</label>
                            <div class="col-lg-5">
                                <select class="form-control" name="tetap_pilihan" id="tetap_pilihan">
                                    <option value="Darat">Darat</option>
                                    <option value="Laut">Laut</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Panjang</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" 
                                    placeholder="Panjang" name="tetap_panjang" >
                            </div>
                            <div class="col-lg-5">
                                <select name="tetap_satuan_panjang"  
                                    id="tetap_satuan_panjang" 
                                    class="form-control select-search"
                                    data-placeholder="Pilih Satuan">
                                    <option value=""></option>
                                    <?php foreach ($satuan as $key => $value) { ?>
                                        <option value="<?php echo $value->id?>">
                                            <?php echo $value->nama?>                                           
                                        </option>
                                    <?php }  ?>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Luas</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" 
                                    placeholder="Luas" name="tetap_luas">
                            </div>
                            <div class="col-lg-5">
                                <select name="tetap_satuan_luas"  
                                    id="tetap_satuan_luas" 
                                    class="form-control select-search"
                                    data-placeholder="Pilih Satuan">
                                    <option value=""></option>
                                    <?php foreach ($satuan as $key => $value) { ?>
                                        <option value="<?php echo $value->id?>">
                                            <?php echo $value->nama?>                                           
                                        </option>
                                    <?php }  ?>
                                    
                                </select>
                            </div>
                        </div>

                    </fieldset>


                        <!-- <div class="form-group">
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
                                        <option value="<?php echo $value->id?>">
                                            <?php echo $value->nama?>                                           
                                        </option>
                                    <?php }  ?>
                                    
                                </select>
                            </div>
                        </div> -->
						
						<div class="text-left">
							<a  href="<?php echo base_url();?>Pengukuhankh" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>