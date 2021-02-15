<!-- Theme JS files -->
<!-- <script type="text/javascript"
	src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/datatables.min.js"></script> -->
<script type="text/javascript"
	src="<?php echo base_url();?>assets/limitless/assets/js/plugins/tables/datatables/extensions/responsive.min.js">
</script>
<script type="text/javascript"
	src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>


<div class="content">
	<!-- Basic datatable -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<div class="row">
				<form action="<?php echo base_url();?>Produksikph/print" method="POST" target="_blank">
					<div class="col-lg-3">
						<div class="form-group text-left">	
							<select name="jenis" id="" class="form-control">
								<option value="1">Jenis Produksi</option>
								<option value="1">Kayu</option>
								<option value="2">Bukan Kayu</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group text-left">
							<select name="kertas" id="" class="form-control">
								<option value="potrait">Orientasi Kertas</option>
								<option value="potrait">Potrait</option>
								<option value="landscape">Landscape</option>
							</select>
						</div>
					</div>
					<div class="col-lg-1">
						<div class="form-group text-left">	
							<button type="submit" class="btn btn-default" id="cetak"><i class="icon-printer2"></i> Cetak</button>
						</div>
					</div>
				</form>
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
                        <th>No</th>
						<th>KPH</th>
                        <th>Jumlah Produksi</th>
						<th>Luas Produksi/Jumlah Budidaya</th>
					</tr>
				</thead>
                <tbody>
                    <?php $jumlah = 0; $luas = 0; $no=1; foreach($data as $data): ?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$data->nama?></td>
                        <td style="text-align:right"><?=number_format($data->jumlah_produksi,0,',','.')?></td>
                        <td style="text-align:right"><?=number_format($data->luas_produksi,0,',','.')?></td>
                    </tr>
                    <?php $jumlah += $data->jumlah_produksi; $luas += $data->luas_produksi; $no++; endforeach; ?>
                    <tr>
                        <td colspan="2">Jumlah</td>
                        <td style="text-align:right"><?=number_format($jumlah,0,',','.')?></td>
						<td style="text-align:right"><?=number_format($luas,0,',','.')?></td>
                    </tr>
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
				},
				success: function (resp) {
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
