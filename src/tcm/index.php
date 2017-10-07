<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index.php
 * @issue : index page link to all CM with bootstrap 
 */
// is user in manger page?
//define('__MP__', TRUE);

// define db & golobal
$database_handle = null;
$hook_store = null;


require PA_LIBS . 'TFunction.php';

//  include magic functions
require PA_LIBS . 'TMagicFunctions.php';


// check install directory
if (file_exists('install') && _DEVELOPER_ == false) {
    Redirect(UR_MP . 'message.php?title='.urlencode('Security Mode').'&text='.urlencode('Login disabled, Please remove install directory before login'));
}

// load plug-in's files
$plugin_loader = new TPluginLoader();


// add side menu global
$side_menu = new TMenu();

// start applaction
$application = new TBootstarp();
//die('1');


################################################################################
                          //==========================\\
                         //->    Just remember Sh    <-\\
                        //------------------------------\\
################################################################################