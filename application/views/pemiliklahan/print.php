<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Kepemilikan Lahan</title>
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
        padding: 5px;
        vertical-align: top;
        }
    </style>
</head>
<body>
    <div id="center" class="f14">
        TABEL x KEPEMILIKAN LAHAN <?=DATE('Y')?>
    </div>
    <table>
        <tr>
            <td rowspan="3" style="text-align: center; vertical-align:middle">No.</td>
            <td rowspan="3" style="text-align: center; vertical-align:middle">Kab/Kota</td>
            <td rowspan="3" style="text-align: center; vertical-align:middle">Pemilik Lahan</td>
            <td colspan="6" style="text-align: center;">Kepemilikan Lahan</td>
            <td colspan="2" rowspan="2" style="text-align: center; vertical-align:middle">Total</td>
            <td colspan="2" rowspan="2" style="text-align: center; vertical-align:middle">Rata-rata</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">Letter C/Girik</td>
            <td colspan="2" style="text-align: center;">AJB</td>
            <td colspan="2" style="text-align: center;">Sertifikat</td>
        </tr>
        <tr>
            <td style="text-align: center;">Persil</td>
            <td style="text-align: center;">Luas (ha)</td>
            <td style="text-align: center;">Persil</td>
            <td style="text-align: center;">Luas (ha)</td>
            <td style="text-align: center;">Persil</td>
            <td style="text-align: center;">Luas (ha)</td>
            <td style="text-align: center;">Persil</td>
            <td style="text-align: center;">Luas (ha)</td>
            <td style="text-align: center;">Persil</td>
            <td style="text-align: center;">Luas (ha)</td>
        </tr>

        <?php 
        $persil_c = 0; $luas_c = 0;
        $persil_ajb = 0; $luas_ajb = 0; 
        $persil_st = 0; $luas_st = 0;
        $persil_total = 0; $luas_total = 0;
        $total_persil = 0; $total_luas = 0;
        $total_pemilik = 0;
        $no=1; 
        foreach($list as $data):
            $total_persil = $data->persil_c + $data->persil_ajb + $data->persil_sertifikat;
            $total_luas = $data->luas_c + $data->luas_ajb + $data->luas_sertifikat;
        ?>
        <tr>
            <td style="text-align: center;"><?=$no?>.</td>
            <td><?=$data->kabupaten?></td>
            <td style="text-align: right;"><?=$data->pemilik_lahan > 0 ? number_format($data->pemilik_lahan,0,'.','.') : '-'?></td>
            <td style="text-align: right;"><?=$data->persil_c > 0 ? number_format($data->persil_c,0,'.','.') : '-' ?></td>
            <td style="text-align: right;"><?=$data->luas_c > 0 ? number_format($data->luas_c,2,',','.') : '-'?></td>
            <td style="text-align: right;"><?=$data->persil_ajb > 0 ? number_format($data->persil_ajb,0,'.','.') : '-' ?></td>
            <td style="text-align: right;"><?=$data->luas_ajb > 0 ? number_format($data->luas_ajb,2,',','.') : '-' ?></td>
            <td style="text-align: right;"><?=$data->persil_sertifikat > 0 ? number_format($data->persil_sertifikat,0,'.','.') : '-' ?></td>
            <td style="text-align: right;"><?=$data->luas_sertifikat > 0 ? number_format($data->luas_sertifikat,2,',','.') : '-' ?></td>
            <td style="text-align: right;"><?=$total_persil > 0 ? number_format($total_persil,0,'.','.') : '-'?></td>
            <td style="text-align: right;"><?=$total_luas > 0 ? number_format($total_luas,2,',','.'):'-'?></td>
            <td style="text-align: right;"><?=$total_persil > 0 ? number_format($total_persil / $data->pemilik_lahan,2,',','.') : '-'?></td>
            <td style="text-align: right;"><?=$total_luas > 0 ? number_format($total_luas  / $data->pemilik_lahan,2,',','.'):'-'?></td>
        </tr>
        <?php 
        $persil_c += $data->persil_c; 
        $luas_c += $data->luas_c;
        $persil_ajb += $data->persil_ajb; 
        $luas_ajb += $data->luas_ajb; 
        $persil_st += $data->persil_sertifikat; 
        $luas_st += $data->luas_sertifikat;
        $persil_total += $data->persil_c + $data->persil_ajb + $data->persil_sertifikat; 
        $luas_total += $data->luas_c + $data->luas_ajb + $data->luas_sertifikat;
        $total_pemilik += $data->pemilik_lahan;
        $no++; 
        endforeach; ?>
        <tr>
            <td colspan="2">Jumlah</td>
            <td style="text-align: right;"><?=$total_pemilik > 0 ? number_format($total_pemilik,0,'.','.') : '-' ?></td>
            <td style="text-align: right;"><?=$persil_c > 0 ? number_format($persil_c,0,'.','.') : '-' ?></td>
            <td style="text-align: right;"><?=$luas_c > 0 ? number_format($luas_c,2,',','.') : '-'?></td>
            <td style="text-align: right;"><?=$persil_ajb > 0 ? number_format($persil_ajb,0,'.','.') : '-'?></td>
            <td style="text-align: right;"><?=$luas_ajb > 0 ? number_format($luas_ajb,2,',','.') : '-'?></td>
            <td style="text-align: right;"><?=$persil_st > 0 ? number_format($persil_st,0,'.','.') : '-'?></td>
            <td style="text-align: right;"><?=$luas_st > 0 ? number_format($luas_st,2,',','.') : '-'?></td>
            <td style="text-align: right;"><?=$persil_total > 0 ? number_format($persil_total,0,'.','.') : '-'?></td>
            <td style="text-align: right;"><?=$luas_total > 0 ? number_format($luas_total,2,',','.') : '-'?></td>
            <td style="text-align: right;"><?=$persil_total > 0 ? number_format($persil_total / $total_pemilik,2,',','.'): '-'?></td>
            <td style="text-align: right;"><?=$luas_total > 0 ? number_format($luas_total / $total_pemilik,2,',','.') : '-'?></td>
        </tr>
    </table>    
</body>
</html>