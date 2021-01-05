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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/limitless/assets/js/pages/dashboard.js"></script>
	<!-- /theme JS files -->
	<style>
		.box-shadow {
			-webkit-box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .1), 0 2px 4px -1px rgba(0, 0, 0, .06);
			box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .1), 0 2px 4px -1px rgba(0, 0, 0, .06);
			background: #fff;
			padding: 1.5rem;
			border-radius: 4px;
			height: 100px;
			border-bottom: 2px solid #333;
		}

		.box-shadow>h2 {
			margin-top: -10px;
			font-size: 25px;
			font-weight: 600;
		}

		.box-shadow>span {
			font-size: 15px;
		}

		.box-shadow-stats {
			-webkit-box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .1), 0 2px 4px -1px rgba(0, 0, 0, .06);
			box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .1), 0 2px 4px -1px rgba(0, 0, 0, .06);
			background: #fff;
			padding: 1.5rem;
			border-radius: 4px;
			height: auto;
		}

		#chartdiv {
			width: 100%;
			height: 500px;
		}

		.box-shadow.p-3.pegawai {
			background: #2ed43730;
			border-bottom: 3px solid #079f11;
		}

		.box-shadow.p-3.penyuluh {
			background: #efe62b42;
			border-bottom: 3px solid #FFC107;
		}

		.box-shadow.p-3.kelompok {
			background: #88857c63;
			border-bottom: 3px solid #88857c;
		}

		.box-shadow.p-3.kepemilikan {
			background: #81b7d294;
			border-bottom: 3px solid #37474F;
		}
	</style>
</head>

<body>

	<!-- Main navbar -->
	<?php $this->load->view("header"); ?>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<?php $this->load->view("usermenu"); ?>
					<!-- /user menu -->


					<!-- Main navigation -->
					<?php $this->load->view("sidebar"); ?>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">


					<!-- Dashboard content -->
					<div class="row">
						<div class="col-md-3">
							<div class="box-shadow p-3 pegawai">
								<div style="display: flex;justify-content: space-between;">
									<div style="background: #07b739;border-radius: 50%;padding: 20px;color: #fff;height: 60px;">
										<i class="icon-users" style="font-size:20px"></i>
									</div>
									<div style="width: 50%;">
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
									<div style="width: 50%;">
										<span>Penyuluhan PKSM</span>
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
									<div style="width: 50%;">
										<span>Kelompok Tani</span>
										<h2 style="margin-top: -0px;font-size: 20px;font-weight: 600;"><?= number_format($this->db->get('kelompok_tani')->num_rows(), 0, '.', '.')  ?></h2>
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
									<div style="width: 50%;">
										<span>Kepemilikan Lahan</span>
										<h2 style="margin-top: -0px;font-size: 20px;font-weight: 600;"><?= number_format($this->db->get('pemilik_lahan')->num_rows(), 0, '.', '.')  ?></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="box-shadow-stats p-3 mt-20">
								<div class="row">
									<div class="form-group col-lg-3">
										<label for="">Kelompok Data</label>
										<select name="" id="kelompokdata" class="form-control">
											<option value="tani">Kelompok Tani</option>
											<option value="lahan">Kepemilikan Lahan</option>
										</select>
									</div>
									<div class="form-group col-lg-3 keltani">
										<label for="">Kabupaten</label>
										<select name="" id="" class="select-search" data-placeholder="Pilih Kabupaten">
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
									<div class="form-group col-lg-3 keltani">
										<label for="">Kecamatan</label>
										<select name="" id="" class="select-search" data-placeholder="Pilih Kabupaten">
											<option value="0">
												< ALL>
											</option>
											<?php foreach ($kecamatan as $key => $value) { ?>
												<option value="<?php echo $value->id ?>">
													<?php echo $value->nama ?>
												</option>
											<?php }  ?>
										</select>
									</div>
									<div class="form-group col-lg-3 keltani">
										<label for="">CDK</label>
										<select name="" id="" class="select-search" data-placeholder="Pilih CDK">
											<option value="0">
												< ALL>
											</option>
											<option value="cdk1">Cabang Dinas Kehutanan I</option>
											<option value="cdk2">Cabang Dinas Kehutanan II</option>
											<option value="cdk3">Cabang Dinas Kehutanan III</option>
											<option value="cdk4">Cabang Dinas Kehutanan IV</option>
											<option value="cdk5">Cabang Dinas Kehutanan V</option>
											<option value="cdk6">Cabang Dinas Kehutanan VI</option>
											<option value="cdk7">Cabang Dinas Kehutanan VII</option>
											<option value="cdk8">Cabang Dinas Kehutanan VIII</option>
											<option value="cdk9">Cabang Dinas Kehutanan IX</option>
										</select>
									</div>
								</div>
								<script>
									$('#kelompokdata').on('change', function() {
										if ($(this).val() == 'tani') {
											$('.keltani').show()
											$('.kellahan').hide();
										} else
										if ($(this).val() == 'lahan') {
											$('.kellahan').show();
											$('.keltani').hide()
										}
									})
								</script>
								<div class="row">
									<div class="col-lg-12">
										<div id="chartdiv"></div>

										<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
										<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
										<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

										<!-- Chart code -->
										<script>
											am4core.ready(function() {

												// Themes begin
												am4core.useTheme(am4themes_animated);
												// Themes end

												var chart = am4core.create('chartdiv', am4charts.XYChart)
												chart.colors.step = 3;

												chart.legend = new am4charts.Legend()
												chart.legend.position = 'top'
												chart.legend.paddingBottom = 20
												chart.legend.labels.template.maxWidth = 95

												var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
												xAxis.dataFields.category = 'category'
												xAxis.renderer.cellStartLocation = 0.1
												xAxis.renderer.cellEndLocation = 0.9
												xAxis.renderer.grid.template.location = 0;

												var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
												yAxis.min = 0;

												function createSeries(value, name) {
													var series = chart.series.push(new am4charts.ColumnSeries())
													series.dataFields.valueY = value
													series.dataFields.categoryX = 'category'
													series.name = name

													series.events.on("hidden", arrangeColumns);
													series.events.on("shown", arrangeColumns);

													var bullet = series.bullets.push(new am4charts.LabelBullet())
													bullet.interactionsEnabled = false
													bullet.dy = 30;
													bullet.label.text = '{valueY}'
													bullet.label.fill = am4core.color('#fff')

													return series;
												}

												chart.data = [
													<?php foreach ($statistik as $s) : ?> {
															category: '<?= $s->nama ?>',
															first: <?= $s->jml_pemula ?>,
															second: <?= $s->jml_madya ?>,
															third: <?= $s->jml_utama ?>
														},
													<?php endforeach; ?>
												]


												createSeries('first', 'Pemula');
												createSeries('second', 'Madya');
												createSeries('third', 'Utama');

												function arrangeColumns() {

													var series = chart.series.getIndex(0);

													var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
													if (series.dataItems.length > 1) {
														var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
														var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
														var delta = ((x1 - x0) / chart.series.length) * w;
														if (am4core.isNumber(delta)) {
															var middle = chart.series.length / 2;

															var newIndex = 0;
															chart.series.each(function(series) {
																if (!series.isHidden && !series.isHiding) {
																	series.dummyData = newIndex;
																	newIndex++;
																} else {
																	series.dummyData = chart.series.indexOf(series);
																}
															})
															var visibleCount = newIndex;
															var newMiddle = visibleCount / 2;

															chart.series.each(function(series) {
																var trueIndex = chart.series.indexOf(series);
																var newIndex = series.dummyData;

																var dx = (newIndex - trueIndex + middle - newMiddle) * delta

																series.animate({
																	property: "dx",
																	to: dx
																}, series.interpolationDuration, series.interpolationEasing);
																series.bulletsContainer.animate({
																	property: "dx",
																	to: dx
																}, series.interpolationDuration, series.interpolationEasing);
															})
														}
													}
												}

											}); // end am4core.ready()
										</script>

									</div>
								</div>
							</div>

						</div>
					</div>
					<!-- /dashboard content -->

					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2018 <a href="#">Statistik</a>
					</div>
					<!-- /footer -->
				</div>
				<!-- /content area -->
			</div>
			<!-- /main content -->
		</div>
		<!-- /page content -->
	</div>
	<!-- /page container -->
</body>

</html>