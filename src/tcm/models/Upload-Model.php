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
class UploadModel extends TModel {

    function __construct() {
        parent::__construct('upload','up_');
    }    
    
    
    public function AddAttach($result, $destination, $type = REALTION_ATTACH) {
        
        $data = array(
            'attach_filename' => $result['value']['name'],
            'attach_size' => $result['value']['size'],
            'attach_ext' => $result['value']['ext'],
            'attach_location' => $result['value']['path'],
            'attach_time' => time(),
            'attach_label' => $_POST['label'],
            'attach_url' => str_replace('../upload/', UR_UPLOAD, $result['value']['path'])
        );
        
        $id = $this->Create($data);
        
        $rel = TRelation::GetInstance();
        
         return $rel->Add($id, $destination, $type);
    }
} 

?>