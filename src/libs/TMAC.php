<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   TMAC
 * @version 1.0
 * @todo : Manager access controller 
 */
class TMAC {

    private static $init = false;

    /**
     * initial class 
     */
    public static function Init() {
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__);
        @session_start();
        self::$init = TRUE;
    }

    /**
     * @todo Get session value
     * @param string $key key of session request
     * @return variable
     */
    public static function GetSession($key) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $key);

        // check isset sesstion for return
        if (isset($_SESSION[$key])) {
            $result = $_SESSION[$key];
        } else {
            $result = null;
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    /**
     * @todo unset session by key
     * @param string $key key of session request to destroy
     * @return null
     */
    public static function DestroySession($key) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $key);
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
        return null;
    }

    /**
     * @todo Set session value with key 
     * @param string $key
     * @param Varible $value
     */
    public static function SetSession($key, $value) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $key, $value);
        $_SESSION[$key] = $value;
    }

    /**
     * @todo Get cookie value 
     * @param string $key
     * @return Variable
     */
    public static function GetCookie($key) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $key);
        if (isset($_COOKIE[$key])) {
            $result = $_COOKIE[$key];
            // result hook
            _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
            return $result;
        }
        return null;
    }

    /**
     * @todo set cookie value with key 
     * @param string $key
     * @param string $value
     * @param int $min how many min until expire  |default  15 days
     * @param  sting $path 
     */
    public static function SetCookie($key, $value, $min = 21600, $path = '/') {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $key, $value, $min);

        setcookie($key, $value, time() + ($min * 60), $path);
    }

    /**
     * @todo give access with set values
     * @param array $UserDetails
     * @param bool $remenber
     */
    public static function GiveAccess($user_details = array(), $remenber = FALSE) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $user_details, $remenber);

        self::SetSession('MN_ID', $user_details['manager_id']);
        self::SetSession('MN_TYPE', $user_details['manager_type']);
        self::SetSession('MN_UA', md5($_SERVER['HTTP_USER_AGENT']));
        self::SetSession('MN_PR', explode(',', $user_details['manager_permission']));
        self::SetSession('MN_LK', LOGIN_KEY);

        // set cookie if need 
        if ($remenber) {
            // get registry value Reminber time how many min.
            $registry = TRegistry::GetInstance();
            $min = $registry->GetValue(ROOT_SYSTEM, 'remenber_time');

            self::SetCookie('MN_ID', $user_details['manager_id'], $min);
            self::SetCookie('MN_TYPE', $user_details['manager_type'], $min);
            self::SetCookie('MN_UA', md5($_SERVER['HTTP_USER_AGENT']), $min);
            self::SetCookie('MN_PR', $user_details['manager_permission'], $min);
            self::SetCookie('MN_LK', LOGIN_KEY, $min);
        }
    }

    /**
     * @todo take access with unset session & expire cookie 
     * @return bool
     */
    public static function TakeAccess() {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__);

        self::DestroySession('MN_ID');
        self::DestroySession('MN_TYPE');
        self::DestroySession('MN_UA');
        self::DestroySession('MN_PR');
        self::DestroySession('MN_LK');

        self::SetCookie('MN_ID', '', time() - 1);
        self::SetCookie('MN_TYPE', '', time() - 1);
        self::SetCookie('MN_UA', '', time() - 1);
        self::SetCookie('MN_PR', '', time() - 1);
        self::SetCookie('MN_LK', '', time() - 1);

        return TRUE;
    }

    /**
     * @todo Check Hijacking in system & login key
     * @return bool
     */
    private static function _checkHijacking() {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__);
        // UA = HTTP_USER_AGENT
        // LK = login key 
        if (isset($_COOKIE['MN_UA'])) {
            $UA = $_COOKIE['MN_UA'];
            $LK = $_COOKIE['MN_LK'];
        } else {
            $UA = $_SESSION['MN_UA'];
            $LK = $_SESSION['MN_LK'];
        }

        // check UA
        if (($UA == md5($_SERVER['HTTP_USER_AGENT'])) && ($LK == LOGIN_KEY)) {
            $result = FALSE;
        } else {
            $result = TRUE;
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    /**
     * @todo store post & get and save curent page to redirect after login
     */
    public static function StoreRequest() {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__);

        if (self::GetSession('post') !== null) {
            return FALSE;
        }

        if (isset($_POST)) {
            self::SetSession('request', true);
            self::SetSession('post', $_POST);
        }
        self::SetSession('redirect', '/'. trim($_SERVER['REQUEST_URI'], '/'));
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__);
    }

    /**
     * @todo restore post & get for example in login failed
     */
    public static function RestoreRequest() {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__);
        // check if not post any think and not reqest set before than restore request
        if ((!isset($_POST) || count($_POST == 0)) && self::GetSession('request') == true) {
            $_POST = self::GetSession('post');
            $_REQUEST = array_merge(self::GetSession('post'), $_GET);
            self::DestroySession('request');
            self::DestroySession('post');
            self::DestroySession('redirect');
        }
    }

    /**
     * @todo check is user login else redirect to login page
     * @return bool
     */
    public static function CheckLogin() {
        $result = false;
        //check if seted session user user logined
        if (isset($_SESSION['MN_ID'], $_SESSION['MN_TYPE'], $_SESSION['MN_UA'], $_SESSION['MN_LK'])) {

            $result = !self::_checkHijacking();
            // else if cookie set make session from cookie if not hijacjcked 
        } elseif (isset($_COOKIE['MN_ID'], $_COOKIE['MN_TYPE'], $_COOKIE['MN_UA'], $_COOKIE['MN_LK'])) {

            // set session if not hjiacked
            if (!self::_checkHijacking()) {

                self::SetSession('MN_ID', $_COOKIE['MN_ID']);
                self::SetSession('MN_TYPE', $_COOKIE['MN_TYPE']);
                self::SetSession('MN_UA', $_COOKIE['MN_UA']);
                self::SetSession('MN_LK', $_COOKIE['MN_LK']);
                if (isset($_COOKIE['MN_PR'])) {

                    self::SetSession('MN_PR', explode(',', $_COOKIE['MN_PR']));
                }
                $result = true;
            }
        }

        global $MANAGER_TYPE;
        // check permissions
        $typ = self::GetSession('MN_TYPE');
        if ($typ != $MANAGER_TYPE['OWNER'] && $typ != $MANAGER_TYPE['ADMIN'] && $typ == $MANAGER_TYPE['DEFINED']) {
            if (!in_array(CURRENT_EXTENSION, self::GetSession('MN_PR'))) {
                $allow = array(
                    'Index/e403',
                    'Access/Logout'
                );
                if (!in_array($_GET['req'], $allow)) {
                    Redirect(UR_MP . 'Index/e403');
                    exit();
                }
            }
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);

        if (!$result) {
            self::TakeAccess();
            // store session to after login
            self::StoreRequest();

            Redirect(UR_MP . 'Access/Login');
            exit();
        } else {
            return TRUE;
        }
    }

    /**
     * @todo check is user login don't redirect
     * @return bool
     */
    public static function IsLogin() {

        //check if seted session user user logined
        if (isset($_SESSION['MN_ID'], $_SESSION['MN_TYPE'], $_SESSION['MN_UA'], $_SESSION['MN_LK'])) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

}
