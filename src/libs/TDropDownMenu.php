<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 7-July-2014
 * @time : 00:41 
 * @subpackage   TDropDownMenu
 * @version 0.8
 * @todo : Drop Down menu class
 */
class TDropDownMenu extends TModel {

    function __construct($table_name = 'dropdown') {
        parent::__construct($table_name, 'dropdown_');
        $this->table_name = $table_name;
    }

    /**
     * get drop down aray by parent one level only
     * @param int $parent
     * @return mixed
     */
    
    public function DropDownByParent($parent) {
        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $parent);

        // select all item by parent
        $sql = "SELECT * FROM %table% WHERE " . $this->table_name . '_parent'
                . ' = :parent ORDER BY dropdown_sort_index ASC';
        $result = $this->db->Select($sql, array($this->table_name), array('type' => 'i', ':parent' => (int) $parent));

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);


        return $result;
    }

    /**
     * retrun dropdown menu in ordered list
     * @param int $parent start parent id
     * @return string
     */
    public function DropDownOL($parent = 0) {


        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $parent);

        if ($parent == 0) {
            $result = '<ol class="drg drop-down-menu" id="drop-down-menu" data-id="0" >';
        } else {
            $result = '<ol>';
        }
// get drop down by parent
        $item_list = $this->DropDownByParent($parent);
// and show this in the each
        foreach ($item_list as $record) {
            $result .= '<li data-id="' . $record[$this->table_name . '_id'] . '" '
                    . '>';
            $result .= "<i class=\"fa fa-plus\"></i>";
            $result .= $record[$this->table_name . '_title'];
            // get the child of them
            $result .= $this->DropDownOL($record[$this->table_name . '_id']);
            $result .= '</li>' . PHP_EOL;
        }
        $result .= '</ol>' . PHP_EOL;

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);


        return $result;
    }

    /**
     * retrun dropdown menu in ordered list
     * @param int $parent start parent id
     * @return string
     */
    public function DropDownUL($parent = 0) {

        global $database_handle;
        $this->db = $database_handle;

        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $parent);
        
        if ($parent != 0) {
            $result = '<ul>';
        } else {
            $result = null;
        }

// get drop down by parent
        $item_list = $this->DropDownByParent($parent,$mode = 0,$lnk = '');
// and show this in the each
        foreach ($item_list as $record) {
            $mod = $record['dropdown_mode'];
            switch ($mod) {
            case 0:
                $link = $record['dropdown_link'] ;
            break;
            case 1:
                $link = UR_BASE . 'یادداشت'. '/' . $record['dropdown_link'] ;
            break;
            case 2:
                $link = UR_BASE . 'برچسب'. '/' . $record['dropdown_link'] ;
            break;

            default:
                $link = UR_BASE . 'سرفصل'. '/' . $record['dropdown_link'] ;
            break;
        }
            $result .= '<li data-id="' . $record[$this->table_name . '_id'] . '" '
                    . '> <a href="'.$link.'">';
            $result .= $record[$this->table_name . '_title'] .'</a>' ;
            // get the child of them
            if ($mod == 4){
                $result .= '<ul>';
                $splt = explode('/', $record['dropdown_link']);
                $splt =(int) $splt[0];
                echo ($splt);
                if ( $splt > 0 ){
                    $cat =  TCategory::GetInstance();
                    $cats =  $cat->CategoryByParent($splt);
                    foreach ($cats as $itm) {
                        $link = UR_BASE . 'سرفصل'. '/' . $itm['category_id'] . '/' . $itm['category_title'];  ;
                        $result .= '<li> <a href="'.$link.'">' . $itm['category_title'].'</a></li>';
                    }
                }
                $result .= '</ul>';
            }
            $result .= $this->DropDownUL($record[$this->table_name . '_id'],$mod, $record['dropdown_link']);
            $result .= '</li>' . PHP_EOL;
            
        }

        if ($parent != 0) {
            $result .= '</ul>' . PHP_EOL;
        }
        

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    /**
     * save dropwodn item position
     * @param int $id
     * @param int $parent
     * @param int $index
     * @return boolean
     */
    public function SavePosition($id, $parent, $index) {
        // Pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this,$id, $parent,$index);
        
        // save the current needed item position index and parant
        $data = array('dropdown_parent' => (int) $parent, 'dropdown_sort_index' => (int) $index);
        $this->Edit($id, $data);
        // increment index of after current item in this parant
        return $this->db->CustomQuery('UPDATE ' . DB_PREFIX . $this->table_name . ' SET '
                . 'dropdown_sort_index = dropdown_sort_index + 1 '
                . 'WHERE  dropdown_sort_index >= ' . ((int) $index) . ' AND dropdown_id <> ' . ((int) $id)
                . ' AND dropdown_parent = ' . ((int) $parent ), array());
    }

}
