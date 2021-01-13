barChartTotal("laporanKelas", 0, 0, 0, "total", 0, 0);
barChartTahun();
pieChartTotal();

$("#ktanibar").click(function () {
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanipie,#tabel").removeClass("btn-primary").addClass("btn-default");
	$("#ktaniTipeGrafik").val("bar");
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let tipe = $("#ktaniBtnValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$("#chartdiv,#ktanitotal,#ktanipemula,#ktanimadya,#ktaniutama").show();
	$("#resultTable").hide();
	if ($("#ktaniBtnValue").val() === "total") {
		barChartTotal("laporanKelas", kab, kec, 0, tipe, startDate, endDate);
	} else {
		barChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate);
	}
});

$("#ktanipie").click(function () {
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanibar,#tabel").removeClass("btn-primary").addClass("btn-default");
	$("#ktaniTipeGrafik").val("pie");
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let tipe = $("#ktaniBtnValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$("#chartdiv,#ktanitotal,#ktanipemula,#ktanimadya,#ktaniutama").show();
	$("#resultTable").hide();
	pieChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate);
});

$("#kabValue").on("change", function () {
	$.get(baseUrl + "Desa/getKecamatan/" + $(this).val(), function (response) {
		$("#kecValue").empty();
		$("#kecValue").append(
			$("<option></option>").attr("value", "0").text("< ALL >")
		);
		var dataArray = JSON.parse(response);
		for (var i in dataArray) {
			$("#kecValue").append(
				$("<option></option>")
					.attr("value", dataArray[i].id)
					.text(dataArray[i].nama)
			);
		}
	});
});

$("#kabValue,#kecValue").on("change", function () {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let tipe = $("#ktaniBtnValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	if ($("#ktaniTipeGrafik").val() == "bar") {
		if ($("#ktaniBtnValue").val() === "total") {
			barChartTotal("laporanKelas", kab, kec, 0, tipe, startDate, endDate);
		} else {
			barChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate);
		}
	} else if ($("#ktaniTipeGrafik").val() == "tabel") {
		getDataTable(kab, kec);
	} else {
		pieChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate);
	}
});

function handlerDate(e) {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let tipe = $("#ktaniBtnValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	if ($("#ktaniTipeGrafik").val() == "bar") {
		if ($("#ktaniBtnValue").val() === "total") {
			barChartTotal("laporanKelas", kab, kec, 0, tipe, startDate, endDate);
		} else {
			barChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate);
		}
	} else {
		pieChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate);
	}
}

$("#ktanitotal").on("click", function () {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanipemula,#ktanimadya,#ktaniutama")
		.removeClass("btn-primary")
		.addClass("btn-default");
	$("#ktaniBtnValue").val("total");
	if ($("#ktaniTipeGrafik").val() == "bar") {
		barChartTotal("laporanKelas", kab, kec, 0, "total", startDate, endDate);
	} else {
		pieChart("laporanKelas", kab, kec, 0, "total", startDate, endDate);
	}
});

$("#ktanipemula").on("click", function () {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanitotal,#ktanimadya,#ktaniutama")
		.removeClass("btn-primary")
		.addClass("btn-default");
	$("#ktaniBtnValue").val("pemula");
	if ($("#ktaniTipeGrafik").val() == "bar") {
		barChart("laporanKelas", kab, kec, 0, "pemula", startDate, endDate);
	} else {
		pieChart("laporanKelas", kab, kec, 0, "pemula", startDate, endDate);
	}
});

$("#ktanimadya").on("click", function () {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanipemula,#ktanitotal,#ktaniutama")
		.removeClass("btn-primary")
		.addClass("btn-default");
	$("#ktaniBtnValue").val("madya");
	if ($("#ktaniTipeGrafik").val() == "bar") {
		barChart("laporanKelas", kab, kec, 0, "madya", startDate, endDate);
	} else {
		pieChart("laporanKelas", kab, kec, 0, "madya", startDate, endDate);
	}
});

$("#ktaniutama").on("click", function () {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanipemula,#ktanimadya,#ktanitotal")
		.removeClass("btn-primary")
		.addClass("btn-default");
	$("#ktaniBtnValue").val("utama");
	if ($("#ktaniTipeGrafik").val() == "bar") {
		barChart("laporanKelas", kab, kec, 0, "utama", startDate, endDate);
	} else {
		pieChart("laporanKelas", kab, kec, 0, "utama", startDate, endDate);
	}
});

function barChartTotal(jenis, kab, kec, cdk, tipe, startDate, endDate) {
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv", am4charts.XYChart);
		chart.scrollbarX = new am4core.Scrollbar();

		// Add data
		chart.dataSource.url =
			baseUrl +
			"/home/" +
			jenis +
			"/" +
			kab +
			"/" +
			kec +
			"/" +
			cdk +
			"/" +
			tipe +
			"/" +
			startDate +
			"/" +
			endDate;
		chart.dataSource.updateCurrentData = true;

		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "kabupaten";
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
		series.dataFields.valueY = "pemula";
		series.dataFields.categoryX = "kabupaten";
		series.tooltipText = "Pemula : {valueY}";
		series.tooltip.pointerOrientation = "vertical";
		series.columns.template.column.fillOpacity = 0.9;

		var series2 = chart.series.push(new am4charts.ColumnSeries());
		series2.dataFields.valueY = "madya";
		series2.dataFields.categoryX = "kabupaten";
		series2.tooltipText = "Madya : {valueY}";
		series2.tooltip.pointerOrientation = "vertical";
		series2.columns.template.column.fillOpacity = 0.9;

		var series3 = chart.series.push(new am4charts.ColumnSeries());
		series3.dataFields.valueY = "utama";
		series3.dataFields.categoryX = "kabupaten";
		series3.tooltipText = "Utama : {valueY}";
		series3.columns.template.column.cornerRadiusTopLeft = 10;
		series3.columns.template.column.cornerRadiusTopRight = 10;
		series3.columns.template.column.fillOpacity = 0.9;

		series.stacked = true;
		series2.stacked = true;
		series3.stacked = true;

		// on hover, make corner radiuses bigger
		var hoverState = series.columns.template.column.states.create("hover");
		hoverState.properties.fillOpacity = 1;

		series.columns.template.adapter.add("fill", function (fill, target) {
			return chart.colors.getIndex(1);
		});
		series2.columns.template.adapter.add("fill", function (fill, target) {
			return chart.colors.getIndex(2);
		});
		series3.columns.template.adapter.add("fill", function (fill, target) {
			return chart.colors.getIndex(3);
		});

		// Cursor
		chart.cursor = new am4charts.XYCursor();
	});
}

function barChart(jenis, kab, kec, cdk, tipe, startDate, endDate) {
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv", am4charts.XYChart);
		chart.scrollbarX = new am4core.Scrollbar();

		// Add data
		chart.dataSource.url =
			baseUrl +
			"/home/" +
			jenis +
			"/" +
			kab +
			"/" +
			kec +
			"/" +
			cdk +
			"/" +
			tipe +
			"/" +
			startDate +
			"/" +
			endDate;
		chart.dataSource.updateCurrentData = true;

		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "kabupaten";
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
		series.dataFields.valueY = "jumlah";
		series.dataFields.categoryX = "kabupaten";
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

		series.columns.template.adapter.add("fill", function (fill, target) {
			return chart.colors.getIndex(target.dataItem.index);
		});

		chart.cursor = new am4charts.XYCursor();
	});
}

function barChartTahun() {
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv2", am4charts.XYChart);
		chart.scrollbarX = new am4core.Scrollbar();

		// Add data
		chart.dataSource.url = baseUrl + "/home/laporankelastahun";
		chart.dataSource.updateCurrentData = true;

		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "tahun";
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
		series.dataFields.categoryX = "tahun";
		series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
		series.columns.template.strokeWidth = 0;

		series.tooltip.pointerOrientation = "vertical";
		series.columns.template.column.fillOpacity = 0.9;

		// on hover, make corner radiuses bigger
		var hoverState = series.columns.template.column.states.create("hover");
		hoverState.properties.cornerRadiusTopLeft = 0;
		hoverState.properties.cornerRadiusTopRight = 0;
		hoverState.properties.fillOpacity = 1;

		series.columns.template.adapter.add("fill", function (fill, target) {
			return chart.colors.getIndex(target.dataItem.index);
		});

		// Cursor
		chart.cursor = new am4charts.XYCursor();
	});
}

// bar chart kepemilikan lahan
function barChartLahan(jenis, blok, filter, sdate, edate) {
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv", am4charts.XYChart);
		chart.scrollbarX = new am4core.Scrollbar();

		// Add data
		chart.dataSource.url =
			baseUrl +
			"/home/laporanKepemilikanLahan/" +
			jenis +
			"/" +
			blok +
			"/" +
			filter +
			"/" +
			sdate +
			"/" +
			edate;
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

		series.columns.template.adapter.add("fill", function (fill, target) {
			return chart.colors.getIndex(target.dataItem.index);
		});

		chart.cursor = new am4charts.XYCursor();
	});
}

function pieChart(jenis, kab, kec, cdk, tipe, startDate, endDate) {
	// pie chart 1
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv", am4charts.PieChart);
		chart.dataSource.url =
			baseUrl +
			"/home/" +
			jenis +
			"/" +
			kab +
			"/" +
			kec +
			"/" +
			cdk +
			"/" +
			tipe +
			"/" +
			startDate +
			"/" +
			endDate;
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

function pieChartLahan(jenis, blok, filter, sdate, edate) {
	// pie chart 1
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv", am4charts.PieChart);
		// Add data
		chart.dataSource.url =
			baseUrl +
			"/home/laporanKepemilikanLahan/" +
			jenis +
			"/" +
			blok +
			"/" +
			filter +
			"/" +
			sdate +
			"/" +
			edate;
		chart.dataSource.updateCurrentData = true;

		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "jenis";
		pieSeries.slices.template.stroke = am4core.color("#fff");
		pieSeries.slices.template.strokeWidth = 2;
		pieSeries.slices.template.strokeOpacity = 1;

		// This creates initial animation
		pieSeries.hiddenState.properties.opacity = 1;
		pieSeries.hiddenState.properties.endAngle = -90;
		pieSeries.hiddenState.properties.startAngle = -90;
	});

	// am4core.ready(function() {
	// 	am4core.useTheme(am4themes_animated);
	// 	var chart = am4core.create("chartdiv", am4charts.PieChart3D);
	// 	chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

	// 	chart.dataSource.url = "<?= base_url() ?>/home/laporanKepemilikanLahan/"+jenis+"/"+blok+"/"+filter;
	// 	chart.dataSource.updateCurrentData = true;

	// 	chart.innerRadius = am4core.percent(40);
	// 	chart.depth = 120;
	// 	chart.legend = new am4charts.Legend();
	// 	var series = chart.series.push(new am4charts.PieSeries3D());
	// 	series.dataFields.value = "total";
	// 	series.dataFields.depthValue = "total";
	// 	series.dataFields.category = "jenis";
	// 	series.slices.template.cornerRadius = 5;
	// 	series.colors.step = 3;

	// }); // end am4core.ready()
}

function pieChartTotal() {
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdivpie1", am4charts.PieChart);
		chart.dataSource.url = baseUrl + "/home/laporankelasfile";
		chart.dataSource.updateCurrentData = true;

		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "file";
		pieSeries.slices.template.stroke = am4core.color("#fff");
		pieSeries.slices.template.strokeWidth = 2;
		pieSeries.slices.template.strokeOpacity = 1;

		// This creates initial animation
		pieSeries.hiddenState.properties.opacity = 1;
		pieSeries.hiddenState.properties.endAngle = -90;
		pieSeries.hiddenState.properties.startAngle = -90;
	});
}

function handlerDateLahan(e) {
	let jenis = $("#jenisSertifikatValue").val();
	let blok = $("#blokSertifikatValue").val();
	let filter = $("#klahanBtnValue").val();
	let startDate =
		$("#tglawallahan").val() === "" ? 0 : $("#tglawallahan").val();
	let endDate =
		$("#tglakhirlahan").val() === "" ? 0 : $("#tglakhirlahan").val();
	if ($("#klahanTipeGrafik").val() === "bar") {
		barChartLahan(jenis, blok, filter, startDate, endDate);
	} else {
		pieChartLahan(jenis, blok, filter, startDate, endDate);
	}
}

function getBlokLahan(jenis) {
	$.get(baseUrl + "/home/getbloklahan/" + jenis, function (response) {
		$("#blokSertifikatValue").empty();
		$("#blokSertifikatValue").append(
			$("<option></option>").attr("value", "0").text("< Pilih Blok >")
		);
		var dataArray = JSON.parse(JSON.stringify(response));
		for (var i in dataArray) {
			$("#blokSertifikatValue").append(
				$("<option></option>").text(dataArray[i].blok)
			);
		}
	});
}

$("#jenisSertifikatValue").on("change", function () {
	getBlokLahan($(this).val());
	let jenis = $("#jenisSertifikatValue").val();
	let blok = $("#blokSertifikatValue").val();
	let filter = $("#klahanBtnValue").val();
	let startDate =
		$("#tglawallahan").val() === "" ? 0 : $("#tglawallahan").val();
	let endDate =
		$("#tglakhirlahan").val() === "" ? 0 : $("#tglakhirlahan").val();
	if ($("#klahanTipeGrafik").val() === "bar") {
		barChartLahan(jenis, blok, filter, startDate, endDate);
	} else {
		pieChartLahan(jenis, blok, filter, startDate, endDate);
	}
});

$("#blokSertifikatValue").on("change", function () {
	let jenis = $("#jenisSertifikatValue").val();
	let blok = $(this).val();
	let filter = $("#klahanBtnValue").val();
	let startDate =
		$("#tglawallahan").val() === "" ? 0 : $("#tglawallahan").val();
	let endDate =
		$("#tglakhirlahan").val() === "" ? 0 : $("#tglakhirlahan").val();
	if ($("#klahanTipeGrafik").val() === "bar") {
		barChartLahan(jenis, blok, filter, startDate, endDate);
	} else {
		pieChartLahan(jenis, blok, filter, startDate, endDate);
	}
});

$("#klahantotal").on("click", function () {
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#klahanBtnValue").val("total");
	$("#klahanlahan").removeClass("btn-primary").addClass("btn-default");
	let jenis = $("#jenisSertifikatValue").val();
	let blok = $("#blokSertifikatValue").val();
	let filter = $("#klahanBtnValue").val();
	let startDate =
		$("#tglawallahan").val() === "" ? 0 : $("#tglawallahan").val();
	let endDate =
		$("#tglakhirlahan").val() === "" ? 0 : $("#tglakhirlahan").val();
	if ($("#klahanTipeGrafik").val() === "bar") {
		barChartLahan(jenis, blok, filter, startDate, endDate);
	} else {
		pieChartLahan(jenis, blok, filter, startDate, endDate);
	}
});

$("#klahanlahan").on("click", function () {
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#klahanBtnValue").val("lahan");
	$("#klahantotal").removeClass("btn-primary").addClass("btn-default");
	let jenis = $("#jenisSertifikatValue").val();
	let blok = $("#blokSertifikatValue").val();
	let filter = $("#klahanBtnValue").val();
	let startDate =
		$("#tglawallahan").val() === "" ? 0 : $("#tglawallahan").val();
	let endDate =
		$("#tglakhirlahan").val() === "" ? 0 : $("#tglakhirlahan").val();
	if ($("#klahanTipeGrafik").val() === "bar") {
		barChartLahan(jenis, blok, filter, startDate, endDate);
	} else {
		pieChartLahan(jenis, blok, filter, startDate, endDate);
	}
});

$("#klahanbar").click(function () {
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#klahanpie").removeClass("btn-primary").addClass("btn-default");
	$("#klahanTipeGrafik").val("bar");
	let jenis = $("#jenisSertifikatValue").val();
	let blok = $("#blokSertifikatValue").val();
	let filter = $("#klahanBtnValue").val();
	let startDate =
		$("#tglawallahan").val() === "" ? 0 : $("#tglawallahan").val();
	let endDate =
		$("#tglakhirlahan").val() === "" ? 0 : $("#tglakhirlahan").val();
	barChartLahan(jenis, blok, filter, startDate, endDate);
});

$("#klahanpie").click(function () {
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#klahanbar").removeClass("btn-primary").addClass("btn-default");
	$("#klahanTipeGrafik").val("pie");
	let jenis = $("#jenisSertifikatValue").val();
	let blok = $("#blokSertifikatValue").val();
	let filter = $("#klahanBtnValue").val();
	let startDate =
		$("#tglawallahan").val() === "" ? 0 : $("#tglawallahan").val();
	let endDate =
		$("#tglakhirlahan").val() === "" ? 0 : $("#tglakhirlahan").val();
	pieChartLahan(jenis, blok, filter, startDate, endDate);
});
$("#tabel").click(function () {
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanibar, #ktanipie").removeClass("btn-primary").addClass("btn-default");
	$("#chartdiv, #ktanitotal, #ktanipemula, #ktanimadya, #ktaniutama").hide();
	$(".tabel").show();
	$("#grafikTani,#pieTani, #grafik").hide();
});

// pilih kelompok data
$("#kelompokdata").on("change", function () {
	if ($(this).val() == "tani") {
		$(".keltani,#grafikTani,#pieTani").show();
		$(".kellahan").hide();
		barChart("laporanKelas", 0, 0, 0, "total", 0, 0);
	} else if ($(this).val() == "lahan") {
		$(".kellahan").show();
		$(".keltani,#grafikTani,#pieTani").hide();
		barChartLahan(0, 0, "total", 0, 0);
		getBlokLahan(0);
	}
});

// get data json tabel
$(document).on("click", "#tabel", function () {
	$("#ktaniTipeGrafik").val("tabel");
	getDataTable(0, 0);
});

function getDataTable(kab, kec) {
	$.get(
		baseUrl + "home/laporanKelas/" + kab + "/" + kec + "/0/total/0/0",
		function (data) {
			$totalPemula = 0;
			$totalMadya = 0;
			$totalUtama = 0;
			$totalSemua = 0;
			$html = "";
			if (kab == "0" && kec == "0") {
				$("#namaTabel").html("Nama Kabupaten");
			} else if (kab != "0" && kec == "0") {
				$("#namaTabel").html("Nama Kecamatan");
			} else {
				$("#namaTabel").html("Nama Desa");
			}
			$("#tabel-tani").empty();
			for (let i in data) {
				$totalPemula = $totalPemula + Number(data[i].pemula);
				$totalMadya = $totalMadya + Number(data[i].madya);
				$totalUtama = $totalUtama + Number(data[i].utama);
				$totalSemua = $totalPemula + $totalMadya + $totalUtama;

				let kab = data[i].kabupaten;
				let pem = data[i].pemula;
				let mad = data[i].madya;
				let utm = data[i].utama;
				$("#tabel-tani").append(
					"<tr><td>" +
						(i++ + 1) +
						"</td><td>" +
						kab +
						"</td><td>" +
						pem +
						"</td><td>" +
						mad +
						"</td><td>" +
						utm +
						"</td><td>" +
						(pem + mad + utm) +
						"</td></tr>"
				);
			}
			$("#totalPemula").html($totalPemula);
			$("#totalMadya").html($totalMadya);
			$("#totalUtama").html($totalUtama);
			$("#totalSemua").html($totalSemua);
		}
	);
}

// get tabel export excel
$("#btnExport").on("click", function () {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	window.location =
		baseUrl + "home/laporanKelas/" + kab + "/" + kec + "/0/total/0/0/excel";
});

function exportTableToExcel(tableID, filename = "") {
	var downloadLink;
	var dataType = "application/vnd.ms-excel";
	var tableSelect = document.getElementById(tableID);
	var tableHTML = tableSelect.outerHTML.replace(/ /g, "%20");

	// Specify file name
	filename = filename ? filename + ".xlsx" : "excel_data.xlsx";

	// Create download link element
	downloadLink = document.createElement("a");

	document.body.appendChild(downloadLink);

	if (navigator.msSaveOrOpenBlob) {
		var blob = new Blob(["\ufeff", tableHTML], {
			type: dataType,
		});
		navigator.msSaveOrOpenBlob(blob, filename);
	} else {
		// Create a link to the file
		downloadLink.href = "data:" + dataType + ", " + tableHTML;

		// Setting the file name
		downloadLink.download = filename;

		//triggering the function
		downloadLink.click();
	}
}
