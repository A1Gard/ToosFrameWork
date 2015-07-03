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
        $this->extrenal_libs = $registry->GetValue(ROOT_SYSTEM, 'ExtenalLibs');
        $this->minified_libs = $registry->GetValue(ROOT_SYSTEM, 'MinifiedLibs');
        $this->template = $registry->GetValue(ROOT_SYSTEM, 'template');
    }

    /**
     * @todo load js & css from internalsource
     */
    private function _loadInternalLibs() {
        // check for minified
        $this->minified_libs ? $suffix = '.min' : $suffix = '';
        // jquery
        echo '<script type="text/javascript" src="' . UR_PUB . 'js/jquery' . $suffix . '.js"></script>'
        . '
            <!--[if lte IE 9]>
                <script src="' . UR_CM_PUB . 'js/iefix.js" type="text/javascript"></script>
            <![endif]-->';
        self::LoadCMCSS('top-grid');
        self::LoadCMCSS('font-awesome.min');
        
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
        $result = '';
        foreach ($js_name as $name) {
            $result .=  '<script type="text/javascript" src="' . UR_CM_PUB . 'js/' . $name . '.js"></script>'."\n";
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        echo $result;
    }

    /**
     * @todo load css from cm public dir
     */
    public function LoadCMCSS($css_name) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $css_name);
        echo '<link type="text/css" rel="stylesheet" href="' . UR_CM_PUB . 'css/' . $css_name . '.css" />';
    }
    /**
     * @todo load js from package public dir
     */
    public static function LoadPackageJS($js_name) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $js_name);
        $result = '';
        foreach ($js_name as $name) {
            $result .=  '<script type="text/javascript" src="' . UR_CM_PUB . 'package/' . $name . '.js"></script>'."\n";
        }
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
        foreach ($css_name as $name) {
            echo '<link type="text/css" rel="stylesheet" href="' . UR_CM_PUB . 'package/' . $name . '.css" />';
        }
    }

    
    /**
     * @todo load js from cm public dir
     */
    public static function LoadTemplateCMJS($js_name) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $js_name);
        echo '<script type="text/javascript" src="' . UR_CM_PUB . 'js/' . $js_name . '.js"></script>';
    }

    /**
     * @todo load css from cm public dir
     */
    public function LoadTemplateCMCSS($css_name) {
        
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $css_name);
        
        $result = '';
        foreach ($css_name as $name) {
             $result .= '<link type="text/css" rel="stylesheet" href="' . UR_CM_PUB . 'template/' . $this->template . '/css/' . $name . '.css" />'."\n";
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
       echo $result;
    }

}

?>