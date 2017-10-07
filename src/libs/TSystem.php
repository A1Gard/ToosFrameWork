<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 32-apr-2014 (2-11-1393) 
 * @time : 03:32 
 * @subpackage   TSystem.php
 * @version 0.4
 * @todo : TSystem system class
 */
class TSystem extends TModel {

    function __construct() {
        parent::__construct('relation');
    }

    protected static $instance;

    public static function GetInstance() {
        if (!isset(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    public function GetRcordCount($table_name, $where = 1) {



        $sql = "SELECT COUNT(*) AS 'count' FROM %table% "
                . "WHERE $where ;";

        $sql_result = $this->db->Select($sql, array($table_name));
        return $sql_result[0]['count'];
    }

    public function GetRecordByOrd($table, $field, $where = '1', $ord = "ASC", $limit = 10) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $table, $where, $ord, $limit);

        $sql = "SELECT * FROM %table% "
                . "WHERE $where ORDER BY $field $ord LIMIT $limit;";
        $result = $this->db->Select($sql, array($table));

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    public function DecHex($num, $len = 2) {
        $result = dechex($num);
        while (strlen($result) < $len) {
            $result = '0' . $result;
        }

        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

    public function GetRedToGreen($count) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $count);

        // not devition to 0
        if ($count == 0) {
            return "#fe3fe6";
            ;
        }
        $red = 255; //i.e. FF
        $green = 0;
        $result = array();
        $step_size = floor(512 / $count); //how many colors do you want?
        while ($green < 255) {
            $green += $step_size;
            if ($green > 255) {
                $green = 255;
            }
            $result[] = "#" . $this->DecHex($red) . $this->DecHex($green) . '00';
        }
        while ($red > 0) {
            $red -= $step_size;
            if ($red < 0) {
                $red = 0;
            }
            $result[] = "#" . $this->DecHex($red) . $this->DecHex($green) . '00';
        }
        if (count($result) == $count) {
            return $result;
        }
        if (count($result) > $count) {
            unset($result[count($result) - 1]);
        } else {
            $result[] = "#fe3fe6";
        }


        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    /**
     * get comment count
     * @return int
     */
    public function GetPENDDINGCommentCount($number_only = false) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $number_only);
        $sql = "SELECT COUNT(*) AS 'count' FROM %table% WHERE comment_status = "
                . COMMENT_STATUS_PENDDING;
        $result = $this->db->Select($sql, array('comment'));
        $result = $result[0]['count'];
        if (!$number_only) {
            if ($result == 0) {
                $result = '';
            } else {
                $result = "<i class=\"notify\"> {$result} </i>";
            }
        }

        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }
    /**
     * get comment count
     * @param string $field field column name
     * @return var
     */
    public function GetProfileField( $field  ) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $field);
        $sql = "SELECT `$field`   FROM %table% WHERE manager_id = "
                . TMAC::GetSession('MN_ID');
        $result = $this->db->Select($sql, array('manager'));
        $result = $result[0][$field];

        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

    public function GetField($table, $prefix, $field, $id) {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $table, $prefix, $field, $id);
        $sql = "SELECT $field AS 'field' FROM %table% WHERE {$prefix}id = "
                . (int) $id;
        $result = $this->db->Select($sql, array($table));
        $result = $result[0]['field'];
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

    static public function GetServerOS() {
        $result = PHP_OS;
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    static public function GetServerIP() {
        $result = $_SERVER['SERVER_ADDR'];
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    static public function GetWebServer() {
        $tmp = explode(' ', $_SERVER['SERVER_SOFTWARE']);
        $result = $tmp[0];
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    static public function GetPHPVersion() {
        $result = PHP_VERSION;
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    static public function GetServerCPUUsage() {

        try {
            $loads = sys_getloadavg();
            $core_nums = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
            $load = round($loads[0] / ($core_nums + 1) * 100, 2);
            $result = $load;
        } catch (Exception $exc) {
            $result = 0;
        }

        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

    static public function GetServerMemUsage() {

        try {
            $free = shell_exec('free');
            $free = (string) trim($free);
            $free_arr = explode("\n", $free);
            $mem = explode(" ", $free_arr[1]);
            $mem = array_filter($mem);
            $mem = array_merge($mem);
            $result = round($mem[2] / $mem[1] * 100, 2);
        } catch (Exception $exc) {
            $result = 0;
        }


        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, __CLASS__, $result);
        return $result;
    }

}
