<?php

// start sesstion 
session_start();
// not in panel admin
//define('__MP__', FALSE);

// define db & golobal
global $database_handle, $hook_store;
$database_handle = null;
$hook_store = null;



// include constant file 
require_once PA_LIBS . 'TFunction.php';

/* @var $request string get apache request passed to index */
if (isset($_REQUEST['req']) && $_REQUEST['req'] != '') {

    $request = rtrim($_REQUEST['req'], '/');
    $url = explode('/', $request);
} else {

    // set deafult index
    $url = array(0 => 'index.php');
}


require_once PA_LIBS . 'Smarty.class.php';
require_once PA_LIBS . 'TDatabasePDO.php';
require_once PA_LIBS . 'TMagicFunctions.php';


$std_mdoel = new TModel();

$reg = new TRegistry();

$title = $reg->GetValue(ROOT_SYSTEM, 'title');


foreach ($_GET as $key => $value) {
    $_GET[$key] = XssClean($value);
}
foreach ($_POST as $key => $value) {
    $_POST[$key] = XssClean($value);
}
foreach ($_REQUEST as $key => $value) {
    $_REQUEST[$key] = XssClean($value);
}



// --------------------------------------- //
?>