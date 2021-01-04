
<div class="form-group text-left">				
	<div class="col-lg-12">
		<a href="<?php echo base_url();?>Report/lapjeniskelamin/<?php echo $kab; ?>/0/<?php echo $cdk; ?>" class="btn btn-default" id="cetak"
			target="_blank">
			<i class="icon-printer2"></i>Cetak</a>            	
	</div>
</div>

<table class="table datatable table-bordered table-striped" id="table-rekap">
	<thead>
		<tr class="bg-success-300">
			<th>Kode</th>
			<th>Nama <?php echo $kab==0 ? "Kabupaten" : "Kecamatan"; ?></th>
			<th>Laki-Laki</th>
			<th>Perempuan</th>
		</tr>
	</thead>					
	<tbody>
		<?php 
		   foreach ($data as $key => $value) { ?>
		   	<tr>
		   		<td><?php echo $value->kode?></td>
		   		<td><?php echo $value->nama?></td>
		   		<td><?php echo ($value->asn_laki+$value->pksm_laki); ?> </td>
		   		<td><?php echo ($value->asn_perempuan+$value->pksm_perempuan); ?></td>
		   	</tr>
		<?php   }
		?>
	</tbody>
</table>