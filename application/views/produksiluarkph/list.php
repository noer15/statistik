<?php setlocale(LC_ALL, 'id-ID', 'id_ID'); ?>
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
		<?php $role = $this->session->userdata('role_id');
			  if($role != 22 && $role != 24): ?>
				<a href="<?php echo base_url();?>Produksiluarkph/tambah" class="btn btn-primary">Tambah</a>			
		<?php endif; ?>

		<table class="table datatable-basic table-hover table-bordered striped" id="table-penyuluh">
		<thead>
			<tr class="bg-teal-400">
				<th>No</th>
				<th>Kab/Kota</th>
				<th>Kec.</th>
				<th>Desa</th>
				<th>Jenis</th>
				<th>Jumlah</th>
				<th>Luas/Volume</th>
				<th>Tanggal</th>
				<th>Status</th>
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php $no=1; foreach($data as $key => $value){ 
			switch ($value->status) {
				case 	0: $status = 'Menunggu Persetujuan Kepala Seksi PSDH'; break;
				case 	1: $status = 'Menunggu Persetujuan Kabid BUPM'; break;
				case 	2: $status = 'Data Telah Disetujui'; break;
				default	 : $status = 'Menunggu Persetujuan'; break;
			}?>
			<tr>
				<td><?=$no?></td>
				<td><?php echo empty($value->nama_kab) ? $value->nama_kab_2 : $value->nama_kab; ?></td>
                <td><?php echo empty($value->nama_kec) ? $value->nama_kec_2 : $value->nama_kec; ?></td>
				<td><?php echo $value->nama_desa; ?></td>
				<td><?php echo $value->potensi; ?></td>
				<td><?php echo $value->jml_produksi; ?> <?php echo $value->satuan; ?></td>
				<td><?php echo $value->luas_produksi; ?> <?php echo $value->luas_satuan; ?></td>
				<td><?php echo $value->bulan ? strftime('%B', strtotime($value->bulan)) . ' -' : ''; ?> <?php echo $value->tahun; ?></td>
				<td><?php echo $status; ?></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="<?php echo base_url();?>Produksiluarkph/edit/<?php echo $value->id;?>">
									<i class="icon-pencil"></i> Edit/Lihat</a>
								</li>
								<?php if($role == 24 || $role == 1): ?>
								<li>
									<a href="#" onclick="deleteData(<?php echo $value->id;?>)"><i class="icon-cross2 text-danger-600"></i> Delete</a>
								</li>
								<?php endif; ?>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
		<?php $no++; } ?>			
		</tbody>
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
	
    $(function () {
    	var baseurl = "<?php echo base_url();?>";
    	// var table = $('#table-uk').DataTable();
    	
    	$('body').on('click', ".submit", function () {
            var id = $("#data-id").val();
            var requestBody = {
                            "id": $('#data-id').val()
                        };
            $.ajax({
            	url: baseurl+'Produksiluarkph/delete/'+id,
                type: 'DELETE',
                contentType: 'application/json',
                data: JSON.stringify(requestBody),
                beforeSend: function () {
                    $('#modal-delete').modal('hide');
                },
                error: function (data) {
                    resp = JSON.parse(data.responseText);
                },
                success: function (resp) {
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