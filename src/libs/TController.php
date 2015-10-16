<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   Controller super class
 * @todo : Controller Super class
 */
class TController extends TBootstarp {

    private $base;
    protected static $_main_title = '';

    function __construct($base = '') {

        // registry class create   ;
        $registry = TRegistry::GetInstance();


        $this->base = $base;
        // every controller have view load view here
        $this->view = new TView();


        // check if not in login page 
        if (!(parent::$request == 'Access,Login' || parent::$request == 'Access,Check')) {
            // manger access controller
            TMAC::Init();
            TMAC::CheckLogin();
            TMAC::RestoreRequest();
        }
    }

    /**
     * @todo load controllerUR_MP_ASSETS if exsits
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
        Redirect(UR_MP . $this->base . '/Edit/' . $id);
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
        GoBack('/delete');
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
        GoBack('/do');
    }

    /**
     * add notifcation
     * @param mixed $array_check array of argumans
     */
    public function _notifiControl($array_check) {
        
        if (isset($array_check[0])) {
            if ($array_check[0] == 'delete') {
                TNotification::Add(self::$_main_title . _lg(" has been delete"), 'success');
            } elseif ($array_check[0] == 'do') {
                TNotification::Add(_lg("Bulk action do successfully"), 'success');
            } 
        }
        
        
        if (isset($array_check[1])) {
            if ($array_check[1] == 'create') {
                TNotification::Add(self::$_main_title . _lg(" has been create"), 'success');
            } elseif ($array_check[1] == 'edit') {
                TNotification::Add(self::$_main_title . _lg(" has been update"), 'success');
            }
        }
    }

}
