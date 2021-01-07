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
									<div class="form-group col-lg-2">
										<label for="">Kelompok Data</label>
										<select name="" id="kelompokdata" class="form-control">
											<option value="tani">Kelompok Tani</option>
											<option value="lahan">Kepemilikan Lahan</option>
										</select>
									</div>
									<!-- kelompok tani -->
									<div class="keltani">
										<div class="form-group col-lg-3">
											<label for="">Kabupaten</label>
											<select name="" id="kabValue" class="select-search" data-placeholder="Pilih Kabupaten">
												<option value="0">
													< ALL >
												</option>
												<?php foreach ($kabupaten as $key => $value) { ?>
													<option value="<?php echo $value->id ?>">
														<?php echo $value->nama ?>
													</option>
												<?php }  ?>
											</select>
										</div>
										<div class="form-group col-lg-3">
											<label for="">Kecamatan</label>
											<select name="" id="kecValue" class="select-search" data-placeholder="Pilih Kabupaten">
												<option value="0">
													< ALL >
												</option>
											</select>
										</div>
										<div class="form-inline">
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
													< ALL >
												</option>
												<?php foreach($sertifikat as $s): ?>
												<option value="<?=$s->id?>"><?=$s->nama?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group col-lg-3">
											<label for="">Blok</label>
											<select name="" id="blokSertifikatValue" class="select-search" data-placeholder="Pilih Blok">
												<option value="0">
													< ALL >
												</option>
											</select>
										</div>
									</div>
								</div>
								<div class="keltani">
									<div style="display: flex; justify-content:space-between;">
										<div class="row">
											<div class="col-lg-12 text-center">
												<button type="button" class="btn btn-primary" id="ktanibar"><span class="icon-stats-bars"></span> Grafik Bar</button>
												<button type="button" class="btn btn-default" id="ktanipie"><span class="icon-pie-chart"></span> Grafik Pie</button>
												<input type="hidden" id="ktaniTipeGrafik" value="bar">
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 text-center">
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
												<input type="hidden" id="klahanTipeGrafik" value="bar">
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 text-center">
												<button type="button" class="btn btn-primary" id="klahantotal">Total</button>
												<button type="button" class="btn btn-default" id="klahanlahan">Jumlah Lahan</button>
												<input type="hidden" id="klahanBtnValue" value="total">
											</div>
										</div>
									</div>
								</div>
								
								<hr>
								<div class="row">
									<div class="col-lg-12">
										<div id="chartdiv"></div>

										<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
										<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
										<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
										<!-- Chart code -->
										<script>
										barChart('laporanKelas',0,0,0,'total',0,0);

										$('#ktanibar').click(function(){
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanipie').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniTipeGrafik').val('bar');
											let kab 		= $('#kabValue').val(); 
											let kec 		= $('#kecValue').val();
											let tipe		= $('#ktaniBtnValue').val();
											let startDate 	= $('#tglawal').val() === '' ? 0 : $('#tglawal').val();
											let endDate 	= $('#tglakhir').val() === '' ? 0 : $('#tglakhir').val();
											barChart('laporanKelas',kab,kec,0,tipe,startDate,endDate);
										});

										$('#ktanipie').click(function(){
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanibar').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniTipeGrafik').val('pie');
											let kab 		= $('#kabValue').val(); 
											let kec 		= $('#kecValue').val();
											let tipe		= $('#ktaniBtnValue').val();
											let startDate 	= $('#tglawal').val() === '' ? 0 : $('#tglawal').val();
											let endDate 	= $('#tglakhir').val() === '' ? 0 : $('#tglakhir').val();
											pieChart('laporanKelas',kab,kec,0,tipe,startDate,endDate);
										});

										$('#kabValue').on('change', function(){
											$.get("<?=base_url()?>Desa/getKecamatan/"+$(this).val(),
												function (response) {
													$('#kecValue').empty();
													$('#kecValue').append($("<option></option>").attr("value",'0').text('< ALL >'));
													var dataArray = JSON.parse(response);          	                	
													for (var i in dataArray) {
														$('#kecValue').append($("<option></option>")
															.attr("value",dataArray[i].id)
															.text(dataArray[i].nama));
													}
												},
											);
										})

										$('#kabValue,#kecValue').on('change', function(){
											let kab 		= $('#kabValue').val(); 
											let kec 		= $('#kecValue').val();
											let tipe		= $('#ktaniBtnValue').val();
											let startDate 	= $('#tglawal').val() === '' ? 0 : $('#tglawal').val();
											let endDate 	= $('#tglakhir').val() === '' ? 0 : $('#tglakhir').val();
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,0,tipe,startDate,endDate);
											}else{
												pieChart('laporanKelas',kab,kec,0,tipe,startDate,endDate);
											}
										});

										function handlerDate(e){
											let kab 		= $('#kabValue').val(); 
											let kec 		= $('#kecValue').val();
											let tipe		= $('#ktaniBtnValue').val();
											let startDate 	= $('#tglawal').val() === '' ? 0 : $('#tglawal').val();
											let endDate 	= $('#tglakhir').val() === '' ? 0 : $('#tglakhir').val();
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,0,tipe,startDate,endDate);
											}else{
												pieChart('laporanKelas',kab,kec,0,tipe,startDate,endDate);
											}
										}

										$('#ktanitotal').on('click', function(){
											let kab 		= $('#kabValue').val(); 
											let kec 		= $('#kecValue').val();
											let startDate 	= $('#tglawal').val() === '' ? 0 : $('#tglawal').val();
											let endDate 	= $('#tglakhir').val() === '' ? 0 : $('#tglakhir').val();
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanipemula,#ktanimadya,#ktaniutama').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniBtnValue').val('total');
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,0,'total',startDate,endDate);
											}else{
												pieChart('laporanKelas',kab,kec,0,'total',startDate,endDate);
											}
										});

										$('#ktanipemula').on('click', function(){
											let kab 		= $('#kabValue').val(); 
											let kec 		= $('#kecValue').val();
											let startDate 	= $('#tglawal').val() === '' ? 0 : $('#tglawal').val();
											let endDate 	= $('#tglakhir').val() === '' ? 0 : $('#tglakhir').val();
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanitotal,#ktanimadya,#ktaniutama').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniBtnValue').val('pemula');
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,0,'pemula',startDate,endDate);
											}else{
												pieChart('laporanKelas',kab,kec,0,'pemula',startDate,endDate);
											}
										});

										$('#ktanimadya').on('click', function(){
											let kab 		= $('#kabValue').val(); 
											let kec 		= $('#kecValue').val();
											let startDate 	= $('#tglawal').val() === '' ? 0 : $('#tglawal').val();
											let endDate 	= $('#tglakhir').val() === '' ? 0 : $('#tglakhir').val();
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanipemula,#ktanitotal,#ktaniutama').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniBtnValue').val('madya');
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,0,'madya',startDate,endDate);
											}else{
												pieChart('laporanKelas',kab,kec,0,'madya',startDate,endDate);
											}
										});

										$('#ktaniutama').on('click', function(){
											let kab 		= $('#kabValue').val(); 
											let kec 		= $('#kecValue').val();
											let startDate 	= $('#tglawal').val() === '' ? 0 : $('#tglawal').val();
											let endDate 	= $('#tglakhir').val() === '' ? 0 : $('#tglakhir').val();
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#ktanipemula,#ktanimadya,#ktanitotal').removeClass('btn-primary').addClass('btn-default');
											$('#ktaniBtnValue').val('utama');
											if($('#ktaniTipeGrafik').val() == 'bar'){
												barChart('laporanKelas',kab,kec,0,'utama',startDate,endDate);
											}else{
												pieChart('laporanKelas',kab,kec,0,'utama',startDate,endDate);
											}
										});

										function barChart(jenis,kab,kec,cdk,tipe,startDate,endDate){
											am4core.ready(function() {
											am4core.useTheme(am4themes_animated);
											var chart = am4core.create("chartdiv", am4charts.XYChart);
											chart.scrollbarX = new am4core.Scrollbar();

											// Add data
											chart.dataSource.url = "<?=base_url()?>/home/"+jenis+"/"+kab+"/"+kec+"/"+cdk+"/"+tipe+"/"+startDate+"/"+endDate;
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

										// bar chart kepemilikan lahan
										function barChartLahan(jenis,blok,filter){
											am4core.ready(function() {
												am4core.useTheme(am4themes_animated);
												var chart = am4core.create("chartdiv", am4charts.XYChart);
												chart.scrollbarX = new am4core.Scrollbar();

												// Add data
												chart.dataSource.url = "<?=base_url()?>/home/laporanKepemilikanLahan/"+jenis+"/"+blok+"/"+filter;
												chart.dataSource.updateCurrentData = true;

												// Create axes
												var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
												categoryAxis.dataFields.category = "jenis";
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
												series.dataFields.valueY = "total";
												series.dataFields.categoryX = "jenis";
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

										function pieChart(jenis,kab,kec,cdk,tipe,startDate,endDate){
											// pie chart 1
											am4core.ready(function() {
												am4core.useTheme(am4themes_animated);
												var chart = am4core.create("chartdiv", am4charts.PieChart);
												chart.dataSource.url = "<?=base_url()?>/home/"+jenis+"/"+kab+"/"+kec+"/"+cdk+"/"+tipe+"/"+startDate+"/"+endDate;
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
											});

										}

										function pieChartLahan(jenis,blok,filter){
											// pie chart 1
											am4core.ready(function() {
												// am4core.useTheme(am4themes_animated);
												// var chart = am4core.create("chartdiv", am4charts.PieChart);
												// // Add data
												// chart.dataSource.url = "<?=base_url()?>/home/laporanKepemilikanLahan/"+jenis+"/"+blok+"/"+filter;
												// chart.dataSource.updateCurrentData = true;

												// // Add and configure Series
												// var pieSeries = chart.series.push(new am4charts.PieSeries());
												// pieSeries.dataFields.value = "total";
												// pieSeries.dataFields.category = "jenis";
												// pieSeries.slices.template.stroke = am4core.color("#fff");
												// pieSeries.slices.template.strokeWidth = 2;
												// pieSeries.slices.template.strokeOpacity = 1;

												// // This creates initial animation
												// pieSeries.hiddenState.properties.opacity = 1;
												// pieSeries.hiddenState.properties.endAngle = -90;
												// pieSeries.hiddenState.properties.startAngle = -90;
												am4core.ready(function() {

												// Themes begin
												am4core.useTheme(am4themes_animated);
												// Themes end

												var chart = am4core.create("chartdiv", am4charts.PieChart3D);
												chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

												chart.dataSource.url = "<?=base_url()?>/home/laporanKepemilikanLahan/"+jenis+"/"+blok+"/"+filter;
												chart.dataSource.updateCurrentData = true;

												chart.innerRadius = am4core.percent(40);
												chart.depth = 120;

												chart.legend = new am4charts.Legend();

												var series = chart.series.push(new am4charts.PieSeries3D());
												series.dataFields.value = "total";
												series.dataFields.depthValue = "total";
												series.dataFields.category = "jenis";
												series.slices.template.cornerRadius = 5;
												series.colors.step = 3;

												}); // end am4core.ready()
											});

										}

										function getBlokLahan(jenis){
											$.get("<?=base_url()?>/home/getbloklahan/"+jenis,
												function (response) {
													$('#blokSertifikatValue').empty();
													$('#blokSertifikatValue').append($("<option></option>").attr("value",'0').text('< Pilih Blok >'));
													var dataArray = JSON.parse(JSON.stringify(response));          	                	
													for (var i in dataArray) {
														$('#blokSertifikatValue').append($("<option></option>")
															.text(dataArray[i].blok));
													}
												}
											);
										}

										$('#jenisSertifikatValue').on('change', function(){
											getBlokLahan($(this).val());
											let jenis = $('#jenisSertifikatValue').val();
											let blok  = $('#blokSertifikatValue').val();
											let filter= $('#klahanBtnValue').val();
											if($('#klahanTipeGrafik').val() === 'bar'){
												barChartLahan(jenis,blok,filter);
											}else{
												pieChartLahan(jenis,blok,filter);
											}
										});

										$('#blokSertifikatValue').on('change', function(){
											let jenis = $('#jenisSertifikatValue').val();
											let blok  = $(this).val();
											let filter= $('#klahanBtnValue').val();
											if($('#klahanTipeGrafik').val() === 'bar'){
												barChartLahan(jenis,blok,filter);
											}else{
												pieChartLahan(jenis,blok,filter);
											}
										});

										$('#klahantotal').on('click', function(){
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#klahanBtnValue').val('total');
											$('#klahanlahan').removeClass('btn-primary').addClass('btn-default');
											let jenis = $('#jenisSertifikatValue').val();
											let blok  = $('#blokSertifikatValue').val();
											let filter= $('#klahanBtnValue').val();

											if($('#klahanTipeGrafik').val() === 'bar'){
												barChartLahan(jenis,blok,filter);
											}else{
												pieChartLahan(jenis,blok,filter);
											}
										})

										$('#klahanlahan').on('click', function(){
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#klahanBtnValue').val('lahan');
											$('#klahantotal').removeClass('btn-primary').addClass('btn-default');
											let jenis = $('#jenisSertifikatValue').val();
											let blok  = $('#blokSertifikatValue').val();
											let filter= $('#klahanBtnValue').val();
											if($('#klahanTipeGrafik').val() === 'bar'){
												barChartLahan(jenis,blok,filter);
											}else{
												pieChartLahan(jenis,blok,filter);
											}
										});

										$('#klahanbar').click(function(){
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#klahanpie').removeClass('btn-primary').addClass('btn-default');
											$('#klahanTipeGrafik').val('bar');
											let jenis = $('#jenisSertifikatValue').val();
											let blok  = $('#blokSertifikatValue').val();
											let filter= $('#klahanBtnValue').val();
											barChartLahan(jenis,blok,filter);
										});

										$('#klahanpie').click(function(){
											$(this).removeClass('btn-default').addClass('btn-primary');
											$('#klahanbar').removeClass('btn-primary').addClass('btn-default');
											$('#klahanTipeGrafik').val('pie');
											let jenis = $('#jenisSertifikatValue').val();
											let blok  = $('#blokSertifikatValue').val();
											let filter= $('#klahanBtnValue').val();
											pieChartLahan(jenis,blok,filter);
										});

										// pilih kelompok data
										$('#kelompokdata').on('change', function() {
											if ($(this).val() == 'tani') {
												$('.keltani').show()
												$('.kellahan').hide();
												barChart('laporanKelas',0,0,0,'total',0,0);
											} else
											if ($(this).val() == 'lahan') {
												$('.kellahan').show();
												$('.keltani').hide()
												barChartLahan(0,0,'total');
												getBlokLahan(0);
											}
										})
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