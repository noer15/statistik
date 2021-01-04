<!DOCTYPE html>
<html>
<head>
  <title>Disposisi</title> 
  <link href="<?php echo base_url();?>assets/limitless/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">

</head>

<style type="text/css">
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: white;
    color: white;
    text-align: left;
}
html { 
	margin-top: 10px;
    margin-bottom: 10px;
    margin-right: 10px;
    margin-left: 10px;
 }

</style>

<body>

<table width="100%" border="0" style="font-size: 10pt;">
	<tr>
		<td >
			<table border="0" width="90%" style="border-collapse: collapse;font-size: 11pt;">
				<tr>
					<td style="width:100px;text-align: center;">
						<img src="<?php echo $logo;?>" width="60%">
						<br>
					</td>
				
					<td style="text-align: center;font-weight: bold;">
						Pemerintah Provinsi Jawa Barat<br/>
						Dinas Kehutanan Provinsi Jawa Barat<br/>
						Cabang Dinas Kehutanan Wilayah IV
					</td>
				</tr>
				
			</table>
			<hr>
		</td>
	</tr>
	<tr>
		<td>
			
	
	
	<div align="center">
	  <br>
	  <strong>KARTU DISPOSISI</strong><br>	  
	  <br>
	</div>
	
	<div align="center">
	<div class="row">
	<div class="col-md-12">
		<table width="100%">
		 <tr>
			<td width="20%" valign="top">No Induk</td>
			<td width="3%" valign="top">:</td>
			<td width="82%" valign="top"><?php echo $data[0]->id;?></td> 						
		 </tr>			 
		 <tr>
			<td width="20%" valign="top">Tanggal Terima</td>
			<td width="3%" valign="top">:</td>
			<td width="82%" valign="top" align="justify">
			 <?php 
			 	$date = date_create($data[0]->tgl_terima);
			 	echo date_format($date,"d/m/Y");
			 ?>			 
			</td> 						
		 </tr>
		 <tr>
			<td width="20%" valign="top">Asal Surat</td>
			<td width="3%" valign="top">:</td>
			<td width="82%" valign="top">
			 <?php echo $data[0]->dari;?>
			</td>			
		 </tr>
		 <tr>
			<td width="15%" valign="top">Nomor</td>
			<td width="3%" valign="top">:</td>
			<td width="82%" valign="top">
			 <?php echo $data[0]->no_surat;?>
			</td>			
		 </tr>
		 <tr>
			<td width="15%" valign="top">Hal</td>
			<td width="3%" valign="top">:</td>
			<td width="82%" valign="top">
			 <?php echo $data[0]->perihal;?>
			</td>			
		 </tr>
		 <tr>
			<td colspan="3">&nbsp;</td>						
		 </tr>
		 
		</table>	
	</div>
	</div>
	</div>	
	
	<div align="center">
		<div class="row">
	 	<table border="1" style="table-layout:fixed; width:100%;border-collapse: collapse;">
	 		<tr>
	 			<td>
	 				<b>Disposisi Kepada :</b> <br>
	 				
	 				<table border="0" width="95%" style="border-collapse: collapse;">
	 					<tr>
	 						<td width="90%">1. Kasubag TU</td>
	 						<td valign="center">
	 							<table width="85%" style="border-collapse: collapse;border:1px solid;">
	 								<tr><td>
	 									<?php if($disposisi[0]->disposisi_ke==2){?>
	 									<i class="icon-check2"></i>
	 									<?php }else{ echo "&nbsp;"; }?>
	 									</td>
	 								</tr>
	 							</table>	 							
	 						</td>
	 					</tr>
	 					<tr>
	 						<td>2. Kasi PSDH</td>
	 						<td>
	 							<table width="85%" heigth="80%" style="border-collapse: collapse;border:1px solid;">
	 								<tr><td>
	 									<?php if($disposisi[0]->disposisi_ke==3){?>
	 									<i class="icon-check2"></i>
	 									<?php }else{ echo "&nbsp;"; }?>
	 								</td></tr>
	 							</table>
	 						</td>
	 					</tr>
	 					<tr>
	 						<td>3. Kasi PDAS PM</td>
	 						<td>
	 							<table width="85%" heigth="80%" style="border-collapse: collapse;border:1px solid;">
	 								<tr><td>
	 								<?php if($disposisi[0]->disposisi_ke==4){?>
	 									<i class="icon-check2"></i>
	 									<?php }else{ echo "&nbsp;"; }?>
	 								</td></tr>
	 							</table>
	 						</td>
	 					</tr>
	 					<tr>
	 						<td>4. Koordinator KBB</td>
	 						<td>
	 							<table width="85%" heigth="80%" style="border-collapse: collapse;border:1px solid;">
	 								<tr><td>
	 								<?php if($disposisi[0]->disposisi_ke==6){?>
	 									<i class="icon-check2"></i>
	 									<?php }else{ echo "&nbsp;"; }?>
	 								</td></tr>
	 							</table>
	 						</td>
	 					</tr>
	 					<tr>
	 						<td>5. Koordinator Penyuluh</td>
	 						<td>
	 							<table width="85%" heigth="80%" style="border-collapse: collapse;border:1px solid;">
	 								<tr><td>
	 								<?php if($disposisi[0]->disposisi_ke==5){?>
	 									<i class="icon-check2"></i>
	 									<?php }else{ echo "&nbsp;"; }?>
	 								</td></tr>
	 							</table>
	 						</td>
	 					</tr>
	 					<tr>
	 						<td height="250px" colspan="2" 
	 							valign="top" wrap><br>Catatan : <br>
	 							<?php echo $disposisi[0]->keterangan;?>
	 						</td>
	 					</tr>
	 				</table>
	 				
	 			</td>
	 			<td valign="top" >
	 				<b>Diteruskan / Proses : </b>
	 				<table>
	 					<tr>
	 						<td>Yth</td>
	 						<td>: <?php echo $disposisi[0]->tindaklanjut_ke;?> </td>
	 					</tr>
	 					<tr>
	 						<td>Catatan</td>
	 						<td>: </td>
	 					</tr>
	 					<tr>
	 						<td colspan="2"><?php echo $disposisi[0]->tindaklanjut_catatan;?></td>	 						
	 					</tr>
	 				</table>
	 			</td>
	 		</tr>
	 	</table>  				
		</div>		
	</div>

		</td>
	</tr>
</table>

    
	
	
</body>
</html>