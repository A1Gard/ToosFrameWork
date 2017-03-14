<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 10-July-2014
 * @time : 03:41 
 * @subpackage   TRelation
 * @version 1.0
 * @todo : use for realtionship info 
 */

class TRelation extends TModel {

    function __construct() {
        parent::__construct('relation');
    }

    protected static $instance;

    public static function GetInstance() {
        if (!isset(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    public function Add($source, $destination, $type) {

        // insert relation
        $data = array('src' => $source,
            'dst' => $destination, 'typ' => $type);
        $result = $this->db->Insert('relation', $data);

        return $result;
    }

    public function Remove($source, $destination, $type) {
        // and remove from realationship
        $result = $this->db->delete('relation', " src = '" .
                ( (int) $source ) . "' AND"
                . " dst = '" . ( (int) $destination ) .
                "' AND typ = '" . ( (int) $type) . "' ");
        return $result;
    }

    public function Has($source, $destination, $type) {

        // else search in relation for tag
        $sql = "SELECT COUNT(src) AS 'count' FROM %table% "
                . "WHERE src = :s AND dst = :d AND "
                . "typ = :type ";
        $sql_result = $this->db->Select($sql, array('relation'), array('type' => 'iii',
            ":s" => $source, ':d' => $destination, ':type' => $type));

        if (( (int) ($sql_result[0]['count']) ) > 0) {

            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function RemoveBySource($source, $type) {
        // and remove from realationship
        $result = $this->db->delete('relation', " src = '" .
                ( (int) $source ) . "'"
                . " AND typ = '" . ( (int) $type) . "' ");
        return $result;
    }

    public function RemoveByDestination($destination, $type) {
        // and remove from realationship
        $result = $this->db->delete('relation', " dst = '" . ( (int) $destination ) .
                "' AND typ = '" . ( (int) $type) . "' ");
        return $result;
    }

    public function GetBySource($source, $type) {

        // else search in relation for tag
        $sql = "SELECT dst  FROM %table% "
                . "WHERE src = :s  AND "
                . "typ = :type ";
        $sql_result = $this->db->Select($sql, array('relation'), array('type' => 'ii',
            ":s" => $source, ':type' => $type));

        $result = array();
        foreach ($sql_result as $record) {
            $result[] = $record['dst'];
        }

        return $result;
    }


    public function GetSourceCount($source, $type) {

        // else search in relation for tag
        $sql = "SELECT COUNT(dst) AS 'count'  FROM %table% "
                . "WHERE src = :s  AND "
                . "typ = :type ";
        $sql_result = $this->db->Select($sql, array('relation'), array('type' => 'ii',
            ":s" => $source, ':type' => $type));


        return $sql_result[0]['count'];
    }

    public function GetByDestination($destination, $type) {

        // else search in relation for tag
        $sql = "SELECT src  FROM %table% "
                . "WHERE dst = :d  AND "
                . "typ = :type ";
        $sql_result = $this->db->Select($sql, array('relation'), array('type' => 'ii',
            ":d" => $destination, ':type' => $type));

        $result = array();
        foreach ($sql_result as $record) {
            $result[] = $record['src'];
        }

        return $result;
    }
    
    public function GetDestinationCount($destination, $type) {

        // else search in relation for tag
        $sql = "SELECT COUNT(src) AS 'count'  FROM %table% "
                . "WHERE dst = :d  AND "
                . "typ = :type ";
        $sql_result = $this->db->Select($sql, array('relation'), array('type' => 'ii',
            ":d" => $destination, ':type' => $type));


        return $sql_result[0]['count'];
    }

    public function Sync($sources, $destination, $type) {


        $tmp = array_search(0, $sources);


        if ($tmp !== false) {
            unset($sources[$tmp]);
        }
        $old = $this->GetByDestination($destination, $type);

        // remove common tag with new and olds
        foreach ($old as $key => $value) {
            $key2 = array_search($value, $sources);
            if ($key2 !== false) {
                unset($old[$key]);
                unset($sources[$key2]);
            }
        }

        // add all remaining new tags
        foreach ($sources as $cat_id) {
            $this->Add($cat_id, $destination, $type);
        }
        // remove all remaining old tags
        foreach ($old as $cat_id) {
            //die($cat_id);
            $this->Remove($cat_id, $destination, $type);
        }

        return TRUE;
    }

}
