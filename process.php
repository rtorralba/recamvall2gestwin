<?php

use App\ValueObjects\Movimiento;
use App\ValueObjects\LineaMovimiento;

require_once __DIR__ . '/vendor/autoload.php';
require_once('config.php');

$inFiles = glob($inFolder.'/*.csv', GLOB_BRACE);

foreach ($inFiles as $file) {
    $csv = new ParseCsv\Csv($file);
    $fileSegments = explode('/', $file);
    $fileName = $fileSegments[count($fileSegments) - 1];

    if (strpos($file, 'PC_')) {
        $tipoMovimiento = 11;
    } elseif (strpos($file, 'PR_')) {
        $tipoMovimiento = 13;
    } elseif (strpos($file, 'AC_')) {
        $tipoMovimiento = 12;
    }

    $movimiento = new Movimiento($tipoMovimiento, $csv->data[0]);
    $csvMovimiento = $movimiento->toCsv();
    $csvLinea = '';
    foreach ($csv->data as $row) {
        $lineaMovimiento = new LineaMovimiento($row);
        $csvLinea .= $lineaMovimiento->toCsv();
    }

    $outFolder = $outProcessedFolder.'/'.$fileName;

    if (!is_dir($outFolder)) {
        mkdir($outFolder);
    }

    file_put_contents($outFolder.'/Movimiento.txt', $csvMovimiento);
    file_put_contents($outFolder.'/LineaMovimiento.txt', $csvLinea);
}
