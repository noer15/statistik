<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/datatables.min.js"></script>	
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/datatables_responsive.js"></script>
<!-- /theme JS files -->


<div class="content">
	<!-- Basic datatable -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title"><?php echo $header;?><strong><?php echo $kelompok[0]->nama;?></strong></h5>
			<div class="heading-elements">
				<ul class="icons-list">
				    <li><a data-action="collapse"></a></li>
				    <li><a data-action="reload"></a></li>
				    <li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
			<a href="<?php echo base_url();?>Kelompoktani" class="btn btn-danger">Kembali</a>
			<a href="<?php echo base_url();?>Anggotakelompoktani/tambah/<?php echo $kelompok[0]->id;?>" class="btn btn-primary">Tambah</a>
			
		
		
		<table class="table datatable-basic table-hover table-bordered striped" id="table-kelompok-anggota">
		<thead>
			<tr class="bg-teal-400">
				<th>No</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Jabatan</th>				
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		<!-- <tbody>
		<?php foreach($data as $key => $value){ ?>
			<tr>
				<td><?php echo $value->nama; ?></td>
				<td><?php echo $value->alamat; ?></td>
				<td><?php echo $value->namajabatan; ?></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">								
								<li><a href="<?php echo base_url();?>Anggotakelompoktani/edit/<?php echo $value->id;?>">
									<i class="icon-pencil"></i> Edit</a>
								</li>
								<li>
									<a href="#" onclick="deleteData(<?php echo $value->id;?>)"><i class="icon-cross2 text-danger-600"></i> Delete</a>
								</li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
		<?php } ?>			
		</tbody> -->
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
    	table = $('#table-kelompok-anggota').DataTable({
            autoWidth: false,
            serverSide: true,
            processing: true,
            bFilter: true,
            bInfo: true,
            bLengthChange: false,
            ajax: {
            	data:function(d){
            		d.kelompok_id = "<?php echo $kelompok[0]->id;?>"
            	},
                url: baseurl+'Anggotakelompoktani/getdata'                
            },
            columns: [
                {data: "no", width : "100px"},
                {data: "nama"},
                {data: "alamat"},
                {data: "jabatan"},
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
            	url: baseurl+'Anggotakelompoktani/delete/'+id,
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