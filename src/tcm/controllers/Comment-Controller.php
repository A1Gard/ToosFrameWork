<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   Comment-controller.php | topics controller
 * @todo :   
 */

class Comment extends TController {
    
    function __construct() {
        
        parent::__construct() ;
        self::$_main_title = _lg('Comment') ;
    }
    
    /**
     * @todo Show index without any thing
     */
    public function Index() {
        
        $this->view->cls_list = $this->model->Read('comment_id,comment_ip, comment_time, '
        . 'comment_member_id, comment_status, comment_parent, comment_text,comment_topic_id');
        $this->view->pagination =  new TPagination($this->model->GetPageCount());
        $this->view->PageRender('Comment/Index',self::$_main_title);
    }

    /**
     * reply comment for new
     * @param int $parent
     */
    public function NewComment($parent,$topic_id) {
       $this->view->prn = $parent;
       $this->view->tid = $topic_id;
       $this->view->navigator->AddItem('دیدگاه ها', UR_MP . 'Comment/Index');
       $this->view->PageRender('Comment/NewComment',self::$_main_title . ' جدید '); 
    }
    
    public function Insert() {

        $_POST['comment_time'] = time();
        $_POST['comment_status'] = 1;
        $_POST['comment_ip'] =  _ipi();

        $id = $this->model->Create($_POST);
        Redirect(UR_MP . 'Comment/Index');
    }
    /**
     * approve or unapprove comments
     * @param int $id
     * @param int $new_staus
     */
    public function Status($id,$new_staus) {
        $this->model->Edit($id,array('comment_status'=>$new_staus));
        GoBack();
    }
    
    public function Delete($id) {
        $this->model->Delete(intval($id));
        GoBack();
    }
}

