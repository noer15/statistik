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
			<a href="<?php echo base_url();?>Industri/tambah" class="btn btn-primary">Tambah</a>
		

		<table class="table datatable-basic table-hover table-bordered striped" id="table-penyuluh">
		<thead>
			<tr class="bg-teal-400">
				<th>Nama Industri</th>
				<th>Alamat</th>
				<th>Kabupaten</th>
				<th>Telp</th>
				<th>Kapasitas Izin</th>
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		
		</table>
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

	
    $(function () {
    	var baseurl = "<?php echo base_url();?>";
    	// var table = $('#table-uk').DataTable();
		
		console.log(baseurl);

		table = $('#table-penyuluh').DataTable({
            autoWidth: false,
            serverSide: true,
            processing: true,
            bFilter: true,
            bInfo: true,
            bLengthChange: false,
            ajax: {
            	data:function(d){},
                url: baseurl+'industri/getdata'                
            },
            columns: [
                {data: "nama_industri", width : "140px"},
                {data: "alamat"},
				{data: "namakab"},
                {data: "phone"},
                {data: "kapasitas_izin"},	
                {data: "aksi", orderable: false, searchable: false, width: "100px"}
            ],            
            order: []
        });
    	
    	$('body').on('click', ".submit", function () {
            var id = $("#data-id").val();
            var requestBody = {
                            "id": $('#data-id').val()
                        };
            $.ajax({
            	url: baseurl+'Industri/delete/'+id,
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