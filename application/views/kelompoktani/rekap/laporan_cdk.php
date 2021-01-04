<div class="form-group text-left">				
	<div class="col-lg-12">
		<a href="<?php echo base_url();?>Report/lapkelompokcdk" class="btn btn-default" id="cetak"
			target="_blank">
			<i class="icon-printer2"></i>Cetak</a>            	
	</div>
</div>

<table class="table datatable table-bordered table-striped" id="table-rekap">
	<thead>
		<tr class="bg-success-300">
			<th>No</th>
			<th>Nama CDK</th>
			<th>Jumlah</th>
			<!-- <th>PKSM</th> -->
		</tr>			
	</thead>					
	<tbody>
		<?php 
		   foreach ($data as $key => $value) { ?>
		   	<tr>
		   		<td><?php echo $key+1; ?></td>
		   		<td><?php echo $value->nama?></td>
		   		<td><?php echo $value->asn?></td>
		   	</tr>
		<?php   }
		?>
	</tbody>
</table>