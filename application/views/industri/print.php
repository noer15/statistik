<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Produksi Olahan Hasil Hutan</title>
    <style>
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #000;
        text-align: left;
        padding: 5px;
        }
    </style>
</head>
<body>
    <div id="center" style="text-align: center;">
        <h3>REKAP DATA <br> INDUSTRI SEKTOR KEHUTAN</h3><br>
    </div>
    <table>
        <tr>
            <td style="text-align: center;">No</td>
            <td style="text-align: center;">Kabupaten/Kota</td>
            <td style="text-align: center;">Jumlah Industri</td>
            <td style="text-align: center;">Luas Kapasitas Izin</td>
        </tr>

        <?php $jumlah = 0; $industri = 0; $no=1; foreach($list as $a): ?>
        <tr>
            <td style="text-align: center;"><?=$no?></td>
            <td><?=$a->nama?></td>
            <td><?=$a->total?></td>
            <td><?=number_format($a->jumlah,0,'.','.')?></td>
        </tr>
        <?php $jumlah += $a->jumlah; $industri += $a->total; $no++; endforeach; ?>
        <tr>
            <td colspan="2">Jumlah</td>
            <td><?=number_format($industri,0,'.','.')?></td>
            <td><?=number_format($jumlah,0,'.','.')?></td>
        </tr>
    </table>    
</body>
</html>