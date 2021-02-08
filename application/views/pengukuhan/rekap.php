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


<div class="content">
	<!-- Basic datatable -->
	<div class="panel panel-flat">
		<div class="panel-heading">
            <div class="form-group text-left">	
                    <a href="<?php echo base_url();?>pengukuhankh/print" class="btn btn-default" id="cetak"
                        target="_blank">
                        <i class="icon-printer2"></i>Cetak</a>
            </div>
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
			<table class="table datatable-basic table-hover table-bordered striped" id="table-pengukuhan">
				<thead>
					<tr class="bg-teal-400">
						<th>Nama Kawasan</th>
                        <th>SK Penunjukan</th>
                        <th>Tanggal</th>
						<th>Wilayah</th>
						<th>Luas (Ha)</th>
                        <th>SK Penetapan</th>
					</tr>
				</thead>
                <tbody>
                    <?php foreach($data as $data): ?>
                    <tr>
                        <td><?=$data->nama?></td>
                        <td><?=$data->sk_penunjukan?></td>
                        <td><?=$data->tgl_penunjukan?></td>
                        <td><?=$data->wilayah?></td>
                        <td><?=$data->luas_darat + $data->luas_laut?></td>
                        <td><?=$data->sk_penetapan?></td>
                    </tr>
                    <?php endforeach; ?>
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
	var table;
	$(function () {
		var baseurl = "<?php echo base_url();?>";
		// table = $('#table-pengukuhan').DataTable({
		// 	autoWidth: false,
		// 	serverSide: true,
		// 	processing: true,
		// 	bFilter: false,
		// 	bInfo: false,
		// 	bLengthChange: false,
		// 	ajax: {
		// 		data: function (d) {
		// 			d.tahun = $('#tahun').val()
		// 		},
		// 		url: baseurl + 'Pengukuhankh/getdatarekap'
		// 	},
		// 	columns: [{
		// 			data: "namakawasan"
		// 		},
		// 		{
		// 			data: "penunjukan"
		// 		},
		// 		{
		// 			data: "tanggal"
        //         },
        //         {
		// 			data: "wilayah"
        //         },
        //         {
		// 			data: "luas"
		// 		},
		// 		{
		// 			data: "penetapan"
		// 		}
		// 	],
		// 	order: []
		// });

		$('body').on('click', ".submit", function () {
			var id = $("#data-id").val();
			var requestBody = {
				"id": $('#data-id').val()
			};
			$.ajax({
				url: baseurl + 'Pengukuhankh/delete/' + id,
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

		$('#tahun').change(function () {
			var tahun = $(this).val();
			table.ajax.reload();
		});

	});

	function deleteData($id) {
		$('#modal-delete').modal('show');
		$("#data-id").val($id);
		return true;
	}

</script>
