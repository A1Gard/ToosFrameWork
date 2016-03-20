<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 3-April-2013 (14-1-1392) 
 * @time : 20:32 
 * @subpackage   TVisitor
 * @version 0.8
 * @todo : TVisitor class for get visitor info
 */
class TVisitor {

    function __construct() {
        
    }

    /**
     * @todo Detect visitor OS
     * @return int os number
     */
    public static function DetectOSI() {

        if (!isset($_SERVER['HTTP_USER_AGENT']))
            return '0';
        $os_list = array(
            // Match user agent string with operating systems
            '(Win16)',
            '(Windows 95)|(Win95)|(Windows_95)',
            '(Windows 98)|(Win98)',
            '(Windows NT 5.0)|(Windows 2000)',
            '(Windows NT 5.1)|(Windows XP)',
            '(Windows NT 5.2)',
            '(Windows NT 6.0)',
            '(Windows NT 6.1)',
            '(Windows NT 6.2)',
            '(Windows Phone 8)',
            '(Windows NT 6.3)',
            '(Windows Phone 8.1)',
            '(Windows NT 10)',
            '(Windows Phone 10)',
            '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
            'Windows ME',
            'OpenBSD',
            'SunOS',
            '(Linux)|(X11)',
            '(iPhone)|(iPad)',
            '(Mac_PowerPC)|(Macintosh)',
            'QNX',
            'BeOS',
            'OS\/2',
            '(android)',
            '(symbian)',
            '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves\/Teoma)|(ia_archiver)'
        );


        // reset ret
        $result = "0";
        // Loop through the array of user agents and matching operating systems
        foreach ($os_list as $current_os => $match) {
            // Find a match

            if (preg_match("/" . $match . "/", $_SERVER['HTTP_USER_AGENT'])) {
                // We found the correct match
                $result = $current_os + 1;
                break;
            }
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    /**
     * @todo Detect visitor OS
     * @return string OS name
     */
    public static function DetectOS() {

        if (!isset($_SERVER['HTTP_USER_AGENT']))
            return 'error';

        $os_list = array(
            // Match user agent string with operating systems
            'Windows 3.11' => 'Win16',
            'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
            'Windows 98' => '(Windows 98)|(Win98)',
            'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
            'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
            'Windows Server 2003' => '(Windows NT 5.2)',
            'Windows Vista | WinServer 2008' => '(Windows NT 6.0)',
            'Windows 7 | WinServer 2008 R2' => '(Windows NT 6.1)',
            'Windows 8' => '(Windows NT 6.2)',
            'Windows Phone 8' => '(Windows Phone 8)',
            'Windows 8.1' => '(Windows NT 6.3)',
            'Windows Phone 8.1' => '(Windows Phone 8.1)',
            'Windows 10' => '(Windows NT 10)',
            'Windows Phone 10' => '(Windows Phone 10)',
            'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
            'Windows ME' => 'Windows ME',
            'Open BSD' => 'OpenBSD',
            'Sun OS' => 'SunOS',
            'Linux' => '(Linux)|(X11)',
            'iPhone | iPad Osx' => '(iPhone)|(iPad)',
            'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
            'QNX' => 'QNX',
            'BeOS' => 'BeOS',
            'OS/2' => 'OS\/2',
            'android' => '(android)',
            'symbian' => '(symbian)',
            'Search Bot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves\/Teoma)|(ia_archiver)'
        );

        // reset ret
        $result = "Unknown";
        // Loop through the array of user agents and matching operating systems
        foreach ($os_list as $current_os => $match) {
            // Find a match
            if (preg_match("/" . $match . "/", $_SERVER['HTTP_USER_AGENT'])) {
                // We found the correct match
                $result = $current_os;
                break;
            }
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    /**
     * @todo Detect is visitor mobile user
     * @return bool
     */
    public static function IsMobile() {

        if (!isset($_SERVER['HTTP_USER_AGENT']))
            return FALSE;

        $is_mobile = FALSE;

        if (preg_match('/(android|up.browser|up.link|mmp|symbian|smartphone|midp|wap|iphone|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $is_mobile = true;
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ( (isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $is_mobile = true;
        }

        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array('w3c ', 'acs-', 'alav', 'alca', 'amoi', 'andr', 'audi', 'avan', 'benq', 'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno', 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar', 'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-', 'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp', 'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-');

        if (in_array($mobile_ua, $mobile_agents)) {
            // if opera and not win or linux
            if ($mobile_ua == 'oper') {
                $sub_str = substr(self::DetectOS(), 0, 3);
                //       win                     linux                   mac
                if (!( ($sub_str == 'Win') || ($sub_str == 'Lin') || ($sub_str == 'Mac') )) {
                    $is_mobile = true;
                }
            } else {
                $is_mobile = true;
            }
        }

        if (isset($_SERVER['ALL_HTTP'])) {
            if (strpos(strtolower($_SERVER['ALL_HTTP']), 'OperaMini') > 0) {
                $is_mobile = true;
            }
        }

        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') < 0) {
            $is_mobile = true;
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $is_mobile);
        return $is_mobile;
    }

    /**
     * @todo Get browser name only
     * @return staring browser name
     */
    public static function DetectBrowser() {

        if (!isset($_SERVER['HTTP_USER_AGENT']))
            return 'error';

        // not all browser famus browsers
        $browser_list = array(
            // Match user agent string with browser
            'DeepNet' => '(Deepnet)',
            'Flock' => '(Flock)',
            'Maxthon' => '(Maxthon)|(MAXTHON)',
            'Avant' => '(Avant)',
            'AOL' => '(AOL)',
            'InternetExplorer' => '(MSIE)',
            'Opera' => '(Opera)',
            'FireFox' => '(Firefox)',
            'Edge' => '(Edge)',
            'Chrome' => '(Chrome)',
            'Safari' => '(Safari)'
        );

        // reset ret
        $result = "Other";
        // Loop through the array of user agents and matching operating systems
        foreach ($browser_list as $current_browser => $match) {
            // Find a match
            if (preg_match("/" . $match . "/", $_SERVER['HTTP_USER_AGENT'])) {
                // We found the correct match
                $result = $current_browser;
                break;
            }
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);

        return $result;
    }

    /**
     * @todo Get browser name only
     * @return int browser num
     */
    public static function DetectBrowserI() {

        if (!isset($_SERVER['HTTP_USER_AGENT']))
            return 'error';

        // not all browser famus browsers
        $browser_list = array(
            // Match user agent string with browser
            '(Deepnet)',
            '(Flock)',
            '(Maxthon)|(MAXTHON)',
            '(Avant)',
            '(AOL)',
            '(MSIE)',
            '(Opera)',
            '(Firefox)',
            '(Edge)',
            '(Chrome)',
            '(Safari)'
        );

        // reset ret
        $result = 0;
        // Loop through the array of user agents and matching operating systems
        foreach ($browser_list as $current_browser => $match) {
            // Find a match
            if (preg_match("/" . $match . "/", $_SERVER['HTTP_USER_AGENT'])) {
                // We found the correct match
                $result = $current_browser+1;
                break;
            }
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);

        return $result;
    }

    /**
     * @todo find browser version
     * @return string version
     */
    public static function BrowserVersion() {

        $version = '0';

        $browser = self::DetectBrowser();

        // if browser is IE
        if ($browser == 'InternetExplorer') {
            // split for find version
            $arr = explode(';', $_SERVER['HTTP_USER_AGENT']);
            // remove MSIE from browser info
            $version = trim(substr(trim($arr[1]), 5));

            // if browser is Opera
        } elseif ($browser == 'Opera') {
            //
            $arr = explode(' ', $_SERVER['HTTP_USER_AGENT']);
            // each to find Vertion/Verstion
            foreach ($arr as $value) {
                if (!(stripos($value, 'Version') === FALSE)) {
                    // if find remove browser name 
                    $version = trim(substr(trim($value), 8));
                    break;
                }
            }

            if ($version == '0') {
                // each to find BrowserName/Verstion
                foreach ($arr as $value) {

                    if (!(stripos($value, $browser) === FALSE)) {
                        // if find remove browser name 
                        $start = ( strlen($browser) + 1);
                        $version = trim(substr(trim($value), $start));
                        break;
                    }
                }
            }
            //for other 
        } else {
            // slipt for each
            $arr = explode(' ', $_SERVER['HTTP_USER_AGENT']);
            // each to find BrowserName/Verstion
            foreach ($arr as $value) {

                if (!(stripos($value, $browser) === FALSE)) {
                    // if find remove browser name 
                    $start = ( strlen($browser) + 1);
                    $version = trim(substr(trim($value), $start));
                    break;
                }
            }
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $version);
        return $version;
    }

    /**
     * get searched keywords
     * @param string $referer
     * @return string
     * @author http://www.codediesel.com/php/grabbing-the-referrer-search-engine-keywords-for-a-site/
     */
    public static function GetKeyword($referer = 'Referer()') {
        if ($referer == 'Referer()') {
            $referer = Referer();
        }

        // pre
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $referer);


        $search_phrase = '';
        $engines = array('dmoz' => 'q=',
            'aol' => 'q=',
            'ask' => 'q=',
            'google' => 'q=',
            'bing' => 'q=',
            'hotbot' => 'q=',
            'teoma' => 'q=',
            'yahoo' => 'p=',
            'altavista' => 'p=',
            'lycos' => 'query=',
            'kanoodle' => 'query='
        );

        foreach ($engines as $engine => $query_param) {
            // Check if the referer is a search engine from our list.
            // Also check if the query parameter is valid.
            if (strpos($referer, $engine . ".") !== false &&
                    strpos($referer, $query_param) !== false) {

                // Grab the keyword from the referer url
                $referer .= "&";
                $pattern = "/[?&]{$query_param}(.*?)&/si";
                preg_match($pattern, $referer, $matches);
                $search_phrase = urldecode($matches[1]);
//                return array($engine, $search_phrase);
            } else {

                $search_phrase = null;
            }
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);

        return $result;
    }

    /**
     * @param string $class alternative class
     * return vistor os icon
     * @uses awesome font
     */
    static public function GetOSIcon($class = '') {
        // get os 
        $os_int = self::DetectOSI();

        $win = range(1, 16);
        $linux = range(17, 19);
        $osx = array(20, 21);
        $android = array(25);
        $searchbot = array(27);
        $other = array(0, 22, 23, 24, 26);

        switch (true) {
            case in_array($os_int, $win):
                $icon = 'windows';
                break;
            case in_array($os_int, $linux):
                $icon = 'linux';
                break;
            case in_array($os_int, $osx):
                $icon = 'apple';
                break;

            case in_array($os_int, $android):
                $icon = 'android';
                break;

            case in_array($os_int, $searchbot):
                $icon = 'google';
                break;
            default:
                $icon = 'question';
                break;
        }

        $result = '<span class="fa fa-' . $icon . ' ' . $class . '" title="' 
                . self::DetectOS() . '" ></span>';
        //result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }
    /**
     * @param string $class alternative class
     * return vistor browser icon
     * @uses awesome font
     */
    static public function GetBrowerIcon($class = '') {
        // get os 
        $bowser = self::DetectBrowser();

       

        $result = '<span class="fa fa-' . strtolower($bowser) . ' ' . $class . '" title="' 
                . self::DetectBrowser() . '" ></span>';
        //result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

}
