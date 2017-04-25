<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   Topic-controller.php | topics controller
 * @todo :   
 */
class Topic extends TController {

    function __construct() {

        parent::__construct('Topic');
        self::$_main_title = _lg('Topic');
    }

    /**
     * @todo Show index without any thing
     */
    public function Index() {
        $this->_notifiControl(func_get_args());
        $this->view->cls_list = $this->model->Read('topic_id, topic_counter, '
                . 'topic_title, topic_status');
        $this->view->pagination = new TPagination($this->model->GetPageCount());
        $this->view->PageRender('Topic/Index', self::$_main_title);
    }

    public function NewTopic() {
        $this->view->navigator->AddItem(_lg('Topics'), UR_MP . 'Topic/Index');
        $this->view->PageRender('Topic/NewTopic',_lg("New Topic") );
    }

    public function Edit($id) {
        $this->_notifiControl(func_get_args());
        $this->view->navigator->AddItem(_lg('Topics'), UR_MP . 'Topic/Index');
        $this->view->record = $this->model->GetRecord($id);
        $tag = new TTag();
        $a = $tag->TList($this->view->record['topic_id'], RELATION_TAG);
        $this->view->tags = implode($a, ',');

        $this->view->attach = $this->model->GetAttached($id);
        $this->view->PageRender('Topic/Edit',  _lg('Edit') . ' - ' . $this->view->record['topic_title']);
    }

    public function Update($id) {

        if (isset($_POST['category'])) {
            $this->CatSync($id);
        }
        $_POST['topic_time'] = time();
        $_POST['topic_term'] = UrlTerm($_POST['topic_title']);

        $this->model->Edit($id, $_POST);
        GoBack('/edit');
    }

    public function Search() {
        header("Content-type:application/json");
        echo $this->model->Search($_GET['term']);
    }

    public function TagChange() {
        header("Content-type:application/json");
        echo $this->model->TagChange($_POST['tag'], $_POST['id'], $_POST['action']);
    }

    public function Sync() {
        $this->model->Sync($_POST['tags'], $_POST['id'], 1);
    }

    public function CatSync($id) {
        $rel = TRelation::GetInstance();
        $rel->Sync($_POST['category'], $id, RELATION_CATEGORY);
        unset($_POST['category']);
    }

    public function Insert() {
        $_POST['topic_time'] = time();
        $_POST['topic_term'] = UrlTerm($_POST['topic_title']);
        $_POST['topic_owner_id'] = $_SESSION['MN_ID'];

        $id = $this->model->Create($_POST);
        Redirect(UR_MP . 'Topic/Edit/' . $id . '/create');
    }

    public function Image($id) {
        $upload = new TUpload();
        $result = $upload->Save('image');
        $url = str_replace('../upload/', UR_UPLOAD, $result['value']['path']);
        $this->model->Edit($id, array('topic_image' => $url));
        GoBack();
    }

    public static function Loader() {
        global $side_menu;

        $index = $side_menu->AddItem(_lg('Topics'), '#', 0, 'fa-bullhorn',-112);
        $side_menu->AddItem(_lg("Topics list"), UR_MP .
                'Topic', $index);
        $side_menu->AddItem(_lg("New Topic"), UR_MP .
                'Topic/NewTopic', $index);
    }

}
