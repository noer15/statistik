<div class="form-group text-left">				
	<div class="col-lg-12">
		<a href="<?php echo base_url();?>Report/lapjabatan/<?php echo $kab; ?>/0/<?php echo $cdk; ?>" class="btn btn-default" id="cetak"
			target="_blank">
			<i class="icon-printer2"></i>Cetak</a>            	
	</div>
</div>

<table class="table datatable table-bordered table-striped" id="table-rekap">
	<thead>
		<tr class="bg-success-300">
			<th rowspan="2">Kode</th>
			<th rowspan="2">Nama <?php echo $kab==0 ? "Kabupaten" : "Kecamatan"; ?></th>
			<th colspan="7" style="text-align: center;">Penyuluh</th>			
		</tr>
		<tr class="bg-success-300">
			<th>Madya</th>
			<th>Mahir</th>
			<th>Muda</th>
			<th>Pelaksana</th>
			<th>Pelaksana Lanjutan</th>
			<th>Penyelia</th>
			<th>Pertama</th>
		</tr>
	</thead>					
	<tbody>
		<?php 
		   foreach ($data as $key => $value) { ?>
		   	<tr>
		   		<td><?php echo $value->kode?></td>
		   		<td><?php echo $value->nama?></td>
		   		<td><?php echo ($value->asn_madya+$value->pksm_madya); ?></td>
		   		<td><?php echo ($value->asn_mahir+$value->pksm_mahir); ?></td>
		   		<td><?php echo ($value->asn_muda+$value->pksm_muda); ?></td>
		   		<td><?php echo ($value->asn_pelaksana+$value->pksm_pelaksana); ?></td>
		   		<td><?php echo ($value->asn_pelaksana_lanjut+$value->pksm_pelaksana_lanjut); ?></td>
		   		<td><?php echo ($value->asn_penyelia+$value->pksm_penyelia); ?></td>
		   		<td><?php echo ($value->asn_pertama+$value->pksm_pertama); ?></td>
		   		
		   	</tr>
		<?php   }
		?>
	</tbody>
</table>