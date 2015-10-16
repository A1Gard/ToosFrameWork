<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   Topic-controller.php | topics controller
 * @todo :   
 */

class DropDownMenu extends TController {
    
    function __construct() {
        
        parent::__construct() ;
        self::$_main_title = _lg('DropDown Menu') ;
    }
    
    
    // parent
    private function _arrryCleanerP($array, $parent_id = 0) {

        foreach ($array[0] as $obj) {
            $result[$obj->id] = $parent_id;
            if ($obj->children[0] != array()) {
                $child = $this->_arrryCleanerP($obj->children, $obj->id);
                $result +=  $child;
            }
        }
        return $result;
    }
    
    // sort
    private function _arrryCleanerS($array) {

        foreach ($array[0] as $key => $obj ) {
            $result[$obj->id] = $key;
            if ($obj->children[0] != array()) {
                $child = $this->_arrryCleanerS($obj->children);
                $result +=  $child;
            }
        }
        return $result;
    }

    
    
    /**
     * @todo Show index without any thing
     */
    public function Index() {
        $this->view->dropdown = new TDropDownMenu();
        $this->view->PageRender('DropDownMenu/Index',self::$_main_title);
    }
    
    public function Insert() {
        unset($_POST['ajax']);
        $id = $this->model->Create($_POST);
        if ((int) $id > 0){
            $result['success'] = true;
            $result['id'] = $id;
            $result['value'] = "insert succesffully";
        }else{
            $result['success'] = false ;
            $result['value'] = 'cannot insert value';
        }
        echo json_encode($result);
    }
    
    public function Update($id) {
        if (isset($_POST['ajax'])){
            unset($_POST['ajax']);
        }
        $result['success'] = $this->model->Edit($id,$_POST);
        $result['value'] = 'can not move menu item';
        echo json_encode($result);
    }
    public function Delete($id) {
        $result['success'] = $this->model->Delete(intval($id));
        $result['value'] = 'can not remove menu item';
        echo json_encode($result);
    }
    
     public function Sync() {
         
        $array = json_decode($_POST['sorted']);
        $arrayp = $this->_arrryCleanerP($array);
        $arrays = $this->_arrryCleanerS($array);
 
        $this->model->DropDownSync($arrayp,$arrays);
        
    }

}

