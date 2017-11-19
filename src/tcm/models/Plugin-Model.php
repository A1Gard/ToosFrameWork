<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   calss-model.php
 * @todo : calssUR_MP_ASSETS page
 */

/**
 * class for user accessUR_MP_ASSETS
 */
class PluginModel extends TModel {

    function __construct() {
        parent::__construct('plugin');
        $this->tag = new TTag();
    }

    function PluginFinder() {
        $file_names = scandir(PLUGIN_DIR);
        $result = array();
        foreach ($file_names as $plugin) {
            if ($plugin != '.' && $plugin != '..' && is_dir($plugin)) {
                $result[] = $this->_GetPluginInfo($plugin);
            }
        }

        return $this->Read('*', 9999);
    }

    private function _GetPluginInfo($plugin_name) {
        $res = $this->db->Select('SELECT plugin_id  FROM %table%'
                . ' WHERE plugin_name = :name', 'plugin', array(':name' => $plugin_name));
        if (count($res) == 0) {
            include_once PLUGIN_DIR . $plugin_name . '/' . $plugin_name . '.php';
            $data = array(
                'plugin_name' => $plugin_name,
                'plugin_version' => $plugin_name::$version,
                'plugin_url' => $plugin_name::$url,
                'plugin_author' => $plugin_name::$author,
                'plugin_discrption' => $plugin_name::$discrption,
            );

            $data['plugin_id'] = $this->Create($data);

            $data['plugin_active'] = 0;
        }
        return 0;
    }

    public function GetPlugInName($id, $inc = false) {
        $info = $this->GetRecord($id);
        if ($inc) {
            include_once PLUGIN_DIR . $info['plugin_name'] . '/'
                    . $info['plugin_name'] . '.php';
        }
        return $info['plugin_name'];
    }

}
