<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   calss-model.php
 * @todo : calssUR_MP_ASSETS page page
 */

/**
 * class for user accessUR_MP_ASSETS
 */
class DropDownMenuModel extends TModel {

    function __construct() {
        parent::__construct('dropdown','dropdown_');
    }    


    
    /**
     * sync the category parent
     * @param mixed $parent
     * @return boolean
     */
    public function DropDownSync($parent,$sort) {
        if ($parent == array()) {
            return true;
        }
        
        // removed all parent
        unset($parent[0]);
        unset($sort[0]);

        $update = null;
        $ids = null;
        
        // each abd save sql for save parent
        foreach ($parent as $id => $parentx) {
            $update .=  PHP_EOL . ' WHEN ' . ( (int) $id ) . ' THEN ' .
                    ( (int) $parentx );
            $ids .= ( (int) $id ) . ',';
        }
        // trim finall sql
        $ids = rtrim($ids, ',');

        // create sql.
        $sql = "UPDATE " . DB_PREFIX . "dropdown
            SET dropdown_parent = CASE dropdown_id
                $update
            END
            WHERE dropdown_id IN (" . $ids . ")";
        // exc sql
        $result = $this->db->CustomQuery($sql);
        
        $update = null;
        $ids = null;
        
        // each abd save sql for save parent
        foreach ($sort as $id => $sortx) {
            $update .=  PHP_EOL . ' WHEN ' . ( (int) $id ) . ' THEN ' .
                    ( (int) $sortx );
            $ids .= ( (int) $id ) . ',';
        }
        // trim finall sql
        $ids = rtrim($ids, ',');

        // create sql.
        $sql = "UPDATE " . DB_PREFIX . "dropdown
            SET dropdown_sort_index = CASE dropdown_id
                $update
            END
            WHERE dropdown_id IN (" . $ids . ")";
        // exc sql
        $result = $this->db->CustomQuery($sql);
        
        return $result;
    }
} 

?>