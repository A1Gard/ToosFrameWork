<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   tconfig.php
 * @todo : config all data here 
 *      - paths
 *      - database constants
 *      - FTP detail
 *      - special keys
 *      - general config
 */



/*
 * Paths & urls & server handler
 */

// server config
define('APACHE_SVR' , true); // is apache server ?

// path and driectory 
define("BASE_DIR", pathinfo(__FILE__,PATHINFO_DIRNAME).'/');

define('PA_UPLOAD'    , 'upload/'); // upload path
define('PA_PLUGIN'    , PA_UPLOAD . 'plugin/'); // plugin path
define('PA_LIBS'      , 'libs/'); // library path
define('PA_LIBS_MP'   , '../libs/'); // library path
define('PA_MP'        , 'tcm') ; // content manage path
define('PLUGIN_DIR'   , BASE_DIR . PA_PLUGIN) ; // plugin dir
define('LIBS_DIR'      , BASE_DIR . PA_LIBS) ; // lib dir
define('MP_DIR'      , BASE_DIR . PA_MP . '/') ; // manager dir


define('UR_BASE'   , '%url%');  // base site url must be have "/" at end
define('UR_MP'     , UR_BASE . PA_MP . (APACHE_SVR? '/':'index.php?req=')) ;// content manage url total addersss
define('UR_MP_ASSETS'  , UR_BASE . PA_MP . '/assets/'); // content manage public url
define('UR_UPLOAD'  , UR_BASE . PA_UPLOAD); // upload url
define('UR_PLUGIN', UR_UPLOAD . 'plugin/') ; // plugin dir


# ------------------------------------------------------------------------------

/*
 * Database constants
 */

// datebase host usual : localhost
define('DB_HOST'    , '%host%');
// database access user 
define('DB_USER'    , '%user%');
// database user access
define('DB_PASSWORD', '%pass%');
// database name 
define('DB_NAME'    , '%db%');



// prefix for all table name - change it if 
//you install more than one toos on single databse
define('DB_PREFIX'  , '%prefix%');
// db system type 
define('DB_TYPE'    , 'mysql');
// method to connect to databse : PDO|mysqli
define('DB_MOTHOD'  , 'PDO');
# ------------------------------------------------------------------------------

/*
 * FTP deatils
 */

// FTP host default : localhost
define('FTP_HOST'    , 'localhost') ;
// FTP user
define('FTP_USER'    , '');
//FTP password
define('FTP_PASSWORD', '');
//FTP port - default : 21
define('FTP_PORT'    , '21');

# ------------------------------------------------------------------------------

/*
 * Special keys
 */

// !Warrning : dont change them after install system 
define('HASH_KEY'   , '%salt1%') ;
define('LOGIN_KEY'  , '%salt2%') ;

# ------------------------------------------------------------------------------

/*
 * general config
 */

// langs
define('LANG' , 'fa_IR') ;
// debug system
define('_DBG_', false ) ;
// developer mode 
define('_DEVELOPER_', false);
// max file upload size = MB
define('MAX_UPLOAD_SIZE', 3 * ( 1024 * 1024 ) );

# ------------------------------------------------------------------------------

