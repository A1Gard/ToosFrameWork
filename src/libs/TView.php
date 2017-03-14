<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   View  Super class
 * @todo : View
 */

class TView {

    function __construct() {
        // make Navigator in view
        $this->navigator = new TNavigator(_lg('Toos'));
    }
    
    
    public function PageRender($file,$title='',$is_include = true) {
        
        $this->title = $title;
        
        if ($is_include) {
            
            // final page title add to Navigator
            $this->navigator->AddItem($title);
            
            require 'views/Layout/header.php';
            require 'views/' . $file . '.php';
            require 'views/Layout/footer.php';
            
        } else {
            
            require 'views/' . $file . '.php';
        }
        
    }

}

?>
