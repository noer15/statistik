<?php defined('BASEPATH') or die('No direct script access allowed');

require APPPATH . 'third_party/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet;

$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A1', 'No')
    ->setCellValue('B1', $name)
    ->setCellValue('C1', 'Pemula')
    ->setCellValue('D1', 'Madya')
    ->setCellValue('E1', 'Utama')
    ->setCellValue('F1', 'Total');

$kolom = 2;
$nomor = 1;
$totalPemula = 0;
$totalMadya = 0;
$totalUtama = 0;
foreach ($file_keltani as $p) {

    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom, $p->nama)
        ->setCellValue('C' . $kolom, $p->pemula)
        ->setCellValue('D' . $kolom, $p->madya)
        ->setCellValue('E' . $kolom, $p->utama)
        ->setCellValue('F' . $kolom, $p->pemula+$p->madya+$p->utama);

    $kolom++;
    $nomor++;

    $totalPemula += $p->pemula;
    $totalMadya += $p->madya;
    $totalUtama += $p->utama;
}

    $spreadsheet->setActiveSheetIndex(0)
        ->mergeCells('A'.$kolom.':B'.$kolom)
        ->setCellValue('A' . $kolom, 'Total')
        ->setCellValue('C' . $kolom, $totalPemula)
        ->setCellValue('D' . $kolom, $totalMadya)
        ->setCellValue('E' . $kolom, $totalUtama)
        ->setCellValue('F' . $kolom, $totalPemula+$totalMadya+$totalUtama);

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $title . '.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
