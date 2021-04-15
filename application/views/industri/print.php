<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Industri Hasil Hutan</title>
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
        TABEL 16. IZIN USAHA INDUSTRI PRIMER HASIL HUTAN KAYU (IUIPHHK) DI JAWA BARAT S/D TAHUN <?=date('Y')?>
    </div>
    <table>
        <tr>
            <td rowspan="2" style="text-align: center; vertical-align:middle">No.</td>
            <td rowspan="2" style="text-align: center; vertical-align:middle">Kabupaten/Kota</td>
            <td colspan="3" style="text-align: center;">Kapasitas Izin Produksi (unit)</td>
            <td rowspan="2" style="text-align: center; vertical-align:middle">Jumlah (unit)</td>
        </tr>
        <tr>
            <td>s/d 2.000 <br> m<sup>3</sup>/tahun</td>
            <td>Diatas 2.000 s/d <br> 6.000 m<sup>3</sup>/tahun</td>
            <td>Diatas 6.000 <br> m<sup>3</sup>/tahun</td>
        </tr>

        <tr><td style="text-align: left;">I</td><td>CDK WILAYAH I</td><td></td><td></td><td></td><td></td></tr>
        <?php $m2 = 0; $m26 = 0; $m6 = 0; $total = 0; $no=1; foreach($list as $a): ?>
        <?php if($a->id == 1 || $a->id == 18 || $a->id == 23 || $a->id == 16 || $a->id == 22): ?>
        <tr>
            <td style="text-align: right;"><?=$no?>.</td>
            <td><?=$a->nama?></td>
            <td style="text-align: right;"><?=$a->m2 > 0 ? $a->m2 : '-'?></td>
            <td style="text-align: right;"><?=$a->m26 > 0 ? $a->m26 : '-'?></td>
            <td style="text-align: right;"><?=$a->m6 > 0 ? $a->m6 : '-'?></td>
            <td style="text-align: right;"><?=($a->m2 + $a->m26 + $a->m6) > 0 ? $a->m2 + $a->m26 + $a->m6 : '-' ?></td>
        </tr>
        <?php $no++; $m2 += $a->m2; $m26 += $a->m26; $m6 += $a->m6; $total += ($a->m2+$a->m26+$a->m6); endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>


        <tr><td style="text-align: left;">II</td><td>CDK WILAYAH II</td><td></td><td></td><td></td><td></td></tr>
        <?php foreach($list as $a): ?>
        <?php if($a->id == 13 || $a->id == 14 || $a->id == 15): ?>
        <tr>
            <td style="text-align: right;"><?=$no?>.</td>
            <td><?=$a->nama?></td>
            <td style="text-align: right;"><?=$a->m2 > 0 ? $a->m2 : '-'?></td>
            <td style="text-align: right;"><?=$a->m26 > 0 ? $a->m26 : '-'?></td>
            <td style="text-align: right;"><?=$a->m6 > 0 ? $a->m6 : '-'?></td>
            <td style="text-align: right;"><?=($a->m2 + $a->m26 + $a->m6) > 0 ? $a->m2 + $a->m26 + $a->m6 : '-' ?></td>
        </tr>
        <?php $no++; $m2 += $a->m2; $m26 += $a->m26; $m6 += $a->m6; $total += ($a->m2+$a->m26+$a->m6); endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr><td style="text-align: left;">III</td><td>CDK WILAYAH III</td><td></td><td></td><td></td><td></td></tr>
        <?php foreach($list as $a): ?>
        <?php if($a->id == 2 || $a->id == 19 ): ?>
        <tr>
            <td style="text-align: right;"><?=$no?>.</td>
            <td><?=$a->nama?></td>
            <td style="text-align: right;"><?=$a->m2 > 0 ? $a->m2 : '-'?></td>
            <td style="text-align: right;"><?=$a->m26 > 0 ? $a->m26 : '-'?></td>
            <td style="text-align: right;"><?=$a->m6 > 0 ? $a->m6 : '-'?></td>
            <td style="text-align: right;"><?=($a->m2 + $a->m26 + $a->m6) > 0 ? $a->m2 + $a->m26 + $a->m6 : '-' ?></td>
        </tr>
        <?php $no++; $m2 += $a->m2; $m26 += $a->m26; $m6 += $a->m6; $total += ($a->m2+$a->m26+$a->m6); endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr><td style="text-align: left;">IV</td><td>CDK WILAYAH IV</td><td></td><td></td><td></td><td></td></tr>
        <?php foreach($list as $a): ?>
        <?php if($a->id == 3 || $a->id == 17 || $a->id == 24): ?>
        <tr>
            <td style="text-align: right;"><?=$no?>.</td>
            <td><?=$a->nama?></td>
            <td style="text-align: right;"><?=$a->m2 > 0 ? $a->m2 : '-'?></td>
            <td style="text-align: right;"><?=$a->m26 > 0 ? $a->m26 : '-'?></td>
            <td style="text-align: right;"><?=$a->m6 > 0 ? $a->m6 : '-'?></td>
            <td style="text-align: right;"><?=($a->m2 + $a->m26 + $a->m6) > 0 ? $a->m2 + $a->m26 + $a->m6 : '-' ?></td>
        </tr>
        <?php $no++; $m2 += $a->m2; $m26 += $a->m26; $m6 += $a->m6; $total += ($a->m2+$a->m26+$a->m6); endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr><td style="text-align: left;">V</td><td>CDK WILAYAH V</td><td></td><td></td><td></td><td></td></tr>
        <?php foreach($list as $a): ?>
        <?php if($a->id == 4 || $a->id == 5 || $a->id == 20): ?>
        <tr>
            <td style="text-align: right;"><?=$no?>.</td>
            <td><?=$a->nama?></td>
            <td style="text-align: right;"><?=$a->m2 > 0 ? $a->m2 : '-'?></td>
            <td style="text-align: right;"><?=$a->m26 > 0 ? $a->m26 : '-'?></td>
            <td style="text-align: right;"><?=$a->m6 > 0 ? $a->m6 : '-'?></td>
            <td style="text-align: right;"><?=($a->m2 + $a->m26 + $a->m6) > 0 ? $a->m2 + $a->m26 + $a->m6 : '-' ?></td>
        </tr>
        <?php $no++; $m2 += $a->m2; $m26 += $a->m26; $m6 += $a->m6; $total += ($a->m2+$a->m26+$a->m6); endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr><td style="text-align: left;">VI</td><td>CDK WILAYAH VI</td><td></td><td></td><td></td><td></td></tr>
        <?php foreach($list as $a): ?>
        <?php if($a->id == 6 || $a->id == 25): ?>
        <tr>
            <td style="text-align: right;"><?=$no?>.</td>
            <td><?=$a->nama?></td>
            <td style="text-align: right;"><?=$a->m2 > 0 ? $a->m2 : '-'?></td>
            <td style="text-align: right;"><?=$a->m26 > 0 ? $a->m26 : '-'?></td>
            <td style="text-align: right;"><?=$a->m6 > 0 ? $a->m6 : '-'?></td>
            <td style="text-align: right;"><?=($a->m2 + $a->m26 + $a->m6) > 0 ? $a->m2 + $a->m26 + $a->m6 : '-' ?></td>
        </tr>
        <?php $no++; $m2 += $a->m2; $m26 += $a->m26; $m6 += $a->m6; $total += ($a->m2+$a->m26+$a->m6); endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr><td style="text-align: left;">VII</td><td>CDK WILAYAH VII</td><td></td><td></td><td></td><td></td></tr>
        <?php foreach($list as $a): ?>
        <?php if($a->id == 7 || $a->id == 26 || $a->id == 27): ?>
        <tr>
            <td style="text-align: right;"><?=$no?>.</td>
            <td><?=$a->nama?></td>
            <td style="text-align: right;"><?=$a->m2 > 0 ? $a->m2 : '-'?></td>
            <td style="text-align: right;"><?=$a->m26 > 0 ? $a->m26 : '-'?></td>
            <td style="text-align: right;"><?=$a->m6 > 0 ? $a->m6 : '-'?></td>
            <td style="text-align: right;"><?=($a->m2 + $a->m26 + $a->m6) > 0 ? $a->m2 + $a->m26 + $a->m6 : '-' ?></td>
        </tr>
        <?php $no++; $m2 += $a->m2; $m26 += $a->m26; $m6 += $a->m6; $total += ($a->m2+$a->m26+$a->m6); endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr><td style="text-align: left;">VIII</td><td>CDK WILAYAH VIII</td><td></td><td></td><td></td><td></td></tr>
        <?php foreach($list as $a): ?>
        <?php if($a->id == 8 || $a->id == 9 || $a->id == 10 || $a->id == 21): ?>
        <tr>
            <td style="text-align: right;"><?=$no?>.</td>
            <td><?=$a->nama?></td>
            <td style="text-align: right;"><?=$a->m2 > 0 ? $a->m2 : '-'?></td>
            <td style="text-align: right;"><?=$a->m26 > 0 ? $a->m26 : '-'?></td>
            <td style="text-align: right;"><?=$a->m6 > 0 ? $a->m6 : '-'?></td>
            <td style="text-align: right;"><?=($a->m2 + $a->m26 + $a->m6) > 0 ? $a->m2 + $a->m26 + $a->m6 : '-' ?></td>
        </tr>
        <?php $no++; $m2 += $a->m2; $m26 += $a->m26; $m6 += $a->m6; $total += ($a->m2+$a->m26+$a->m6); endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr><td style="text-align: left;">IX</td><td>CDK WILAYAH IX</td><td></td><td></td><td></td><td></td></tr>
        <?php foreach($list as $a): ?>
        <?php if($a->id == 11 || $a->id == 12): ?>
        <tr>
            <td style="text-align: right;"><?=$no?>.</td>
            <td><?=$a->nama?></td>
            <td style="text-align: right;"><?=$a->m2 > 0 ? $a->m2 : '-'?></td>
            <td style="text-align: right;"><?=$a->m26 > 0 ? $a->m26 : '-'?></td>
            <td style="text-align: right;"><?=$a->m6 > 0 ? $a->m6 : '-'?></td>
            <td style="text-align: right;"><?=($a->m2 + $a->m26 + $a->m6) > 0 ? $a->m2 + $a->m26 + $a->m6 : '-' ?></td>
        </tr>
        <?php $no++; $m2 += $a->m2; $m26 += $a->m26; $m6 += $a->m6; $total += ($a->m2+$a->m26+$a->m6); endif; ?>

        <?php endforeach; ?>

        <tr>
            <td colspan="2" style="text-align: center;">Jumlah</td>
            <td style="text-align: right;"><?=number_format($m2,0,'.','.')?></td>
            <td style="text-align: right;"><?=number_format($m26,0,'.','.')?></td>
            <td style="text-align: right;"><?=number_format($m6,0,'.','.')?></td>
            <td style="text-align: right;"><?=number_format($total,0,'.','.')?></td>
        </tr>
    </table>    
    <div id="center" style="padding-top: 5px;">
        <i>Sumber: Dinas Kehutanan Provinsi Jawa Barat</i>
    </div> 
</body>
</html>