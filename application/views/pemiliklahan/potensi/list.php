<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/datatables.min.js"></script>   
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/datatables_basic.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/datatables_responsive.js"></script>
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
							<label class="col-lg-2 control-label">Pemilik Lahan </label>
							<div class="col-lg-10">
                                <input type="hidden" name="pemilikId" value="<?php echo $pemilik[0]->id;?>">
								<input type="text" class="form-control" placeholder="Nama Pemilik" name="nama_pemilik" disabled value="<?php echo $pemilik[0]->nama_sertifikat;?>">
							</div>
			</div>
			<br>
			<div class="form-group">
               	<label class="col-lg-2 control-label">Potensi</label>
                <div class="col-lg-10">
                    <select name="potensi"  id="potensi" class="form-control select" required
                    	data-placeholder="Pilih Potensi">
                    	<option value="1">Kayu</option>
                        <option value="2">Bukan Kayu</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="form-group" id="cbdiameter">
               	<label class="col-lg-2 control-label">Diameter Kayu</label>
                <div class="col-lg-10">
                    <select name="diameter"  id="diameter" class="form-control" required
                    	data-placeholder="Pilih Diameter">
                    	<option value="1">Diameter > 5 cm</option>
                        <option value="2">Diameter < 5 cm</option>
                    </select>
                </div>
            </div>

            <br>
            <div class="form-group">
            	<div class="col-lg-12 text-left">

                    <a href="<?php echo base_url();?>Pemiliklahan" class="btn btn-danger">Kembali</a>

			        <a href="<?php echo base_url();?>Potensi/tambah/<?php echo $pemilik[0]->id;?>?p=1&d=1" 
				            id="tambah" class="btn btn-primary">Tambah</a>
			
				</div>
			</div>
		</div>

		<div class="panel-body">
            <div id="potensi1">
		<table class="table datatable table-hover table-bordered striped" id="table-potensi">
    		<thead>
                <tr class="bg-teal-400">
        			<th>No</th>				
        			<th><span id="coljenis">Jenis Pohon</span></th>				
        			<th>Tahun Tanam</th>				
                    <th><span id="colname">Diameter</span></th>
                    <th>Tinggi Pohon</th>
                    <th>Tahun</th>
                    <th>Jumlah Budidaya</th>
                    <th>Jumlah Produksi</th>
        			<th class="text-center">Aksi</th>
                </tr>
    		</thead>		
		</table>
            </div>

            <div id="potensi2">
        <table class="table datatable table-hover table-bordered striped" id="table-potensi2">
            <thead>
                <tr class="bg-teal-400">
                    <th>No</th>             
                    <th><span id="coljenis">Jenis Bukan Kayu</span></th>                                 
                    <th>Tahun Tanam</th>                
                    <th>Diameter</th>
                    <th>Tinggi Pohon</th>
                    <th>Tahun</th>
                    <th>Jumlah Budidaya</th>
                    <th>Jumlah Produksi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>        
        </table>
            </div>
	</div>
    </div>
	<!-- /basic datatable -->

	<!-- Footer -->
	<div class="footer text-muted">
		&copy; 2018 <a href="#">admin Statistik</a> 
	</div>
	<!-- /footer -->

</div>

<script type="text/javascript">
	var table;
    var table2;
    $(function () {
        $('#potensi1').show();
        $('#potensi2').hide();

    	var baseurl = "<?php echo base_url();?>";
        var p = "<?php echo $pemilik[0]->id;?>";
      
       table = $('#table-potensi').DataTable({
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: {
                data : function(d){
                    d.potensi=$('#potensi').val();
                    d.diameter=$('#diameter').val();
                },
                    url : baseurl+'/Potensi/getlist/'+p,
                },
                columns: [
                    {data: 'no'},
                    {data: 'jenis_potensi'},
                    {data: 'tahun_tanam'},                    
                    {data: 'jml_pohon', className: "text-right"},                            
                    {data: 'tinggi_pohon',width: "100px"},

                    {data: 'tahun'},
                    {data: 'jml_budidaya'},
                    {data: 'jml_produksi'},
                    {data: 'aksi', orderable: false, searchable: false}                    
                ],
                columnDefs:[
                    {
                        targets:[5,6,7], 
                        visible:false
                    }
                ]
        });

       table2 = $('#table-potensi2').DataTable({
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: {
                data : function(d){
                    d.potensi=$('#potensi').val();
                    d.diameter=$('#diameter').val();
                },
                    url : baseurl+'/Potensi/getlist/'+p,
                },
                columns: [
                    {data: 'no'},
                    {data: 'jenis_potensi'},
                    {data: 'tahun_tanam'},                    
                    {data: 'jml_pohon', className: "text-right"},                            
                    {data: 'tinggi_pohon',width: "100px"},

                    {data: 'tahun'},
                    {data: 'jml_budidaya'},
                    {data: 'jml_produksi'},
                    {data: 'aksi', orderable: false, searchable: false}                    
                ],
                columnDefs:[
                    {
                        targets:[2,3,4], 
                        visible:false
                    }
                ]
        });

    	//var urlTambah = baseurl+"Potensi/tambah/<?php echo $pemilik[0]->id;?>";
    	//console.log(urlTambah);            
    	// var table = $('#table-uk').DataTable();
    	$('#potensi').change(function(){
            var cb  = $(this).val();                        
            if(cb=='1'){
                $('#potensi1').show();
                $('#potensi2').hide();

                $('#cbdiameter').show();        

                document.getElementById("coljenis").innerHTML = "Jenis Pohon";



                urlTambah = baseurl+"Potensi/tambah/<?php echo $pemilik[0]->id;?>"+"?p="+cb+"&d=1";   

                table.ajax.reload();     


            }else{
                $('#potensi1').hide();
                $('#potensi2').show();

                document.getElementById("colname").innerHTML = "Jml Pohon";
                document.getElementById("coljenis").innerHTML = "Jenis Bukan Kayu";
                $('#cbdiameter').hide();                                
                urlTambah = baseurl+"Potensi/tambah/<?php echo $pemilik[0]->id;?>"+"?p="+cb;
                table2.ajax.reload();
            }
            $('#tambah').attr('href',urlTambah);
                           

        });

        $('#diameter').change(function(){
            var cb  = $('#potensi').val();    
            var cbd  = $(this).val();

            console.log();

            if (cbd==1){
                $('#potensi1').show();
                $('#potensi2').hide();
                document.getElementById("colname").innerHTML = "Diameter";
                document.getElementById("coljenis").innerHTML = "Jenis Pohon";
            }else{
                $('#potensi1').show();
                $('#potensi2').hide();
                document.getElementById("colname").innerHTML = "Jumlah Pohon";
                document.getElementById("coljenis").innerHTML = "Jenis Pohon";
            }

            table.ajax.reload();

            urlTambah = baseurl+"Potensi/tambah/<?php echo $pemilik[0]->id;?>"+"?p="+cb+"&d="+cbd;
            $('#tambah').attr('href',urlTambah);            
            
        });

    	
    	$('body').on('click', ".submit", function () {
            var id = $("#data-id").val();
            var requestBody = {
                            "id": $('#data-id').val()
                        };
            $.ajax({
            	url: baseurl+'Potensi/delete/'+id,
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