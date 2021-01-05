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
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/limitless/assets/js/pages/form_select2.js"></script>
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
		.box-shadow > h1 {
			margin-top: 1px;
			font-size: 30px;
			font-weight: 600;
		}
		.box-shadow > span {
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
							<div class="box-shadow p-3">
								<span>Data Pegawai</span>
								<h1><?=$this->db->get('tb_pegawai')->num_rows()?></h1>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box-shadow p-3">
								<span>Penyuluhan PKSM</span>
								<h1><?=$this->db->get('t_penyuluh')->num_rows()?></h1>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box-shadow p-3">
								<span>Kelompok Tani</span>
								<h1><?=$this->db->get('kelompok_tani')->num_rows()?></h1>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box-shadow p-3">
								<span>Kepemilikan Lahan</span>
								<h1><?=$this->db->get('pemilik_lahan')->num_rows()?></h1>
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
										<select name="" id="" class="select-search" 
                        					data-placeholder="Pilih Kabupaten">
											<option value="0">< ALL ></option>
											<?php foreach ($kabupaten as $key => $value) { ?>
												<option value="<?php echo $value->id?>">
													<?php echo $value->nama?>                                           
												</option>
											<?php }  ?>
										</select>
									</div>
									<div class="form-group col-lg-3 keltani">
										<label for="">Kecamatan</label>
										<select name="" id="" class="select-search"
											data-placeholder="Pilih Kabupaten">
											<option value="0">< ALL ></option>
											<?php foreach ($kecamatan as $key => $value) { ?>
												<option value="<?php echo $value->id?>">
													<?php echo $value->nama?>                                    		
												</option>
											<?php }  ?>   
										</select>
									</div>
									<div class="form-group col-lg-3 keltani">
										<label for="">CDK</label>
										<select name="" id="" class="select-search"
											data-placeholder="Pilih CDK">
											<option value="0">< ALL ></option>
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
									$('#kelompokdata').on('change', function(){
										if($(this).val() == 'tani'){
											$('.keltani').show()
											$('.kellahan').hide();
										}else
										if($(this).val() == 'lahan'){
											$('.kellahan').show();
											$('.keltani').hide()
										}
									})
								</script>
								<hr>
								<div class="row">
									<div class="col-lg-12 text-center">
										<button type="button" class="btn btn-primary"><span class="icon-stats-bars"></span> Grafik Bar</button>
										<button type="button" class="btn btn-default"><span class="icon-pie-chart"></span> Grafik Pie</button>
									</div>
								</div>
								<div class="row mt-10">
									<div class="col-lg-12 text-center">
										<button type="button" class="btn btn-primary" id="ktanitotal">Total</button>
										<button type="button" class="btn btn-default" id="ktanipemula">Pemula</button>
										<button type="button" class="btn btn-default" id="ktanimadya">Madya</button>
										<button type="button" class="btn btn-default" id="ktaniutama">Utama</button>
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
										$.get("<?=base_url()?>/home/laporanKelas/0/0/0",
											function (data) {
												localStorage.setItem('dataStatistik', JSON.stringify(data));
												barChart(data);
											}
										);

										function barChart(barChartData){
											am4core.ready(function() {
											am4core.useTheme(am4themes_animated);
											var chart = am4core.create("chartdiv", am4charts.XYChart);
											chart.scrollbarX = new am4core.Scrollbar();

											let dataStatistik = '[';
											for($i=0; $i < barChartData.length; $i++){
												dataStatistik += '{"country":"'+barChartData[$i].nama+'",';
												dataStatistik += '"visits":'+barChartData[$i].jml+'},';
											}
											dataStatistik  += ']';

											// Add data
											chart.data = [{"country":"Kabupaten Bogor","visits":34},{"country":"Kabupaten Sukabumi","visits":184},{"country":"Kabupaten Cianjur","visits":381},{"country":"Kabupaten Bandung","visits":178},{"country":"Kabupaten Garut","visits":33},{"country":"Kabupaten Tasikmalaya","visits":507},{"country":"Kabupaten Ciamis","visits":518},{"country":"Kabupaten Kuningan","visits":249},{"country":"Kabupaten Cirebon","visits":173},{"country":"Kabupaten Majalengka","visits":232},{"country":"Kabupaten Sumedang","visits":133},{"country":"Kabupaten Indramayu","visits":5},{"country":"Kabupaten Subang","visits":175},{"country":"Kabupaten Purwakarta","visits":141},{"country":"Kabupaten Karawang","visits":73},{"country":"Kabupaten Bekasi","visits":0},{"country":"Kabupaten Bandung Barat","visits":192},{"country":"Kota Bogor","visits":0},{"country":"Kota Sukabumi","visits":0},{"country":"Kota Bandung","visits":0},{"country":"Kota Cirebon","visits":0},{"country":"Kota Bekasi","visits":0},{"country":"Kota Depok","visits":0},{"country":"Kota Cimahi","visits":0},{"country":"Kota Tasikmalaya","visits":36},{"country":"Kota Banjar","visits":34},{"country":"Kabupaten Pangandaran","visits":159},];
											// chart.dataSource.url = "/data/myData.php";
											// chart.dataSource.updateCurrentData = true;
											// chart.dataSource.reloadFrequency = 5000;

											// chart.dataSource.events.on("parseended", function(ev) {
											// parsed data is assigned to data source's `data` property
											// var data = ev.target.data;
											// for (var i = 0; i < data.length; i++) {
											// 	data[i]["year"] = "Year: " + data[i]["year"];
											// }
											// });

											console.log(dataStatistik);

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