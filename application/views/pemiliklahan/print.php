<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Kepemilikan Lahan</title>
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
        <h3>REKAP DATA <br> KEPEMILIKAN LAHAN</h3><br>
    </div>
    <table>
        <tr>
            <td rowspan="2" style="text-align: center;">No</td>
            <td rowspan="2" style="text-align: center;">Jenis Sertifikat</td>
            <td colspan="2" style="text-align: center;">Jumlah kepemilikan lahan</td>
            <td rowspan="2" style="text-align: center;">Persentase</td>
            <td rowspan="2" style="text-align: center;">Keterangan</td>
        </tr>
        <tr>
            <td style="text-align: center;">Jumlah Persil</td>
            <td style="text-align: center;">Luas Lahan (Ha)</td>
        </tr>

        <?php $totalPersil = 0; $totalLuas = 0; $no=1; foreach($list as $data): ?>
        <tr>
            <td style="text-align: center;"><?=$no?></td>
            <td><?=$data->nama?></td>
            <td><?=$data->persil?></td>
            <td><?=$data->luas_lahan?></td>
            <td><?= round(($data->persil / $data->total) * 100, 2)?>%</td>
            <td></td>
        </tr>
        <?php $totalPersil += $data->persil; $totalLuas += $data->luas_lahan; $no++; endforeach; ?>
        <tr>
            <td colspan="2">Jumlah</td>
            <td><?=$totalPersil?></td>
            <td><?=$totalLuas?></td>
            <td colspan="2"></td>
        </tr>

    </table>    
</body>
</html>