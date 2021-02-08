<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('DOMPDF_ENABLE_AUTOLOAD', false);
require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");

class Pdfgenerator {
  public function generate($html, $filename='', $stream=TRUE, $paper = 'F4', $orientation = "portrait")
  {
    $dompdf = new Dompdf\DOMPDF();;
    //$dompdf->set_option('isHtml5ParserEnabled', true);

    $dompdf->load_html($html);
    $dompdf->set_paper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
  }
}