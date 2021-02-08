<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pengukuhan Lahan</title>
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
        <h3>REKAP DATA <br> PENGUKUHAN KAWASAN HUTAN</h3><br>
    </div>
    <table>
        <tr>
            <td rowspan="3" style="text-align: center;"><b>No</b></td>
            <td rowspan="3" style="text-align: center;"><b>Nama Kawasan</b></td>
            <td colspan="2" style="text-align: center;"><b>SK.Penunjukan</b></td>
            <td colspan="4" style="text-align: center;"><b>Penataan Batas</b></td>
            <td rowspan="3" style="text-align: center;"><b>SK.Penetapan</b></td>
        </tr>
        <tr>
            <td rowspan="2" style="text-align: center;">Nomor</td>
            <td rowspan="2" style="text-align: center;">Tanggal</td>
            <td colspan="2" style="text-align: center;">Darat</td>
            <td colspan="2" style="text-align: center;">Perairan</td>
        </tr>
        <tr>
            <td>Luas (ha)</td><td>km</td><td>Luas (ha)</td><td>km</td>
        </tr>
        <?php $no=1; foreach($list as $a): ?>
        <tr>
            <td style="text-align: center;"><?=$no?></td>
            <td><?=$a->nama?></td>
            <td><?=$a->sk_penunjukan?></td>
            <td><?=date('d-m-Y', strtotime($a->tgl_penunjukan))?></td>
            <td style="text-align: center;"><?=$a->luas_darat?></td>
            <td></td>
            <td style="text-align: center;"><?=$a->luas_laut?></td>
            <td></td>
            <td><?=$a->sk_penetapan?></td>
        </tr>
        <?php $no++; endforeach; ?>
    </table>    
</body>
</html>