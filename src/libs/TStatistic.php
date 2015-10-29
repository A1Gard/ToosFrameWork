<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 20-Sep-2014
 * @time : 15:41 
 * @subpackage TStatistic
 * @version 1.0
 * @todo :  Statistic class
 */
class TStatistic extends TModel {

    function __construct() {
        
        $visit_long = 3600 ;
        $online_long = 300 ;
        
        // pre hook
        _hk('P' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $visit_long, $online_long);
        
        parent::__construct('statistic');
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
        $rs = $this->db->Select('SELECT statistic_id FROM %table% WHERE statistic_ip = ' .
                _ipi() . ' AND statistic_last_visit > ' . (time() - VISIT_LONG), array('statistic'));

        if (is_array($rs) && count($rs) > 0) {

            $this->db->Select('UPDATE %table%  SET statistic_visit = statistic_visit + 1'
                    . ', statistic_last_visit = ' . time() . ' WHERE statistic_id = ' .
                    $rs[0]['statistic_id'], array('statistic'));
        } else {
            //
            $data = array(
                'statistic_time' => time(),
                'statistic_last_visit' => time(),
                'statistic_os' => TVisitor::DetectOSI(),
                'statistic_browser' => TVisitor::DetectBrowserI(),
                'statistic_verstion' => (int) TVisitor::BrowserVersion(),
                'statistic_ip' => _ipi(),
                'statistic_referer' => Referer(),
                'statistic_keyword' => TVisitor::GetKeyword()
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
        $rs = $this->db->Select('SELECT statistic_id FROM %table% WHERE statistic_ip = ' .
                _ipi() . ' AND statistic_last_visit > ' . (time() - VISIT_LONG), array('statistic'));

        if (is_array($rs) && count($rs) > 0) {

            $this->db->Select('UPDATE %table%  SET statistic_visit = statistic_visit - 1'
                    . ', statistic_last_visit = ' . time() . ' WHERE statistic_id = ' .
                    $rs[0]['statistic_id'], array('statistic'));
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
        $rs = $this->db->Select("SELECT SUM(statistic_visit) AS 'sum' FROM %table% WHERE statistic_time"
                . " BETWEEN " . $start . " AND " . $end . " ;", array('statistic'));
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
        $rs = $this->db->Select("SELECT COUNT(statistic_id) AS 'count' FROM %table% WHERE statistic_time"
                . " BETWEEN " . $start . " AND " . $end . " ;", array('statistic'));
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
            statistic_last_visit > " . (time() - ONLINE_LONG), array('statistic'));
        $result = $rs[0]['count'];
        
                // result hook
        _hk('R' . ':' . __CLASS__ . ':' . __FUNCTION__, $this, $result);
        
        return $result;
    }

}
