<table>
	<tr>
		<td>
			<?php 
				$subj = "";
		        if ($status==1){
		        	$subj="Surat Masuk";
		        }else if ($status==2){
		        	$subj="Disposisi Surat";
		        }
		        echo $subj;
			?>
		</td>
	</tr>

	<tr>
		<td>Asal Surat</td>
		<td>: </td>
		<td><?php echo $data[0]->dari;?></td>
	</tr>
	<tr>
		<td>Nomor</td>
		<td>: </td>
		<td><?php echo $data[0]->no_surat;?></td>
	</tr>
	<tr>
		<td>Tanggal Surat</td>
		<td>: </td>
		<td><?php echo $data[0]->tgl_surat;?></td>
	</tr>
	<tr>
		<td>Perihal</td>
		<td>: </td>
		<td><?php echo $data[0]->perihal;?></td>
	</tr>

	<?php if($status==2){?>

	<tr>
		<td colspan="3"> <br>
			<table>
				<tr>
					<td><b>Disposisi :</b> </td>
				</tr>
				<tr>
					<td>Kepada</td>
					<td>:</td>
					<td><?php echo $disposisi[0]->namajab;?> ( <?php echo $disposisi[0]->nama;?> ) </td>
				</tr>
				<tr>
					<td>Catatan</td>
					<td>:</td>
					<td><?php echo $disposisi[0]->keterangan;?> </td>
				</tr>
			</table>
		</td>		
	</tr>
	<?php } ?>
</table>
<p>Untuk menindaklanjuti Surat ini, silahkan klik tombol <b>Tindak Lanjut</b> berikut :</p>
<span style="text-decoration: underline; font-size: 18px; line-height: 27px;">
	<strong>
		<?php if($status==2){?>
	    <a target="_new" class="mobile-button" style="display: inline-block;font-size: 12px;font-family: Helvetica, Arial, sans-serif;font-weight: bold;color: #ffffff;text-decoration: none;background-color: green;padding: 5px 20px;border-radius: 10px;-webkit-border-radius: 10px !important;-moz-border-radius: 10px !important;border-bottom: 3px solid #5f0109;" 
	    href="<?php echo base_url();?>suratmasuk/teruskan/<?php echo $data[0]->id;?>">Tindak Lanjut</a>
	    <a target="_new" class="mobile-button" style="display: inline-block;font-size: 12px;font-family: Helvetica, Arial, sans-serif;font-weight: bold;color: #ffffff;text-decoration: none;background-color: red;padding: 5px 20px;border-radius: 10px;-webkit-border-radius: 10px !important;-moz-border-radius: 10px !important;border-bottom: 3px solid #5f0109;" 
	    href="<?php echo base_url();?>report/disposisi/<?php echo $data[0]->id;?>">Kartu Disposisi</a>
	    <?php }else  ?>
	    <?php if($status==1){?>
	    <a target="_new" class="mobile-button" style="display: inline-block;font-size: 12px;font-family: Helvetica, Arial, sans-serif;font-weight: bold;color: #ffffff;text-decoration: none;background-color: green;padding: 5px 20px;border-radius: 10px;-webkit-border-radius: 10px !important;-moz-border-radius: 10px !important;border-bottom: 3px solid #5f0109;" 
	    href="<?php echo base_url();?>suratmasuk/disposisi/<?php echo $data[0]->id;?>">Disposisi</a>
	    <?php } ?>
	</strong>
</span>