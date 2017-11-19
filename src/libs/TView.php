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
        $this->assest_loader = TAseetLoader::GetInstance();
    }

    public function PageRender($file, $title = '', $is_include = true) {

        $this->title = $title;

        if ($is_include) {

            // final page title add to Navigator
            $this->navigator->AddItem($title);

            require PA_MP_REAL . '/views/Layout/header.php';
            if (file_exists(PA_MP_REAL . '/views/' . $file . '.php')) {
                require PA_MP_REAL . '/views/' . $file . '.php';
            } else {
                _lp("Can't find this page for render");
            }
            require PA_MP_REAL . '/views/Layout/footer.php';
        } else {
            if (file_exists(PA_MP_REAL . '/views/' . $file . '.php')) {
                require PA_MP_REAL . '/views/' . $file . '.php';
            } else {
                _lp("Can't find this page for render");
            }
        }
    }

}

?>
