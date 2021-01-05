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
									<div class="form-group col-lg-3 keltani">
										<label for="">Kecamatan</label>
										<select name="" id="kecValue" class="select-search" data-placeholder="Pilih Kabupaten">
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
										<select name="" id="cdkValue" class="select-search" data-placeholder="Pilih CDK">
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
								<hr>
								<div class="row">
									<div class="col-lg-12 text-center">
										<button type="button" class="btn btn-primary" id="ktanibar"><span class="icon-stats-bars"></span> Grafik Bar</button>
										<button type="button" class="btn btn-default" id="ktanipie"><span class="icon-pie-chart"></span> Grafik Pie</button>
										<input type="hidden" id="ktaniTipeGrafik" value="bar">
									</div>
								</div>
								<div class="row mt-10">
									<div class="col-lg-12 text-center">
										<button type="button" class="btn btn-primary" id="ktanitotal">Total</button>
										<button type="button" class="btn btn-default" id="ktanipemula">Pemula</button>
										<button type="button" class="btn btn-default" id="ktanimadya">Madya</button>
										<button type="button" class="btn btn-default" id="ktaniutama">Utama</button>
										<input type="hidden" id="ktaniBtnValue" value="total">
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div id="chartdiv"></div>

										<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
										<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
										<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
										<!-- Chart code -->
										<script>
										barChart('laporanKelas',0,0,0,'total');

										$('#ktanibar').click(function(){
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanipie').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniTipeGrafik').val('bar');
											let kab = $('#kabValue').val(); 
											let kec = $('#kecValue').val(); 
											let cdk = $('#cdkValue').val();
											let tipe= $('#ktaniBtnValue').val();
											barChart('laporanKelas',kab,kec,cdk,tipe);
										});

										$('#ktanipie').click(function(){
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanibar').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniTipeGrafik').val('pie');
											let kab = $('#kabValue').val(); 
											let kec = $('#kecValue').val(); 
											let cdk = $('#cdkValue').val();
											let tipe= $('#ktaniBtnValue').val();
											pieChart('laporanKelas',kab,kec,cdk,tipe);
										});

										$('#kabValue,#kecValue,#cdkValue').on('change', function(){
											let kab = $('#kabValue').val(); 
											let kec = $('#kecValue').val(); 
											let cdk = $('#cdkValue').val();
											let tipe= $('#ktaniBtnValue').val();
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,cdk,tipe);
											}else{
												pieChart('laporanKelas',kab,kec,cdk,tipe);
											}
										});

										$('#ktanitotal').on('click', function(){
											let kab = $('#kabValue').val(); 
											let kec = $('#kecValue').val(); 
											let cdk = $('#cdkValue').val();
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanipemula,#ktanimadya,#ktaniutama').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniBtnValue').val('total');
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,cdk,'total');
											}else{
												pieChart('laporanKelas',kab,kec,cdk,'total');
											}
										});

										$('#ktanipemula').on('click', function(){
											let kab = $('#kabValue').val(); 
											let kec = $('#kecValue').val(); 
											let cdk = $('#cdkValue').val();
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanitotal,#ktanimadya,#ktaniutama').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniBtnValue').val('pemula');
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,cdk,'pemula');
											}else{
												pieChart('laporanKelas',kab,kec,cdk,'pemula');
											}
										});

										$('#ktanimadya').on('click', function(){
											let kab = $('#kabValue').val(); 
											let kec = $('#kecValue').val(); 
											let cdk = $('#cdkValue').val();
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanipemula,#ktanitotal,#ktaniutama').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniBtnValue').val('madya');
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,cdk,'madya');
											}else{
												pieChart('laporanKelas',kab,kec,cdk,'madya');
											}
										});

										$('#ktaniutama').on('click', function(){
											let kab = $('#kabValue').val(); 
											let kec = $('#kecValue').val(); 
											let cdk = $('#cdkValue').val();
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanipemula,#ktanimadya,#ktanitotal').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniBtnValue').val('utama');
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,cdk,'utama');
											}else{
												pieChart('laporanKelas',kab,kec,cdk,'utama');
											}
										});

										function barChart(jenis,kab,kec,cdk,tipe){
											am4core.ready(function() {
											am4core.useTheme(am4themes_animated);
											var chart = am4core.create("chartdiv", am4charts.XYChart);
											chart.scrollbarX = new am4core.Scrollbar();

											// Add data
											chart.dataSource.url = "<?=base_url()?>/home/"+jenis+"/"+kab+"/"+kec+"/"+cdk+"/"+tipe;
											chart.dataSource.updateCurrentData = true;

											// Create axes
											var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
											categoryAxis.dataFields.category = "country";
											categoryAxis.renderer.grid.template.location = 0;
											categoryAxis.renderer.minGridDistance = 30;
											categoryAxis.renderer.labels.template.horizontalCenter = "right";
											categoryAxis.renderer.labels.template.verticalCenter = "middle";
											categoryAxis.renderer.labels.template.rotation = 270;
											categoryAxis.tooltip.disabled = true;
											categoryAxis.renderer.minHeight = 110;

											var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
											valueAxis.renderer.minWidth = 50;

											// Create series
											var series = chart.series.push(new am4charts.ColumnSeries());
											series.sequencedInterpolation = true;
											series.dataFields.valueY = "visits";
											series.dataFields.categoryX = "country";
											series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
											series.columns.template.strokeWidth = 0;

											series.tooltip.pointerOrientation = "vertical";

											series.columns.template.column.cornerRadiusTopLeft = 10;
											series.columns.template.column.cornerRadiusTopRight = 10;
											series.columns.template.column.fillOpacity = 0.8;

											// on hover, make corner radiuses bigger
											var hoverState = series.columns.template.column.states.create("hover");
											hoverState.properties.cornerRadiusTopLeft = 0;
											hoverState.properties.cornerRadiusTopRight = 0;
											hoverState.properties.fillOpacity = 1;

											series.columns.template.adapter.add("fill", function(fill, target) {
											return chart.colors.getIndex(target.dataItem.index);
											});

											chart.cursor = new am4charts.XYCursor();

											});
										}

										function pieChart(jenis,kab,kec,cdk,tipe){
											am4core.ready(function() {
											am4core.useTheme(am4themes_animated);
											var chart = am4core.create("chartdiv", am4charts.PieChart);
											chart.dataSource.url = "<?=base_url()?>/home/"+jenis+"/"+kab+"/"+kec+"/"+cdk+"/"+tipe;
											chart.dataSource.updateCurrentData = true;

											// Add and configure Series
											var pieSeries = chart.series.push(new am4charts.PieSeries());
											pieSeries.dataFields.value = "visits";
											pieSeries.dataFields.category = "country";
											pieSeries.slices.template.stroke = am4core.color("#fff");
											pieSeries.slices.template.strokeWidth = 2;
											pieSeries.slices.template.strokeOpacity = 1;

											// This creates initial animation
											pieSeries.hiddenState.properties.opacity = 1;
											pieSeries.hiddenState.properties.endAngle = -90;
											pieSeries.hiddenState.properties.startAngle = -90;

											}); // end am4core.ready()
										}
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