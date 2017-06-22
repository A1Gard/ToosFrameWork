<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   Category-controller.php | topics controller
 * @todo :   
 */
class Category extends TController {

    function __construct() {

        parent::__construct('category');
        self::$_main_title = _lg('Category');
    }

    /**
     * @todo Show index without any thing
     */
    public function Index() {

        $this->view->cls_list = $this->model->CategoryList();
        $this->view->cat = $this->model->GetInstance();
        $this->view->PageRender('Category/Index'. __CLASS__, self::$_main_title);
    }

    public function Insert() {
        $id = $this->model->Create($_POST);
        GoBack(_lg('Category added...'));
    }

    public function Edit($id) {
        $this->view->navigator->AddItem(_lg('Categories'), UR_MP . 'Category/Index');
        $this->view->record = $this->model->GetRecord($id);
        $this->view->cat = $this->model->GetInstance();
        $this->view->PageRender('Category/Edit'. __CLASS__, self::$_main_title . ' ویرایش  - ' . $this->view->record['category_title']);
    }

    public function Node() {
        $this->view->cat = $this->model->GetInstance();
        $this->view->PageRender('Category/Node'. __CLASS__, self::$_main_title . " Pro");
    }

    public function Update($id) {
        if ($_FILES['image']) {
            $up = new TUpload(UPLOAD_BY_OTHER, 'category');
            $up->Save('image', $id);
        }
        $this->model->Edit($id, $_POST, 'category_');
        Redirect(UR_MP . 'Category/Edit/' . $id);
    }

    public function Delete($id) {
        $this->model->Delete(intval($id));
        GoBack();
    }

    private function _arrryCleaner($array, $parent_id = 0) {

        foreach ($array[0] as $obj) {
            $result[$obj->id] = $parent_id;
            if ($obj->children[0] != array()) {
                $child = $this->_arrryCleaner($obj->children, $obj->id);
                $result += $child;
            }
        }
        return $result;
    }

    public function Sync() {
        $array = json_decode($_POST['sorted']);
        $array = $this->_arrryCleaner($array);
        $result = array();
        $result['success'] = $this->model->CategorySync($array);
        if ($result['success']) {
            $result['value'] = _lg('List order saved successfully');
        } else {
            $result['value'] = _lg('List order saved failed');
        }

        echo json_encode($result);
    }

    public static function Loader() {
        global $side_menu;
        
        $index = $side_menu->AddItem(_lg('Categories'), '#', 0, 'fa-book');
        $side_menu->AddItem(_lg('Categories classic list'), UR_MP .
                'Category', $index);
//        $side_menu->AddItem(_lg('Categories node list'), UR_MP .
//                'Category/Pro', $index);
    }

    /**
      UPDATE categories
      SET order = CASE id
      WHEN 1 THEN 3
      WHEN 2 THEN 4
      WHEN 3 THEN 5
      END,
      title = CASE id
      WHEN 1 THEN 'New Title 1'

      ELSE title
      END
      WHERE id IN (1,2,3)
     * 
     */
}
