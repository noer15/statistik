<!-- Theme JS files -->
<script type="text/javascript"
	src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript"
	src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/extensions/responsive.min.js">
</script>
<script type="text/javascript"
	src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/datatables_responsive.js">
</script>
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
            <?php 
			$role = $this->session->userdata('role_id');
			if($role != 21 && $role != 24): ?>
			<a href="<?php echo base_url();?>Kelompoktani/tambah" class="btn btn-primary">Tambah</a>
            <?php endif; ?>
            <table class="table datatable-basic table-hover table-bordered striped" id="table-kelompok1">
				<thead>
					<tr class="bg-teal-400">
						<th>No Register</th>
						<th>Nama Kelompok</th>
						<th>Alamat</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Status</th>
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
		var base_url = "<?php echo base_url();?>";

		table = $('#table-kelompok1').DataTable({
			autoWidth: false,
			serverSide: true,
			processing: true,
			bFilter: true,
			bInfo: true,
			bLengthChange: false,
			ajax: {
				data: function (d) {},
				url: base_url + 'Kelompoktani/getdata'
			},
			columns: [{
					data: "no_register",
					width: "140px"
				},
				{
					data: "nama"
				},
				{
					data: "alamat"
				},
				{
					data: "phone"
				},
				{
					data: "email"
				},
				{
					data: "status"
				},
				{
					data: "aksi",
					orderable: false,
					searchable: false,
					width: "100px"
				}
			],
			order: []
		});


		$('body').on('click', ".submit", function () {
			var id = $("#data-id").val();
			var requestBody = {
				"id": $('#data-id').val()
			};
			$.ajax({
				url: base_url + 'Kelompoktani/delete/' + id,
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
