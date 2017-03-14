<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   TDatabase
 * @version 1.0
 * @todo : pdo mothod to connect to db 
 */
class TDatabase extends PDO {

    public $last_insert_id;

    public function __construct($DB_TYPE = DB_TYPE, $DB_HOST = DB_HOST, $DB_NAME = DB_NAME, $DB_USER = DB_USER, $DB_PASS = DB_PASSWORD) {

        try {
            parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
            // if cant connect to db ;
        } catch (PDOException $e) {
            if (_DBG_) // if dubig mode show error
                throw new Exception("Fatal Toos Error : PDO Connect Error <!-- {$e->getMessage()} --> ");
        }

        $this->query("SET CHARACTER SET UTF8");
        $this->query("SET NAMES utf8");
    }

    public static function GetInstance($DB_TYPE = DB_TYPE, $DB_HOST = DB_HOST, $DB_NAME = DB_NAME, $DB_USER = DB_USER, $DB_PASS = DB_PASSWORD) {
        if (!isset(self::$instance))
            self::$instance = new self($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
        return self::$instance;
    }

    /**
     * select
     * @todo Select from database
     * @param string $sql An SQL string
     * @param array $tables tables to select
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function Select($sql, $tables = array(), $array = array(), $fetchMode = PDO::FETCH_ASSOC) {


        // normalize string input
        if (!is_array($tables) && is_string($tables)) {
            $tables = array($tables);
        }

        // make tables to select
        $tbl = NULL;
        foreach ($tables as $table) {
            $tbl .= DB_PREFIX . $table . ',';
        }

        $tbl = rtrim($tbl, ',');
        // replace after make
        $sql = str_replace('%table%', $tbl, $sql);


        //remove type
        if (isset($array['type'])) {
            unset($array['type']);
        }

        //send sql
        $stmt = $this->prepare($sql);
        // send params
        foreach ($array as $key => $value) {
            $stmt->bindValue("$key", $value);
        }
        // run sql
        $success = $stmt->execute();

        // dubug unsuccess
        if ((_DBG_) && (!$success)) {
            _err(array_merge($stmt->errorInfo(), array($sql)));
        }

        return $stmt->fetchAll($fetchMode);
    }

    /**
     * selectEx
     * @todo Select from database
     * @param string $sql An SQL string
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function SelectEx($sql, $fetchMode = PDO::FETCH_ASSOC) {

        $stmt = $this->prepare($sql);
        // run sql
        $success = $stmt->execute();

        // dubug unsuccess
        if ((_DBG_) && (!$success)) {

            _err(array_merge($stmt->errorInfo(), array($sql)));
        }

        return $stmt->fetchAll($fetchMode);
    }

    /**
     * insert
     * @todo  insert value to one table
     * @param string $table A name of table to insert into
     * @param array $data An associative array
     * @return bool success
     */
    public function Insert($table, $data = array()) {

        // sort array by keys
        ksort($data);
        //remove type
        if (isset($data['type'])) {
            unset($data['type']);
        }

        // make array and key for each
        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO " . DB_PREFIX . "$table (`$fieldNames`) VALUES ($fieldValues)";
        // send sql
        $stmt = $this->prepare($sql);

        // send param
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        // run sql
        $success = $stmt->execute();

        // dubug unsuccess
        if ((_DBG_) && (!$success)) {

            _err(array_merge($stmt->errorInfo(), array($sql)));
        }
        $this->last_insert_id = $this->lastInsertId();
        return $success;
    }
    /**
     * replace
     * @todo  replace value to one table
     * @param string $table A name of table to insert into
     * @param array $data An associative array
     * @return bool success
     */
    public function Replace($table, $data = array()) {

        // sort array by keys
        ksort($data);
        //remove type
        if (isset($data['type'])) {
            unset($data['type']);
        }

        // make array and key for each
        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sql = "REPLACE INTO " . DB_PREFIX . "$table (`$fieldNames`) VALUES ($fieldValues)";
        // send sql
        $stmt = $this->prepare($sql);

        // send param
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        // run sql
        $success = $stmt->execute();

        // dubug unsuccess
        if ((_DBG_) && (!$success)) {

            _err(array_merge($stmt->errorInfo(), array($sql)));
        }
        $this->last_insert_id = $this->lastInsertId();
        return $success;
    }

    /**
     * update
     * @todo update recored inn db
     * @param string $table A name of table to insert into
     * @param array $data An associative array
     * @param string $where the WHERE query part - condition
     * @return bool success
     */
    public function Update($table, $data = array(), $where = '1') {

        // sort array by keys
        ksort($data);
        //remove type
        if (isset($data['type'])) {
            unset($data['type']);
        }

        // make params
        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sql = "UPDATE " . DB_PREFIX . "$table SET $fieldDetails WHERE $where";

        // send sql
        $stmt = $this->prepare($sql);

        // send params
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        // run sql
        $success = $stmt->execute();

        // dubug unsuccess
        if ((_DBG_) && (!$success)) {

            _err(array_merge($stmt->errorInfo(), array($sql)));
        }
        return $success;
    }

    /**
     * custom query
     * @todo Select from database
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function CustomQuery($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {

        //remove type
        if (isset($array['type'])) {
            unset($array['type']);
        }
        //send sql
        $stmt = $this->prepare($sql);
        // send params
        foreach ($array as $key => $value) {
            $stmt->bindValue("$key", $value);
        }
        // run sql
        $success = $stmt->execute();

        // dubug unsuccess
        if ((_DBG_) && (!$success)) {

            _err(array_merge($stmt->errorInfo(), array($sql)));
            
        }

        return $stmt->fetchAll($fetchMode);
    }

    /**
     * delete
     * @todo delet record from table
     * @param string $table table name
     * @param string $where condition
     * @param int $limit limit query
     * @return int Affected Rows
     */
    public function Delete($table, $where, $limit = 1) {
        return $this->exec("DELETE FROM " . DB_PREFIX . "$table WHERE $where LIMIT $limit");
    }

}

?>