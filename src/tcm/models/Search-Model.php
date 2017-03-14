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
class SearchModel extends TModel {

    function __construct() {
        parent::__construct('category');
    }

    /**
     * search in all items
     * @param int $mode seatch mode
     * @param sting $searched_term
     * @param int $min_length min length of trem
     * @param int $max_result max record result
     * @return string json encoded
     */
    public function AjaxSearchAll($mode = SEARCH_MODE_CATEGORY, $searched_term = null, $min_length = 2, $max_result = 10) {


        // if length set search start
        if (strlen($searched_term) >= $min_length) {

            switch ($mode) {
                case SEARCH_MODE_CATEGORY:

                    $sql = "SELECT category_id AS 'id',category_title AS 'label' FROM %table% "
                            . "WHERE category_title REGEXP :term LIMIT $max_result ;";
                    $result = $this->db->Select($sql, array('category'), array('type' => 's',
                        ":term" => '^.*' . $searched_term . '.*$'));


                    break;
                case SEARCH_MODE_TAG:

                    $sql = "SELECT tag_id AS 'id',tag_label AS 'label' FROM %table% "
                            . "WHERE tag_label REGEXP :term LIMIT $max_result ;";
                    $result = $this->db->Select($sql, array('tag'), array('type' => 's',
                        ":term" => '^.*' . $searched_term . '.*$'));


                    break;
                case SEARCH_MODE_TOPIC:

                    $sql = "SELECT topic_id AS 'id',topic_title AS 'label' FROM %table% "
                            . "WHERE topic_title REGEXP :term LIMIT $max_result ;";
                    $result = $this->db->Select($sql, array('topic'), array('type' => 's',
                        ":term" => '^.*' . $searched_term . '.*$'));


                    break;
                case SEARCH_MODE_MEMEBER:

                    $mode = array('member_name','member_number','member_email');
                    if (isset($_GET['field'])){
                        $field = $mode[$_GET['field']];
                    }  else {
                        $field = 'member_name';
                    }
                    $sql = "SELECT member_id AS 'id',member_name AS 'label' FROM %table% "
                            . "WHERE $field REGEXP :term LIMIT $max_result ;";
                    $result = $this->db->Select($sql, array('member'), array('type' => 'ss',
                        ":term" => '^.*' . $searched_term . '.*$'));


                    break;

                default:
                    break;
            }
            // jsone encode result
            $result = json_encode($result);
        } else
            $result = null;

        return $result;
    }

}
