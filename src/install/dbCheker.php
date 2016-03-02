<?php

include_once '../libs/TDatabasePDO.php';
sleep(1);
error_reporting(1);
try {
    $dbcon = new TDatabase('mysql',$_POST['dbhost'], $_POST['dbname'], $_POST['dbuser'], $_POST['dbpass']);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    die('<br /> We can connect to Database please check your input');
}
die('true');

