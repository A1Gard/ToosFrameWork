<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 3-April-2013 (14-1-1392) 
 * @time : 23:32 
 * @subpackage   TPublicLibrary
 * @version unstable 
 * @todo : Load Js or css needs in cms
 */
class TPublicLibrary {

    private $extrenal_libs = false;
    private $minified_libs = false;
    public $template = null;

    function __construct() {
        // Get setting from registry 
        $registry = TRegistry::GetInstance();
        $this->extrenal_libs = 0 ;
        $this->minified_libs = 1;
        $this->template = $registry->GetValue(ROOT_SYSTEM, 'template');
    }

    /**
     * @todo load js & css from internalsource
     */
    private function _loadInternalLibs() {
        // check for minified
        $this->minified_libs ? $suffix = '.min' : $suffix = '';
        
        // jquery
        echo '<script type="text/javascript" src="' . UR_MP_ASSETS . 'js/jquery' . $suffix . '.js"></script>' . PHP_EOL
        . '
            <!--[if lte IE 9]>
                <script src="' . UR_MP_ASSETS . 'js/iefix.js" type="text/javascript"></script>
            <![endif]-->' . PHP_EOL;
        echo "\n\t<!-- css self load--> \n";
        self::LoadCMCSS('topstrap.min');
        self::LoadCMCSS('font-awesome.min','awesome-font');
        self::LoadCMCSS('genreal');
        self::LoadCMCSS('element');
        echo  PHP_EOL.PHP_EOL;
    }

    /**
     * @todo load lib with system role
     */
    public function LoadPublicLibs() {
        $this->_loadInternalLibs();
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this);
    }

    /**
     * @todo load js from cm public dir
     */
    public static function LoadCMJS($js_name) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $js_name);
        $result = "\n\t<!-- js manager page load--> \n";
        foreach ($js_name as $name) {
            $result .= "\t" . '<script type="text/javascript" src="' . UR_MP_ASSETS . 'js/' . $name . '.js"></script>' . PHP_EOL;
        }
        $result .= PHP_EOL.PHP_EOL;
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        echo $result;
    }

    /**
     * @todo load css from cm public dir
     * @param (mixed|string) $css_name
     * @param string $id if need id for csss
     */
    public function LoadCMCSS($css_name,$id = null) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $css_name);
        if (is_array($css_name)) {
            foreach ($css_name as $css) {
            
            echo "\t" . '<link type="text/css" rel="stylesheet" href="' . UR_MP_ASSETS . 'css/' . $css . '.css"  '.($id != null? 'id="'.$id.'" ' : '' ).'  />' . PHP_EOL;
            }
        }  else {
            echo "\t" . '<link type="text/css"  rel="stylesheet" href="' . UR_MP_ASSETS . 'css/' . $css_name . '.css" '.($id != null? 'id="'.$id.'" ' : '' ).'  />' . PHP_EOL;
        }
    }

    /**
     * @todo load js from package public dir
     */
    public static function LoadPackageJS($js_name) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $js_name);
        $result = "\n\t<!-- js package load--> \n";
        foreach ($js_name as $name) {
            $result .= "\t" . '<script type="text/javascript" src="' . UR_MP_ASSETS . 'package/' . $name . '.js"></script>' . PHP_EOL;
        }
        $result .= PHP_EOL.PHP_EOL;
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        echo $result;
    }

    /**
     * @todo load css from package public dir
     */
    public function LoadPackageCSS($css_name) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $css_name);
        echo "\n\t<!-- css package load--> \n";
        foreach ($css_name as $name) {
            echo "\t" . '<link type="text/css" rel="stylesheet" href="' . UR_MP_ASSETS . 'package/' . $name . '.css" />' . PHP_EOL;
        }
        echo  PHP_EOL.PHP_EOL;
    }

    /**
     * @todo load js from cm public dir
     */
    public static function LoadTemplateCMJS($js_name) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $js_name);
        echo "\n\t<!-- css device load--> \n";
        echo "\t" . '<script type="text/javascript" src="' . UR_MP_ASSETS . 'js/' . $js_name . '.js"></script>' . PHP_EOL;
    }

    /**
     * @todo load css from cm public dir
     */
    public function LoadTemplateCMCSS($css_name) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $css_name);

        $result = '';
        foreach ($css_name as $name) {
            $result .= "\t" . '<link type="text/css" rel="stylesheet" href="' . UR_MP_ASSETS . 'template/' . $this->template . '/css/' . $name . '.css" />' . PHP_EOL;
        }
        $result .= PHP_EOL.PHP_EOL;
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        echo $result;
    }

    public function LoadExtedentLib() {
        if (_lg('ltr') == 'rtl'):
            echo "\n\t".'<!-- rtl -->
        <link type="text/css" rel="stylesheet" href="'.UR_MP_ASSETS.'css/general-rtl.css" />
        <link type="text/css" rel="stylesheet" href="'.UR_MP_ASSETS.'css/element-rtl.css" />' .PHP_EOL.PHP_EOL ;
        
        endif;
        echo "\n\t<!-- css device load--> \n";
        self::LoadCMCSS('huge');
        self::LoadCMCSS('desktop');
        self::LoadCMCSS('tablet');
        self::LoadCMCSS('mobile');
    }

}

?>