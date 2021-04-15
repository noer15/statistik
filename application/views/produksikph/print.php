<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Produksi Hasil Hutan Kayu</title>
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
        TABEL <?=$jenisProduksi == 1 ? '8.' : '11.'?> JENIS DAN PRODUKSI HASIL HUTAN <?=$jenisProduksi == 1 ? 'KAYU BULAT' : 'BUKAN KAYU'?> DI JAWA BARAT PER KPH TAHUN <?=DATE('Y')?>
    </div>
    <table>
        <tr>
            <td rowspan="3" style="text-align: center; vertical-align:middle;">No.</td>
            <td rowspan="3" style="text-align: center; vertical-align:middle;">Nama KPH</td>
            <td colspan="<?= count((array)$jenis)*2 ?>" style="text-align: center;">Jenis Produksi</td>
            <td colspan="2" rowspan="2" style="text-align: center; vertical-align:middle;">Jumlah</td>
        </tr>

        <tr>
            <?php foreach($jenis as $jenis): ?>
            <td colspan="2" style="text-align: center;"><?=$jenis->nama?></td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <?php foreach($listjenis as $jenis): ?>
            <td style="text-align: center;"><?=$jenisProduksi == 1 ? 'Luas' : 'Jumlah'?></td>
            <td style="text-align: center;">Volume</td>
            <?php endforeach; ?>
            <td style="text-align: center;"><?=$jenisProduksi == 1 ? 'Luas' : 'Jumlah'?></td>
            <td style="text-align: center;">Volume</td>
        </tr>

        <?php $no=1;
        $jumlah_total_luas = 0;
        $jumlah_total_volume = 0;
        foreach($list as $a): ?>
        <tr>
            <td style="text-align: center;"><?=$no?>.</td>
            <td><?=$a->unit_kerja?></td>
            <?php 
            $jumlah_luas = 0; $jumlah_volume = 0;
            foreach($listjenis as $jenis): $jenis_nama = strtolower($jenis->nama);?>
            <td style="text-align: right;"><?=$a->{"luas_produksi_$jenis_nama"} > 0 ? number_format($a->{"luas_produksi_$jenis_nama"},2,',','.') : '-'?></td>
            <td style="text-align: right;"><?=$a->{"jml_produksi_$jenis_nama"} > 0 ? number_format($a->{"jml_produksi_$jenis_nama"},2,',','.') : '-'?></td>
            <?php 
            $jumlah_luas += $a->{"luas_produksi_$jenis_nama"}; 
            $jumlah_volume += $a->{"jml_produksi_$jenis_nama"};
            endforeach; ?>
            <td style="text-align: right;"><?=$jumlah_luas > 0 ? number_format($jumlah_luas,2,',','.') : '-'?></td>
            <td style="text-align: right;"><?=$jumlah_volume > 0 ? number_format($jumlah_volume,2,',','.') : '-'?></td>

        </tr>
        <?php 
        $no++;
        $jumlah_total_luas += $jumlah_luas;
        $jumlah_total_volume += $jumlah_volume;
        endforeach; ?>

        <tr>
            <td colspan="2" style="text-align: center;">Jumlah</td>
            <?php 
            foreach($totalList as $tj):
                $totalLuas = 0 ; $totalVolume = 0;
                foreach($listjenis as $lsn): 
                    $jenis_nama = strtolower($lsn->nama); ?>
                    <td style="text-align: right;"><?=$tj->{"luas_produksi_$jenis_nama"} > 0 ? number_format($tj->{"luas_produksi_$jenis_nama"},2,',','.') : '-'?></td>
                    <td style="text-align: right;"><?=$tj->{"jml_produksi_$jenis_nama"} > 0 ? number_format($tj->{"jml_produksi_$jenis_nama"},2,',','.') : '-'?></td>
                
            <?php 
                $totalLuas += $tj->{"luas_produksi_$jenis_nama"}; 
                $totalVolume += $tj->{"jml_produksi_$jenis_nama"};
                endforeach; ?>
                <td style="text-align: right;"><?=number_format($totalLuas,2,',','.')?></td>
                <td style="text-align: right;"><?=number_format($totalVolume,2,',','.')?></td>
            <?php
            endforeach; ?>
        </tr>
    </table>    
    <div id="center" style="padding-top: 5px;">
        <i>Sumber: Perum Perhutani Divisi Regional Jawa Barat dan Banten</i>
    </div> 
</body>
</html>