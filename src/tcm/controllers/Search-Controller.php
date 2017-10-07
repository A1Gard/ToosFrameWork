<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   Topic-controller.php | topics controller
 * @todo :   
 */

class Search extends TController {
    
    function __construct() {
        
        parent::__construct() ;
        self::$_main_title = _lg('Search') ;
    }
    
    public function AjaxSearchAll() {
       echo $this->model->AjaxSearchAll($_GET['mode'],$_GET['q']);     
    }
    
 
}

