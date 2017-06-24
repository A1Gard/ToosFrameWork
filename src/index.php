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