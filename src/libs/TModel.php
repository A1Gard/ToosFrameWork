<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   TModel.php
 * @todo : TModel Super class
 */
class TModel {

    // table name for general functopn in this class
    private $table_name = null;
    private $prefix = null;

    function __construct($table_name = null, $prefix = null) {

        // set etable name
        $this->table_name = $table_name;
        // set prefix
        if ($prefix == null) {
            $this->prefix = $table_name . '_';
        } else {
            $this->prefix = $prefix;
        }
        // singlton .
        // test if Database handled create before than dont create again .
        global $database_handle;
        if ($database_handle != null) {
            $this->db = $database_handle;
        }
        // check database connect type.
        switch (DB_MOTHOD) {
            case 'PDO':

                //check class exists
                if (!class_exists('TDatabase', FALSE)) {
                    require (PA_LIBS_MP . 'TDatabasePDO.php');
                }

                $this->db = new TDatabase(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
                break;
            #--------------------------
            case 'mysqli':

                //check class exists
                if (!class_exists('TDatabase', FALSE)) {
                    require (PA_LIBS_MP . 'TDatabaseMysqli.php');
                }

                $this->db = new TDatabase(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
                break;
            #--------------------------
            default:

                throw new Exception('Fatal Toos Error : Unknown database type');
            #--------------------------
        }
        // else not create before than after create save connecion handle global.
        $database_handle = $this->db;
    }

    
    /**
     * 
     * @param string $table_name
     * @param string $prefix
     */
    public function Reassign($table_name = null, $prefix = null) {
        // set etable name
        $this->table_name = $table_name;
        // set prefix
        if ($prefix == null) {
            $this->prefix = $table_name . '_';
        } else {
            $this->prefix = $prefix;
        }
    }

    /**
     * @todo Read record list from table
     * @param string $colums list of required colum in list
     * @return accotied array
     * @category general
     */
    public function Read($colums, $limit = null, $table_name = null, $prefix = null) {

        if ($limit == null) {
            // set defualt limit 
            $registry = TRegistry::GetInstance();
            $limit = $registry->GetValue(ROOT_SYSTEM, 'record_list_limit');
        }

        if ($table_name == null) {
            $table_name = $this->table_name;
        }
        if ($prefix == null) {
            $prefix = $this->prefix;
        }
        if (isset($_GET['page'])) {
            $start = abs(intval($_GET['page']));
            $start--;
            $start *= $limit;
        } else {
            $start = 0;
        }

        if (isset($_GET['order']) && strpos($colums, $_GET['order']) !== false) {
            if (isset($_GET['desc'])) {
                $order = $_GET['order'] . ' DESC';
            } else {
                $order = $_GET['order'] . ' ASC';
            }
        } else {
            $order = $prefix . 'id DESC';
        }

        $cond = '1';
        // if not have filter
        if (!isset($_GET['filter'], $_GET['search'])) {
            $where = array();
        }
        if (isset($_GET['filter'])) {
            $filter = explode(',', $_GET['filter']);
            // else have filter apply fillter
            $term = substr($filter[1], 1);

//           die($term);

            switch ($filter[1][0]) {

                case '<':
                    $cond .= " AND {$filter[0]}  <  :{$filter[0]}  ";
                    break;
                case '>':
                    $cond .= " AND {$filter[0]}  >  :{$filter[0]}  ";
                    break;
                case '%':
                    $term = '%' . $term . '%';
                    $cond .= " AND {$filter[0]}  LIKE  :{$filter[0]}  ";
                    break;
                case '$':
                    $term = '^.*' . $term . '.*$';
                    $cond .= " AND {$filter[0]}   REGEXP   :{$filter[0]}  ";
                    break;

                default:
                    $term = $filter[1];
                    $cond .= " AND {$filter[0]}  =  :{$filter[0]}  ";
                    break;
            }
            $where[$filter[0]] = $term;
        }
        if (isset($_GET['search']) && $_GET['search'] != '') {

            $prf = 'AND ( ';
            foreach (explode(',', $_GET['fields']) as $col) {
                $term = '^.*' . $_GET['search'] . '.*$';
                $cond .= " {$prf}  {$col}   REGEXP   :{$col}  ";
                $where[$col] = $term;
                $prf = 'OR';
            }
            $cond .= ')';
        }
//        print_r($where);
        if (isset($_GET['rel'], $_GET['typ']) && $_GET['rel'] != 0) {
            $sql = "SELECT $colums 
        FROM " . DB_PREFIX . $this->table_name . " as t LEFT JOIN " . DB_PREFIX . "relation r 
        ON r.dst = t." . $this->prefix . "id WHERE r.typ =  :t  AND r.src = :s  AND $cond ORDER BY {$order}  LIMIT $start,$limit";
//            die($sql);
            $where[':s'] = $_GET['rel'];
            $where[':t'] = $_GET['typ'];
        } else {

            $sql = "SELECT $colums FROM %table% WHERE "
                    . " $cond ORDER BY {$order} "
                    . " LIMIT $start,$limit";
        }
//    print_r($sql);die;
        // get count
        $result = $this->db->Select($sql, array($this->table_name), $where);
        return $result;
    }

    /**
     * @todo insert data to table width array
     * @param array $data 
     * @return int inserted id
     * @category general
     */
    public function Create($data) {
        $result = $this->db->Insert($this->table_name, $data);
        return $this->db->last_insert_id;
    }

    /**
     * @todo replace data to table width array
     * @param array $data 
     * @return int inserted id
     * @category general
     */
    public function Recreate($data) {
        $result = $this->db->Replace($this->table_name, $data);
        return $this->db->last_insert_id;
    }

    /**
     * @todo get record data from table
     * @param int $id
     * @param string $where select custom where
     * @return acctioted array reorod data
     * @category general
     */
    public function GetRecord($id, $where = null) {
        $sql = "SELECT * FROM %table% WHERE {$this->prefix}id = :id $where";

        $result = $this->db->Select($sql, array($this->table_name), array('type' => 'i', ":id" => $id));
        if (isset($result[0])) {
            return $result[0];
        } else {
            return FALSE;
        }
    }

    /**
     * @todo edit an reocrd with id 
     * @param int $id
     * @param array $data
     * @param string $prefix prifex id
     * @category general
     */
    public function Edit($id, $data, $prefix = null) {
        if ($prefix == null) {
            $prefix = $this->prefix;
        }
        $id = intval($id);
        return $this->db->Update($this->table_name, $data, "{$prefix}id = '{$id}'");
    }

    /**
     * delete record from table with id
     * @param int $id
     * @category general
     */
    public function Delete($id, $prefix = null) {
        if ($prefix == null) {
            $prefix = $this->prefix;
        }
        return $this->db->Delete($this->table_name, " {$prefix}id = " . ( (int) $id));
    }

    public function GetPageCount($limit = null) {
        if ($limit == null) {
            // set defualt limit 
            $registry = TRegistry::GetInstance();
            $limit = $registry->GetValue(ROOT_SYSTEM, 'record_list_limit');
        }

        $cond = '1';
        // if not have filter
        if (!isset($_GET['filter'], $_GET['search'])) {
            $where = array();
        }
        if (isset($_GET['filter'])) {
            $filter = explode(',', $_GET['filter']);
            // else have filter apply fillter
            $term = substr($filter[1], 1);

//           die($term);

            switch ($filter[1][0]) {

                case '<':
                    $cond .= " AND {$filter[0]}  <  :{$filter[0]}  ";
                    break;
                case '>':
                    $cond .= " AND {$filter[0]}  >  :{$filter[0]}  ";
                    break;
                case '%':
                    $term = '%' . $term . '%';
                    $cond .= " AND {$filter[0]}  LIKE  :{$filter[0]}  ";
                    break;
                case '$':
                    $term = '^.*' . $term . '.*$';
                    $cond .= " AND {$filter[0]}   REGEXP   :{$filter[0]}  ";
                    break;

                default:
                    $term = $filter[1];
                    $cond .= " AND {$filter[0]}  =  :{$filter[0]}  ";
                    break;
            }
            $where[$filter[0]] = $term;
        }
        if (isset($_GET['search']) && $_GET['search'] != '') {

            $prf = 'AND ( ';
            foreach (explode(',', $_GET['fields']) as $col) {
                $term = '^.*' . $_GET['search'] . '.*$';
                $cond .= " {$prf}  {$col}   REGEXP   :{$col}  ";
                $where[$col] = $term;
                $prf = 'OR';
            }
            $cond .= ')';
        }

        if (isset($_GET['rel'], $_GET['typ']) && $_GET['rel'] != 0) {
            $sql = "SELECT COUNT(*) AS 'count' 
        FROM " . DB_PREFIX . $this->table_name . " as t LEFT JOIN " . DB_PREFIX . "relation r 
        ON r.dst = t." . $this->prefix . "id WHERE r.typ =  :t  AND r.src = :s  AND $cond ";
            $where[':s'] = $_GET['rel'];
            $where[':t'] = $_GET['typ'];
        } else {

            $sql = "SELECT COUNT(*) AS 'count' FROM %table% WHERE "
                    . " $cond ";
        }
//    print_r($sql);die;
        // get count
        $result = $this->db->Select($sql, array($this->table_name), $where);

        $mod = $result[0]['count'] % $limit;
        // page count
        $result = floor($result[0]['count'] / $limit);
        // check mod and inc
        if ($mod > 0) {
            $result++;
        }
        return $result;
    }

    /**
     * get filed for select element
     * @param string $title field for title of <option> ;
     * @param string $value field for value of <option> ;
     * @param string $where cond for select items 
     * @return mixed
     */
    function Selectable($title = null, $value = null, $where = '1') {
        if ($title == null) {
            $title = $this->prefix . 'title';
        }
        if ($value == null) {
            $value = $this->prefix . 'id';
        }
        $sql = "SELECT $value AS '0',$title AS '1' FROM %table% WHERE "
                . " $where ";
        $result = $this->db->Select($sql, array($this->table_name));
        return $result;
    }

    /**
     * get normal array for display in TListview
     * @param string $title field for title of <option> ;
     * @param string $value field for value of <option> ;
     * @param string $where cond for select items 
     * @return mixed
     */
    function NormalArray($title = null, $value = null, $where = '1') {
        if ($title == null) {
            $title = $this->prefix . 'title';
        }
        if ($value == null) {
            $value = $this->prefix . 'id';
        }
        $sql = "SELECT $value ,$title FROM %table% WHERE "
                . " $where ";
        $res = $this->db->Select($sql, array($this->table_name));
        foreach ($res as $record) {
            $result[$record[$value]] = $record[$title];
        }
        return $result;
    }

    /**
     * Read Extdent not apply filter, search or relation
     * @param string $fields imploded fields
     * @param string $where 
     * @param mixed $params array of paramters
     * @return mixed
     */
    function ReadEx($fields, $where = '1', $params = array()) {
        $result = $this->db->Select("SELECT $fields FROM %table% WHERE $where", array($this->table_name), $params);
        return $result;
    }

}
