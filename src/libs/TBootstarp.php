<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   Bootstrap super class
 * @todo : bootstrap class system manager page & bootsrap function. 
 */

/**
 * @name Bootstarp 
 * @todo Bootstrap the system 
 */
class TBootstarp {

    // user request detail
    private $_url = array();
    public static $request = NULL;

    function __construct() {

        // get - load request to class
        $this->_GetRequest();
        // load controller
        $this->_Loader(count($this->_url));

        // run debug system set 
        if (_DBG_) {
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
        }
    }

    /**
     * @name _getRequest 
     * @todo get reauest user and pass to class 
     */
    private function _GetRequest() {

        /* @var $request string get apache request passed to index */
        if (isset($_REQUEST['req']) && $_REQUEST['req'] != '') {

            $request = rtrim($_REQUEST['req'], '/');
            $this->_url = explode('/', $request);
        } else {

            // set deafult index
            $this->_url = array(0 => 'index.php');
        }

        self::$request = implode(',', $this->_url);
        define('CURRENT_EXTENSION', $this->_url[0]) ;
    }

    /**
     * @name _loader 
     * @todo load cm controler
     * @param int $length url requset length array
     */
    private function _Loader($length) {

        // loading extension loaders
        $this->_ExtensionLoader();
        

        // check is requset any thing
        if (($length == 1) && ($this->_url[0] == 'index.php')) {
            // load index
            $this->_LoadDefaultController();
        } else {
            // load request controller
            $this->_LoadExistsController($length);
        }
        
    }

    /**
     * @name _LoadDefaultControler
     * @todo load default contoller - index
     * @return bool
     */
    private function _LoadDefaultController() {

//        if (__MP__) {
//            // default file ;
//            $filename = 'controllers/Index-Controller.php';
//        } else {

            $filename = PA_MP_REAL . '/controllers/Index-Controller.php';
//        }

        // check file  inc file
        if (file_exists($filename)) {
            require_once  $filename;
        } else {
            if (_DBG_) {
                throw new Exception(" requere file '$filename' in 'Bootstrap->_LoadDefaultController()' ");
            }
        }


//        echo 1;
        $this->controller = new Index();
        // loadUR_MP_ASSETS if exists
        $this->controller->LoadModel($this->_url[0]);
        // call deafult method
        $this->controller->Index();
        return false;
    }

    /**
     * @name _LoadExistsController
     * @todo load MVC must do to user
     * @param int $length request array length
     * @return bool
     */
    private function _LoadExistsController($length) {
        // default file ;
        $filename = PA_MP_REAL . '/controllers/' . $this->_url[0] . '-Controller.php';

        // check file  inc file
        if (file_exists($filename))
            require_once $filename;
        else {
            $filename = PA_MP_REAL . '/controllers/Index-Controller.php';
            require_once  $filename;
            $_404 = new Index();
            $_404->e404();
            exit();
        }

        // set default method loader
        if (!isset($this->_url[1])) {
            $this->_url[1] = "Index";
            $length = 2;
        }


        
        // else
        // create from class 
        $this->controller = new $this->_url[0]();
        // loadUR_MP_ASSETS if exists
        $this->controller->LoadModel($this->_url[0]);
        
        if (!method_exists($this->controller, $this->_url[1])) {
            $filename = PA_MP_REAL . '/controllers/Index-Controller.php';
            require_once  $filename;
            $_404 = new Index();
            $_404->e404();
            exit();
        }

        switch ($length) {
            /**
             * controller->mothod();
             */
            case 2:
                $this->controller->{$this->_url[1]}();
                break;
            /**
             * controller->mothod($param1,...);
             */
            default:
                $passing_array = array_slice($this->_url, 2);

                call_user_func_array(array($this->controller, $this->_url[1]), $passing_array);
                break;
        }
    }
    
    private function _ExtensionLoader() {
        global $loaded_extensions;
        $path = PA_MP_REAL . '/controllers/';
        foreach (glob($path.'*.php') as $controller) {
            include_once $controller;
            $cls = substr($controller, strlen($path), -15);
            $cls::Loader();
            $loaded_extensions[] = $cls ;
        }
    }
}

#------------------------------------------------------------------------------
