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
define('APACHE_SVR' , true); // is apache server ?
define('PA_CORE'    , 'tcore/'); // core path
define('PA_LIBS'    , 'libs/'); // library path
define('PA_LIBS_CM' , '../libs/'); // library path
define('PA_CM'      , 'tcm') ; // content manage path


define('UR_BASE'    , 'http://toos.org/');  // base site url must be have "/" at end
define('UR_PUB'     , UR_BASE . 'public/');  // public site url
define('UR_CM'      , UR_BASE . PA_CM . '/'); // content manage url
define('UR_CMT'     , UR_CM . (APACHE_SVR?'':'index.php?req=')) ;// content manage url total addersss
define('UR_CM_PUB'  , UR_BASE . PA_CM . '/public/'); // content manage public url
define('UR_UPLOAD'  , UR_BASE . 'upload/'); // upload url

# ------------------------------------------------------------------------------

/*
 * Database constants
 */

// datebase host usual : localhost
define('DB_HOST'    , 'localhost');
// database access user 
define('DB_USER'    , 'root');
// database user access
define('DB_PASSWORD', '');
// database name 
define('DB_NAME'    , 'toos');



// prefix for all table name - change it if 
//you install more than one toos on single databse
define('DB_PREFIX'  , 'ts_');
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
define('HASH_KEY'   , 'fHJ@34^Jf43*e4wfIK&ef#5OFIR$f325eh54w') ;
define('LOGIN_KEY'  , '$r%ewfjUIH7#38f@dnkj152~fsF456fe5e33G') ;

# ------------------------------------------------------------------------------

/*
 * general config
 */

// langs
define('LANG' , 'fa_IR') ;
// debug system
define('_DBG_', true ) ;
// max file upload size = MB
define('MAX_UPLOAD_SIZE', 3 * ( 1024 * 1024 ) );

# ------------------------------------------------------------------------------

