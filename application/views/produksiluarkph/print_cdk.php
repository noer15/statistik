<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Produksi Hasil Hutan Luar Kawasan</title>
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
    <table page-break-inside: auto;>
        <thead>
            <tr>
                <th colspan="10" style="border: none; font-family:Arial; font-size:14px; padding-bottom:25px;font-weight:normal">TABEL 11.1 PRODUKSI HASIL HUTAN <?=$jenisProduksi == 1 ? 'KAYU' : 'BUKAN KAYU'?> DARI LUAR KAWASAN HUTAN PER CDK TAHUN <?=DATE('Y')?></th>
            </tr>
        </thead>
        <tr>
            <td rowspan="3" style="text-align: center; vertical-align:middle;width:3rem">No.</td>
            <td rowspan="3" style="text-align: center; vertical-align:middle;">Kab/Kota</td>
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

        <!-- Data CDK -->

        <tr>
            <td style="text-align: left;">I</td>
            <td>CDK WILAYAH I</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <?php $no=1;
            $jumlah_total_luas = 0;
            $jumlah_total_volume = 0;
            foreach($list as $a): ?>
            <?php if($a->kabId == 1 || $a->kabId == 18 || $a->kabId == 23 || $a->kabId == 16 || $a->kabId == 22):?>
            <tr>
                <td style="text-align:right"><?=$no++?>.</td>
                <td><?=$a->kab?></td>
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
                $jumlah_total_luas += $jumlah_luas;
                $jumlah_total_volume += $jumlah_volume;
                endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <tr>
            <td style="text-align: left;">II</td>
            <td>CDK WILAYAH II</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <?php
            $jumlah_total_luas = 0;
            $jumlah_total_volume = 0;
            foreach($list as $a): ?>
            <?php if($a->kabId == 13 || $a->kabId == 14 || $a->kabId == 15):?>
            <tr>
                <td style="text-align:right"><?=$no++?>.</td>
                <td><?=$a->kab?></td>
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
                $jumlah_total_luas += $jumlah_luas;
                $jumlah_total_volume += $jumlah_volume;
                endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <tr>
            <td style="text-align: left;">III</td>
            <td>CDK WILAYAH III</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <?php
            $jumlah_total_luas = 0;
            $jumlah_total_volume = 0;
            foreach($list as $a): ?>
            <?php if($a->kabId == 2 || $a->kabId == 19):?>
            <tr>
                <td style="text-align:right"><?=$no++?>.</td>
                <td><?=$a->kab?></td>
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
                $jumlah_total_luas += $jumlah_luas;
                $jumlah_total_volume += $jumlah_volume;
                endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <tr>
            <td style="text-align: left;">IV</td>
            <td>CDK WILAYAH IV</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <?php
            $jumlah_total_luas = 0;
            $jumlah_total_volume = 0;
            foreach($list as $a): ?>
            <?php if($a->kabId == 3 || $a->kabId == 17 || $a->kabId == 24):?>
            <tr>
                <td style="text-align:right"><?=$no++?>.</td>
                <td><?=$a->kab?></td>
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
                $jumlah_total_luas += $jumlah_luas;
                $jumlah_total_volume += $jumlah_volume;
                endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <tr>
            <td style="text-align: left;">V</td>
            <td>CDK WILAYAH V</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <?php
            $jumlah_total_luas = 0;
            $jumlah_total_volume = 0;
            foreach($list as $a): ?>
            <?php if($a->kabId == 4 || $a->kabId == 5 || $a->kabId == 20):?>
            <tr>
                <td style="text-align:right"><?=$no++?>.</td>
                <td><?=$a->kab?></td>
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
                $jumlah_total_luas += $jumlah_luas;
                $jumlah_total_volume += $jumlah_volume;
                endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <tr>
            <td style="text-align: left;">VI</td>
            <td>CDK WILAYAH VI</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <?php
            $jumlah_total_luas = 0;
            $jumlah_total_volume = 0;
            foreach($list as $a): ?>
            <?php if($a->kabId == 6 || $a->kabId == 25):?>
            <tr>
                <td style="text-align:right"><?=$no++?>.</td>
                <td><?=$a->kab?></td>
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
                $jumlah_total_luas += $jumlah_luas;
                $jumlah_total_volume += $jumlah_volume;
                endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <tr>
            <td style="text-align: left;">VII</td>
            <td>CDK WILAYAH VII</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <?php
            $jumlah_total_luas = 0;
            $jumlah_total_volume = 0;
            foreach($list as $a): ?>
            <?php if($a->kabId == 7 || $a->kabId == 26 || $a->kabId == 27):?>
            <tr>
                <td style="text-align:right"><?=$no++?>.</td>
                <td><?=$a->kab?></td>
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
                $jumlah_total_luas += $jumlah_luas;
                $jumlah_total_volume += $jumlah_volume;
                endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <tr>
            <td style="text-align: left;">VIII</td>
            <td>CDK WILAYAH VIII</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <?php
            $jumlah_total_luas = 0;
            $jumlah_total_volume = 0;
            foreach($list as $a): ?>
            <?php if($a->kabId == 8 || $a->kabId == 9 || $a->kabId == 10 || $a->kabId == 21):?>
            <tr>
                <td style="text-align:right"><?=$no++?>.</td>
                <td><?=$a->kab?></td>
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
                $jumlah_total_luas += $jumlah_luas;
                $jumlah_total_volume += $jumlah_volume;
                endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <tr>
            <td style="text-align: left;">IX</td>
            <td>CDK WILAYAH IX</td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

        <?php
            $jumlah_total_luas = 0;
            $jumlah_total_volume = 0;
            foreach($list as $a): ?>
            <?php if($a->kabId == 11 || $a->kabId == 12):?>
            <tr>
                <td style="text-align:right"><?=$no++?>.</td>
                <td><?=$a->kab?></td>
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
                $jumlah_total_luas += $jumlah_luas;
                $jumlah_total_volume += $jumlah_volume;
                endif; ?>
        <?php endforeach; ?>
        <tr>
            <td></td><td></td>
            <?php for($i=0; $i < count((array)$jenis)*2; $i++): ?>
            <td></td><td></td>
            <?php endfor;?>
        </tr>

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
        <i>Sumber: Dinas Kehutanan Provinsi Jawa Barat</i>
    </div> 
    <script type="text/php">
        if(isset($pdf)){
            $pdf->page_script('
                if($PAGE_NUM > 0){
                    $font = $fontMetrics->get_font("Arial");
                    $size = 14;
                    $text = 'TABEL 11.1  PRODUKSI HASIL HUTAN <?=$jenisProduksi == 1 ? 'KAYU' : 'BUKAN KAYU'?> DARI LUAR KAWASAN HUTAN PER CDK TAHUN <?=DATE('Y')?>';
                    $pdf->text(100,100,$text,$size);
                }
            ')
        }
    </script>
</body>
</html>