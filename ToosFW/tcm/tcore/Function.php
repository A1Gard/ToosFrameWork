<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   Function.php
 * @todo : system function to use
 */

/**
 * __autoload load lib auto . 
 * @param string $class class name
 */
function __autoload($class) {

    if (__CM__) {
        if (file_exists(PA_CORE . $class . '.php')) {
            require PA_CORE . $class . '.php';
        } else {
            require PA_LIBS_CM . $class . '.php';
        }
    }else{
        require 'libs/' . $class . '.php';
    }
}

/**
 * @todo redirect to $location
 * @param string $location url to redirect
 */
function Redirect($location) {
    header("location:" . $location);
}

/**
 * @todo go to back page
 * @param string $message
 */
function GoBack($message = null, $notification_icon = 1, $params = array()) {
    if ($message == null) {
        Redirect($_SERVER["HTTP_REFERER"]);
    } else {
        RedirectNotification($_SERVER["HTTP_REFERER"], $message, $notification_icon, $params);
    }
}

/**
 * @todo redirect to $location
 * @param string $location url to redirect
 * @param string $message notification message for get in TLanguage class
 * @param int $notification_icon notification icon id 
 * @param mixed $params params for Prints_f
 */
function RedirectNotification($location, $message, $notification_icon = 1, $params = array()) {

    $msg_id = TLanguage::GetIndex($message);
    // check passed array .
    count($params) == 0 ?
                    $args = (APACHE_SVR ? '?' : '&') . "msg_id=" . $msg_id . '&ni=' . $notification_icon :
                    $args = (APACHE_SVR ? '?' : '&') . "msg_id=" . $msg_id . '&ni=' . $notification_icon .
                    '&args=' . implode(',', $params);
    // redirect
    header("location:" . $location . $args);
}

/**
 * @todo Referer return linked page to here
 * @param string $Default url to if notset referer
 * @return string
 */
function Referer($default = '') {
    if (isset($_SERVER['HTTP_REFERER'])) {
        return $_SERVER['HTTP_REFERER'];
    } else {
        return $default;
    }
}

/**
 * 
 * @param string real $password
 * @return string hashed password
 */
function Password($password) {

    $ret = THash::Create('sha256', $password);
    $ret = THash::Create('md5', $ret);
    return $ret;
}

/**
 * get link prefix use in classes same as pagination
 * @param string $item_change array key need to be delete from GET
 * @return string prefix link
 */
function GetLinkPrefix($item_change) {

    $get_request = $_GET;

    if (isset($get_request[$item_change])) {
        unset($get_request[$item_change]);
    }
    $prefix = '?' . http_build_query($get_request) . '&';
    return $prefix;
}
