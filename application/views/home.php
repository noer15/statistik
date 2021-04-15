<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home - Statistik</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/limitless/assets/css/main.css" rel="stylesheet" type="text/css">

	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/pages/form_select2.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/core/app.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

</head>

<body>
	<?php $this->load->view("header"); ?>
	<div class="page-container">
		<div class="page-content">
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">
					<?php $this->load->view("usermenu"); ?>
					<?php $this->load->view("sidebar"); ?>
				</div>
			</div>
			<div class="content-wrapper">
				<div class="content">
					<div class="row">
						<div class="col-md-3">
							<div class="box-shadow p-3 pegawai">
								<div style="display: flex;justify-content: space-between;">
									<div style="background: #07b739;border-radius: 50%;padding: 20px;color: #fff;height: 60px;">
										<i class="icon-users" style="font-size:20px"></i>
									</div>
									<div style="width: 60%;">
										<span>Data Pegawai</span>
										<h2 style="margin-top: -0px;font-size: 20px;font-weight: 600;"><?= $this->db->get('tb_pegawai')->num_rows() ?></h2>
									</div>
								</div>

							</div>
						</div>
						<div class="col-md-3">
							<div class="box-shadow p-3 penyuluh">
								<div style="display: flex;justify-content: space-between;">
									<div style="background: #FFC107;border-radius: 50%;padding: 20px;color: #fff;height: 60px;">
										<i class="icon-user-tie" style="font-size:20px"></i>
									</div>
									<div style="width: 70%;">
										<span>Penyuluhan Kehutanan Swadaya Masyarakat (PKSM)</span>
										<h2 style="margin-top: -0px;font-size: 20px;font-weight: 600;"><?= $this->db->get('t_penyuluh')->num_rows() ?></h2>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box-shadow p-3 kelompok">
								<div style="display: flex;justify-content: space-between;">
									<div style="background: #88857c;border-radius: 50%;padding: 20px;color: #fff;height: 60px;">
										<i class="icon-stats-bars" style="font-size:20px"></i>
									</div>
									<div style="width: 60%;">
										<span>Kelompok Tani Hutan</span>
										<h2 style="margin-top: -0px;font-size: 20px;font-weight: 600;"><?= number_format($this->db->get('kelompok_tani')->num_rows(), 0, '.', '.')  ?> <span style="font-size: 12px;">Kelompok</span></h2>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box-shadow p-3 kepemilikan">
								<div style="display: flex;justify-content: space-between;">
									<div style="background: #37474F;border-radius: 50%;padding: 20px;color: #fff;height: 60px;">
										<i class="icon-map" style="font-size:20px"></i>
									</div>
									<div style="width: 60%;">
										<span>Kepemilikan Lahan</span>
										<h2 style="margin-top: -0px;font-size: 20px;font-weight: 600;"><?= number_format($this->db->get('pemilik_lahan')->num_rows(), 0, '.', '.')  ?> <span style="font-size: 12px;">Persil</span></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="box-shadow-stats p-3 mt-20">
								<div class="row">
									<div class="form-group col-lg-2">
										<label for="">Kelompok Data</label>
										<select name="" id="kelompokdata" class="form-control">
											<option value="tani">Kelompok Tani</option>
											<option value="lahan">Kepemilikan Lahan</option>
											<option value="anggota">Anggota Kelompok Tani</option>
											<option value="pinjampakai">Pinjam Pakai Kawasan Hutan</option>
										</select>
									</div>
									<!-- kelompok tani -->
									<div class="keltani">
										<div class="form-group col-lg-3">
											<label for="">Kabupaten</label>
											<select name="" id="kabValue" class="select-search" data-placeholder="Pilih Kabupaten">
												<option value="0">
													< ALL>
												</option>
												<?php foreach ($kabupaten as $key => $value) { ?>
													<option value="<?php echo $value->id ?>">
														<?php echo $value->nama ?>
													</option>
												<?php }  ?>
											</select>
										</div>
										<div class="form-group col-lg-2">
											<label for="">Kecamatan</label>
											<select name="" id="kecValue" class="select-search" data-placeholder="Pilih Kabupaten">
												<option value="0">
													< ALL>
												</option>
											</select>
										</div>
										<div class="form-group col-lg-2">
											<label for="">Desa</label>
											<select name="" id="desaValue" class="select-search" data-placeholder="Pilih Desa">
												<option value="0">
													< ALL>
												</option>
											</select>
										</div>
										<div class="form-group col-lg-2">
											<label for="">Kelompok Tani</label>
											<select name="" id="kelompokTaniValue" class="select-search" data-placeholder="Pilih Kelompok Tani">
												<option value="0">
													< ALL>
												</option>
											</select>
										</div>
										<div class="form-inline hide">
											<div class="form-group col-lg-4">
												<label for="">Periode Tanggal</label>
												<div class="row">
													<div class="col-lg-6">
														<input type="date" name="" id="tglawal" class="form-control" onchange="handlerDate(event)">
													</div>
													<div class="col-lg-6">
														<input type="date" name="" id="tglakhir" class="form-control" style="width: 95%;" onchange="handlerDate(event)">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="kellahan" style="display: none;">
										<div class="form-group col-lg-3">
											<label for="">Jenis Sertifikat</label>
											<select name="" id="jenisSertifikatValue" class="select-search" data-placeholder="Pilih Jenis Sertifikat">
												<option value="0">
													< ALL>
												</option>
												<?php foreach ($sertifikat as $s) : ?>
													<option value="<?= $s->id ?>"><?= $s->nama ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group col-lg-3">
											<label for="">Blok</label>
											<select name="" id="blokSertifikatValue" class="select-search" data-placeholder="Pilih Blok">
												<option value="0">
													< ALL>
												</option>
											</select>
										</div>
										<div class="form-inline hide">
											<div class="form-group col-lg-4">
												<label for="">Periode Tanggal</label>
												<div class="row">
													<div class="col-lg-6">
														<input type="date" name="" id="tglawallahan" class="form-control" onchange="handlerDateLahan(event)">
													</div>
													<div class="col-lg-6">
														<input type="date" name="" id="tglakhirlahan" class="form-control" style="width: 95%;" onchange="handlerDateLahan(event)">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="keltani" style="margin-top: 20px;">
									<div style="display: flex; justify-content:space-between;">
										<div class="row">
											<div class="col-lg-12">
												<button type="button" class="btn btn-primary" id="ktanibar"><span class="icon-stats-bars"></span> Grafik Bar</button>
												<button type="button" class="btn btn-default" id="ktanipie" style="display: none;"><span class="icon-pie-chart"></span> Grafik Pie</button>
												<button type="button" class="btn btn-default" id="tabel"><span class="icon-table"></span> Tabel</button>
												<input type="hidden" id="ktaniTipeGrafik" value="bar">
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<button type="button" class="btn btn-primary" id="ktanitotal">Total</button>
												<button type="button" class="btn btn-default" id="ktanipemula">Pemula</button>
												<button type="button" class="btn btn-default" id="ktanimadya">Madya</button>
												<button type="button" class="btn btn-default" id="ktaniutama">Utama</button>
												<input type="hidden" id="ktaniBtnValue" value="total">
											</div>
										</div>
									</div>
								</div>
								<div class="kellahan" style="display: none;">
									<div style="display: flex; justify-content:space-between;">
										<div class="row">
											<div class="col-lg-12 text-center">
												<button type="button" class="btn btn-primary" id="klahanbar"><span class="icon-stats-bars"></span> Grafik Bar</button>
												<button type="button" class="btn btn-default" id="klahanpie"><span class="icon-pie-chart"></span> Grafik Pie</button>
												<button type="button" class="btn btn-default hide" id="klahantable"><span class="icon-table"></span> Tabel</button>
												<input type="hidden" id="klahanTipeGrafik" value="bar">
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 text-center">
												<button type="button" class="btn btn-primary" id="klahantotal">Jumlah Persil</button>
												<button type="button" class="btn btn-default" id="klahanlahan">Luas Lahan</button>
												<input type="hidden" id="klahanBtnValue" value="total">
											</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-12">
										<div class="panel panel-default tabel" style="display: none;" id="resultTable">
											<!-- Default panel contents -->
											<div class="panel-heading">
												<button id="btnExport" class="btn btn-primary">Report Kelompok Tani</button>
											</div>
											<div id="tblData">
												<table class="table" style="width:100%">
													<thead>
														<tr>
															<th>No</th>
															<th id="namaTabel">Nama</th>
															<th>Pemula</th>
															<th>Madya</th>
															<th>Utama</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody id="tabel-tani"></tbody>
													<tfoot>
														<tr style="background-color: #eee9e9;color: black;;">
															<td colspan="2">Total</td>
															<td id="totalPemula"></td>
															<td id="totalMadya"></td>
															<td id="totalUtama"></td>
															<td id="totalSemua"></td>
												</table>
											</div>
										</div>

										<div class="panel panel-default tabel" style="display: none;" id="resultTableLahan">
											<!-- Default panel contents -->
											<div class="panel-heading">
												<button id="btnExport" class="btn btn-primary">Report Kepemilikan Lahan</button>
											</div>
											<div id="tblData">
												<table class="table" style="width:100%">
													<thead>
														<tr>
															<th>No</th>
															<th id="namaTabel">Nama</th>
															<th>Pemula</th>
															<th>Madya</th>
															<th>Utama</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody id="tabel-tani"></tbody>
													<tfoot>
														<tr style="background-color: #eee9e9;color: black;;">
															<td colspan="2">Total</td>
															<td id="totalPemula"></td>
															<td id="totalMadya"></td>
															<td id="totalUtama"></td>
															<td id="totalSemua"></td>
												</table>
											</div>
										</div>

										<!-- grafik pertama -->
										<div id="grafik">
											<div id="grafikText" class="text-center">
												<h3 style="margin-bottom:0px" id="grafikTextTitle"></h3>
												<small id="grafikTextSubtitle"></small>
											</div>
											<div class="row">
												<div class="col-lg-9">
													<div id="chartdiv"></div>
												</div>
												<div class="col-lg-3">
													<div class="card__anggota_total hide">
														<span>Total Data</span>
														<h3 id="textTotalKelompokTani"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Pemula</span>
														<h3 id="textTotalKelompokTaniPemula"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Madya</span>
														<h3 id="textTotalKelompokTaniMadya"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Utama</span>
														<h3 id="textTotalKelompokTaniUtama"></h3>
													</div>
												</div>
											</div>
											<hr><br>
										</div>
										<div id="grafikTani">
											<div id="grafikText" class="text-center">
												<h3 style="margin-bottom:0px" id="grafikTaniTitle">Jumlah Kelompok Tani Hutan Per Tahun</h3>
												<small id="grafikTaniSubtitle">Data kelompok tani berdasarkan tahun berdiri</small>
											</div>
											<div class="row">
												<div class="col-lg-9">
													<div id="chartdiv2"></div>
												</div>
												<div class="col-lg-3">
													<div class="card__anggota_total hide">
														<span>Total Data</span>
														<h3 id="textTotalKelompokTaniTahun"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Tertinggi</span>
														<h3 id="textTotalKelompokTaniTahunTertinggi"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Terendah</span>
														<h3 id="textTotalKelompokTaniTahunTerendah"></h3>
													</div>
												</div>
											</div>
											<hr><br>
										</div>
										<div id="pieTani">
											<div id="grafikText" class="text-center">
												<h3 style="margin-bottom:0px">Jumlah Kelompok Tani Hutan Berdasarkan Dasar Hukum</h3>
												<small>Data kelompok tani berdasarkan dasar hukum</small>
											</div>
											<div class="row">
												<div class="col-lg-9">
													<div id="chartdivpie1"></div>
												</div>
												<div class="col-lg-3">
													<div class="card__anggota_total">
														<span>Total Data</span>
														<h3 id="textTotalKelompokTaniFile"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Pengesahan Menkumham</span>
														<h3 id="textTotalKelompokTaniFileMenkumham"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Pengesahan Akta</span>
														<h3 id="textTotalKelompokTaniFileAkta"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Pengesahan SK</span>
														<h3 id="textTotalKelompokTaniFileSk"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Pengesahan BA</span>
														<h3 id="textTotalKelompokTaniFileBa"></h3>
													</div>
												</div>
											</div>
											<hr><br>
										</div>
										<div id="grafikLahan" style="display: none;">
											<div id="grafikLahanText" class="text-center">
												<h3 style="margin-bottom:0px" id="grafikLahanTextTitle">Luas Lahan Kepemilikan</h3>
												<small id="grafikLahanTextSubtitle">Data jumlah lahan dan persil</small>
											</div>
											<div class="row">
												<div class="col-lg-9">
													<div id="chartdivlahan"></div>
												</div>
												<div class="col-lg-3">
													<div class="card__anggota_total">
														<span>Jumlah Persil</span>
														<h3 id="textTotalLahanPersil"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Luas Lahan</span>
														<h3 id="textTotalLahan"></h3>
													</div>
												</div>
											</div>
											<hr><br>
										</div>
										<div id="pieAnggota" style="display:none">
											<div id="grafikText" class="text-center">
												<h3 style="margin-bottom:0px">Jumlah Anggota Kelompok Tani Hutan</h3>
												<small>Data Anggota Kelompok tani</small>
											</div>
											<div class="row">
												<div class="col-lg-9">
													<div class="card__anggota">
														<div id="chartdivpieanggota1"></div>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="card__anggota_total">
														<span>Total Semua Umur</span>
														<h3 id="textTotalAnggota"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Umur 0 - 17thn</span>
														<h3 id="textTotalAnggota17"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Umur 18 - 35thn</span>
														<h3 id="textTotalAnggota35"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Umur 36 - 50thn</span>
														<h3 id="textTotalAnggota50"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Umur 51thn++</span>
														<h3 id="textTotalAnggota51"></h3>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="card__anggota">
														<div id="chartdivpieanggota2"></div>
														<div class="row">
															<div class="col-md-6">
																<div class="card__anggota_total">
																	<span>Semua Data</span>
																	<h3 id="textTotalAnggotaJK"></h3>
																</div>
															</div>
															<div class="col-md-6">
																<div class="card__anggota_total">
																	<span>Laki-Laki</span>
																	<h3 id="textTotalAnggotaJKL"></h3>
																</div>
															</div>
															<div class="col-md-6">
																<div class="card__anggota_total">
																	<span>Perempuan</span>
																	<h3 id="textTotalAnggotaJKP"></h3>
																</div>
															</div>
															<div class="col-md-6">
																<div class="card__anggota_total">
																	<span>Tidak diketahui</span>
																	<h3 id="textTotalAnggotaJKN"></h3>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="card__anggota">
														<div id="chartdivpieanggota3"></div>
														<div class="row" id="resultAnggotaPP">
															<div class="col-md-4">
																<div class="card__anggota_total">
																	<span>Semua</span>
																	<h3 id="textTotalAnggotaPP"></h3>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div id="grafikPinjamPakai" style="display: none;">
											<div id="grafikText" class="text-center">
												<h3 style="margin-bottom:0px" id="grafikPinjamPakaiTitle">Data Pinjam Pakai Kawasan Hutan Pada Hutan Lindung dan Hutan Produksi</h3>
												<small id="grafikPinjamPakaiSubtitle">Data Pinjam Pakai Kawasan Hutan</small>
											</div>
											<div class="row">
												<div class="col-lg-9">
													<div id="chartdiv3"></div>
												</div>
												<div class="col-lg-3">
													<div class="form-group">
														<select name="" id="selectPinjamPakai" class="form-control">
															<option value="kph">Unit Kerja Pengelola</option>
															<option value="kawasan">Kawasan Hutan</option>
															<option value="peruntukan">Peruntukan</option>
														</select>
													</div>
													<div class="card__anggota_total">
														<span>Total Data</span>
														<h3 id="textTotalPinjamPakai"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Tertinggi</span>
														<h3 id="textTotalPinjamPakaiTertinggi"></h3>
													</div>
													<div class="card__anggota_total">
														<span>Terendah</span>
														<h3 id="textTotalPinjamPakaiTerendah"></h3>
													</div>
												</div>
											</div>
											<hr><br>
										</div>
										<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
										<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
										<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
										<!-- Chart code -->
										<script>
											const baseUrl = '<?= base_url() ?>';
										</script>
										<script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="footer text-muted">
							&copy; 2018 <a href="#">Statistik</a>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>

</html>