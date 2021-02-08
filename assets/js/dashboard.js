barChartTotal("laporanKelas", 0, 0, 0, "total", 0, 0, 0, 0);
barChartTahun();
pieChartTotal();

$("#ktanibar").click(function () {
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanipie,#tabel").removeClass("btn-primary").addClass("btn-default");
	$("#ktaniTipeGrafik").val("bar");
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let desa = $("#desaValue").val();
	let anggota = $("#KelompokTaniValue").val();
	let tipe = $("#ktaniBtnValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$("#grafik,#chartdiv,#chartdivlahan,#ktanitotal,#ktanipemula,#ktanimadya,#ktaniutama").show();
	$("#resultTable").hide();
	if ($("#ktaniBtnValue").val() === "total") {
		barChartTotal("laporanKelas", kab, kec, 0, tipe, startDate, endDate, desa, anggota);
	} else {
		barChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate, desa, anggota);
	}
});

$("#ktanipie").click(function () {
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanibar,#tabel").removeClass("btn-primary").addClass("btn-default");
	$("#ktaniTipeGrafik").val("pie");
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let desa = $("#desaValue").val();
	let anggota = $("#KelompokTaniValue").val();
	let tipe = $("#ktaniBtnValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$("#chartdiv,#chartdivlahan,#ktanitotal,#ktanipemula,#ktanimadya,#ktaniutama").show();
	$("#resultTable").hide();
	pieChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate, desa, anggota);
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

$("#kecValue").on("change", function () {
	$.get(baseUrl + "Desa/getDesa/" + $(this).val(), function (response) {
		$("#desaValue").empty();
		$("#desaValue").append(
			$("<option></option>").attr("value", "0").text("< ALL >")
		);
		var dataArray = JSON.parse(response);
		for (var i in dataArray) {
			$("#desaValue").append(
				$("<option></option>")
					.attr("value", dataArray[i].id)
					.text(dataArray[i].nama)
			);
		}
	});
});

$("#desaValue").on("change", function () {
	$.get(baseUrl + "Desa/getKelompokTani/" + $(this).val(), function (response) {
		$("#kelompokTaniValue").empty();
		$("#kelompokTaniValue").append(
			$("<option></option>").attr("value", "0").text("< ALL >")
		);
		var dataArray = JSON.parse(response);
		for (var i in dataArray) {
			$("#kelompokTaniValue").append(
				$("<option></option>")
					.attr("value", dataArray[i].id)
					.text(dataArray[i].nama)
			);
		}
	});
});

$("#kabValue,#kecValue,#desaValue,#kelompokTaniValue").on(
	"change",
	function () {
		let kab = $("#kabValue").val();
		let kec = $("#kecValue").val();
		let desa = $("#desaValue").val();
		let anggota = $("#KelompokTaniValue").val();
		let tipe = $("#ktaniBtnValue").val();
		let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
		let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
		if ($("#ktaniTipeGrafik").val() == "bar") {
			if ($("#ktaniBtnValue").val() === "total") {
				barChartTotal("laporanKelas", kab, kec, 0, tipe, startDate, endDate, desa, anggota);
			} else {
				barChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate, desa, anggota);
			}
		} else if ($("#ktaniTipeGrafik").val() == "tabel") {
			getDataTable(kab, kec, desa);
		} else {
			pieChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate, desa, anggota);
		}
	}
);

function handlerDate(e) {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let desa = $("#desaValue").val();
	let anggota = $("#KelompokTaniValue").val();
	let tipe = $("#ktaniBtnValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	if ($("#ktaniTipeGrafik").val() == "bar") {
		if ($("#ktaniBtnValue").val() === "total") {
			barChartTotal("laporanKelas", kab, kec, 0, tipe, startDate, endDate, desa, anggota);
		} else {
			barChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate, desa, anggota);
		}
	} else {
		pieChart("laporanKelas", kab, kec, 0, tipe, startDate, endDate, desa, anggota);
	}
}

$("#ktanitotal").on("click", function () {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let desa = $("#desaValue").val();
	let anggota = $("#KelompokTaniValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanipemula,#ktanimadya,#ktaniutama")
		.removeClass("btn-primary")
		.addClass("btn-default");
	$("#ktaniBtnValue").val("total");
	if ($("#ktaniTipeGrafik").val() == "bar") {
		barChartTotal("laporanKelas", kab, kec, 0, "total", startDate, endDate, desa, anggota);
	} else {
		pieChart("laporanKelas", kab, kec, 0, "total", startDate, endDate, desa, anggota);
	}
});

$("#ktanipemula").on("click", function () {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let desa = $("#desaValue").val();
	let anggota = $("#KelompokTaniValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanitotal,#ktanimadya,#ktaniutama")
		.removeClass("btn-primary")
		.addClass("btn-default");
	$("#ktaniBtnValue").val("pemula");
	if ($("#ktaniTipeGrafik").val() == "bar") {
		barChart("laporanKelas", kab, kec, 0, "pemula", startDate, endDate, desa, anggota);
	} else {
		pieChart("laporanKelas", kab, kec, 0, "pemula", startDate, endDate, desa, anggota);
	}
});

$("#ktanimadya").on("click", function () {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let desa = $("#desaValue").val();
	let anggota = $("#KelompokTaniValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanipemula,#ktanitotal,#ktaniutama")
		.removeClass("btn-primary")
		.addClass("btn-default");
	$("#ktaniBtnValue").val("madya");
	if ($("#ktaniTipeGrafik").val() == "bar") {
		barChart("laporanKelas", kab, kec, 0, "madya", startDate, endDate, desa, anggota);
	} else {
		pieChart("laporanKelas", kab, kec, 0, "madya", startDate, endDate, desa, anggota);
	}
});

$("#ktaniutama").on("click", function () {
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let desa = $("#desaValue").val();
	let anggota = $("#KelompokTaniValue").val();
	let startDate = $("#tglawal").val() === "" ? 0 : $("#tglawal").val();
	let endDate = $("#tglakhir").val() === "" ? 0 : $("#tglakhir").val();
	$(this).removeClass("btn-default").addClass("btn-primary");
	$("#ktanipemula,#ktanimadya,#ktanitotal")
		.removeClass("btn-primary")
		.addClass("btn-default");
	$("#ktaniBtnValue").val("utama");
	if ($("#ktaniTipeGrafik").val() == "bar") {
		barChart("laporanKelas", kab, kec, 0, "utama", startDate, endDate, desa, anggota);
	} else {
		pieChart("laporanKelas", kab, kec, 0, "utama", startDate, endDate, desa, anggota);
	}
});

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
	let startDate = $("#tglawallahan").val() === "" ? 0 : $("#tglawallahan").val();
	let endDate = $("#tglakhirlahan").val() === "" ? 0 : $("#tglakhirlahan").val();
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
		$(".keltani,#grafik,#grafikTani,#pieTani").show();
		$(".kellahan,#grafikLahan,#pieAnggota,#grafikPinjamPakai,#ktanipie").hide();
		barChart("laporanKelas", 0, 0, 0, "total", 0, 0);
	} else if ($(this).val() == "lahan") {
		$(".kellahan,#grafikLahan,#chartdivlahan,#ktanipie").show();
		$(".keltani,#grafik,#grafikTani,#pieTani,#pieAnggota,#grafikPinjamPakai").hide();
		barChartLahan(0, 0, "total", 0, 0);
		getBlokLahan(0);
	} else if ($(this).val() == "anggota") {
		pieChartAnggota();
		$("#pieAnggota").show();
		$(".kellahan,#grafik,#grafikLahan,#grafikTani,#pieTani,#chartdivlahan,#grafikPinjamPakai").hide();
	} else if ($(this).val() == "pinjampakai") {
		barChartPinjamPakai('kph');
		$('#grafikPinjamPakai').show();
		$(".kellahan,.keltani,#grafik,#grafikLahan,#grafikTani,#pieTani,#chartdivlahan,#pieAnggota").hide();
	}
});

// get data json tabel
$(document).on("click", "#tabel", function () {
	$("#ktaniTipeGrafik").val("tabel");
	let kab = $("#kabValue").val();
	let kec = $("#kecValue").val();
	let desa = $("#desaValue").val();
	getDataTable(kab, kec, desa);
});

function getDataTable(kab, kec, desa) {
	$.get(
		baseUrl + "home/laporanKelas/" + kab + "/" + kec + "/0/total/0/0/" + desa,
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
			} else if (kab != "0" && kec != "0" && desa == "0") {
				$("#namaTabel").html("Nama Desa");
			} else {
				$("#namaTabel").html("Nama Kelompok Tani");
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
	let des = $("#desaValue").val();
	window.location =
		baseUrl + "home/laporanKelas/" + kab + "/" + kec + "/0/total/0/0/" + des + "/0/excel";
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


// FUNGSI CHART 

function barChartTotal(jenis, kab, kec, cdk, tipe, startDate, endDate, desa, anggota) {
	$("#grafikTextTitle").text("Jumlah Semua Data Kelompok Tani");
	$("#grafikTextSubtitle").text("Data kelompok tani Pemula, Madya dan Utama");
	barChartTotalText(jenis, kab, kec, cdk, "total", startDate, endDate, desa, anggota);
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv", am4charts.XYChart);
		chart.scrollbarX = new am4core.Scrollbar();

		// Add data
		chart.dataSource.url = baseUrl + "/home/" + jenis + "/" + kab + "/" + kec + "/" + cdk + "/" + tipe + "/" + startDate + "/" + endDate + "/" + desa + "/" + anggota;
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
			return chart.colors.getIndex(5);
		});
		series3.columns.template.adapter.add("fill", function (fill, target) {
			return chart.colors.getIndex(10);
		});

		// Cursor
		chart.cursor = new am4charts.XYCursor();
	});
}

function barChartTotalText(jenis, kab, kec, cdk, tipe, startDate, endDate, desa, anggota) {
	$.get(baseUrl + "/home/" + jenis + "/" + kab + "/" + kec + "/" + cdk + "/" + tipe + "/" + startDate + "/" + endDate + "/" + desa + "/" + anggota,
		function (response) {
			let total = 0;
			let madya = 0;
			let pemula = 0;
			let utama = 0;
			for (let i in response) {
				total = total + response[i].pemula + response[i].madya + response[i].utama;
				madya = madya + response[i].madya;
				pemula = pemula + response[i].pemula;
				utama = utama + response[i].utama;
			}
			$("#textTotalKelompokTani").html("<b>" + total + "</b> kelompok tani");
			$("#textTotalKelompokTaniPemula").html(
				"<b>" + pemula + "</b> kelompok tani"
			);
			$("#textTotalKelompokTaniMadya").html(
				"<b>" + madya + "</b> kelompok tani"
			);
			$("#textTotalKelompokTaniUtama").html(
				"<b>" + utama + "</b> kelompok tani"
			);
		}
	);
}

function barChart(jenis, kab, kec, cdk, tipe, startDate, endDate, desa, anggota) {
	barChartTotalText(jenis, kab, kec, cdk, "total", startDate, endDate, desa, anggota);
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv", am4charts.XYChart);
		chart.scrollbarX = new am4core.Scrollbar();

		// Add data
		chart.dataSource.url = baseUrl + "/home/" + jenis + "/" + kab + "/" + kec + "/" + cdk + "/" + tipe + "/" + startDate + "/" + endDate + "/" + desa + "/" + anggota;
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
			return chart.colors.getIndex(1);
		});

		chart.cursor = new am4charts.XYCursor();
	});
}

function barChartTahun() {
	barChartTotalTahunText();
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
			return chart.colors.getIndex(1);
		});

		// Cursor
		chart.cursor = new am4charts.XYCursor();
	});
}

function barChartTotalTahunText() {
	$.get(baseUrl + "/home/laporankelastahun", function (response) {
		let total = 0;
		let tertinggi = 0;
		let terendah = 0;
		let tahun = 0;
		for (let i in response) {
			total = total + response[i].total;
			if (response[i].total > tertinggi) {
				tertinggi = response[i].total;
				tahuntertinggi = response[i].tahun;
			} else {
				terendah = response[i].total;
				if (response[i].tahun !== "0") {
					tahunterendah = response[i].tahun;
				}
			}
		}

		$("#textTotalKelompokTaniTahun").html("<b>" + total + "</b> kelompok tani");
		$("#textTotalKelompokTaniTahunTertinggi").html(
			"<b>" +
			tertinggi +
			"</b> kelompok tani <br> Tahun berdiri <b>" +
			tahuntertinggi +
			"</b>"
		);
		$("#textTotalKelompokTaniTahunTerendah").html(
			"<b>" +
			terendah +
			"</b> kelompok tani <br> Tahun berdiri <b>" +
			tahunterendah +
			"</b>"
		);
	});
}

// bar chart kepemilikan lahan
function barChartLahan(jenis, blok, filter, sdate, edate) {
	pieChartLahanTotal(jenis, blok, "total", sdate, edate);
	pieChartLahanTotal(jenis, blok, "lahan", sdate, edate);
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdivlahan", am4charts.XYChart);
		chart.scrollbarX = new am4core.Scrollbar();

		// Add data
		chart.dataSource.url = baseUrl + "/home/laporanKepemilikanLahan/" + jenis + "/" + blok + "/" + filter + "/" + sdate + "/" + edate;
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
			return chart.colors.getIndex(1);
		});

		chart.cursor = new am4charts.XYCursor();
	});
}

function pieChart(jenis, kab, kec, cdk, tipe, startDate, endDate) {
	// pie chart 1
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv", am4charts.PieChart);
		chart.dataSource.url = baseUrl + "/home/" + jenis + "/" + kab + "/" + kec + "/" + cdk + "/" + tipe + "/" + startDate + "/" + endDate;
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
	pieChartLahanTotal(jenis, blok, "total", sdate, edate);
	pieChartLahanTotal(jenis, blok, "lahan", sdate, edate);
	// pie chart 1
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdivlahan", am4charts.PieChart);
		// Add data
		chart.dataSource.url = baseUrl + "/home/laporanKepemilikanLahan/" + jenis + "/" + blok + "/" + filter + "/" + sdate + "/" + edate;
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
}

function pieChartLahanTotal(jenis, blok, filter, sdate, edate) {
	$.get(baseUrl + "/home/laporanKepemilikanLahan/" + jenis + "/" + blok + "/" + filter + "/" + sdate + "/" + edate,
		function (response) {
			if (filter === "total") {
				let persil = 0;
				for (let i in response) {
					persil = persil + response[i].total;
				}
				$("#textTotalLahanPersil").html("<b>" + persil + "</b> persil");
			} else {
				let lahan = 0;
				for (let i in response) {
					lahan = lahan + response[i].total;
				}
				$("#textTotalLahan").html(
					"<b>" + (lahan / 10000).toFixed(4) + "</b> Ha (Hektar)"
				);
			}
		}
	);
}

function pieChartTotal() {
	pieChartTotalFile();
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

function pieChartTotalFile() {
	$.get(baseUrl + "/home/laporankelasfile", function (response) {
		$("#textTotalKelompokTaniFile").html(
			"<b>" +
			(response[0].total +
				response[1].total +
				response[2].total +
				response[3].total) +
			"</b> File"
		);
		$("#textTotalKelompokTaniFileMenkumham").html(
			"<b>" + response[0].total + "</b> File"
		);
		$("#textTotalKelompokTaniFileAkta").html(
			"<b>" + response[1].total + "</b> File"
		);
		$("#textTotalKelompokTaniFileSk").html(
			"<b>" + response[2].total + "</b> File"
		);
		$("#textTotalKelompokTaniFileBa").html(
			"<b>" + response[3].total + "</b> File"
		);
	});
}

function pieChartAnggota() {
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdivpieanggota1", am4charts.PieChart);
		chart.dataSource.url = baseUrl + "/home/laporananggotakelompok/umur";
		chart.dataSource.updateCurrentData = true;

		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "name";
		pieSeries.slices.template.stroke = am4core.color("#fff");
		pieSeries.slices.template.strokeWidth = 2;
		pieSeries.slices.template.strokeOpacity = 1;

		// This creates initial animation
		pieSeries.hiddenState.properties.opacity = 1;
		pieSeries.hiddenState.properties.endAngle = -90;
		pieSeries.hiddenState.properties.startAngle = -90;
	});

	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdivpieanggota2", am4charts.PieChart);
		chart.dataSource.url = baseUrl + "/home/laporananggotakelompok/jk";
		chart.dataSource.updateCurrentData = true;

		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "name";
		pieSeries.slices.template.stroke = am4core.color("#fff");
		pieSeries.slices.template.strokeWidth = 2;
		pieSeries.slices.template.strokeOpacity = 1;

		// This creates initial animation
		pieSeries.hiddenState.properties.opacity = 1;
		pieSeries.hiddenState.properties.endAngle = -90;
		pieSeries.hiddenState.properties.startAngle = -90;
	});

	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdivpieanggota3", am4charts.PieChart);
		chart.dataSource.url = baseUrl + "/home/laporananggotakelompok/pendidikan";
		chart.dataSource.updateCurrentData = true;

		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "name";
		pieSeries.slices.template.stroke = am4core.color("#fff");

		// This creates initial animation
		pieSeries.hiddenState.properties.opacity = 1;
		pieSeries.hiddenState.properties.endAngle = -90;
		pieSeries.hiddenState.properties.startAngle = -90;
	});

	$.get(baseUrl + "/home/laporananggotakelompok/umur", function (response) {
		$("#textTotalAnggota").text(
			response[0].total +
			response[1].total +
			response[2].total +
			response[3].total +
			" anggota"
		);
		$("#textTotalAnggota17").text(response[0].total + " anggota");
		$("#textTotalAnggota35").text(response[1].total + " anggota");
		$("#textTotalAnggota50").text(response[2].total + " anggota");
		$("#textTotalAnggota51").text(response[3].total + " anggota");
	});

	$.get(baseUrl + "/home/laporananggotakelompok/jk", function (response) {
		$("#textTotalAnggotaJK").text(
			response[0].total + response[1].total + response[2].total + " anggota"
		);
		$("#textTotalAnggotaJKL").text(response[0].total + " anggota");
		$("#textTotalAnggotaJKP").text(response[1].total + " anggota");
		$("#textTotalAnggotaJKN").text(response[2].total + " anggota");
	});

	$.get(
		baseUrl + "/home/laporananggotakelompok/pendidikan",
		function (response) {
			let html = "";
			let total = 0;
			for (let i in response) {
				total = total + response[i].total;
				if (response[i].name != "") {
					$pendidikan = response[i].name;
				} else {
					$pendidikan = "Tidak diketahui";
				}

				html =
					'<div class="col-md-4">\
							<div class="card__anggota_total">\
								<span>' +
					$pendidikan +
					"</span>\
								<h3>" +
					response[i].total +
					" anggota</h3>\
							</div>\
						</div>";

				$("#resultAnggotaPP").append(html);
			}
			$("#textTotalAnggotaPP").text(total);
		}
	);
}

$('#selectPinjamPakai').on("change", function () {
	let jenis = $(this).val();
	barChartPinjamPakai(jenis);
});

function barChartPinjamPakai(jenis) {
	am4core.ready(function () {
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartdiv3", am4charts.PieChart);
		chart.dataSource.url = baseUrl + "/home/laporanPinjamPakai/0/0/" + jenis;
		chart.dataSource.updateCurrentData = true;

		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "nama";
		pieSeries.slices.template.stroke = am4core.color("#fff");
		pieSeries.slices.template.strokeWidth = 2;
		pieSeries.slices.template.strokeOpacity = 1;

		// This creates initial animation
		pieSeries.hiddenState.properties.opacity = 1;
		pieSeries.hiddenState.properties.endAngle = -90;
		pieSeries.hiddenState.properties.startAngle = -90;
	});

	// am4core.ready(function () {
	// 	am4core.useTheme(am4themes_animated);
	// 	var chart = am4core.create("chartdiv3", am4charts.XYChart);
	// 	chart.scrollbarX = new am4core.Scrollbar();

	// 	// Add data
	// 	chart.dataSource.url = baseUrl + "/home/laporanPinjamPakai/0/0/" + jenis;
	// 	chart.dataSource.updateCurrentData = true;

	// 	// Create axes
	// 	var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
	// 	categoryAxis.dataFields.category = "nama";
	// 	categoryAxis.renderer.grid.template.location = 0;
	// 	categoryAxis.renderer.minGridDistance = 30;
	// 	categoryAxis.renderer.labels.template.horizontalCenter = "right";
	// 	categoryAxis.renderer.labels.template.verticalCenter = "middle";
	// 	categoryAxis.renderer.labels.template.rotation = 270;
	// 	categoryAxis.tooltip.disabled = true;
	// 	categoryAxis.renderer.minHeight = 110;

	// 	var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
	// 	valueAxis.renderer.minWidth = 50;

	// 	// Create series
	// 	var series = chart.series.push(new am4charts.ColumnSeries());
	// 	series.sequencedInterpolation = true;
	// 	series.dataFields.valueY = "total";
	// 	series.dataFields.categoryX = "nama";
	// 	series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
	// 	series.columns.template.strokeWidth = 0;

	// 	series.tooltip.pointerOrientation = "vertical";

	// 	series.columns.template.column.cornerRadiusTopLeft = 10;
	// 	series.columns.template.column.cornerRadiusTopRight = 10;
	// 	series.columns.template.column.fillOpacity = 0.8;

	// 	// on hover, make corner radiuses bigger
	// 	var hoverState = series.columns.template.column.states.create("hover");
	// 	hoverState.properties.cornerRadiusTopLeft = 0;
	// 	hoverState.properties.cornerRadiusTopRight = 0;
	// 	hoverState.properties.fillOpacity = 1;

	// 	series.columns.template.adapter.add("fill", function (fill, target) {
	// 		return chart.colors.getIndex(1);
	// 	});

	// 	chart.cursor = new am4charts.XYCursor();
	// });

	$.get(baseUrl + "/home/laporanPinjamPakai/0/0/" + jenis,
		function (response) {
			let total = 0; let tertinggi = 0; let terendah = 0;
			let namaTertinggi = ''; let namaTerendah = ''; let title = '';

			for (let i in response) {
				total = total + response[i].total;
				if (response[i].total > tertinggi) {
					tertinggi = response[i].total;
					namaTertinggi = response[i].nama;
				} else {
					terendah = response[i].total;
					namaTerendah = response[i].nama;
				}
			}

			if (jenis == 'kph') {
				title = 'Unit Kerja';
			} else if (jenis == 'kawasan') {
				title = 'Kawasan';
			} else {
				title = 'Peruntukan';
			}

			$('#textTotalPinjamPakai').html(`<b>${total}</b> total data`);
			$('#textTotalPinjamPakaiTertinggi').html(`<b>${tertinggi}</b> ${title} <b>${namaTertinggi}</b>`);
			$('#textTotalPinjamPakaiTerendah').html(`<b>${terendah}</b> ${title} <b>${namaTerendah}</b>`);
		}
	);
}