<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pinjam Pakai Kawasan Lahan</title>
    <style>
        body {
            font-family: arial;
            font-size: 11px;
        }
        .f14 {
            font-family: arial;
            font-size: 14px;
            padding-bottom: 20px;
        }
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #000;
        text-align: left;
        padding: 2px;
        vertical-align: top;
        }
    </style>
</head>
<body>
    <div id="center" class="f14">
        TABEL 5. REKAPITULASI DATA PINJAM PAKAI KAWASAN HUTAN PADA HUTAN LINDUNG DAN HUTAN PRODUKSI TAHUN <?= date('Y') ?>
    </div>
    <table>
        <tr>
            <td rowspan="2" style="text-align: center; vertical-align:middle">No.</td>
            <td rowspan="2" style="text-align: center; vertical-align:middle">Kab/Kota</td>
            <td colspan="2" style="text-align: center; vertical-align:middle">Kawasan hutan yang digunakan</td>
            <td rowspan="2" style="text-align: center; vertical-align:middle">Keterangan</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align:middle">Jumlah Lokasi</td>
            <td style="text-align: center; vertical-align:middle">Luas (ha)</td>
        </tr>

        <?php $totalLokasi = 0; $totalLuas = 0; $no=1; foreach($list as $a): ?>
        <tr>
            <td style="text-align: center;"><?=$no?>.</td>
            <td><?=$a->kab?></td>
            <td style="text-align: right;"><?=$a->jumlah_lokasi?></td>
            <td style="text-align: right;"><?=number_format($a->luas,2,',','.')?></td>
            <td></td>
        </tr>
        <?php $totalLokasi += $a->jumlah_lokasi; $totalLuas += $a->luas; $no++; endforeach; ?>
        <tr>
            <td colspan="2" style="text-align: center;">Jumlah</td>
            <td style="text-align: right;"><?=$totalLokasi?></td>
            <td style="text-align: right;"><?=number_format($totalLuas,2,',','.')?></td>
            <td></td>
        </tr>
    </table>  
    <div id="center" style="padding-top: 5px;">
        <i>Sumber: Dinas Kehutanan Provinsi Jawa Barat, Perum Perhutani Divisi Regional Jawa Barat dan Banten</i>
    </div>  
</body>
</html>