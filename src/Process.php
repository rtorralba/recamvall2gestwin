<?php

namespace App;

use App\ValueObjects\GrupoLineaMovimiento;
use App\ValueObjects\Movimiento;
use App\ValueObjects\LineaMovimiento;
use App\Utils;

class Process
{
    private static $outProcessedFolder = APP_DIR.'/out';

    public static function transform($file)
    {
        $csv = new \ParseCsv\Csv($file);
        $fileSegments = explode('/', $file);
        $fileName = $fileSegments[count($fileSegments) - 1];

        $tipoMovimiento = Utils::getTipoMovimiento($file);

        $movimiento = new Movimiento($tipoMovimiento, $csv->data[0]);
        $csvMovimiento = $movimiento->toCsv();
        $csvLinea = '';
        $nroLinea = 1;
        foreach ($csv->data as $row) {
            $lineaMovimiento = new LineaMovimiento($row, $nroLinea);
            $nroLinea++;
            $csvLinea .= $lineaMovimiento->toCsv();
        }

        $grupoLineaMovimiento = new GrupoLineaMovimiento($csv->data[0]);
        $csvGrupoLineaMovimiento = $grupoLineaMovimiento->toCsv();

        $outFolder = self::$outProcessedFolder.'/'.$fileName;

        if (!is_dir($outFolder)) {
            mkdir($outFolder);
        }

        $outZip = $outFolder.'.zip';

        file_put_contents($outFolder.'/Movimiento.txt', $csvMovimiento);
        file_put_contents($outFolder.'/LineaMovimiento.txt', $csvLinea);
        file_put_contents($outFolder.'/GrupoLineaMovimiento.txt', $csvGrupoLineaMovimiento);

        $zipper = new \Chumper\Zipper\Zipper;
        $filesToZip = glob($outFolder);
        $zipper->make($outZip)->add($filesToZip)->close();

        self::deleteDir($outFolder);

        return $outZip;
    }

    private static function deleteDir($target)
    {
        if (is_dir($target)) {
            $files = glob($target . '/*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

            foreach ($files as $file) {
                unlink($file);
            }

            rmdir($target);
        }
    }
}
