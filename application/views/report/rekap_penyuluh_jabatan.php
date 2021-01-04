<!DOCTYPE html>
<html>
<head>
  <title>Rekap Penyuluh</title> 
  <link href="<?php echo base_url();?>assets/limitless/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">

</head>
<style type="text/css">
.html { 
	margin-top: 10px;
    margin-bottom: 20px;
    margin-right: 20px;
    margin-left: 20px;
 }

</style>

<body>

<table width="100%" border="0" style="font-size: 10pt;">
	<tr>
		<td>
			
	
	
	<div align="center">
	  <br>
	  <strong>REKAP DATA PENYULUH BERDASARKAN JABATAN</strong><br>	  
	  <br>
	</div>
	
	<div align="center">
	<div class="row">
	<div class="col-md-12">
		<?php if(isset($kab[0]->nama)){ ?>
		<table width="100%">
		 <tr>
			<td width="20%" valign="top">Kabupaten</td>
			<td width="3%" valign="top">:</td>
			<td width="82%" valign="top"><?php echo $kab[0]->nama;?></td>
		 </tr>			 
		 <?php if(isset($kec[0]->nama)){ ?>
		 <tr>
			<td width="20%" valign="top">Kecamatan</td>
			<td width="3%" valign="top">:</td>
			<td width="82%" valign="top">
			 <?php echo $kec[0]->nama;?>
			</td>			
		 </tr>
		<?php } ?>
		 <tr>
			<td colspan="3">&nbsp;</td>						
		 </tr>		 
		</table>	
		<?php }else{ echo"<br>"; }?>
	</div>
	</div>
	</div>	
	
	<div align="center">
		<div class="row">
	 	<table border="1" style="table-layout:fixed; width:100%;border-collapse: collapse;">
	 		<tr>
	 			<td rowspan="2" style="width: 5%;text-align: center;"><b>No</b></td>
	 			<td rowspan="2" style="width: 10%;text-align: center;"><b>Kode</b></td>
	 			<td rowspan="2" style="text-align: center;"><b>Nama <?php echo isset($kab[0]->nama) ? " Kecamatan ": "Kabupaten"; ?> </b></td>
	 			<td colspan="7" style="width: 55%;text-align: center;"><b>Jabatan Penyuluh</b></td>
	 		</tr>
	 		<tr>
				<td style="text-align: center;">Madya</td>
				<td style="text-align: center;">Mahir</td>
				<td style="text-align: center;">Muda</td>
				<td style="text-align: center;">Pelaksana</td>
				<td style="text-align: center;" >Lanjutan</td>
				<td style="text-align: center;">Penyelia</td>
				<td style="text-align: center;">Pertama</td>
			</tr>

	 		<?php
	 		  foreach ($data as $key => $value) { ?>
	 		  	<tr>
	 		  		<td align="center"><?php echo $key+1?></td>
	 		  		<td align="center"><?php echo $value->kode; ?></td>
	 		  		<td><?php echo $value->nama; ?></td>
	 		  		<td align="center"><?php echo ($value->asn_madya + $value->pksm_madya ); ?></td>
	 		  		<td align="center"><?php echo ($value->asn_mahir+$value->pksm_mahir); ?></td>
	 		  		<td align="center"><?php echo ($value->asn_muda+$value->pksm_muda); ?></td>
	 		  		<td align="center"><?php echo ($value->asn_pelaksana+$value->pksm_pelaksana); ?></td>
	 		  		<td align="center"><?php echo ($value->asn_pelaksana_lanjut+$value->pksm_pelaksana_lanjut); ?></td>	 		  		
	 		  		<td align="center"><?php echo ($value->asn_penyelia+$value->pksm_penyelia); ?></td>
	 		  		<td align="center"><?php echo ($value->asn_pertama+$value->pksm_pertama); ?></td>
	 		  	</tr>
	 		 <?php } ?>
	 	</table>
		</div>		
	</div>

		</td>
	</tr>
</table>

    
	
	
</body>
</html>