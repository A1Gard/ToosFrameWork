<?php

class TAseetLoader {

    static $asset_list = array();
    protected static $instance = null;

    protected function __construct() {
        
    }

    protected function __clone() {
        
    }

    public static function GetInstance() {
        if (!isset(static::$instance))
            static::$instance = new static;
        return static::$instance;
    }

    public static function AddAsset($type, $path, $rtl_path = '') {
        self::$asset_list[] = sprintf($type, $path );
        if (_lg('ltr') == 'rtl' && $rtl_path = ''):
            self::$asset_list[] = sprintf($type, $rtl_path);
        endif;
    }

    public static function AssetsLoad() {
        foreach (self::$asset_list as $key => $asset) {
            echo $asset . PHP_EOL;
        }
    }

}
