<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   Controller super class
 * @todo : Controller Super class
 */
class Controller extends Bootstarp {

    private $base;

    function __construct($base = '') {

        // registry class create   ;
        $registry = TRegistry::GetInstance();


        $this->base = $base;
        // every controller have view load view here
        $this->view = new View();


        // check if not in login page 
        if (!(parent::$request == 'Access,Login' || parent::$request == 'Access,Check')) {
            // manger access controller
            TMAC::Init();
            TMAC::CheckLogin();
            TMAC::RestoreRequest();
        }
    }

    /**
     * @todo load controller model if exsits
     * @param string $name
     */
    public function LoadModel($name) {

        $filename = 'models/' . $name . '-Model.php';
        // check exists
        if (file_exists($filename)) {
            // require and make class
            require $filename;
            $model_class = $name . 'Model';

            $this->model = new $model_class();
        }
    }

    /**
     * universal record insert in table
     */
    public function Insert() {
        $id = $this->model->Create($_POST);
        Redirect(UR_CM . $this->base . '/Edit/' . $id);
    }

    /**
     * usniversal record update or edit
     * @param int $id
     */
    public function Update($id) {
        $this->model->Edit($id, $_POST);
        GoBack();
    }

    /**
     * unversal record delete from table
     * @param int $id 
     */
    public function Delete($id) {
        $this->model->Delete(intval($id));
        GoBack();
    }

    /**
     * universak bulk action in controller
     * @return string
     */
    public function BulkAction() {
        $arr = explode(',', $_POST['action']);
        switch ($arr[0]) {
            case 'Delete':
                foreach ($_POST['id'] as $id) {
                    $this->model->Delete($id);
                }

                break;
            case 'Edit':


                $data = array($arr[1] => $arr[2]);
                foreach ($_POST['id'] as $id) {
                    $this->model->Edit($id, $data);
                }
                break;

            default:
                return 'error';
                break;
        }
        GoBack();
    }

}
