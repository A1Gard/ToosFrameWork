<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   calss-model.php
 * @todo : calssUR_MP_ASSETS page
 */

/**
 * class for user accessUR_MP_ASSETS
 */
class TopicModel extends TModel {

    function __construct() {
        parent::__construct('topic', 'topic_');
        $this->tag = new TTag();
    }

    public function Search($searched_term) {

        return $this->tag->Search($searched_term);
    }

    public function TagChange($tag, $id, $action) {
        $result = array('success' => TRUE, 'value' => null);

        if ($action == ACTION_DELETE) {
            //remove tag
            if ($this->tag->Remove($tag, $id, RELATION_TAG)) {

                $result['value'] = 'tag "' . $tag . '" removed to yours successfully';
            } else {
                $result['success'] = false;
                $result['value'] = 'can not remove tag';
            }
        } else {
            //add tag
            if ($this->tag->Add($tag, $id, RELATION_TAG)) {

                $result['value'] = 'tag "' . $tag . '" added to yours successfully';
            } else {
                $result['success'] = false;
                $result['value'] = 'can not add tag';
            }
        }

        return json_encode($result);
    }

    public function Sync($tags, $object_id, $type) {

        $this->tag->Sync($tags, $object_id, $type);
    }

    public function GetAttached($destination, $type = REALTION_ATTACH) {
        $rel = TRelation::GetInstance();
        $result = $rel->GetByDestination($destination, $type);
        if (count($result) > 0) {
            $sql = "SELECT attach_label,attach_id FROM %table% WHERE attach_id IN(" .
                    implode(',', $result) . ') ;';
            $result = $this->db->select($sql, array('attach'));
        }
        return $result;
    }

    function GetGallery($id) {
        $idz = implode(',', $this->GetRelation($id, REALTION_GALLERY));
        if (strlen($idz) == 0) {
            return array();
        }
        return $this->db->Select("SELECT up_id,up_location,up_filename FROM %table% WHERE up_id IN ($idz)", 'upload');
    }

}

?>