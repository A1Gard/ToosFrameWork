<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 30-March-2014 (11-1-1392) 
 * @time : 22:39 
 * @subpackage   PluginLoader
 * @todo : Load plug-in info
 */
class TPluginLoader {
    // connect to db
    function __construct() {
        
        $plug_exists = $this->GetExistsPlugins();
        $plug_active = $this->GetActivePlugins();
        foreach ($plug_active as $active) {
            if (in_array($active['plugin_name'], $plug_exists)){
                require '../upload/plugin/' . $active['plugin_name'] . '/' . 
                        $active['plugin_name'] . '.php';
            }
        }
        
    }
    
    /**
     * list of plug-ins in 'plugin' folder
     * @return array of string
     */
    private function GetExistsPlugins() {
        // get list of plugin in dir
        $dirs = glob('../upload/plugin/*' , GLOB_ONLYDIR);
        $plugin = array();
        foreach ($dirs as $dir) {
            $tmp  = explode('/', $dir);
            $plugin[] = $tmp[3];
        }
        return $plugin;
    }
    /**
     * list of active plugins in db
     * @return array of string
     */
    private function GetActivePlugins() {
        // get list of plugin in dir
//        require 'Model.php';
        global  $pdbc ; // set global to use all plugin jobs
        $pdbc = new TModel(); // plugin dbc connection
        
        $sql = "SELECT plugin_name FROM %table% ";
        
        return $pdbc->db->Select($sql, array('plugin'));
    }

}
