<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index.php
 * @issue : index page link to all CM with bootstrap 
 */
// is user in manger page?
define('__MP__', TRUE);

// define db & golobal
$database_handle = null;
$hook_store = null;

// include config file to do 
require '../tconfig.php';
// include constant file 
require '../tconstant.php';

require PA_LIBS_MP . 'TFunction.php';
// load plug-in's files
$plugin_loader = new TPluginLoader();


//  include magic functions
require '../libs/TMagicFunctions.php';

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