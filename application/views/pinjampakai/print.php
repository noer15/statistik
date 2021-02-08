<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pinjam Pakai Kawasan Lahan</title>
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
        <h3>REKAP DATA <br> PINJAM PAKAI KAWASAN HUTAN</h3><br>
    </div>
    <table>
        <tr>
            <td rowspan="2" style="text-align: center;">No</td>
            <td rowspan="2" style="text-align: center;">KPH</td>
            <td colspan="2" style="text-align: center;">Kawasan hutan yang digunakan</td>
            <td rowspan="2" style="text-align: center;">Keterangan</td>
        </tr>
        <tr>
            <td style="text-align: center;">Jumlah Lokasi</td>
            <td style="text-align: center;">Luas (Ha)</td>
        </tr>

        <?php $totalLokasi = 0; $totalLuas = 0; $no=1; foreach($list as $a): ?>
        <tr>
            <td style="text-align: center;"><?=$no?></td>
            <td><?=$a->kab?></td>
            <td><?=$a->jumlah_lokasi?></td>
            <td><?=$a->luas?></td>
            <td></td>
        </tr>
        <?php $totalLokasi += $a->jumlah_lokasi; $totalLuas += $a->luas; $no++; endforeach; ?>
        <tr>
            <td colspan="2">Jumlah</td>
            <td><?=$totalLokasi?></td>
            <td><?=$totalLuas?></td>
            <td></td>
        </tr>
    </table>    
</body>
</html>