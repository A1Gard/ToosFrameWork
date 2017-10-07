<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   Tdatabase
 * @todo : mysqli mothod to connect to db .
 * @ignore unusable.
 */


class TDatabase extends mysqli
{
    
    
    private $_type = NULL ;


    public function __construct( $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
        
        if (_DBG_){ // if dubig mode show error
            // test if not connect .
            if ($this->connect_error) {
                throw new Exception("Fatal Toos Error : Mysqli Connect Error <!-- {$this->error} --> ");
            }
        }
        
        $this->query("SET CHARACTER SET utf8");
        $this->query("SET NAMES utf8");
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
    public function Select($sql, $tables = array(), $array = array(), $fetchMode = MYSQLI_ASSOC) {
        
        
        // save types
        $this->_type = $array['type'];
        unset($array['type']);
        
        // made tables to select
        $tbl = NULL ;
        foreach ($tables as $table) {
            $tbl .= DB_PREFIX . $table . ',';
        }
        
        $tbl = rtrim($tbl,',');
        // replace after make
        $sql = str_replace('%table%', $tbl, $sql);
        
        
        $tmp = explode(' ', $sql);
        
        $sql = null ;
        
        foreach ($tmp as $value) {
            if (substr($value, 0, 1) == ':') {
                $sql .= '?';
            }  else {
                $sql .= ' ' . $value;
            }
        }
        
        $stmt = $this->stmt_init();
        
        // send sql 
        $stmt->prepare($sql);
       
        if (count($array) > 0)
        // send params
        call_user_func_array(array($stmt, 'bind_param'), $this->_MakeValues($array));
        
                
        // run sql
        $success = $stmt->execute();
        
        
        // dubug unsuccess
        if ((_DBG_) && (!$success) ) {
            
            foreach ($stmt->error_list as $error) {
                echo "<br /> " . $error;
            }
        }
    
        // init result
        $result = array();
        
        // get meta reusult
        $meta = $stmt->result_metadata();
        
        // make fileds
        while ($field = $meta->fetch_field()){
            $params[] = &$row[$field->name];
        }

        //bind values bu fileds
        call_user_func_array(array($stmt, 'bind_result'), $params);
        
        // get results
        while ($stmt->fetch()) {
            foreach($row as $key => $val) {
                $c[$key] = $val;
            }
            $result[] = $c;
        } 
        
        
        //$stmt
        return $result;
    }
    
    
    /**
     * Custom Query
     * @todo Select from database
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function CustomQuery($sql, $array = array(), $fetchMode = MYSQLI_ASSOC) {
        
        
        $tmp = explode(' ', $sql);
        
        $sql = null ;
        
        foreach ($tmp as $value) {
            if (substr($value, 0, 1) == ':') {
                $sql .= '?';
            }  else {
                $sql .= ' ' . $value;
            }
        }
        
        $stmt = $this->stmt_init();
        
        // send sql 
        $stmt->prepare($sql);
       
        if (count($array) > 0)
        // send params
        call_user_func_array(array($stmt, 'bind_param'), $this->_MakeValues($array));
        
                
        // run sql
        $success = $stmt->execute();
        
        
        // dubug unsuccess
        if ((_DBG_) && (!$success) ) {
            
            foreach ($stmt->error_list as $error) {
                echo "<br /> " . $error;
            }
        }
    
        // init result
        $result = array();
        
        // get meta reusult
        $meta = $stmt->result_metadata();
        
        // make fileds
        while ($field = $meta->fetch_field()){
            $params[] = &$row[$field->name];
        }

        //bind values bu fileds
        call_user_func_array(array($stmt, 'bind_result'), $params);
        
        // get results
        while ($stmt->fetch()) {
            foreach($row as $key => $val) {
                $c[$key] = $val;
            }
            $result[] = $c;
        } 
        
        
        //$stmt
        return $result;
    }
    
    /**
     * @todo extedent select without param
     * @param string $sql sql query
     * @param int $fetchMode constant mysqlu fetch mode
     * @return array
     */
    public function SelectEx($sql, $fetchMode = MYSQLI_ASSOC) {
    
        // send query
        $result = $this->query($sql) ;
        
        // result
        return $result->fetch_all($fetchMode);
    }
    
    
    /**
     * insert
     * @todo  insert value to one table
     * @param string $table A name of table to insert into
     * @param array $data An associative array
     * @return bool success
     */
    public function Insert($table, $data=array()) {
        
        // save types
        $this->_type = $data['type'];
        unset($data['type']);
        
        // made array and key for each
        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = str_repeat('?,', count($data));
        
        $fieldValues = rtrim($fieldValues, ',');
        
        if (count($data) > 0)
        // send sql 
        $stmt = $this->prepare("INSERT INTO " . DB_PREFIX . "$table (`$fieldNames`) VALUES ($fieldValues);");
        
        // send params
        call_user_func_array(array($stmt, 'bind_param'), $this->_MakeValues($data));
        
        // run sql
        $success = $stmt->execute();
                
        // dubug unsuccess
        if ((_DBG_) && (!$success) ) {
            
            foreach ($stmt->error_list as $error) {
                echo "<br /> " . $error;
            }
        }
        return $success;
    }
    /**
     * replace
     * @todo  replace value to one table
     * @param string $table A name of table to insert into
     * @param array $data An associative array
     * @return bool success
     */
    public function Replace($table, $data=array()) {
        
        // save types
        $this->_type = $data['type'];
        unset($data['type']);
        
        // made array and key for each
        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = str_repeat('?,', count($data));
        
        $fieldValues = rtrim($fieldValues, ',');
        
        if (count($data) > 0)
        // send sql 
        $stmt = $this->prepare("REPLACE INTO " . DB_PREFIX . "$table (`$fieldNames`) VALUES ($fieldValues);");
        
        // send params
        call_user_func_array(array($stmt, 'bind_param'), $this->_MakeValues($data));
        
        // run sql
        $success = $stmt->execute();
                
        // dubug unsuccess
        if ((_DBG_) && (!$success) ) {
            
            foreach ($stmt->error_list as $error) {
                echo "<br /> " . $error;
            }
        }
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
    public function Update($table, $data=array(), $where = 1) {
        
        // save types
        $this->_type = $data['type'];
        unset($data['type']);
        // make params
        $fieldDetails = NULL;
        
        foreach($data as $key=> $value) {
            $fieldDetails .= "`$key`=?,";
        }
        // trim
        $fieldDetails = rtrim($fieldDetails, ',');
        
        $stmt = $this->stmt_init();
        
        // send sql
        $stmt->prepare("UPDATE " . DB_PREFIX . "$table SET $fieldDetails WHERE $where");
        
        if (count($data) > 0)
        // send params
        call_user_func_array(array($stmt, 'bind_param'), $this->_MakeValues($data));
        
        // run sql
        $success = $stmt->execute();
        
        // dubug unuccess
        if ((_DBG_) && (!$success) ) {
            
            foreach ($stmt->error_list as $error) {
                echo "<br /> " . $error;
            }
        }
        return $success;
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
    
    
    private function _MakeValues($arr) {
        
        //if (strnatcmp(phpversion(),'5.3') >= 0) { //Reference is required for PHP 5.3+ 
            $refs[0] = $this->_type;
            unset($arr['type']);
            foreach($arr as $key => $value){
                $refs[] = &$arr[$key];
            }
            return $refs;
        //}
      
        //return $arr; 
        
    }

}

?>