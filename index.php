<?php

use App\Process;
use App\Utils;
use Symfony\Component\Translation\Tests\DataCollectorTranslatorTest;

require_once __DIR__ . '/vendor/autoload.php';
require_once('config.php');

const APP_DIR = __DIR__;
const DOCUMENT_NUMBER_DOCUMENT = APP_DIR.'/currentDocument.txt';

if ($_POST) {
    $uploadsDir = APP_DIR . '/uploads/';
    $file = $uploadsDir.$_FILES['file']['name'];
    $extension = Utils::getExtensionFromFile($file);
    move_uploaded_file($_FILES['file']['tmp_name'], $file);

    if (in_array($extension, ['xls', 'xlsx'])) {
        $file = Utils::saveCsvFromExcel($file);
    }

    $filePath = Process::transform($file);
    unlink($file);

    //$currentNumber = (int) file_get_contents(DOCUMENT_NUMBER_DOCUMENT);
    //$nextNumber = $currentNumber + 1;
    //file_put_contents(DOCUMENT_NUMBER_DOCUMENT, $nextNumber);

    Utils::downloadZip($filePath);
}
?>
<h1>recamvall2gestwin</h1>
<form method="POST" enctype="multipart/form-data">
    <h3>1. Selecciona el archivo de Recamvall (PC_XXXXXXXXX.xlsx, PR_XXXXXXXXX.xlsx, AC_XXXXXXXXX.xlsx)</h3>
    <input type="file" name="file" required>
    <br>
    <br>
    <h3>2. Pulsa el botón "Transformar" y descarga el zip resultante</h3>
    <input type="submit" name="Transformar" value="Transformar">
    <h3>3. Descomprime el zip en tu ordenador</h3>
    <h4>4. Importar el zip descomprimido con el programa gestwin.</h4>
    <p>Compras -> Procesos-> Exportacion e Importacion de documentos de Compra</p>
    <img src="/img/image.png"/>
</form>
