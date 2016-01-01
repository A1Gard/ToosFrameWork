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

        global $hook_store;
        $plug_exists = $this->GetExistsPlugins();
        $plug_active = $this->GetActivePlugins();
        
        // load active and exists plugins
        foreach ($plug_active as $active) {
            if (in_array($active['plugin_name'], $plug_exists)) {
                include_once  PLUGIN_DIR . $active['plugin_name'] . '/' .
                        $active['plugin_name'] . '.php';
            }
        }
        
        // load all active hook 
        $h_model = new TModel('hook');
        foreach ($h_model->Read('hook_effect,hook_function_name') as $hook) {
            $hook_store[$hook['hook_effect']][] = $hook['hook_function_name'] ;
        }
    }

    /**
     * list of plug-ins in 'plugin' folder
     * @return array of string
     */
    private function GetExistsPlugins() {
        // get list of plugin in dir
        $dirs = glob( PLUGIN_DIR . '*', GLOB_ONLYDIR);
        $plugin = array();
        foreach ($dirs as $dir) {
            $tmp = explode('/', $dir);
            $plugin[] = $tmp[count($tmp)-1];
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
        global $pdbc; // set global to use all plugin jobs
        $pdbc = new TModel(); // plugin dbc connection

        $sql = "SELECT plugin_name FROM %table% WHERE plugin_status = 1";

        return $pdbc->db->Select($sql, array('plugin'));
    }

}
