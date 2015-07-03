<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   Game-controller.php | topics controller
 * @todo :   
 */
class Widget extends Controller {

    private static $_main_title;

    function __construct() {

        parent::__construct();
        self::$_main_title = _lg('Widget');
    }

    public function Template() {

        $this->view->PageRender('Widget/Template', self::$_main_title, FALSE);
    }

    public function Prepared() {
        $this->view->prepared = $this->model->Read('*');
        $this->view->PageRender('Widget/Prepared', self::$_main_title, FALSE);
    }

    public function Insert() {
        $cls = $_POST['class'];
        require './../upload/widget/' . $cls . '.php';
        $class = new $cls(WIDGET_TEMPLATE_MODE);
        $data['type'] = 'sis';
        $data['widget_class'] = $cls;
        $data['widget_type'] = $_POST['type'];
        $data['widget_setting'] = serialize($class->GetSetting());
        $result['success'] = FALSE;
        $result['value'] = _lg('can\'t insert widget');
        $id = $this->model->Create($data);

        if ((int) $id > 0) {
            $this->view->class = $cls;
            $this->view->PageRender('Widget/NewWidget', self::$_main_title, FALSE);
            $result['success'] = TRUE;
            $result['value'] = str_replace('%id%', $id,$this->view->new_widget);
        }
        echo json_encode($result);
        //
    }


    public function Update($id) {

        if (isset($_POST['ajax'])){
            unset($_POST['ajax']);
            $result['success'] = $this->model->Edit($id, array('widget_setting'=>  serialize($_POST)));
            $result['value'] = null;
            echo json_encode($result);

        }else{
            $this->model->Edit($id, array('widget_setting'=>  serialize($_POST))); 
            GoBack();
        }
    }

    public function Delete($id) {
        $result['success'] = $this->model->Delete(intval($id));
        $result['value'] = 'can not remove prepared widget';
        echo json_encode($result);
        //GoBack();
    }
    
    public function GetWidgetTitle($id){
        return $this->model->GetWidgetTitle($id);
    }

}
