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
                        <option value="1">Status</option>
                        <option value="2">Pendidikan</option>
                        <option value="3">Jabatan</option>
                        <option value="4">Jenis Kelamin</option>
                        <!-- <option value="5">CDK ( Cabang Dinas Kehutanan )</option> -->
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

            <div class="form-group" id="divCDK">
            <br>
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

			<!-- <div class="form-group text-left">				
				<div class="col-lg-12">
            		<a href="<?php echo base_url();?>Report/rekappenyuluh/0/0" class="btn btn-default" id="cetak"
            			target="_blank">
            			<i class="icon-printer2"></i> Cetak</a>            	
            	</div>
        	</div>

        	<div class="form-group">
        		<div class="col-lg-12">
	            <table class="table datatable table-bordered table-striped" id="table-rekap">
					<thead>
						<tr class="bg-success-300">
							<th>Kode</th>
							<th>Nama <span id="colname"> Kabupaten</span></th>
							<th>Jumlah</th>
						</tr>
					</thead>					
				</table>
				</div>
			</div> -->

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
                $('#divCDK').show();
                $('#divKab').show();
                $('#myDIV').show();
                $('#myDIV').load("<?php echo base_url().'Penyuluh/lapstatus/0/0/0'; ?>");
            }else
            if(lap==2){
                $('#divCDK').show();
                $('#divKab').show();
                $('#myDIV').show();
                $('#myDIV').load("<?php echo base_url().'Penyuluh/lappendidikan/0/0'; ?>");
            }else
            if(lap==3){
                $('#divCDK').show();
                $('#divKab').show();
                $('#myDIV').show();
                $('#myDIV').load("<?php echo base_url().'Penyuluh/lapjabatan/0/0'; ?>");
            }else
            if(lap==4){
                $('#divCDK').show();
                $('#divKab').show();
                $('#myDIV').show();
                $('#myDIV').load("<?php echo base_url().'Penyuluh/lapjeniskelamin/0/0'; ?>");
            }else
            // if(lap==5){
            //     $('#divCDK').show();   
            //     $('#divKab').hide();

            //     $('#myDIV').show();
            //     $('#myDIV').load("<?php echo base_url().'Penyuluh/lapcdk'; ?>");
            // }
            {
                $('#divKab').hide();
                $('#myDIV').hide();
                $('#divCDK').hide();
                $('#kec-group').hide();
            }
            

        });

    });

</script>


<script type="text/javascript">
	
    $(function () {
    	var baseurl = "<?php echo base_url();?>";
    	// var table = $('#table-uk').DataTable();
    	
    	$('body').on('click', ".submit", function () {
            var id = $("#data-id").val();
            var requestBody = {
                            "id": $('#data-id').val()
                        };
            $.ajax({
            	url: baseurl+'Penyuluh/delete/'+id,
                type: 'DELETE',
                contentType: 'application/json',
                data: JSON.stringify(requestBody),
                beforeSend: function () {
                    $('#modal-delete').modal('hide');
                },
                error: function (data) {
                    resp = JSON.parse(data.responseText);
                    //swal('Terjadi Kesalahan!', resp.message, 'error');
                },
                success: function (resp) {
                    //swal('Sukses!', resp.message, 'success');
                    //table.ajax.reload();
                    location.reload();

                },
                complete: function (xhr) {}
            });
        });

    });

    function deleteData($id) {
        $('#modal-delete').modal('show');
        $("#data-id").val($id);
        return true;
    }
    
</script>

<script type="text/javascript">
	$(function () {
		var baseurl = "<?php echo base_url();?>";
		$('#kec-group').hide();

		var table = $('#table-rekap').DataTable({
            responsive: true,
            serverSide: true,
            processing: true,
            paging:   false,
            ordeding: false,
            info : false,
            searching:false,
            ajax: {
                data : function(d){
                    d.kab=$('#kab').val();                    
                },
                    url : baseurl+'penyuluh/rekaplist',
                },
                columns: [
                    {data: 'kode'},
                    {data: 'nama',width: "50%"},
                    {data: 'jml'}         
                ]
        });

        $('#cdk').change(function(){
            var cdk  = $(this).val();     
            var kab  = $('#kab').val();     
            var kec  = $('#kec').val();                        
            var lap = $('#pilih_lap').val();        

            //console.log(lap);            
            var url_;

            if(lap==1){
                url_ = baseurl+"Report/lapstatus/"+kab+"/"+kec+"/"+cdk;  
                urlLoad = baseurl+"Penyuluh/lapstatus/"+kab+"/"+cdk;
                //$('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else
            if(lap==2){
                url_ = baseurl+"Report/lappendidikan/"+kab+"/"+kec+"/"+cdk;
                urlLoad = baseurl+"Penyuluh/lappendidikan/"+kab+"/"+cdk;
                //$('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else
            if(lap==3){
                url_ = baseurl+"Report/lapjabatan/"+kab+"/"+kec+"/"+cdk;   
                urlLoad = baseurl+"Penyuluh/lapjabatan/"+kab+"/"+cdk;
                //$('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else
            if(lap==4){
                url_ = baseurl+"Report/lapjeniskelamin/"+kab+"/"+kec+"/"+cdk; 
                urlLoad = baseurl+"Penyuluh/lapjeniskelamin/"+kab+"/"+cdk;
                //$('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }

            console.log(urlLoad);
            console.log(url_);
            $('#cetak').attr('href',url_);
            //table.ajax.reload(); 

        });

		$('#kab').change(function(){
            var kab  = $(this).val();     
            var kec  = $('#kec').val();                        
            var lap = $('#pilih_lap').val();        
            var cdk  = $('#cdk').val();                        
            //$('#cdk').select.

            var url_;

            if(lap==1){
                url_ = baseurl+"Report/lapstatus/"+kab+"/"+kec+"/"+cdk;    
                urlLoad = baseurl+"Penyuluh/lapstatus/"+kab+"/"+cdk;
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else
            if(lap==2){
                url_ = baseurl+"Report/lappendidikan/"+kab+"/"+kec+"/"+cdk;    
                urlLoad = baseurl+"Penyuluh/lappendidikan/"+kab+"/"+cdk;
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else
            if(lap==3){
                url_ = baseurl+"Report/lapjabatan/"+kab+"/"+kec+"/"+cdk;   
                urlLoad = baseurl+"Penyuluh/lapjabatan/"+kab+"/"+cdk;
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else
            if(lap==4){
                url_ = baseurl+"Report/lapjeniskelamin/"+kab+"/"+kec+"/"+cdk; 
                urlLoad = baseurl+"Penyuluh/lapjeniskelamin/"+kab+"/"+cdk;
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }
            // if(lap==5){
            //     url_ = baseurl+"Report/lapcdk/"+kab+"/"+kec;
            // }

            console.log(urlLoad);                        
           
            $("#kec").empty();
            $('#kec').append($("<option></option>")
                        	.attr("value",0)
                            .text('< All >'));
            if(kab==0){
                if(lap==1){
                    urlLoad = baseurl+"Penyuluh/lapstatus/0/0";                   
                }else
                if(lap==2){
                    urlLoad = baseurl+"Penyuluh/lappendidikan/0/"+cdk;
                }else
                if(lap==3){
                    urlLoad = baseurl+"Penyuluh/lapjabatan/0/"+cdk;                
                }else
                if(lap==4){
                    urlLoad = baseurl+"Penyuluh/lapjeniskelamin/0/"+cdk;
                }
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);

            	//document.getElementById("colname").innerHTML = " Kabupaten";
            	$('#kec-group').hide();
            }else{
            	//document.getElementById("colname").innerHTML = " Kecamatan";
            	$('#kec-group').show();
	         //    $.ajax({                            
	         //        url: baseurl+'/Desa/getKecamatan/'+kab,
	         //        type:'GET',
	         //        contentType: 'application/json',
	         //        success: function (resp) { 

	         //        	var dataArray = JSON.parse(resp);                 	
	         //        	// console.log(dataArray);                	                	
	         //        	for (var i in dataArray) {
	         //        		//console.log(dataArray[i]);
	         //            	$('#kec').append($("<option></option>")
	         //                	.attr("value",dataArray[i].id)
	         //                    .text(dataArray[i].nama));
	         //            }
	         //            //console.log(dataArray[0].id);                		                    
	         //        },
	        	// });        
        	}
            
            console.log(url_);
            $('#cetak').attr('href',url_);

        	//table.ajax.reload(); 
        });

        $('#kec').change(function(){
        	var kab  = $('#kab').val();
            var kec  = $(this).val();     
            //console.log(kab)                                       
            url_ = baseurl+"Report/rekappenyuluh/"+kab+"/"+kec;
            $('#cetak').attr('href',url_);
        });        

	});
</script>
