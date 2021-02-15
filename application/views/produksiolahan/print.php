<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Produksi Olahan Hasil Hutan</title>
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
        TABEL 15.1 PRODUKSI OLAHAN HASIL HUTAN KAYU TAHUN <?=DATE('Y')?>
    </div>
    <table> <!-- tinggal bagian kin -->
        <tr>
            <td style="text-align: center; vertical-align:middle" rowspan="3">No.</td>
            <td style="text-align: center; vertical-align:middle" rowspan="3">Kab/Kota</td>
            <td style="text-align: center;" colspan="<?= count((array)$jenis) * 2?>">Jenis Olahan Hasil Hutan Kayu</td>
        </tr>
        <tr>
            <?php foreach($jenis as $jenis): ?>
            <td colspan="2" style="text-align: center;"><?=$jenis->nama?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td style="text-align: center;">Unit</td>
            <td style="text-align: center;">Produksi (m<sup>3</sup>)</td>
            <?php endfor; ?>
        </tr>

        <tr>
            <td style="text-align: left;">I</td>
            <td>CDK WILAYAH I</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>
        <?php $no=1; foreach($list as $a): ?>
            <?php if($a->idkab == 1 || $a->idkab == 18 || $a->idkab == 23 || $a->idkab == 16 || $a->idkab == 22): ?>
            <tr>
                <td style="text-align: right;"><?=$no?>.</td>
                <td><?=$a->namakab?></td>
                <?php $index = 1; 
                for($j=0; $j < count((array)$jenis)*2; $j++): ?>
                <td style="text-align: right;"><?= $a->{"unit_$index"} > 0 ? number_format($a->{"unit_$index"},0,'.','.') : '-'?></td>
                <td style="text-align: right;"><?= $a->{"jumlah_$index"} > 0 ? number_format($a->{"jumlah_$index"},2,',','.') : '-'?></td>
                <?php $idx = 1; $index++; endfor; ?>
            </tr>
            <?php $no++; endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>

        <tr>
            <td style="text-align: left;">II</td>
            <td>CDK WILAYAH II</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>
        <?php foreach($list as $a): ?>
            <?php if($a->idkab == 13 || $a->idkab == 14 || $a->idkab == 15): ?>
            <tr>
                <td style="text-align: right;"><?=$no?>.</td>
                <td><?=$a->namakab?></td>
                <?php $index = 1; for($j=0; $j < count((array)$jenis)*2; $j++): ?>
                <td style="text-align: right;"><?= $a->{"unit_$index"} > 0 ? number_format($a->{"unit_$index"},0,'.','.') : '-'?></td>
                <td style="text-align: right;"><?= $a->{"jumlah_$index"} > 0 ? number_format($a->{"jumlah_$index"},2,',','.') : '-'?></td>
                <?php $idx = 1; $index++; endfor; ?>
            </tr>
            <?php $no++; endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>

        <tr>
            <td style="text-align: left;">III</td>
            <td>CDK WILAYAH III</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>
        <?php foreach($list as $a): ?>
            <?php if($a->idkab == 2 || $a->idkab == 19): ?>
            <tr>
                <td style="text-align: right;"><?=$no?>.</td>
                <td><?=$a->namakab?></td>
                <?php $index = 1; for($j=0; $j < count((array)$jenis)*2; $j++): ?>
                <td style="text-align: right;"><?= $a->{"unit_$index"} > 0 ? number_format($a->{"unit_$index"},0,'.','.') : '-'?></td>
                <td style="text-align: right;j"><?= $a->{"jumlah_$index"} > 0 ? number_format($a->{"jumlah_$index"},2,',','.') : '-'?></td>
                <?php $idx = 1; $index++; endfor; ?>
            </tr>
            <?php $no++; endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>

        <tr>
            <td style="text-align: left;">IV</td>
            <td>CDK WILAYAH IV</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>
        <?php foreach($list as $a): ?>
            <?php if($a->idkab == 3 || $a->idkab == 17 || $a->idkab == 24): ?>
            <tr>
                <td style="text-align: right;"><?=$no?>.</td>
                <td><?=$a->namakab?></td>
                <?php $index = 1; for($j=0; $j < count((array)$jenis)*2; $j++): ?>
                <td style="text-align: right;"><?= $a->{"unit_$index"} > 0 ? number_format($a->{"unit_$index"},0,'.','.') : '-'?></td>
                <td style="text-align: right;"><?= $a->{"jumlah_$index"} > 0 ? number_format($a->{"jumlah_$index"},2,',','.') : '-'?></td>
                <?php 
                $idx = 1; $index++;endfor; ?>
            </tr>
            <?php $no++; endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>

        <tr>
            <td style="text-align: left;">V</td>
            <td>CDK WILAYAH V</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>
        <?php foreach($list as $a): ?>
            <?php if($a->idkab == 4 || $a->idkab == 5 || $a->idkab == 20): ?>
            <tr>
                <td style="text-align: right;"><?=$no?>.</td>
                <td><?=$a->namakab?></td>
                <?php $index = 1; for($j=0; $j < count((array)$jenis)*2; $j++): ?>
                <td style="text-align: right;"><?= $a->{"unit_$index"} > 0 ? number_format($a->{"unit_$index"},0,'.','.') : '-'?></td>
                <td style="text-align: right;"><?= $a->{"jumlah_$index"} > 0 ? number_format($a->{"jumlah_$index"},2,',','.') : '-'?></td>
                <?php $idx = 1; $index++; endfor; ?>
            </tr>
            <?php $no++; endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>

        <tr>
            <td style="text-align: left;">VI</td>
            <td>CDK WILAYAH VI</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>
        <?php foreach($list as $a): ?>
            <?php if($a->idkab == 6 || $a->idkab == 25): ?>
            <tr>
                <td style="text-align: right;"><?=$no?>.</td>
                <td><?=$a->namakab?></td>
                <?php $index = 1; for($j=0; $j < count((array)$jenis)*2; $j++): ?>
                <td style="text-align: right;"><?= $a->{"unit_$index"} > 0 ? number_format($a->{"unit_$index"},0,'.','.') : '-'?></td>
                <td style="text-align: right;"><?= $a->{"jumlah_$index"} > 0 ? number_format($a->{"jumlah_$index"},2,',','.') : '-'?></td>
                <?php $idx = 1; $index++; endfor; ?>
            </tr>
            <?php $no++; endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>

        <tr>
            <td style="text-align: left;">VII</td>
            <td>CDK WILAYAH VII</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>
        <?php $idx = 1; for($i=0; $i < count((array)$jenis)*2; $i++): ${"cdk7_unit_$idx"} = 0; ${"cdk7_jumlah_$idx"} = 0; $idx++; endfor; foreach($list as $a): ?>
            <?php if($a->idkab == 7 || $a->idkab == 26 || $a->idkab == 27): ?>
            <tr>
                <td style="text-align: right;"><?=$no?>.</td>
                <td><?=$a->namakab?></td>
                <?php $index = 1; for($j=0; $j < count((array)$jenis)*2; $j++): ?>
                <td style="text-align: right;"><?= $a->{"unit_$index"} > 0 ? number_format($a->{"unit_$index"},0,'.','.') : '-'?></td>
                <td style="text-align: right;"><?= $a->{"jumlah_$index"} > 0 ? number_format($a->{"jumlah_$index"},2,',','.') : '-'?></td>
                <?php $idx = 1; $index++; endfor; ?>
            </tr>
            <?php $no++; endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>

        <tr>
            <td style="text-align: left;">VIII</td>
            <td>CDK WILAYAH VIII</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>
        <?php $idx = 1;foreach($list as $a): ?>
            <?php if($a->idkab == 8 || $a->idkab == 9 || $a->idkab == 10 || $a->idkab == 21): ?>
            <tr>
                <td style="text-align: right;"><?=$no?>.</td>
                <td><?=$a->namakab?></td>
                <?php $index = 1; for($j=0; $j < count((array)$jenis)*2; $j++): ?>
                <td style="text-align: right;"><?= $a->{"unit_$index"} > 0 ? number_format($a->{"unit_$index"},0,'.','.') : '-'?></td>
                <td style="text-align: right;"><?= $a->{"jumlah_$index"} > 0 ? number_format($a->{"jumlah_$index"},2,',','.') : '-'?></td>
                <?php $idx = 1; $index++; endfor; ?>
            </tr>
            <?php $no++; endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>

        <tr>
            <td style="text-align: left;">IX</td>
            <td>CDK WILAYAH IX</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor; ?>
        </tr>
        <?php foreach($list as $a): ?>
            <?php if($a->idkab == 11 || $a->idkab == 12): ?>
            <tr>
                <td style="text-align: right;"><?=$no?>.</td>
                <td><?=$a->namakab?></td>
                <?php $index = 1; for($j=0; $j < count((array)$jenis)*2; $j++): ?>
                <td style="text-align: right;"><?= $a->{"unit_$index"} > 0 ? number_format($a->{"unit_$index"},0,'.','.') : '-'?></td>
                <td style="text-align: right;"><?= $a->{"jumlah_$index"} > 0 ? number_format($a->{"jumlah_$index"},2,',','.') : '-'?></td>
                <?php $idx = 1; $index++; endfor; ?>
            </tr>
            <?php $no++; endif; ?>
        <?php endforeach; ?>
        
        <tr>
            <td colspan="2" style="text-align: center;">Jumlah</td>
            <?php foreach($total as $total): ?>
            <td style="text-align: right;"><?=$total->industri > 0 ? number_format($total->industri,0,'.','.') : '-' ?></td>
            <td style="text-align: right;"><?=$total->jumlah > 0 ? number_format($total->jumlah,2,',','.') : '-' ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
    <div id="center" style="padding-top: 5px;">
        <i>Sumber: Dinas Kehutanan Provinsi Jawa Barat</i>
    </div> 
</body>
</html>