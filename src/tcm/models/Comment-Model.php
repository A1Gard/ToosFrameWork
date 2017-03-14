<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   calss-model.php
 * @todo : calssUR_MP_ASSETS page page
 */

/**
 * class for user accessUR_MP_ASSETS
 */
class CommentModel extends TModel {

    function __construct() {
        parent::__construct('comment', 'comment_');
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
            $table_name = 'comment';
        }
        if ($prefix == null) {
            $prefix = 'comment_';
        }
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

            $sql = "SELECT $colums
            , m.member_name, f.manager_displayname , t.topic_title
            FROM " . DB_PREFIX . "comment c
            LEFT JOIN " . DB_PREFIX . "member m on m.member_id = c.comment_member_id
            LEFT JOIN " . DB_PREFIX . "topic t on t.topic_id = c.comment_topic_id
            LEFT JOIN " . DB_PREFIX . "manager f on f.manager_id = c.comment_member_id*-1 ORDER BY {$order} "
                    . " LIMIT $start,$limit;";
            //die($sql);

            $result = $this->db->Select($sql, array('comment'));
        } else {
            // else have filter apply fillter
            $filter = explode(',', $_GET['filter']);


             $sql = "SELECT $colums
            , m.member_name, f.manager_displayname , t.topic_title
            FROM " . DB_PREFIX . "comment c
            LEFT JOIN " . DB_PREFIX . "member m on m.member_id = c.comment_member_id
            LEFT JOIN " . DB_PREFIX . "topic t on t.topic_id = c.comment_topic_id
            LEFT JOIN " . DB_PREFIX . "manager f on f.manager_id = c.comment_member_id*-1 WHERE "
                     .  " {$filter[0]} =  :{$filter[0]} ORDER BY {$order} " 
                    . " LIMIT $start,$limit;";

                   // die($sql);
            // get count
            $result = $this->db->Select($sql, array('comment'), array($filter[0] => $filter[1]));
        }
        return $result;
    }

}

?>