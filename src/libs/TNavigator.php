<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   TNavigator
 * @version 1.0
 * @todo : Navigator class create TNavigator 
 */

class TNavigator {
    
    
    /**
     * @todo this is TNavigator default item body
     * @var String Item 
     */
    public static $item_body = '
               <span itemscope="itemscope" class="crust">
                    <a class="crumb" %url%>
                    %text%
                    </a>
                    <span class="arrow">
                        <span>&gt;</span>
                    </span>
                </span>';
    /**
     * @todo items save here
     * @var Array of item (item is array) 
     */
    private $item = array();
    
    /**
     * @todo Add item to class items- internal
     * @param string $text title or item text
     * @param string $link item link
     */
    private function _addItem($text,$link) {
        // get last item
        $key = count($this->item);
        // add to array
        $this->item[$key]['text'] = $text ;
        
        // made link
        if ($link == '') {
            $this->item[$key]['link'] = '' ;
        }  else {
            $this->item[$key]['link'] = 'href="' . $link . '"' ;
        }
        
    }
    
    /**
     * construct class and get root title and add to item
     * @param String $root
     */
    function __construct($root) {
        
        // add root in first
        $this->_addItem($root, __MP__ ? UR_MP : UR_BASE );
    }
    
    /**
     * @todo add Item extrenal from out of class
     * @param string $text title or text of item 
     * @param string $link url or link of item
     */
    public function AddItem($text,$link='') {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $text, $link);
        
        // add item to class intenal .
        $this->_addItem($text, $link);
    }

    /**
     * @todo render item and show form added items
     */
    public function Render() {
     
        $result = '';
        foreach ($this->item as $itm) {
            
            // replace item values in body
            $temp = str_replace('%text%', $itm['text'], self::$item_body);
            $temp = str_replace('%url%', $itm['link'], $temp);
            
            $result .= $temp ;
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        echo $result;
    }
    
    

}

?>
