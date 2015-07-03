<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   Member-controller.php | topics controller
 * @todo :   
 */

class Req extends Controller {
    
    private static $_main_title ;
    function __construct() {
        
        parent::__construct() ;
        self::$_main_title = _lg('برنامه فردی') ;
    }
    
    /**
     * @todo Show index without any thing
     */
    public function Index() {
        
        $this->view->cls_list = $this->model->Read('req_title, req_status, req_id, member_name');
        $this->view->pagination =  new TPagination($this->model->GetPageCount());
        $this->view->PageRender('Req/Index',self::$_main_title);
    }


    
    public function Edit($id) {
        $this->view->navigator->AddItem(_lg('فهرست برنامه'), UR_CM . 'Req/Index');
        $this->view->record = $this->model->GetRecord($id);
        $this->view->PageRender('Req/Edit',self::$_main_title . ' ویرایش  - ' .$this->view->record['req_title'] );
    }
    
    public function Update($id) {
        $this->model->Edit($id,$_POST);
        Redirect(UR_CM . 'Req/Edit/' . $id);
    }
    
    /**
     * approver or unapprove user change tyoe directly
     * @param int $id
     * @param int $new_type
     */
    public function Status($id,$new_type) {
        //die($new_type);
        $this->model->Edit($id,array('req_status'=>$new_type));
        GoBack();
    }
    
    public function Delete($id) {
        $this->model->Delete(intval($id));
        GoBack();
    }
}

