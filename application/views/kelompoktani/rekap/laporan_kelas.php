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
			<th style="text-align: center; width:5px">No.</th>
			<th style="text-align: center;">Nama <?php echo $kab==0 ? "Kabupaten" : ($kec==0 ? "Kecamatan" : "Desa"); ?></th>
			<th style="text-align: center;">Pemula</th>
			<th style="text-align: center;">Madya</th>
			<th style="text-align: center;">Utama</th>
			<th style="text-align: center;">Jumlah</th>
		</tr>
	</thead>					
	<tbody>
		<?php
		   $totPemula = 0; $totMadya = 0;  $totUtama = 0;  $totJml = 0; $no =1; 
		   foreach ($data as $key => $value) { ?>
		   	<tr>
			    <td style="text-align: center;"><?=$no++?>.</td>
		   		<td><?php echo $value->nama?></td>
		   		<td style="text-align: right;"><?php echo number_format($value->jml_pemula,0,'.','.')?></td>
		   		<td style="text-align: right;"><?php echo number_format($value->jml_madya,0,'.','.')?></td>
		   		<td style="text-align: right;"><?php echo number_format($value->jml_utama,0,'.','.')?></td>
		   		<td style="text-align: right;"><?php echo number_format($value->jml,0,'.','.');?></td>
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
			<th style="text-align: right;"><?php echo number_format($totPemula,0,'.','.');?></th>
			<th style="text-align: right;"><?php echo number_format($totMadya,0,'.','.');?></th>
			<th style="text-align: right;"><?php echo number_format($totUtama,0,'.','.');?></th>
			<th style="text-align: right;"><?php echo number_format($totJml,0,'.','.');?></th>
		</tr>
	</tfoot>
</table>