<div class="form-group text-left">				
	<div class="col-lg-12">
		<a href="<?php echo base_url();?>Report/lapkelas/<?php echo $kab; ?>/<?php echo $kec; ?>/<?php echo $cdk; ?>" class="btn btn-default" id="cetak"
			target="_blank">
			<i class="icon-printer2"></i>Cetak</a>            	
	</div>
</div>

<table class="table datatable table-bordered table-striped" id="table-rekap">
	<thead>
		<tr class="bg-success-300">
			<th>Kode</th>
			<th>Nama  <?php echo $kab==0 ? "Kabupaten" : ($kec==0 ? "Kecamatan" : "Desa"); ?></th>
			<th>Pemula</th>
			<th>Madya</th>
			<th>Utama</th>
			<th>Jumlah</th>
		</tr>
	</thead>					
	<tbody>
		<?php
		   $totPemula = 0; $totMadya = 0;  $totUtama = 0;  $totJml = 0; 
		   foreach ($data as $key => $value) { ?>
		   	<tr>
		   		<td><?php echo $value->kode?></td>
		   		<td><?php echo $value->nama?></td>
		   		<td><?php echo $value->jml_pemula?></td>
		   		<td><?php echo $value->jml_madya?></td>
		   		<td><?php echo $value->jml_utama?></td>
		   		<td><?php echo $value->jml;?></td>
		   	</tr>
		<?php 

		  $totPemula = $totPemula  + $value->jml_pemula;
		  $totMadya = $totMadya  + $value->jml_madya;
		  $totUtama = $totUtama  + $value->jml_utama;
		  $totJml = $totJml  + $value->jml;

			}
		?>
	</tbody>
	<tfoot>
		<tr class="bg-grey-300">
			<th colspan="2" style="text-align: center;">Jumlah </th>			
			<th><?php echo $totPemula;?></th>
			<th><?php echo $totMadya;?></th>
			<th><?php echo $totUtama;?></th>
			<th><?php echo $totJml;?></th>
		</tr>
	</tfoot>
</table>