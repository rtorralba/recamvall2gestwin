<?php

use App\Process;
use App\Utils;

require_once __DIR__ . '/vendor/autoload.php';
require_once('config.php');

const APP_DIR = __DIR__;

if ($_POST) {
    $uploadsDir = APP_DIR . '/uploads/';
    $file = $uploadsDir.$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $file);

    $filePath = Process::transform($file);

    Utils::downloadZip($filePath);

    unlink($file);
}
?>
<h1>recamvall2gestwin</h1>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <br>
    <br>
    <input type="submit" name="Transformar">
</form>
