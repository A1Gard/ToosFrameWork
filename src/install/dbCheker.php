<?php

include_once '../libs/TDatabasePDO.php';
error_reporting(1);
try {
    $dbcon = new TDatabase('mysql', $_POST['dbhost'], $_POST['dbname'], $_POST['dbuser'], $_POST['dbpass']);
    $tbl_result = $dbcon->query("SHOW TABLES");
    $tables = $tbl_result->fetchAll();
    $is_ext = FALSE;
    foreach ($tables as $table_name) {
        if ($table_name[0] == $_POST['dbprf'].'registry') {
            $is_ext = TRUE;
            break;
        }
    }
    if ($is_ext) {
        die("Toos is installed before than <br /> Please check db or choose "
                . "another prefix for install other system inside installed "
                . "system(s)");
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    die('<br /> We can connect to Database please check your input');
}
die('true');

