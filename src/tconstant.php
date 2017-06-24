<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   tconfig.php
 * @todo : config all data here 
 *      - manager types
 *      - registry roots 
 */
# ------------------------------------------------------------------------------

/*
 * system conatants
 */

// verstion 
define('VERSION', '0.9');
// build no
define('BUILD', '20170601');
// database version
define('DB_VERSION', 'unstable');

# ------------------------------------------------------------------------------

/*
 * regitery roots
 */

// unknown root keys
define('ROOT_UNKNOWN', 0);
// system root keys
define('ROOT_SYSTEM', 1);
// server root keys
define('ROOT_SERVER', 2);
// plugins root keys
define('ROOT_PLUGIN', 3);
// extension root keys
define('ROOT_EXTENSION', 4);
// user root keys
define('ROOT_USER', 5);



# ------------------------------------------------------------------------------

/*
 * manager types 
 * ----------------------------------
 * this constant define in array foreach in select
 */

// init array
$MANAGER_TYPE = array();

// unknow manager can't see & do any thing.
$MANAGER_TYPE['UNKNOWN'] = 0;
// Protected Admin manager full access
$MANAGER_TYPE['OWNER'] = 1;
// Admin manager full access
$MANAGER_TYPE['ADMIN'] = 2;
// Defined manager semi access defined rule by amin
$MANAGER_TYPE['DEFINED'] = 3;
// Defined manager semi access defined rule by system
$MANAGER_TYPE['LIMITED'] = 4;
// Banded or suspened manager
$MANAGER_TYPE['BANNDED'] = 5;

# ------------------------------------------------------------------------------
/*
 * try type for log
 */

// unknown try
define('TRY_UNKNOWN', 0);
// login try
define('TRY_LOGIN', 1);
// search try
define('TRY_SEARCH', 2);
// comment try
define('TRY_COMMENT', 3);
//  try new password
define('TRY_PASSWORD', 4);
//  try
define('TRY_2', 5);


# ------------------------------------------------------------------------------

/*
 * notification icon
 */

// ok icon
define('NF_SUCCESS', 'success');
// info icon
define('NF_INFO', 'info');
// warning icon
define('NF_WARNING', 'warning');
// error icon
define('NF_ERROR', 'error');
// other icon
define('NF_Other', '');

$notfi = array('success', 'info', 'warning', 'error');


# ------------------------------------------------------------------------------
/*
 * image resize modes
 */


define('RESIZE_WIDTH_FIXED', 0);
define('RESIZE_HEIGHT_FIXED', 1);
define('RESIZE_BOTH', 2);


# ------------------------------------------------------------------------------

/*
 * Upload modes
 */

define('UPLOAD_BY_DATE', 0);
define('UPLOAD_BY_TYPE', 1);
define('UPLOAD_BY_OTHER', 2);



# ------------------------------------------------------------------------------

/*
 * Action modes
 */

define('ACTION_ADD', 0);
define('ACTION_EDIT', 1);
define('ACTION_DELETE', 2);



# ------------------------------------------------------------------------------

/*
 * widget modes
 */

define('WIDGET_TEMPLATE_MODE', 0);
define('WIDGET_PREPARE_MODE', 1);
define('WIDGET_USE_MODE', 2);


# ------------------------------------------------------------------------------

/*
 * widget Type
 */

define('WIDGET_TYPE_DROPDOWN', 0);
define('WIDGET_TYPE_THEME', 1);
# ------------------------------------------------------------------------------

/*
 * serchmode Type
 */

define('SEARCH_MODE_CATEGORY', 0);
define('SEARCH_MODE_TAG', 1);
define('SEARCH_MODE_TOPIC', 2);
define('SEARCH_MODE_MEMEBER', 3);

# ------------------------------------------------------------------------------

/*
 * DropDown Type
 */

define('DROPDOWN_MODE_LINK', 0);
define('DROPDOWN_MODE_TOPIC', 1);
define('DROPDOWN_MODE_TAG', 2);
define('DROPDOWN_MODE_CATEGORY', 3);
define('DROPDOWN_MODE_CATEGORY_SUB_CATS', 4);
define('DROPDOWN_MODE_CATEGORY_SUB_TOPICS', 5);


# ------------------------------------------------------------------------------

/*
 * member Type
 */

define('MEMBER_PENNDLING', 0);
define('MEMBER_APPROVED', 1);
define('MEMBER_SPECIAL', 2);
define('MEMBER_BANDED', 3);


# ------------------------------------------------------------------------------

/*
 * comment status
 */

define('COMMENT_STATUS_PENDDING', 0);
define('COMMENT_STATUS_APPROVED', 1);
define('COMMENT_STATUS_UNAPPROVED', 2);

# ------------------------------------------------------------------------------


/*
 * relationship Type
 * system relation between 1 - 9 
 * sub relation must be between 10 - 99
 * other realtion must be from 100
 */

define('RELATION_TAG', 1);
define('RELATION_CATEGORY', 2);
define('REALTION_ATTACH', 3);
define('REALTION_LIKE', 4);
define('REALTION_FRIEND', 5);
define('REALTION_GALLERY', 6);


# ------------------------------------------------------------------------------

define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);


# ------------------------------------------------------------------------------
// not all browser famus browsers
$browser_list = array(
    // Match user agent string with browser
    'Unknow',
    'Deepnet',
    'Flock',
    'Maxthon',
    'Avant',
    'AOL',
    'MSIE',
    'Opera',
    'Firefox',
    'Edge',
    'Chrome',
    'Safari'
);

$os_list = array(
    'Unknow',
    'Windows 3.11',
    'Windows 95',
    'Windows 98',
    'Windows 2000',
    'Windows XP',
    'Windows Server 2003',
    'Windows Vista | WinServer 2008',
    'Windows 7 | WinServer 2008 R2',
    'Windows 8',
    'Windows Phone 8',
    'Windows 8.1',
    'Windows Phone 8.1',
    'Windows 10',
    'Windows Phone 10',
    'Windows NT 4.0',
    'Windows ME',
    'Open BSD',
    'Sun OS',
    'Linux',
    'iPhone | iPad Osx',
    'Mac OS',
    'QNX',
    'BeOS',
    'OS/2',
    'android',
    'symbian',
    'Search Bot'
);







/**
 * Customize system config
 */
define('DT_SHORT_TIME', 'H:i:s');

define('DT_SHORT_DATE', 'Y/m/d');
define('DT_JS_SHORT_DATE', 'yyyy/mm/dd');
define('DT_SHORT_FULL_DATETIME', DT_SHORT_TIME . ' ' . DT_SHORT_DATE);


define("HOT_CORNER", true);
define("MINIFY_HTML", true);
