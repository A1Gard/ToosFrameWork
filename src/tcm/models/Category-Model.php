<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 9-Julay-2014 
 * @time : 16:32 
 * @subpackage   calss-model.php
 * @todo : calss model page page
 */

/**
 * class for category
 */
class CategoryModel extends TCategory {

    function __construct() {
        parent::__construct('category');
    }

    /**
     * sync the category parent
     * @param mixed $catgories
     * @return boolean
     */
    public function CategorySync($catgories) {
        if ($catgories == array()) {
            return true;
        }
        // removed all parent
        unset($catgories[0]);
        
        $update = null;
        $ids = null;
        
        // each abd save sql for save parent
        foreach ($catgories as $id => $parent) {
            $update .=  PHP_EOL . ' WHEN ' . ( (int) $id ) . ' THEN ' .
                    ( (int) $parent );
            $ids .= ( (int) $id ) . ',';
        }
        // trim finall sql
        $ids = rtrim($ids, ',');

        // create sql.
        $sql = "UPDATE " . DB_PREFIX . "category
            SET category_parent = CASE category_id
                $update
            END
            WHERE category_id IN (" . $ids . ")";
        // exc sql
        $result = $this->db->CustomQuery($sql);
        
        if ($result !== FALSE) {
            $result = TRUE;
        }
        return $result;
    }

}

?>