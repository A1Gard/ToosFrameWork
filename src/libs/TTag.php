<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 7-July-2014
 * @time : 00:41 
 * @subpackage   TTag.php
 * @todo : TTag manager class
 */
//##############################################################################
//##                min table strutcure need for this class                   ##
//##############################################################################
/*
 * 
  CREATE TABLE `tablename` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_label` varchar(45) COLLATE utf8_estonian_ci NOT NULL,
  PRIMARY KEY (`tag_id`)
  ) DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci
 * 
 */
//##############################################################################


class TTag extends TModel {

    private $last_tag_selected = null;
    private $table = null;
    private $prefix = null;

    function __construct($table = 'tag', $prefix = 'tag_') {
        parent::__construct($table, $prefix);
        $this->table = $table;
        $this->prefix = $prefix;
    }

    /**
     * search in tag list
     * @param string $searched_term
     * @param int $min_length to search $min_length
     * @param int $max_result max count result
     * @return json
     */
    public function Search($searched_term, $min_length = 2, $max_result = 10) {


        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $searched_term,
                $min_length, $max_result);

        // if length set search start
        if (strlen($searched_term) >= $min_length) {
            $sql = "SELECT {$this->prefix}id AS 'id',{$this->prefix}label AS "
            . " 'label' FROM %table% WHERE {$this->prefix}label"
            . " REGEXP :term LIMIT $max_result ;";
            $result = $this->db->Select($sql, array($this->table), array('type' 
                => 's', ":term" => '^.*' . $searched_term . '.*$'));

            // jsone encode result
            $result = json_encode($result);
        } else
            $result = null;

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    /**
     * search in tags and retrun tag id
     * @param string $tag
     * @return int
     */
    public function GetId($tag) {


        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $tag);
        
        $sql = "SELECT {$this->prefix}id AS 'id' FROM %table% "
                . "WHERE {$this->prefix}label = :term LIMIT 1";
        $result = $this->db->Select($sql, array($this->table), array('type' => 's',
            ":term" => $tag));
        // if not found return false
        if (count($result) == 0) {
            $result = false;
        } else { // retrun tag id
            $result = $result[0]['id'];
        }
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

    /**
     * check the object has tag or not
     * @param string $tag
     * @param int $object_id
     * @param int $type
     * @return boolean
     */
    public function Has($tag, $object_id, $type) {

        // pre
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $tag, $object_id,
                $type);
        
        $result = false;

        // set last tag selected
        $this->last_tag_selected = $this->GetId($tag);

        // if tag id is false has tag = false
        if ($this->last_tag_selected == false) {
            $result = false;
        } else {
            // else search in relation for tag
            $sql = "SELECT COUNT(src) AS 'count' FROM %table% "
                    . "WHERE src = :tag AND dst = :obj AND "
                    . "typ = :type ";
            $sql_result = $this->db->Select($sql, array('relation'), array(
                'type' => 'iii', ":tag" => $this->last_tag_selected,
                ':obj' => $object_id, ':type' => $type));

            if (( (int) ($sql_result[0]['count']) ) > 0) {

                $result = true;
            } else {
                $result = false;
            }
        }
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);

        return $result;
    }

    /**
     * add tag to object
     * @param string $tag tag label
     * @param int $object_id
     * @param int $type
     * @return boolean
     */
    public function Add($tag, $object_id, $type) {


         // pre
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $tag, $object_id,
                $type);
        
        // if has tag not add again
        $has_tag = $this->Has($tag, $object_id, $type);
        if ($has_tag) {
            $result = true;
        } else {

            // check if last selected tag = null insert new tag in tag table
            if ($this->last_tag_selected == null) {
                $data = array($this->prefix . 'label' => $tag);
                $result = $this->db->Insert($this->table, $data);
                $this->last_tag_selected = $this->db->last_insert_id;
            }
            // insert the tag in relation
            $data = array('src' => $this->last_tag_selected,
                'dst' => $object_id, 'typ' => $type);
            $result = $this->db->Insert('relation', $data);
        }
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

    /**
     * remove tag from object
     * @param string $tag
     * @param int $object_id
     * @param int $type
     * @return boolean
     */
    public function Remove($tag, $object_id, $type) {
        
        
         // pre
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $tag, $object_id,
                $type);
        
        // if has tag is false dont search again
        $has_tag = $this->Has($tag, $object_id, $type);
        if (!$has_tag) {
            $result = true;
        } else {

            // else get tag id
            $tag_id = (int) $this->GetId($tag);

            // and remove from realationship
            $result = $this->db->delete('relation', " src = '{$tag_id}' AND"
                    . " dst = '" . ( (int) $object_id ) .
                    "' AND typ = '" . ( (int) $type) . "' ");
        }
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

    /**
     * get tag list of an object
     * @param int $object_id object id
     * @param int $type
     * @return array
     */
    public function TList($object_id, $type) {

         // pre
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $object_id,
                $type);
        // get tag list of object
        // get all tags fron relation and tag table
        $sql = "SELECT {$this->prefix}id, {$this->prefix}label FROM %table% "
                . "WHERE  dst = :obj AND "
                . "typ = :type AND {$this->prefix}id = src";
        $sql_result = $this->db->Select($sql, array('relation', $this->table), 
                array('type' => 'ii', ':obj' => $object_id, ':type' => $type));
        // make result here
        $result = array();
        foreach ($sql_result as $tag) {
            $result[$tag[$this->prefix . 'id']] = $tag[$this->prefix . 'label'];
        }

        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

    /**
     * tag synchronizing
     * @param string $tag_list new tag lists
     * @param int $object_id
     * @param int $type
     * @return boolean
     */
    public function Sync($tag_list, $object_id, $type) {

         // pre
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $tag_list,
                $object_id, $type);
        // get new tags
        $new_tags = explode(',', $tag_list);
        // get old tags
        $old_tags = $this->TList($object_id, $type);

        // remove common tag with new and olds
        foreach ($new_tags as $key => $value) {
            if (($key2 = array_search($value, $old_tags)) !== false) {
                unset($old_tags[$key2]);
                unset($new_tags[$key]);
            }
        }

        // add all remaining new tags
        foreach ($new_tags as $tag) {
            $this->Add($tag, $object_id, $type);
        }
        // remove all remaining old tags
        foreach ($old_tags as $tag) {
            $this->Remove($tag, $object_id, $type);
        }
        
        $result = TRUE;
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        return $result;
    }

}
