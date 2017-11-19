<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index.php
 * @issue : index page link to all CM with bootstrap 
 */
require_once './tconstant.php';


// if system not install redirect to install page
if (file_exists('tconfig.php')) {
    // include config file to do 
    require 'tconfig.php';
} else {
    header('location:install');
    exit;
}

// check is have request
if (isset($_GET['req'])) {
    $offset = strpos(UR_BASE, '/', 9);
    $_GET['req'] = str_replace(substr(UR_BASE, $offset+1), '', $_GET['req']);
    // initial request
    $_GET['req'] = trim($_GET['req'], '/');
    $req = explode('/', $_GET['req']);
    // check is manaher path ?
    if ($req[0] == PA_MP) {
        $_GET['req'] = str_replace(PA_MP, '', $_GET['req']);
        $_GET['req'] = trim($_GET['req'], '/');
        $_REQUEST['req'] = $_GET['req'];
        require_once PA_MP_REAL . '/index.php';
        exit();
    }
    $_REQUEST['req'] = $_GET['req'];
}

die('under constract');

require_once './api/initial.php';

define('PAGE_C', 12);



$dt = new TDate();

if (isset($_COOKIE['mid'])) {
    $_SESSION['mid'] = $_COOKIE['mid'];
}

Redirect('/tcm');

if (isset($templatez) && is_array($templatez)) {
    $smarty->assign('browser', TVisitor::DetectBrowser());
    foreach ($templatez as $template) {
        $smarty->display($template . '.tpl');
    }
}

################################################################################
                     //==========================\\
                    //->    Just renember Sh    <-\\
                    //------------------------------\\
################################################################################