<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pengukuhan Lahan</title>
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
        TABEL 3. PERKEMBANGAN PENGUKUHAN KAWASAN KONSERVASI PER NAMA KAWASAN DI JAWA BARAT TAHUN <?=DATE('Y')?>
    </div>
    <table>
        <tr>
            <td rowspan="3" style="text-align: center; vertical-align:middle">No.</td>
            <td rowspan="3" style="text-align: center; vertical-align:middle">Nama Kawasan</td>
            <td rowspan="3" style="text-align: center; vertical-align:middle">Kab/Kota</td>
            <td colspan="2" style="text-align: center; vertical-align:middle">SK. Penunjukan</td>
            <td colspan="4" style="text-align: center; vertical-align:middle">Penataan Batas</td>
            <td rowspan="3" style="text-align: center; vertical-align:middle">SK. Penetapan</td>
        </tr>
        <tr>
            <td rowspan="2" style="text-align: center; vertical-align:middle">Nomor</td>
            <td rowspan="2" style="text-align: center; vertical-align:middle">Tanggal</td>
            <td colspan="2" style="text-align: center; vertical-align:middle">Darat</td>
            <td colspan="2" style="text-align: center; vertical-align:middle">Perairan</td>
        </tr>
        <tr>
            <td style="text-align: center;">Luas (ha)</td>
            <td style="text-align: center;">km</td>
            <td style="text-align: center;">Luas (ha)</td>
            <td style="text-align: center;">km</td>
        </tr>

        <tr>
            <td style="text-align: center;">A.</td><td>Taman Nasional</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <?php $no=1; foreach($list as $a): ?>
            <?php if(strlen(strstr($a->nama, 'Taman Nasional')) > 0): ?>
                <tr>
                    <td style="text-align: center;"><?=$no?>.</td>
                    <td><?=$a->nama?></td>
                    <td><?=$a->kabupaten?></td>
                    <td><?=$a->sk_penunjukan?></td>
                    <td><?=date('d-m-Y', strtotime($a->tgl_penunjukan))?></td>
                    <td style="text-align: right;"><?=$a->luas_darat > 0 ? number_format($a->luas_darat,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;"><?=$a->luas_laut > 0 ? number_format($a->luas_laut,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td><?=$a->sk_penetapan?></td>
                </tr>
            <?php $no++;  endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr>
            <td style="text-align: center;">B.</td><td>Cagar Alam</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <?php $no=1; foreach($list as $a): ?>
            <?php if(strlen(strstr($a->nama, 'Cagar Alam')) > 0): ?>
                <tr>
                    <td style="text-align: center;"><?=$no?>.</td>
                    <td><?=$a->nama?></td>
                    <td><?=$a->kabupaten?></td>
                    <td><?=$a->sk_penunjukan?></td>
                    <td><?=date('d-m-Y', strtotime($a->tgl_penunjukan))?></td>
                    <td style="text-align: right;"><?=$a->luas_darat > 0 ? number_format($a->luas_darat,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;"><?=$a->luas_laut > 0 ? number_format($a->luas_laut,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td><?=$a->sk_penetapan?></td>
                </tr>
            <?php $no++;  endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr>
            <td style="text-align: center;">C.</td><td>Suaka Margasatwa</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <?php $no=1; foreach($list as $a): ?>
            <?php if(strlen(strstr($a->nama, 'Suaka Margasatwa')) > 0): ?>
                <tr>
                    <td style="text-align: center;"><?=$no?>.</td>
                    <td><?=$a->nama?></td>
                    <td><?=$a->kabupaten?></td>
                    <td><?=$a->sk_penunjukan?></td>
                    <td><?=date('d-m-Y', strtotime($a->tgl_penunjukan))?></td>
                    <td style="text-align: right;"><?=$a->luas_darat > 0 ? number_format($a->luas_darat,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;"><?=$a->luas_laut > 0 ? number_format($a->luas_laut,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td><?=$a->sk_penetapan?></td>
                </tr>
            <?php $no++;  endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr>
            <td style="text-align: center;">D.</td><td>Taman Buru</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <?php $no=1; foreach($list as $a): ?>
            <?php if(strlen(strstr($a->nama, 'Taman Buru')) > 0): ?>
                <tr>
                    <td style="text-align: center;"><?=$no?>.</td>
                    <td><?=$a->nama?></td>
                    <td><?=$a->kabupaten?></td>
                    <td><?=$a->sk_penunjukan?></td>
                    <td><?=date('d-m-Y', strtotime($a->tgl_penunjukan))?></td>
                    <td style="text-align: right;"><?=$a->luas_darat > 0 ? number_format($a->luas_darat,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;"><?=$a->luas_laut > 0 ? number_format($a->luas_laut,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td><?=$a->sk_penetapan?></td>
                </tr>
            <?php $no++;  endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr>
            <td style="text-align: center;">E.</td><td>Taman Wisata Alam</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <?php $no=1; foreach($list as $a): ?>
            <?php if(strlen(strstr($a->nama, 'Taman Wisata Alam')) > 0): ?>
                <tr>
                    <td style="text-align: center;"><?=$no?>.</td>
                    <td><?=$a->nama?></td>
                    <td><?=$a->kabupaten?></td>
                    <td><?=$a->sk_penunjukan?></td>
                    <td><?=date('d-m-Y', strtotime($a->tgl_penunjukan))?></td>
                    <td style="text-align: right;"><?=$a->luas_darat > 0 ? number_format($a->luas_darat,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;"><?=$a->luas_laut > 0 ? number_format($a->luas_laut,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td><?=$a->sk_penetapan?></td>
                </tr>
            <?php $no++;  endif; ?>
        <?php endforeach; ?>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

        <tr>
            <td style="text-align: center;">F.</td><td>Taman Hutan Raya</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <?php $no=1; foreach($list as $a): ?>
            <?php if(strlen(strstr($a->nama, 'Taman Hutan Raya')) > 0): ?>
                <tr>
                    <td style="text-align: center;"><?=$no?>.</td>
                    <td><?=$a->nama?></td>
                    <td><?=$a->kabupaten?></td>
                    <td><?=$a->sk_penunjukan?></td>
                    <td><?=date('d-m-Y', strtotime($a->tgl_penunjukan))?></td>
                    <td style="text-align: right;"><?=$a->luas_darat > 0 ? number_format($a->luas_darat,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;"><?=$a->luas_laut > 0 ? number_format($a->luas_laut,2,',','.') : '-'?></td>
                    <td style="text-align: right;">-</td>
                    <td><?=$a->sk_penetapan?></td>
                </tr>
            <?php $no++;  endif; ?>
        <?php endforeach; ?>

    </table>    
    <div id="center" style="padding-top: 5px;">
        <i>Sumber: Dinas Kehutanan Provinsi Jawa Barat, Balai Besar KSDA Jawa Barat, Taman Nasional dan Perum Perhutani Divisi Regional Jawa Barat dan Banten</i>
    </div> 
</body>
</html>