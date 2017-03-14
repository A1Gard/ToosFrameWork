<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   Topic-controller.php | topics controller
 * @todo :   
 */

class Upload extends TController {
    
    function __construct() {
        
        parent::__construct() ;
        self::$_main_title = _lg('Upload') ;
    }
    
   
    public function Upload($file_name) {
        $upload = new TUpload();
        $result = $upload->Save($file_name);
        //print_r($result);
        return $result;
    }
    
    public function RealTimeUpload($file_name = 'upload') {
        $upload = new TUpload();
        $result = $upload->Save($file_name);
        $url = str_replace('../upload/', UR_UPLOAD, $result['value']['path']);
        echo "<html><body><script type=\"text/javascript\">window.parent."
        . "CKEDITOR.tools.callFunction('1','" . $url . "');</script></body></html>;";

    }
    
    public function UploadAttach($file_name, $destination, $type = REALTION_ATTACH) {
        
        $upload = new TUpload();
        $result = $upload->Save($file_name);
        if($result['success']){
            $res =  $this->model->AddAttach($result, $destination, $type);
        }else{
            $res =  false;
        }
        GoBack();
    }
    
    public function RemoveAttach($attach_id, $destination, $type = REALTION_ATTACH) {
        $rel = TRelation::GetInstance();
        $rel->Remove($attach_id, $destination, $type);
        GoBack();
    }
    
}

