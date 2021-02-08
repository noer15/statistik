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
        <h3>REKAP DATA <br> PRODUKSI OLAHAN HASIL HUTAN</h3><br>
    </div>
    <table>
        <tr>
            <td style="text-align: center;">No</td>
            <td style="text-align: center;">Nama Industri</td>
            <td style="text-align: center;">Jenis Olahan</td>
            <td style="text-align: center;">Jumlah</td>
            <td style="text-align: center;">Tanggal</td>
            <td style="text-align: center;">Keterangan</td>
        </tr>

        <?php $jumlah = 0; $no=1; foreach($list as $a): ?>
        <tr>
            <td style="text-align: center;"><?=$no?></td>
            <td><?=$a->industri?></td>
            <td><?=$a->olahan?></td>
            <td><?=number_format($a->jumlah,0,'.','.')?></td>
            <td><?=date('F', strtotime($a->bulan))?> <?=$a->tahun?></td>
            <td></td>
        </tr>
        <?php $jumlah += $a->jumlah; $no++; endforeach; ?>
        <tr>
            <td colspan="3">Jumlah</td>
            <td colspan="3"><?=number_format($jumlah,0,'.','.')?></td>
        </tr>
    </table>    
</body>
</html>