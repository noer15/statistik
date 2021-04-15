<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<!-- Core JS files -->
<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/loaders/blockui.min.js"></script> -->
<!-- /core JS files -->

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/datatables.min.js"></script>
<!-- /theme JS files -->

<div class="content">
	<!-- Basic datatable -->
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
				<label class="col-lg-2">Laporan Berdasarkan</label>
				<div class="col-lg-5">
                	<select name="pilih_lap"  id="pilih_lap" class="form-control" >
                        <option value="">< Pilih Laporan > </option>
                        <option value="1">Kelas</option>
                        <!-- <option value="2">CDK ( Cabang Dinas Kehutanan )</option> -->
                	</select>
                </div>
			</div>

            <br>            			

            <div class="form-group" id="divKab">
                <label class="col-lg-2">Kabupaten</label>
                <div class="col-lg-5">
                    <select name="kab"  id="kab" class="select-search" 
                        data-placeholder="Pilih Kabupaten">
                        <option value="0"> < All > </option>
                        <?php foreach ($kabupaten as $key => $value) { ?>
                            <option value="<?php echo $value->id?>">
                                <?php echo $value->nama?>                                           
                            </option>
                        <?php }  ?>                                
                    </select>
                </div>
            </div>

			<div class="form-group" id="kec-group">
                <br>
				<label class="col-lg-2 control-label">Kecamatan</label>
				<div class="col-lg-5">
                	<select name="kec"  id="kec" class="select-search" 
                        data-placeholder="Pilih Kecamatan">
                        <option value="0"> < All > </option>
                        <?php foreach ($kecamatan as $key => $value) { ?>
                        	<option value="<?php echo $value->id?>">
                            	<?php echo $value->nama?>                                    		
                            </option>
                        <?php }  ?>                                
                	</select>
                </div>
			</div>
			<br>
            <?php 
            $role = $this->session->userdata('role_id');
            if($role == 24 && $role == 1):?>
            <div class="form-group" id="divCDK">            
                <label class="col-lg-2 control-label">CDK </label>
                <div class="col-lg-5">
                    <select name="cdk"  id="cdk" class="select-search" 
                        data-placeholder="Pilih CDK">
                        <option value="0"> < All > </option>                                                        
                        <?php foreach ($datacdk as $key => $value) { ?>
                            <option value="<?php echo $value->id?>">
                                <?php echo $value->nama?>                                           
                            </option>
                        <?php }  ?>
                    </select>
                </div>
            </div>
			<?php endif; ?>
		</div>

		
	</div>
	<!-- /basic datatable -->

    <div class="panel panel-flat">
        <div class="panel-body">
            <div id="myDIV"></div>
        </div>
    </div>

	<!-- Footer -->
	<div class="footer text-muted">
		&copy; 2018 <a href="#">admin Statistik</a> 
	</div>
	<!-- /footer -->

</div>

<script type="text/javascript">                
    $(function(){        
        //var lap = $('#pilih_lap').val();

        $('#divKab').hide();
        $('#myDIV').hide();
        $('#divCDK').hide();
        $('#kec-group').hide();
        

        $('#pilih_lap').change(function(){
            var lap = $(this).val();            
            if(lap==1){
                $('#divKab').show();
                $('#divCDK').show();
                $('#myDIV').show();
                $('#myDIV').load("<?php echo base_url().'Kelompoktani/lapkelas/0/0/0'; ?>");
            }else
            if(lap==2){                
                $('#divKab').hide();
                $('#kec-group').hide();

                $('#myDIV').show();
                $('#myDIV').load("<?php echo base_url().'Kelompoktani/lapcdk'; ?>");
            }
            else{
                $('#divKab').hide();
                $('#kec-group').hide();
                $('#myDIV').hide();
            }

        });

    });

</script>


<script type="text/javascript">
	
    $(function () {
    	var baseurl = "<?php echo base_url();?>";
    	// var table = $('#table-uk').DataTable();
    });
</script>

<script type="text/javascript">
	$(function () {
		var baseurl = "<?php echo base_url();?>";
		$('#kec-group').hide();

		$('#kab').change(function(){
            var kab  = $(this).val();     
            var kec  = $('#kec').val();                        
            var lap = $('#pilih_lap').val();        
            var cdk  = $('#cdk').val();
            
            var url_;

            if(lap==1){
                url_ = baseurl+"Report/lapkelas/"+kab+"/"+kec+"/"+cdk;    
                urlLoad = baseurl+"Kelompoktani/lapkelas/"+kab+"/"+kec+"/"+cdk;        
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else            
            if(lap==2){
                url_ = baseurl+"Report/lapkelompokcdk";
                urlLoad = baseurl+"Kelompoktani/lapcdk";
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }

            console.log(urlLoad);
            
           
            $("#kec").empty();
            $('#kec').append($("<option></option>")
                        	.attr("value",0)
                            .text('< All >'));
            if(kab==0){
                if(lap==1){
                    urlLoad = baseurl+"Kelompoktani/lapkelas/0"+"/"+kec+"/"+cdk;  
                }else
                if(lap==2){
                    urlLoad = baseurl+"Kelompoktani/lapcdk";                   
                }
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);

            	//document.getElementById("colname").innerHTML = " Kabupaten";
            	$('#kec-group').hide();
            }else{
            	//document.getElementById("colname").innerHTML = " Kecamatan";
            	$('#kec-group').show();
	            $.ajax({                            
	                url: baseurl+'/Desa/getKecamatan/'+kab,
	                type:'GET',
	                contentType: 'application/json',
	                success: function (resp) { 

	                	var dataArray = JSON.parse(resp);                 	
	                	// console.log(dataArray);                	                	
	                	for (var i in dataArray) {
	                		//console.log(dataArray[i]);
	                    	$('#kec').append($("<option></option>")
	                        	.attr("value",dataArray[i].id)
	                            .text(dataArray[i].nama));
	                    }
	                    //console.log(dataArray[0].id);                		                    
	                },
	        	});        
        	}
            
            $('#cetak').attr('href',url_);
         
        });

        $('#kec').change(function(){
        	var kab  = $('#kab').val();
            var kec  = $(this).val();  
            var cdk  = $('#cdk').val();  
            var lap = $('#pilih_lap').val();            
            var url_; 

            if(lap==1){
                url_ = baseurl+"Report/lapkelas/"+kab+"/"+kec+"/"+cdk;     
                urlLoad = baseurl+"Kelompoktani/lapkelas/"+kab+"/"+kec+"/"+cdk;      
                //$('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else            
            if(lap==2){
                url_ = baseurl+"Report/lapkelompokcdk";
                urlLoad = baseurl+"Kelompoktani/lapcdk";
                //$('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }

            console.log(urlLoad)

            url_ = baseurl+"Report/rekapkelompok/"+kab+"/"+kec;
            $('#cetak').attr('href',url_);
        });

        $('#cdk').change(function(){
            var cdk  = $(this).val();     
            var kab  = $('#kab').val();     
            var kec  = $('#kec').val();                        
            var lap = $('#pilih_lap').val();        

            //console.log(lap);            
            var url_;

            if(lap==1){

                url_ = baseurl+"Report/lapkelas/"+kab+"/"+kec+"/"+cdk;    
                urlLoad = baseurl+"Kelompoktani/lapkelas/"+kab+"/"+kec+"/"+cdk;        
                //$('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else
            if(lap==2){
                $('#myDIV').load(urlLoad);
            }
            console.log(urlLoad);
            console.log(url_);
            $('#cetak').attr('href',url_);
            //table.ajax.reload(); 

        });

	});
</script>
