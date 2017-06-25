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
     * @param int $meta_id meta id
     * @return variable
     */
    public function GetValue($root, $key, $meta_id = null) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key);

        $data = array(":registry_root" => $root,
            ":registry_key" => $key);

        if ($root == ROOT_USER) {
            $other = ' AND registry_meta = :registry_meta';
            $data[':registry_meta'] = GetManagerId();
        } else {

            if ($meta_id !== null) {
                $other = ' AND registry_meta = :registry_meta';
                $data[':registry_meta'] = $meta_id;
            } else {
                $other = '';
            }
        }

        // sql
        $sql = "SELECT registry_value FROM %table% WHERE 
            registry_root = :registry_root AND registry_key = :registry_key $other ;";
        // select
        $result = $this->db->Select($sql, array('registry'), $data);
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
     * warring this function can be sql injection if use direct user input
     * @todo Update registry key's value
     * @param int $root root of key
     * @param string $key key of registry
     * @param string $value new value content
     * @param int $meta_id meta id
     * @return bool
     */
    public function SetValue($root, $key, $value, $meta_id = null) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key, $value, $meta_id);

        $where = "registry_root = '$root' AND registry_key = '$key' ";
        $data = array('type' => 's', "registry_value" => $value);

        if ($meta_id !== null) {
            $where .= " AND registry_meta = '$meta_id' ";
        }
        // update value by root & key
        return $this->db->Update('registry', $data, $where);
    }

    /**
     * @todo add new key to registry
     * @param int $root root of key 
     * @param string $key name
     * @param variable $value content
     * @param int $meta regiter meta
     * @return bool
     */
    public function AddValue($root, $key, $value, $meta = 0) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key, $value);
        // make value
        $data = array('type' => 'iss',
            'registry_root' => $root,
            'registry_key' => $key,
            'registry_meta' => $meta,
            'registry_value' => $value);

        // send to insert in regiery
        return $this->db->Insert('registry', $data);
    }

    /**
     * @todo safe add new key to registry
     * @param int $root root of key 
     * @param string $key name
     * @param variable $value content
     * @param int $meta regiter meta
     * @return bool
     */
    public function SafeAddValue($root, $key, $value, $meta = 0) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key, $value);
        // make value
        $data = array('type' => 'iss',
            'registry_root' => $root,
            'registry_key' => $key,
            'registry_meta' => $meta,
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
        } else {
            $result_ = true;
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result_);
        // retrun result
        return $result_;
    }

    /**
     * @todo Select value from custom root registry key or cant return system value
     * @param int $root root of key
     * @param string $key key name
     * @param int $meta_id meta id
     * @return variable
     */
    public function GetValueEx($root, $key, $meta_id) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $root, $key, $meta_id);

        $result_ = $this->GetValue($root, $key, $meta_id);
        if ($result_ == null) {
            $result_ = $this->GetValue(ROOT_SYSTEM, $key);
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result_);
        // retrun result
        return $result_;
    }

}
