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


    if (__MP__) {
        $file = PA_LIBS_MP . $class . '.php';
    } else {
        $file = 'libs/' . $class . '.php';
    }

    if (file_exists($file)) {
        require $file;
    } else {
        if (_DBG_) {
            echo "require autoload error for '$file'";
        }
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
function GoBack($message = null) {
    if ($message == null) {
        Redirect($_SERVER["HTTP_REFERER"]);
    } else {
        $message = trim($message, '/');
        $tmp = explode('/', $_SERVER["HTTP_REFERER"]);
        $lst = array('create', 'edit', 'delete', 'do');
        if (in_array($tmp[count($tmp) - 1], $lst)) {
            $red = substr($_SERVER["HTTP_REFERER"], 0, strlen($_SERVER["HTTP_REFERER"]) - ( strlen($tmp[count($tmp) - 1]) + 1));
        } else {
            $red = $_SERVER["HTTP_REFERER"];
        }
        Redirect($red . '#' . $message);
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
 * @param string $item_change array key(s) need to be delete from GET
 * @return string prefix link
 */
function GetLinkPrefix($item_change) {

    $get_request = $_GET;
    $is_array = explode(',', $item_change);
    if (count($is_array) == 1) {
        if (isset($get_request[$item_change])) {
            unset($get_request[$item_change]);
        }
    } else {
        foreach ($is_array as $value) {
            if (isset($get_request[$value])) {
                unset($get_request[$value]);
            }
        }
    }
    $prefix = '?' . http_build_query($get_request) . '&';
    return $prefix;
}

/*
 * XSS filter 
 *
 * This was built from numerous sources
 * (thanks all, sorry I didn't track to credit you)
 * 
 * It was tested against *most* exploits here: http://ha.ckers.org/xss.html
 * WARNING: Some weren't tested!!!
 * Those include the Actionscript and SSI samples, or any newer than Jan 2011
 *
 *
 * TO-DO: compare to SymphonyCMS filter:
 * https://github.com/symphonycms/xssfilter/blob/master/extension.driver.php
 * (Symphony's is probably faster than my hack)
 * Source from: https://gist.github.com/mbijon/1098477
 */

function XssClean($data) {
    // Fix &entity\n;
    $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    } while ($old_data !== $data);

    // we are done...
    return $data;
}
