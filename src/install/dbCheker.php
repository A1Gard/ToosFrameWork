<?php

include_once '../libs/TDatabasePDO.php';
error_reporting(1);
try {
    $dbcon = new TDatabase($_POST['dbhost'], $_POST['dbname'], $_POST['dbuser'], $_POST['dbpass']);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
die('true');

