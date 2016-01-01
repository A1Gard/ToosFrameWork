<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 9-July-2014
 * @time : 20:41 
 * @subpackage  TMenu
 * @version 1.0
 * @todo : All Menu mode managing class
 */
class TMenu {

    // item detials
    private $menu_parent = array();
    private $menu_title = array();
    private $menu_link = array();
    private $menu_icon = array();
    // item insert pinter
    private $pointer = 1000;
    // sub item classes | parent
    private $sub_class = 'sub';
    private $parent_class = 'sub-menu';
    // array of all item ready to sort for render
    private $item_array = array();

    function __construct() {
        
    }

    /**
     * get retun Item count in menu
     * @return int
     */
    public function ItemCount() {
        $result = count($this->menu_title);

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    /**
     * main item count (main = has no parent)
     * @return int
     */
    public function MainItemCount() {
        $result = array_count_values($this->menu_parent);

        $result = $result[0];
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    /**
     * Child items count ( child = has parent) 
     * @return int
     */
    public function ChildItemCount() {

        $result = $this->ItemCount() - $this->MainItemCount();

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    /**
     * set class for sub items
     * @param string $sub_items_class class info
     */
    public function SetSubClass($sub_items_class) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $sub_items_class);

        $this->sub_class = $sub_items_class;
    }

    /**
     * set class for parent items
     * @param type $parent_items_class class info
     */
    public function SetParentClass($parent_items_class) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $parent_items_class);

        $this->sub_class = $parent_items_class;
    }

    /**
     * Add item to menu
     * @param string $title title of item
     * @param string $link 
     * @param int $parent parent of item ( 0 = no parent)
     * @param string $icon awsome icon of item
     * @param int $pointer offset of this item [+/-] 
     * @return int inserted item id
     */
    public function AddItem($title, $link = '#', $parent = 0, $icon = null, $pointer = null) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $title, $link, $parent, $icon, $pointer);

        if ($pointer != null) {
            $tmp = $this->pointer;
            $this->pointer = $this->pointer + $pointer;
        }
        $this->menu_title[$this->pointer] = $title;
        $this->menu_link[$this->pointer] = $link;
        $this->menu_parent[$this->pointer] = $parent;
        $this->menu_icon[$this->pointer] = $icon;

        $result = $this->pointer;



        $this->pointer = (isset($tmp) ? $tmp + 1 : $this->pointer + 1);


        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    /**
     * assing item again
     * @param int $index item index
     * @param string $title title of item
     * @param string $link 
     * @param int $parent parent of item ( 0 = no parent)
     * @param string $icon awsome icon of item
     * @return boolean reassigned or not 
     */
    public function ReassignItem($index, $title = null, $link = null, $parent = null, $icon = null) {

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $index, $title, $link, $parent, $icon);


        if (isset($this->menu_title[$index])) {

            $this->menu_title[$index] = ($title == null ? $this->menu_title[$index] : $title );
            $this->menu_link[$index] = ($link == null ? $this->menu_link[$index] : $link );
            $this->menu_parent[$index] = ($parent == null ? $this->menu_parent[$index] : $parent );
            $this->menu_icon[$index] = ($icon == null ? $this->menu_icon[$index] : $icon );

            $result = TRUE;
        } else {
            $result = FALSE;
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    /**
     * remove item from menu with|without childs
     * @param int $index or id of item
     * @param type $remove_children is children remove ro not
     * @return boolean removed or not
     */
    public function RemoveItem($index, $remove_children = true) {


        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $index, $remove_children);


        if (isset($this->menu_title[$index])) {

            unset($this->menu_title[$index]);
            unset($this->menu_link[$index]);
            unset($this->menu_parent[$index]);
            unset($this->menu_icon[$index]);

            // remove child if ture
            if ($remove_children) {
                foreach ($this->menu_parent as $key => $parent) {
                    if ($parent == $index) {
                        unset($this->menu_title[$key]);
                        unset($this->menu_link[$key]);
                        unset($this->menu_parent[$key]);
                        unset($this->menu_icon[$key]);
                    }
                }
            }

            $result = TRUE;
        } else {
            $result = FALSE;
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    /**
     * made and sort array for render menu
     * @return boolean
     */
    private function _renderArray() {
        $tmp = array();
        foreach ($this->menu_parent as $key => $parent) {
            $tmp[$parent][] = $key;
        }
        $this->item_array = array();
        foreach ($tmp as $k => $arr) {
            sort($arr);
            $this->item_array[$k] = $arr;
        }
        return TRUE;
    }

    /**
     * show list by item index
     * @param int $index index of items and subitmes
     */
    private function _showList($index) {

        $result = '';
        foreach ($this->item_array[$index] as $key => $value) {

            // if has child show childs
            if (isset($this->item_array[$value])) {

                $result .= '<li class="' . $this->parent_class . ' item-' .
                        $value . '" ><a href="' . $this->menu_link[$value] . '">' .
                        // icon show
                        ($this->menu_icon[$value] != null ? ( '<i class="fa ' .
                                $this->menu_icon[$value] . '"></i>') : '' ) .
                        // title show
                        '<span>' . $this->menu_title[$value];


                $result .= '</span></a> ' . PHP_EOL . ' <ul class="' . $this->sub_class .
                        '">' . PHP_EOL;
                $result .= $this->_showList($value);
                $result .= '</ul>' . PHP_EOL;

                $result .= "</li> \n";
            } else {

                $result .= '<li class="item-' . $value . '"><a href="' . $this->menu_link[$value] . '">' .
                        // icon show
                        ($this->menu_icon[$value] != null ? ( '<i class="fa ' .
                                $this->menu_icon[$value] . '"></i>') : '' ) .
                        // title show
                        '<span>' . $this->menu_title[$value] . '</span>' . "</a> </li> \n";
            }
        }
        return $result;
    }

    /**
     * Render and show menu
     * @param string $id menu id
     * @param string $class menu classes
     */
    public function Render($id = 'TMenu', $class = '') {


        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $id, $class);

        $result = '<ul class="' . $class . '" id="' . $id . '" >' . PHP_EOL;


        $this->_renderArray();

        $result .=$this->_showList(0);


        $result .= '</ul>' . PHP_EOL;


        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

}
