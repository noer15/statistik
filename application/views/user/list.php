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
			<?php if($this->session->userdata('role_id')==1){ ?>
			<a href="<?php echo base_url();?>/user/tambah" class="btn btn-primary">Tambah</a>
			<?php } ?>
		</div>

		<table class="table datatable" id="table-uk">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Username</th>
				<th>Status</th>				
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($data as $key => $value){ ?>
			<tr>
				<td><?php echo $value->name; ?></td>
				<td><?php echo $value->username; ?></td>
				<td><?php if ($value->suspend==0) { ?> <span class="label label-primary">Aktif</span> 
					<?php }else { ?> <span class="label label-danger">Tidak Aktif</span> <?php } ?></td>                     
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?php echo base_url();?>user/edit/<?php echo $value->id;?>">
									<i class="icon-pencil"></i> Edit</a>
								</li>
								<?php if($this->session->userdata('role_id')==1){ ?>
								<li>
									<a href="#" onclick="deleteData(<?php echo $value->id;?>)"><i class="icon-cross2 text-danger-600"></i> Delete</a>
								</li>
								<?php } ?>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
		<?php } ?>			
		</tbody>
		</table>
	</div>
	<!-- /basic datatable -->

	<!-- Footer -->
	<div class="footer text-muted">
		&copy; 2018 <a href="#">admin Statistik</a> 
	</div>
	<!-- /footer -->

</div>

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
            	url: 'user/delete/'+id,
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

    function deleteData(id) {
        $('#modal-delete').modal('show');
        $("#data-id").val(id);
        return true;
    }
    
</script>