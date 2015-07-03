<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   Bootstrap super class
 * @todo : bootstrap class system content manage & bootsrap function. 
 */



/** 
 * @name Bootstarp 
 * @todo Bootstrap the system 
 */
class Bootstarp {

    // user request detail
    private $_url = array();
    public static  $request = NULL ;


    function __construct() {
        
        // get - load request to class
        $this->_GetRequest();
        
        // load controller
        $this->_Loader(count($this->_url)) ; 
        
        // run debug system set 
        if (_DBG_) {
            error_reporting(E_ALL);
        }  else {
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
            
            $request = rtrim( $_REQUEST['req'] , '/');
            $this->_url = explode('/', $request);
            
        }  else {
            
            // set deafult index
            $this->_url = array(0 => 'index.php');
        }
        
        self::$request = implode(',', $this->_url ) ;   
    }
    
    
    
    /**
     * @name _loader 
     * @todo load cm controler
     * @param int $length url requset length array
     */
    private function _Loader($length) {
        
        // check is requset any thing
        if (($length == 1) && ($this->_url[0] == 'index.php')) {
            // load index
            $this->_LoadDefaultController();
        }  else {
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
        
        // default file ;
        $filename = 'controllers/Index-Controller.php';
        
        // check file  inc file
        if (file_exists($filename))
            require $filename ;
        else 
           throw new Exception(" requere file '$filename' in 'Bootstrap->_LoadDefaultController()' "); 

        $this->controller = new Index() ;
        // load model if exists
        $this->controller->LoadModel($this->_url[0]) ;
        // call deafult method
        $this->controller->Index() ;
        return false;
    }
    
    
    /**
     * @name _LoadExistsController
     * @todo load MVC must do to user
     * @param int $length request array length
     * @return bool
     */
    private function _LoadExistsController($length){
        
         // default file ;
        $filename = 'controllers/' . $this->_url[0] . '-Controller.php';

        // check file  inc file
        if (file_exists($filename))
            require $filename ;
        else 
             throw new Exception(" requere file '$filename' in 'Bootstrap->_LoadDefaultController()' "); 

        if ($length == 1) {
             $this->controller = new $this->_url[0]() ;
             $this->controller->Index();
             return false;
        }
        
        // else
        
        // create from class 
        $this->controller = new $this->_url[0]() ;
        // load model if exists
        $this->controller->LoadModel($this->_url[0]) ;
        
        
        switch ($length) {
            /**
             * controller->mothod();
             */
            case 2:
                
                $this->controller->{$this->_url[1]}();    
                break;
            /**
             * controller->mothod($param1);
             */
            case 3:
                $this->controller->{$this->_url[1]}($this->_url[2]);    
                break;
            /**
             * controller->mothod($param1,$param2);
             */
            case 4:
                $this->controller->{$this->_url[1]}($this->_url[2],$this->_url[3]);    
                break;
            /**
             * controller->mothod($param1,$param2,$param3);
             */
            case 5:
                $this->controller->{$this->_url[1]}($this->_url[2],$this->_url[3],$this->_url[4]);    
                break;
            /**
             * controller->mothod($param1,$param2,$param3,$param4);
             */
            default:
                $this->controller->{$this->_url[1]}($this->_url[2],$this->_url[3],$this->_url[4],$this->_url[5]); 
                break;
        }
        
    }

    
    
}

#------------------------------------------------------------------------------


?>