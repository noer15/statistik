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
	  <strong>REKAP DATA PENYULUH BERDASARKAN STATUS</strong><br>	  
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
	 			<td style="width: 5%;text-align: center;"><b>No</b></td>
	 			<td style="width: 15%;text-align: center;"><b>Kode</b></td>
	 			<td style="width: 60%;text-align: center;"><b>Nama <?php echo isset($kab[0]->nama) ? " Kecamatan ": "Kabupaten"; ?> </b></td>
	 			<td style="width: 20%;text-align: center;"><b>ASN</b></td>
	 			<td style="width: 20%;text-align: center;"><b>PKSM</b></td>
	 		</tr>
	 		<?php
	 		  foreach ($data as $key => $value) { ?>
	 		  	<tr>
	 		  		<td align="center"><?php echo $key+1?></td>
	 		  		<td align="center"><?php echo $value->kode; ?></td>
	 		  		<td><?php echo $value->nama; ?></td>
	 		  		<td align="center"><?php echo $value->jml_asn; ?></td>
	 		  		<td align="center"><?php echo $value->jml_pksm; ?></td>
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