<?php
session_start();
ob_start();

if (!isset($_SESSION['install'])) {
    header("location:index.php");
}

// include all required libs
include_once '../libs/THash.php';
include_once '../libs/TDatabasePDO.php';

error_reporting(1);

// try to read config sample
try {
    $f_name = 'tconfig.sample.php';
    $f_handle = fopen($f_name, 'r');
    $f_content = fread($f_handle, filesize($f_name));
    fclose($f_handle);
    unset($f_handle);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    die;
}


// try to connect with posted value that sure before write on config.
try {
    $dbcon = new TDatabase('mysql', $_POST['dbhost'], $_POST['dbname'], $_POST['dbuser'], $_POST['dbpass']);
     // check db is empty or not
    $tbl_result = $dbcon->query("SHOW TABLES");
    $tables = $tbl_result->fetchAll();
    $is_ext = FALSE;
    foreach ($tables as $table_name) {
        if ($table_name[0] == $_POST['dbprf'].'registry') {
            $is_ext = TRUE;
            break;
        }
    }
    // same as new table fonud install failed
    if ($is_ext) {
        die("Toos is installed before than <br /> Please check db or choose "
                . "another prefix for install other system inside installed "
                . "system(s)");
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    die('<br /> We can connect to Database please check your input');
}
// replace value for write on config file
$f_content = str_replace('%url%', trim($_POST['url'], '/') . '/', $f_content);
$f_content = str_replace('%host%', $_POST['dbhost'], $f_content);
$f_content = str_replace('%user%', $_POST['dbuser'], $f_content);
$f_content = str_replace('%pass%', $_POST['dbpass'], $f_content);
$f_content = str_replace('%db%', $_POST['dbname'], $f_content);
$f_content = str_replace('%prefix%', $_POST['dbprf'], $f_content);
// generate random salt 
$f_content = str_replace('%salt1%', THash::SaltGenerator(32), $f_content);
$f_content = str_replace('%salt2%', THash::SaltGenerator(32), $f_content);

// write config file
$f_name = '../tconfig.php';
$f_handle = fopen($f_name, 'w');
$is_write = fwrite($f_handle, $f_content);
fclose($f_handle);

// check if writed on cconfig redirect on next step
if ($is_write !== false) {
    header("location: systemSetting.php");
    exit();
}
ob_end_flush();
// else show this follwing form to user.
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Toos system install - Config writer </title>
        <link type="text/css" rel="stylesheet" href="assets/css/install.css" />
        <link type="text/css" rel="stylesheet" href="../tcm/assets/css/element.css" />
        <script type="text/javascript" src="../tcm/assets/js/jquery.min.js"></script>
    </head>
    <body>
        <div id="main">
            <h1>
                Config writer
            </h1>
            <div style="padding:1em;">
                <div class="notification-bar">
                    <div class="notification warning">
                        * Sorry, We haven't  write config file. Please copy following 
                        text and create new file <b>'tconfig.php'</b> in root folder
                        inside <b>'tconstant.php'</b> and paste this text there, 
                        then click on the <b> Next </b> button.
                        <br />
                        * Or set write permision to root folder and click on the 
                        <b> Rewrite</b> button.
                    </div>
                </div>
                <br />

                <textarea class="read-only" onclick="this.select()" onfocus="this.select()"><?php echo $f_content; ?></textarea>
                <br />
                <button class="button" onclick="window.location.reload();" >Rewrite</button>
                &nbsp;
                &nbsp;
                <button class="button" id="configchecker">
                    &nbsp;&nbsp;
                    Next
                    &nbsp;&nbsp;
                </button>
            </div>
        </div>
        <script type="text/javascript" src="assets/js/install.js"></script>
    </body>
</html>
