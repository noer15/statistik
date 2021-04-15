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
			<a href="<?php echo base_url();?>module/tambah" class="btn btn-primary">Tambah</a>
		</div>

		<div style="overflow: auto; height:600px;">
			<table class="table datatable" id="table-uk">
				<thead>
					<tr>
						<th style="width: 2px;">NO.</th>
						<th colspan="3">Nama Modul</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align: center;">1.</td>
						<td colspan="4" style="background-color: #ccc;">Master</td>
					</tr>
					<?php foreach($data as $key => $value){ ?>
					<?php if($value->module == 'Master'): ?>
					<tr>
						<td></td>
						<td colspan="3">&emsp; <?php echo $value->name; ?></td>
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="<?php echo base_url();?>module/edit/<?php echo $value->id;?>">
												<i class="icon-pencil"></i> Edit</a>
										</li>
										<li>
											<a href="#" onclick="deleteData(<?php echo $value->id;?>)"><i
													class="icon-cross2 text-danger-600"></i> Delete</a>
										</li>
									</ul>
								</li>
							</ul>
						</td>
					</tr>
					<?php endif; ?>
					<?php } ?>

					<tr>
						<td style="text-align: center;">2.</td>
						<td colspan="4" style="background-color: #ccc;">Input</td>
					</tr>
					<?php
			$oldSub1 = '';
			foreach($input as $key => $value){ ?>
					<tr>
						<td></td>
						<td colspan="4" style="background-color: #ddd;">&emsp; <?=$value->sub1?></td>
					</tr>
					<?php foreach($this->db->get_where('module', ['sub1' => $value->sub1])->result() as $sub1): ?>
					<?php 
							$oldSub1 = $oldSub1;
							if($sub1->sub2 && $sub1->sub2 == $oldSub1): ?>
					<tr>
						<td></td>
						<td colspan="4" style="background-color: #eee;">&emsp;&emsp;&emsp; <?=$sub1->sub2?></td>
					</tr>
					<?php foreach($this->db->get_where('module', ['sub2' => $sub1->sub2])->result() as $sub2): ?>
					<tr>
						<td></td>
						<td colspan="3">&emsp;&emsp;&emsp;&emsp;&emsp; <?php echo $sub2->name; ?></td>
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="<?php echo base_url();?>module/edit/<?php echo $sub2->id;?>">
												<i class="icon-pencil"></i> Edit</a>
										</li>
										<li>
											<a href="#" onclick="deleteData(<?php echo $sub2->id;?>)"><i
													class="icon-cross2 text-danger-600"></i> Delete</a>
										</li>
									</ul>
								</li>
							</ul>
						</td>
					</tr>
					<?php endforeach; ?>

					<?php else: $oldSub1 = $sub1->sub2; ?>
					<tr>
						<td></td>
						<td colspan="3">&emsp;&emsp;&emsp; <?php echo $sub1->name; ?></td>
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="<?php echo base_url();?>module/edit/<?php echo $sub1->id;?>">
												<i class="icon-pencil"></i> Edit</a>
										</li>
										<li>
											<a href="#" onclick="deleteData(<?php echo $sub1->id;?>)"><i
													class="icon-cross2 text-danger-600"></i> Delete</a>
										</li>
									</ul>
								</li>
							</ul>
						</td>
					</tr>
					<?php endif; ?>
					<?php endforeach; ?>
					<?php } ?>

					<tr>
						<td style="text-align: center;">3.</td>
						<td colspan="4" style="background-color: #ccc;">Laporan</td>
					</tr>
					<?php foreach($data as $key => $value){ ?>
					<?php if($value->module == 'Laporan'): ?>
					<tr>
						<td></td>
						<td colspan="3">&emsp;<?php echo $value->name; ?></td>
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="<?php echo base_url();?>module/edit/<?php echo $value->id;?>">
												<i class="icon-pencil"></i> Edit</a>
										</li>
										<li>
											<a href="#" onclick="deleteData(<?php echo $value->id;?>)"><i
													class="icon-cross2 text-danger-600"></i> Delete</a>
										</li>
									</ul>
								</li>
							</ul>
						</td>
					</tr>
					<?php endif; ?>
					<?php } ?>

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
				url: baseurl + 'module/delete/' + id,
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
