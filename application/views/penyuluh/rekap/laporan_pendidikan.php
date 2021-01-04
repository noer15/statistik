<div class="form-group text-left">				
	<div class="col-lg-12">
		<a href="<?php echo base_url();?>Report/lappendidikan/<?php echo $kab; ?>/0/<?php echo $cdk; ?>" class="btn btn-default" id="cetak"
			target="_blank">
			<i class="icon-printer2"></i>Cetak</a>            	
	</div>
</div>

<table class="table table-bordered table-striped" id="table-rekap" width="100%">
	<thead>
		<tr class="bg-success-300">
			<th rowspan="2">Kode</th>
			<th rowspan="2">Nama <?php echo $kab==0 ? "Kabupaten" : "Kecamatan"; ?></th>
			<th colspan="4" style="text-align: center;">ASN</th>
			<th colspan="4" style="text-align: center;">PKSM</th>
		</tr>
		<tr class="bg-success-300">
			<th>SMA</th>
			<th>S1</th>
			<th>S2</th>
			<th>S3</th>

			<th>SMA</th>
			<th>S1</th>
			<th>S2</th>
			<th>S3</th>

		</tr>
	</thead>			
	<tbody>
		<?php 
		   foreach ($data as $key => $value) { ?>
		   	<tr>
		   		<td><?php echo $value->kode?></td>
		   		<td><?php echo $value->nama?></td>
		   		<td><?php echo $value->jml_asn_sma; ?></td>
		   		<td><?php echo $value->jml_asn_s1; ?></td>
		   		<td><?php echo $value->jml_asn_s2; ?></td>
		   		<td><?php echo $value->jml_asn_s3; ?></td>

		   		<td><?php echo $value->jml_pksm_sma;?></td>
		   		<td><?php echo $value->jml_pksm_s1;?></td>
		   		<td><?php echo $value->jml_pksm_s2;?></td>
		   		<td><?php echo $value->jml_pksm_s3;?></td>
		   	</tr>
		<?php   }
		?>
	</tbody>		
</table>