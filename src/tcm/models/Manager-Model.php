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
class ManagerModel extends TModel {

    function __construct() {
        parent::__construct('manager','manager_');
    }    
    
    
    /**
     * @todo edit an reocrd with id 
     * @param int $id
     * @param array $data
     * @param string $prefix prifex id
     * @category general
     */
    public function Edit($id, $data, $prefix = null) {
        $on_edit =  $this->GetRecord($id);
        if ($on_edit['manager_protected']  && $_SESSION['MN_ID'] == $on_edit['manager_id'] ||$on_edit['manager_protected'] == 0 ) {
            parent::Edit($id, $data, $prefix);
            return true;
        }
        return false;
    }
} 

?>