<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
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

        $not_login_need = array(
            'Access,Login',
            'Access,Check',
            'Access,Forget',
            'Access,ChangePasswd'
        );
        // check if not in login page 
        if (!in_array(parent::$request, $not_login_need)) {
            // manger access controller
            TMAC::Init();
            TMAC::CheckLogin();
            if (TMAC::GetSession('post') !== null) {
                TMAC::RestoreRequest();
            }
        }
    }

    /**
     * @todo load controllerUR_MP_ASSETS if exsits
     * @param string $name
     */
    public function LoadModel($name) {

        $filename =  PA_MP_REAL . '/models/' . $name . '-Model.php';
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
     * extension loader | load in every page for
     *      maker menu and or etc.
     * @return boolean
     */
    public static function Loader() {

        return true;
    }

    /**
     * extension initializer | run once on extension installing
     * @return boolean
     */
    public static function Initializer() {

        $registry = TRegistry::GetInstance();
        if ($registry->Exists(ROOT_EXTENSION, __CLASS__)) {
            return FALSE;
        }
        $registry->SetValue(ROOT_EXTENSION, __CLASS__, 1);
        return true;
    }

    /**
     * add realtion 
     * @param string $src
     * @param int $dst
     * @param int $type
     */
    public function AddRelation($src, $dst, $type) {
        $lst = explode(',', $src);
        foreach ($lst as $curr_src) {
            $this->model->AddRelation($curr_src, $dst, $type);
        }
    }
    /**
     * remove realtion 
     * @param string $src
     * @param int $dst
     * @param int $type
     */
    public function RemoveRelation($src, $dst, $type) {
        $lst = explode(',', $src);
        foreach ($lst as $curr_src) {
            $this->model->RemoveRelation($curr_src, $dst, $type);
        }
    }

    /**
     * extension finalizer | run once on extension unstialling 
     * @return boolean
     */
    public static function Finalizer() {

        $registry = TRegistry::GetInstance();
        $registry->RemoveValue(ROOT_EXTENSION, __CLASS__);
        return true;
    }

}
