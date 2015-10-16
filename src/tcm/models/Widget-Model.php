<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   calss-model.php
 * @todo : calssUR_MP_ASSETS page page
 */

/**
 * class for user accessUR_MP_ASSETS
 */
class WidgetModel extends TModel {

    function __construct() {
        parent::__construct('widget','widget_');
    }    
    
    public function GetWidgetTitle($id){
        
        $record = $this->GetRecord($id);
        $result = unserialize($record);
        
        if (isset($result['title'])){
            $result = $result['title'];
        }else{
            $result = 'untitled';
        }
    }
    
} 

?>