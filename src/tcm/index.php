<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index.php
 * @issue : index page link to all CM with bootstrap 
 */
// is user in cm
define('__MP__', TRUE);

// define db & golobal
$database_handle = null ;
$hook_store = null;

// include config file to do 
require '../tconfig.php';
// include constant file 
require '../tconstant.php';
//  include bootstrap
require PA_CORE . 'Bootstrap.php';
//  include functions
require PA_CORE . 'Function.php';
//  include pluginloder
require PA_CORE . 'PluginLoader.php';
// load plug-in's files
$plugin_loader = new PluginLoader();

//  include magic functions
require  '../libs/TMagicFunctions.php';


// start applaction
$application = new Bootstarp() ;


################################################################################
                          //==========================\\
                         //->    Just remember Sh    <-\\
                        //------------------------------\\
################################################################################