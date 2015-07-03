<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 20-Sep-2014
 * @time : 15:41 
 * @subpackage TState
 * @version 1.0
 * @todo :  State class
 */
class TState extends Model {

    function __construct() {
        
        $visit_long = 3600 ;
        $online_long = 300 ;
        
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $visit_long, $online_long);
        
        parent::__construct('state');
        define('VISIT_LONG', $visit_long); // on hour
        define('ONLINE_LONG', $online_long ); // 5 min
    }

    
    public static function GetInstance() {
        if (!isset(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }
    
    
    /**
     * count visitor info
     * @return boolean
     */
    public function Count() {

        //$this->FileLog("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] \n", 'fff.txt');

        // if is visited count 
        $rs = $this->db->Select('SELECT state_id FROM %table% WHERE state_ip = ' .
                _ipi() . ' AND state_last_visit > ' . (time() - VISIT_LONG), array('state'));

        if (is_array($rs) && count($rs) > 0) {

            $this->db->Select('UPDATE %table%  SET state_visit = state_visit + 1'
                    . ', state_last_visit = ' . time() . ' WHERE state_id = ' .
                    $rs[0]['state_id'], array('state'));
        } else {
            //
            $data = array(
                'state_time' => time(),
                'state_last_visit' => time(),
                'state_os' => TVisitor::DetectOSI(),
                'state_browser' => TVisitor::DetectBrowserI(),
                'state_verstion' => (int) TVisitor::BrowserVersion(),
                'state_ip' => _ipi(),
                'state_referer' => Referer(),
                'state_keyword' => TVisitor::GetKeyword()
            );
            $this->Create($data);
        }
        return TRUE;
    }

    /**
     * Discount user view
     * @return boolean
     */
    public function Discount() {


        // if is visited count 
        $rs = $this->db->Select('SELECT state_id FROM %table% WHERE state_ip = ' .
                _ipi() . ' AND state_last_visit > ' . (time() - VISIT_LONG), array('state'));

        if (is_array($rs) && count($rs) > 0) {

            $this->db->Select('UPDATE %table%  SET state_visit = state_visit - 1'
                    . ', state_last_visit = ' . time() . ' WHERE state_id = ' .
                    $rs[0]['state_id'], array('state'));
        }
        return TRUE;
    }

    /**
     * get visit count in time long
     * @param int $start timestamp
     * @param int $end time stamp
     * @return int 
     */
    public function VisitCount($start, $end = 'now') {

        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $start,$end);
        
        if ($end == 'now'){
            $end = time();
        }
        $rs = $this->db->Select("SELECT SUM(state_visit) AS 'sum' FROM %table% WHERE state_time"
                . " BETWEEN " . $start . " AND " . $end . " ;", array('state'));
        $result = (int) $rs[0]['sum'];
        
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

    /**
     * get visitor count in time long
     * @param type $start timestamp
     * @param type $end timestamp
     * @return int
     */
    public function VisitorCount($start, $end = 'now') {
        if ($end == 'now'){
            $end = time();
        }
        $rs = $this->db->Select("SELECT COUNT(state_id) AS 'count' FROM %table% WHERE state_time"
                . " BETWEEN " . $start . " AND " . $end . " ;", array('state'));
        $result = $rs[0]['count'];
        
        // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

    /**
     * get online user count
     * @return type
     */
    public function OnlineCount() {

        
        $rs = $this->db->Select("SELECT COUNT(*) AS 'count' FROM %table% WHERE 
            state_last_visit > " . (time() - ONLINE_LONG), array('state'));
        $result = $rs[0]['count'];
        
                // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

}
