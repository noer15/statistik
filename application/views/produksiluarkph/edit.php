<!-- Theme JS files -->

<script type="text/javascript"
	src="<?php echo base_url();?>assets/limitless/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript"
	src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>

<script type="text/javascript">
	$(function () {
		var baseurl = "<?php echo base_url();?>"
		$('#potensi').change(function () {
			var potensi = $(this).val();
			$("#jenis").empty();
			$.ajax({
				url: baseurl + '/Potensi/getJenis/' + potensi,
				type: 'GET',
				contentType: 'application/json',
				success: function (resp) {
					var dataArray = JSON.parse(resp);             
					for (var i in dataArray) {
						$('#jenis').append($("<option></option>")
							.attr("value", dataArray[i].id)
							.text(dataArray[i].nama));
					}
				},
			});
        });
        $('#kab').change(function(){
            var kab = $(this).val();
            $("#kec").empty();                        
            $.ajax({                            
                url: baseurl+'/Produksiluarkph/getKec/'+kab,
                type:'GET',
                contentType: 'application/json',
                success: function (resp) {   
                    $('#kec').html('<option value="0"> Pilih Kecamatan</option>');        
                    var dataArray = JSON.parse(resp);            
                    for (var i in dataArray) {
                        $('#kec').append($("<option></option>")
                            .attr("value",dataArray[i].kode)
                            .text(dataArray[i].nama));
                    }
                },
            });  
        })

        $('#kec').change(function(){
            var kab = $(this).val();
            $("#desa").empty();                        
            $.ajax({                            
                url: baseurl+'/Produksiluarkph/getDesa/'+kab,
                type:'GET',
                contentType: 'application/json',
                success: function (resp) {   
                    $('#desa').html('<option value="0"> Pilih Desa</option>');        
                    var dataArray = JSON.parse(resp);            
                    for (var i in dataArray) {
                        $('#desa').append($("<option></option>")
                            .attr("value",dataArray[i].id)
                            .text(dataArray[i].nama));
                    }
                },
            });  
        })
	});

</script>

<!-- /theme JS files -->

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- Basic layout-->
			<form action="<?php echo base_url();?>Produksiluarkph/update" class="form-horizontal" method="post">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?php echo $header;?></h5>
						<div class="heading-elements">
							<ul class="icons-list">
								<li><a data-action="collapse"></a></li>
								<li><a data-action="reload"></a></li>
								<li><a data-action="close"></a></li>
							</ul>
						</div>
					</div>
					<div class="panel-body">

						<input type="hidden" name="id" value="<?php echo $data[0]->id;?>">

						<div class="form-group">
							<label class="col-lg-2 control-label">Kabupaten</label>
							<div class="col-lg-10">
								<select name="kab" id="kab" class="form-control" required
									data-placeholder="Pilih Kabupaten">
									<option value="0">Pilih Kabupaten</option>
									<?php foreach ($this->db->get('m_kabupaten')->result() as $key => $value) { ?>
									<option value="<?php echo $value->kode?>" <?= $value->id == $data[0]->kab_id ? 'selected' : '' ?>>
										<?php echo $value->nama?>
									</option>
									<?php }  ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Kecamatan</label>
							<div class="col-lg-10">
								<select name="kec" id="kec" class="form-control" required
									data-placeholder="Pilih Kecamatan">
									<option value="0"> Pilih Kecamatan</option>
                                    <?php foreach ($this->db->get('m_kecamatan')->result() as $key => $value) { ?>
									<option value="<?php echo $value->kode?>" <?= $value->id == $data[0]->kec_id ? 'selected' : '' ?>>
										<?php echo $value->nama?>
									</option>
									<?php }  ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Desa</label>
							<div class="col-lg-10">
								<select name="desa" id="desa" class="form-control" required
									data-placeholder="Pilih Desa">
									<option value="0"> Pilih Desa</option>
                                    <?php foreach ($this->db->get('m_desa')->result() as $key => $value) { ?>
									<option value="<?php echo $value->kode?>" <?= $value->id == $data[0]->desa_id ? 'selected' : '' ?>>
										<?php echo $value->nama?>
									</option>
									<?php }  ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Potensi</label>
							<div class="col-lg-10">
								<select name="potensi" id="potensi" class="form-control" required
									data-placeholder="Pilih Potensi">
									<option value="2" <?php if($potensi==2) {echo "selected";} ?>>Non Kayu</option>
									<option value="1" <?php if($potensi==1) {echo "selected";} ?>>Kayu</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jenis Produksi</label>
							<div class="col-lg-10">
								<select name="jenis" id="jenis" class="form-control" required
									data-placeholder="Pilih Jenis Potensi">
									<?php foreach ($jenis as $key => $value) { ?>
									<option value="<?php echo $value->id?>"
										<?php if($data[0]->jenis_potensi_id==$value->id){ echo "selected"; } ?>>
										<?php echo $value->nama?>
									</option>
									<?php }  ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Jml Produksi</label>
							<div class="col-lg-10">
								<input type="number" class="form-control" placeholder="jml_produksi" name="jml_produksi"
									value="<?php echo $data[0]->jml_produksi;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Satuan</label>
							<div class="col-lg-10">
								<select name="satuan" id="" class="form-control">
									<?php foreach($this->db->get('m_satuan')->result() as $satuan): ?>
									<option value="<?=$satuan->nama?>"
										<?= $satuan->nama == $data[0]->satuan ? 'selected' : ''?>><?=$satuan->nama?>
									</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div id="vtahun">
								<label for="" class="col-lg-2 control-label">Tahun</label>
								<div class="col-lg-4">
									<select name="tahun" id="tahun" class="form-control">
										<option value="2020" <?= $data[0]->tahun == '2020' ? 'selected' : ''?>>2020
										</option>
										<option value="2021" <?= $data[0]->tahun == '2021' ? 'selected' : ''?>>2021
										</option>
										<option value="2022" <?= $data[0]->tahun == '2022' ? 'selected' : ''?>>2022
										</option>
										<option value="2023" <?= $data[0]->tahun == '2023' ? 'selected' : ''?>>2023
										</option>
										<option value="2024" <?= $data[0]->tahun == '2024' ? 'selected' : ''?>>2024
										</option>
										<option value="2025" <?= $data[0]->tahun == '2025' ? 'selected' : ''?>>2025
										</option>
									</select>
								</div>
							</div>
							<div id="vbulan" <?= $data[0]->tahun == '2020' ? 'style="display:none"' : ''?>>
								<label for="" class="col-lg-2 control-label">Bulan</label>
								<div class="col-lg-4">
									<input type="hidden" name="bulan" id="bulanValue" value="<?=$data[0]->bulan?>">
									<select id="bulan" class="form-control">
										<option value="01" <?= $data[0]->bulan == '01' ? 'selected' : ''?>>January
										</option>
										<option value="02" <?= $data[0]->bulan == '02' ? 'selected' : ''?>>Februari
										</option>
										<option value="03" <?= $data[0]->bulan == '03' ? 'selected' : ''?>>Maret
										</option>
										<option value="04" <?= $data[0]->bulan == '04' ? 'selected' : ''?>>April
										</option>
										<option value="05" <?= $data[0]->bulan == '05' ? 'selected' : ''?>>Mei</option>
										<option value="06" <?= $data[0]->bulan == '06' ? 'selected' : ''?>>Juni</option>
										<option value="07" <?= $data[0]->bulan == '07' ? 'selected' : ''?>>Juli</option>
										<option value="08" <?= $data[0]->bulan == '08' ? 'selected' : ''?>>Agustus
										</option>
										<option value="09" <?= $data[0]->bulan == '09' ? 'selected' : ''?>>September
										</option>
										<option value="10" <?= $data[0]->bulan == '10' ? 'selected' : ''?>>Oktober
										</option>
										<option value="11" <?= $data[0]->bulan == '11' ? 'selected' : ''?>>November
										</option>
										<option value="12" <?= $data[0]->bulan == '12' ? 'selected' : ''?>>Desember
										</option>
									</select>
								</div>
							</div>
							<script>
								$('#tahun').change(function () {
									let thn = $(this).val();
									if (thn == '2020') {
										$('#vbulan').hide();
										$('#bulanValue').val("");
									} else {
										$('#vbulan').show();
										$('#bulanValue').val($('#bulan').val());
									}
								});

								$('#bulan').change(function () {
									let bln = $(this).val();
									$('#bulanValue').val(bln);
								})

							</script>
						</div>
						<div class="text-left">
							<a href="<?php echo base_url();?>Produksiluarkph" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</form>
			<!-- /basic layout -->
		</div>
	</div>
</div>
