<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   TTryLog.php
 * @version 1.0
 * @todo : loging try to do : login - search - send comment & ...
 */

class TTryLog extends TModel {

    function __construct() {
        parent::__construct();
    }
    
    
    /**
     * @todo check how many tyried in last min
     * @param int $type type of try
     * @param  $last_mins in last minutes 
     * @return int how many request in test time
     */
    public function Check($type=0, $last_mins = 10) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $type, $last_mins);
        $sql = "SELECT COUNT(`trylog_id`) AS 'count' FROM %table% WHERE 
            `trylog_ip` = " . _ipi() . " 
             AND `trylog_time` > " . (time()- ($last_mins * 60) );
        $result = $this->db->Select($sql, array('trylog'),array('type'=>''));
        
        $result_ = $result[0]['count'];
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result_);
        // retrun count
        return $result_;
    }

    /**
     * @todo log try
     * @param int $type type of try
     * @return bool
     */
    public function Log($type=0) {
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $type);
        
        // make value
        $data = array('type'=> 'iii',
            'trylog_type'   => $type,
            'trylog_ip'     => _ipi(),
            'trylog_time'   => time());
        
        // send to insert in regiery
        return $this->db->Insert('trylog',$data);
    }
}
?>
