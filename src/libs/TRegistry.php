<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   TRegistry.php
 * @version 1.0
 * @todo : TRegistry system class
 */
class TRegistry {

    protected static $instance;

    public static function GetInstance() {
        if (!isset(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    function __construct() {
        global $database_handle;
        $this->db = $database_handle;
        //parent::__construct();
    }

    /**
     * @todo Select value from registry key
     * @param int $root root of key
     * @param string $key key name
     * @return variable
     */
    public function GetValue($root, $key) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key);

        // sql
        $sql = "SELECT registry_value FROM %table% WHERE 
            registry_root = :registry_root AND registry_key = :registry_key ;";
        // select
        $result = $this->db->Select($sql, array('registry'), array('type' => 'is', ":registry_root" => $root,
            ":registry_key" => $key));
        if (isset($result[0]['registry_value'])) {
            $result_ = $result[0]['registry_value'];
        } else {
            $result_ = null;
        }
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result_);
        // retrun result
        return $result_;
    }

    /**
     * @todo Update registry key's value
     * @param int $root root of key
     * @param string $key key of registry
     * @param string $value new value content
     * @return bool
     */
    public function SetValue($root, $key, $value) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key, $value);
        // update value by root & key
        return $this->db->Update('registry', array('type' => 's', "registry_value" => $value), "registry_root = '$root' AND registry_key = '$key' ");
    }

    /**
     * @todo add new key to registry
     * @param int $root root of key 
     * @param string $key name
     * @param variable $value content
     * @return bool
     */
    public function AddValue($root, $key, $value) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key, $value);
        // make value
        $data = array('type' => 'iss',
            'registry_root' => $root,
            'registry_key' => $key,
            'registry_value' => $value);

        // send to insert in regiery
        return $this->db->Insert('registry', $data);
    }
    /**
     * @todo safe add new key to registry
     * @param int $root root of key 
     * @param string $key name
     * @param variable $value content
     * @return bool
     */
    public function SafeAddValue($root, $key, $value) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key, $value);
        // make value
        $data = array('type' => 'iss',
            'registry_root' => $root,
            'registry_key' => $key,
            'registry_value' => $value);

        // send to insert in regiery
        return $this->db->Replace('registry', $data);
    }

    /**
     * @todo delete key from regitry
     * @param int $root root of key
     * @param string $key name
     * @return bool
     */
    public function RemoveValue($root, $key) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key);
        return $this->db->delete('registry', "`registry_root` = '$root' AND
            `registry_key` = '$key'");
    }

    
    /**
     * is key Exists
     * @param int $root root of key 
     * @param string $key name
     * @return bool
     */
    public function Exists($root, $key) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key);

        // sql
        $sql = "SELECT COUNT(*) AS 'count' FROM %table% WHERE 
            registry_root = :registry_root AND registry_key = :registry_key ;";
        // select
        $result = $this->db->Select($sql, array('registry'), array('type' => 'is', ":registry_root" => $root,
            ":registry_key" => $key));

        if ($result[0]['count'] == 0) {
            $result_ = false;
        }else{
            $result_ = true;
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result_);
        // retrun result
        return $result_;
    }

}
