<?php

namespace App;

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Utils
{
    public static function downloadZip($file)
    {
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            unlink($file);
            exit;
        }
    }

    public static function getExtensionFromFile($file)
    {
        $fileParts = explode('.', $file);
        return $fileParts[count($fileParts) - 1];
    }

    public static function getTipoMovimiento($file)
    {
        if (strpos($file, 'PC_')) {
            return 11;
        } elseif (strpos($file, 'PR_')) {
            return 13;
        } elseif (strpos($file, 'AC_')) {
            return 12;
        }
    }

    public static function saveCsvFromExcel($file)
    {
        $reader = ReaderEntityFactory::createReaderFromFile($file);
        $reader->open($file);
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                $rows = [];
                foreach ($row->getCells() as $cell) {
                    $rows[] = $cell->getValue();
                }
                $csv .= implode(',', $rows)."\n";
            }
        }
        $reader->close();

        $newFile = $file.'.csv';

        file_put_contents($newFile, $csv);

        return $newFile;
    }
}
