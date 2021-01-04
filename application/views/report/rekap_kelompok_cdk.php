<!DOCTYPE html>
<html>
<head>
  <title>Rekap Kelompok Tani</title> 
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
	  <strong>REKAP DATA KELOMPOK TANI <br> BERDASARKAN CDK </strong><br>	  
	  <br>
	</div>
	
	
	<div align="center">
		<div class="row">
	 	<table border="1" style="table-layout:fixed; width:100%;border-collapse: collapse;">
	 		<tr>
	 			<td style="width: 5%;text-align: center;"><b>No</b></td>
	 			<td style="width: 80%; text-align: center;"><b>Nama CDK</b></td>
	 			<td style="width: 15%;text-align: center;"><b>Jumlah</b></td>
	 		</tr>
	 		<?php
	 		  foreach ($data as $key => $value) { ?>
	 		  	<tr>
	 		  		<td align="center"><?php echo $key+1?></td>
	 		  		<td><?php echo $value->nama; ?></td>
	 		  		<td align="center"><?php echo $value->asn; ?></td>
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