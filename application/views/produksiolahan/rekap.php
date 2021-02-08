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
				<form action="<?php echo base_url();?>produksiolahan/print" method="POST" target="_blank">
				<div class="col-lg-1">
					<div class="form-group text-left">	
						<button type="submit" class="btn btn-default" id="cetak"><i class="icon-printer2"></i> Cetak</button>
					</div>
				</div>
				<div class="col-lg-3">
					<div id="vtahun">
						<select name="tahun" id="tahun" class="form-control" aria-placeholder="Pilih Tahun"
							onchange="window.location = '<?php echo base_url();?>produksiolahan/rekap/'+$(this).val()+'/'+$('#bulan').val()">
							<option value="0">< Semua Tahun ></option>
							<option value="2017" <?= $tahun == '2017' ? 'selected' : ''?>>2017</option>
							<option value="2018" <?= $tahun == '2018' ? 'selected' : ''?>>2018</option>
							<option value="2019" <?= $tahun == '2019' ? 'selected' : ''?>>2019</option>
							<option value="2020" <?= $tahun == '2020' ? 'selected' : ''?>>2020</option>
							<option value="2021" <?= $tahun == '2021' ? 'selected' : ''?>>2021</option>
							<option value="2022" <?= $tahun == '2022' ? 'selected' : ''?>>2022</option>
							<option value="2023" <?= $tahun == '2023' ? 'selected' : ''?>>2023</option>
							<option value="2024" <?= $tahun == '2024' ? 'selected' : ''?>>2024</option>
							<option value="2025" <?= $tahun == '2025' ? 'selected' : ''?>>2025</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3">
					<div id="vbulan">
						<input type="hidden" name="bulan" id="bulanValue" value="01" aria-placeholder="Pilih Bulan">
						<select id="bulan" class="form-control" onchange="window.location = '<?php echo base_url();?>produksiolahan/rekap/'+$('#tahun').val()+'/'+$(this).val()">
							<option value="0">< Pilih Bulan ></option>
							<option value="01" <?= $bulan == '01' ? 'selected' : ''?> >January</option>
							<option value="02" <?= $bulan == '02' ? 'selected' : ''?>>Februari</option>
							<option value="03" <?= $bulan == '03' ? 'selected' : ''?>>Maret</option>
							<option value="04" <?= $bulan == '04' ? 'selected' : ''?>>April</option>
							<option value="05" <?= $bulan == '05' ? 'selected' : ''?>>Mei</option>
							<option value="06" <?= $bulan == '06' ? 'selected' : ''?>>Juni</option>
							<option value="07" <?= $bulan == '07' ? 'selected' : ''?>>Juli</option>
							<option value="08" <?= $bulan == '08' ? 'selected' : ''?>>Agustus</option>
							<option value="09" <?= $bulan == '09' ? 'selected' : ''?>>September</option>
							<option value="10" <?= $bulan == '10' ? 'selected' : ''?>>Oktober</option>
							<option value="11" <?= $bulan == '11' ? 'selected' : ''?>>November</option>
							<option value="12" <?= $bulan == '12' ? 'selected' : ''?>>Desember</option>
						</select>
					</div>
					<script>
						$('#tahun').change(function(){
							let thn = $(this).val();
							if(thn == '2020'){
								$('#vbulan').hide();
								$('#bulanValue').val("");
							}else{
								$('#vbulan').show();
								$('#bulanValue').val($('#bulan').val());
							}
						});

						$('#bulan').change(function(){
							let bln = $(this).val();
							$('#bulanValue').val(bln);
						})
					</script>
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
						<th>Industri</th>
                        <th>Hasil Olahan</th>
                        <th>Jumlah</th>
						<th>Bulan</th>
						<th>Tahun</th>
					</tr>
				</thead>
                <tbody>
                    <?php $jumlah = 0; $no=1; foreach($data as $data): ?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$data->industri?></td>
                        <td><?=$data->olahan?></td>
                        <td><?=number_format($data->jumlah,0,'.','.')?></td>
						<td><?=$data->bulan?></td>
						<td><?=$data->tahun?></td>
                    </tr>
                    <?php $jumlah += $data->jumlah;  $no++; endforeach; ?>
                    <tr>
                        <td colspan="3">Jumlah</td>
                        <td colspan="3"><?=number_format($jumlah,0,'.','.')?></td>
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
