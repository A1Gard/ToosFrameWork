<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 32-apr-2014 (2-11-1393) 
 * @time : 03:32 
 * @subpackage   TSystem.php
 * @version 0.4
 * @todo : TSystem system class
 */
class TSystem extends Model {

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
    public function GetPenddlingCommentCount() {
        $sql = "SELECT COUNT(*) AS 'count' FROM %table% WHERE comment_status = "
                . COMMENT_STATUS_PENDDLING;
        $result = $this->db->Select($sql, array('comment'));
        $result = $result[0]['count'];

        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

}
