<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   TLanguage
 * @version 1.0
 * @todo : language class for trasnlates 
 */
class TLanguage {

    private static $_lang = array();
    private static $_lang_search = array();

    /**
     * @name _init
     * @todo load lang file if language not loaded before than
     * @return bool
     */
    private static function _init() {
        // check loaded or not
        if (count(self::$_lang) == 0) {
            // load
            require '../langs/' . LANG . '_CM.php';
            self::$_lang = $_LANG;
            self::$_lang_search = array_map('strtolower', $_LANG);
        } else {
            return false;
        }
    }

    /**
     * @todo echo trasnlated input string
     * @param string $string input straing for translate
     * @return bool
     */
    public static function Prints($string) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $string);
        self::_init();
        // seach in array ;
        $key = array_search(strtolower($string), self::$_lang_search );
        $result = self::$_lang[$key + 1];
        if ($key === FALSE) {
            $result = $string;
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);

        return print $result;
    }

    /**
     * @todo translate find and retrun
     * @param string $string input to translate
     * @return string
     */
    public static function Get($string) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $string);
        
        self::_init();
        $key = array_search(strtolower($string), self::$_lang_search );

        if ($key === FALSE) {
            $result = $string;
        }else{
            $result = self::$_lang[$key + 1];
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    /**
     * @todo translate find key and retrun
     * @param string $string input to translate
     * @return int
     */
    public static function GetIndex($string) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $string);
        self::_init();
        $key = array_search($string, self::$_lang);
        $result = ($key + 1);
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    /**
     * @todo get value by key
     * @param int $key key of request
     * @return string translate value
     */
    public static function Index($key) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $key);

        $result = self::$_lang[$key];
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

}
