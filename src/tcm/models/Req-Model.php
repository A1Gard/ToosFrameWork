<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   calss-model.php
 * @todo : calssUR_MP_ASSETS page page
 */

/**
 * class for user accessUR_MP_ASSETS
 */
class ReqModel extends TModel {

    function __construct() {
        parent::__construct('req', 'req_');
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


        $table_name = 'req';


        $prefix = 'req_';

        if (isset($_GET['page'])) {
            $start = abs(intval($_GET['page']));
            $start--;
            $start *= $limit;
        } else {
            $start = 0;
        }

        if (isset($_GET['order']) && strpos($colums, $_GET['order']) !== false) {
            $order = $_GET['order'] . ' ASC';
        } else {
            $order = $prefix . 'id DESC';
        }

        // if not have filter
        if (!isset($_GET['filter'])) {

            $sql = "SELECT $colums FROM %table% WHERE  req_member_id = member_id ORDER BY {$order} "
                    . " LIMIT $start,$limit;";

            $result = $this->db->Select($sql, array($table_name,'member'));
        } else {
            // else have filter apply fillter
            $filter = explode(',', $_GET['filter']);
            $sql = "SELECT $colums FROM %table%  WHERE  req_member_id = member_id AND "
                    . " {$filter[0]} =  :{$filter[0]} ORDER BY {$order} " 
                    . " ORDER BY {$order} "
                    . " LIMIT $start,$limit";
            // get count
            $result = $this->db->Select($sql, array($table_name,'member'), array($filter[0] => $filter[1]));
        }
        return $result;
    }

}

?>