
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
            <?php 
                $role_id = $this->session->userdata('role_id');
                $user_id = $this->session->userdata('user_id');        
                if ($role_id==1 || $role_id==18) {
            ?>

			<div class="form-group">
				<a href="<?php echo base_url();?>pegawai_kementrian/tambah" class="btn btn-primary">Tambah</a>
			</div>

            <?php } ?>
		
			<table class="table datatable-basic table-bordered table-striped" id="table-pegawai">
				<thead>
					<tr class="bg-teal-400">
						<th>NIP</th>
						<th>Nama</th>
						<th>Pangkat/Gol</th>						
						<th>Jabatan</th>
                        <th>Unit Kerja</th>
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

<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/datatables_responsive.js"></script>

<script type="text/javascript">
	
	var table;

    $(function () {
    	var base_url = "<?php echo base_url();?>";
    	table = $('#table-pegawai').DataTable({
            autoWidth: false,
            serverSide: true,
            processing: true,
            bFilter: true,
            bInfo: true,
            bLengthChange: false,
            ajax: {
            	data:function(d){
                	d.pegawai = <?php echo $data[0]->id; ?>
                },
                url: base_url+'pegawai/getdata'                
            },
            columns: [
                {data: "nip", width : "80px"},
                {data: "nama", width : "30%"},
                {data: "pangkat"},
                {data: "jabatan"},
                {data: "unit_kerja"},
                {data: "aksi", orderable: false, searchable: false, width: "100px"}
            ],
           //  columnDefs: [
           //      {
           //      	"targets": [ 1 ],
           //          "visible": false
           //     	}
           // ],
            order: []
        });
    	
    	$('body').on('click', ".submit", function () {
            var id = $("#data-id").val();
            var requestBody = {
                            "id": $('#data-id').val()
                        };
            $.ajax({
            	url: base_url+'pegawai/delete/'+id,
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

<!-- 
<script type="text/javascript">
	
    $(function () {
    	//var base_url = <?php echo base_url();?>
    	// var table = $('#table-uk').DataTable();
    	
    	$('body').on('click', ".submit", function () {
            var id = $("#data-id").val();
            var requestBody = {
                            "id": $('#data-id').val()
                        };
            $.ajax({
            	url: 'pegawai/delete/'+id,
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
    
</script> -->