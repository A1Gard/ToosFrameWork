<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 24-March-2014 (4-1-1393) 
 * @time : 16:32 
 * @subpackage   MagicFunction
 * @version 1.0
 * @todo : toos magic functions - more use | short | fast use
 */

/**
 * magic language print function
 * @param string $string input to translate and print
 */
function _lp($string) {
    TLanguage::Prints($string);
}

/**
 * magic language get function
 * @param string $string input to get translate
 * @return string translated string
 */
function _lg($string) {
    return TLanguage::Get($string);
}

/**
 * magic hooking function 
 * @param string $effect
 * @param class handle $cls_handle class handle fore use in plugin  
 */
function _hk($effect, $cls_handle, &$a1 = null, &$a2 = null, &$a3 = null, &$a4 = null, &$a5 = null, &$a6 = null, &$a7 = null) {


    // plugin db connection from PluginLoader
    global $pdbc, $hook_store;


    if (isset($hook_store[$effect])) {
        $hooks = $hook_store[$effect];
    } else {
        return FALSE;
    }
    // do all effect
    foreach ($hooks as $hook) {
        // get function name
        if (!function_exists($hook)) {
            continue;
        }
        $fnc = $hook;
        switch (func_num_args()) {
            case 3:
                $fnc($cls_handle, $a1);
                break;
            case 4:
                $fnc($cls_handle, $a1, $a2);
                break;
            case 5:
                $fnc($cls_handle, $a1, $a2, $a3);
                break;
            case 6:
                $fnc($cls_handle, $a1, $a2, $a3, $a4);
                break;
            case 7:
                $fnc($cls_handle, $a1, $a2, $a3, $a4, $a5);
                break;
            case 8:
                $fnc($cls_handle, $a1, $a2, $a3, $a4, $a5, $a6);
                break;
            case 9:
                $fnc($cls_handle, $a1, $a2, $a3, $a4, $a5, $a6, $a7);
                break;

            default:
                $fnc($cls_handle);
                break;
        }
    }
    
}

/**
 * return ip
 * @return string ip
 */
function _ip() {
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * retrun client ip int
 * @return int
 */
function _ipi() {
    return (int) ip2long($_SERVER['REMOTE_ADDR']);
}

/**
 * retrun readble ip
 * @param long int $ip
 * @return string
 */
function _ips($ip) {
    return long2ip($ip);
}

/**
 * dubug with var_dump
 * @param variable $var
 */
function _vd($var) {
    echo '<pre>';
    $backtrace = debug_backtrace();
    $last = $backtrace[0];
    echo "called from {$last['file']} line {$last['line']}\r\n";
    var_dump($var);
    echo '</pre>';
}

/**
 * dubug with var_export
 * @param variable $var
 */
function _ve($var) {
    echo '<pre>';
    $backtrace = debug_backtrace();
    $last = $backtrace[0];
    echo "called from {$last['file']} line {$last['line']}\r\n";
    var_export($var);
    echo '</pre>';
}

/**
 * dubug with print_r
 * @param variable $var
 */
function _pr($var) {
    echo '<pre>';
    $backtrace = debug_backtrace();
    $last = $backtrace[0];
    echo "called from {$last['file']} line {$last['line']}\r\n";
    print_r($var);
    echo '</pre>';
}

/**
 * var echo error 
 * @param unknow $var
 * @param bool $is_die is die after error report ;
 */
function _err($var, $is_die = true) {
    echo '<pre>';
    $backtrace = debug_backtrace();
    foreach ($backtrace as $bt) {
        if ($bt['file'] != LIBS_DIR . 'TBootstarp.php' && $bt['file'] != MP_DIR . 'index.php') {
            echo $bt['file'] . ':' . $bt['line'] . '(' . $bt['function'] . ')' . PHP_EOL;
        }
    }
    if (is_string($var)) {

        echo PHP_EOL . '<b>' . $var . '</b>';
    } else {
        foreach ($var as $val) {
            echo PHP_EOL . '<b>' . $val . '</b>';
        }
    }
    echo '</pre>';
    if ($is_die) {
        die;
    }
}
