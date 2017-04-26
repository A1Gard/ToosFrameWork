<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   manager-controller.php | topics controller
 * @todo :   
 */
class Manager extends TController {

    function __construct() {

        parent::__construct();
        self::$_main_title = _lg('Managers');
    }

    /**
     * @todo Show index without any thing
     */
    public function Index() {


        $this->view->cls_list = $this->model->Read('manager_id, manager_username,'
                . ' manager_displayname, manager_email');
        $this->view->pagination = new TPagination($this->model->GetPageCount());
        $this->view->PageRender('Manager/Index', self::$_main_title);
    }

    public function NewManager() {
        $this->view->navigator->AddItem(_lg('Managers'), UR_MP . 'Manager/Index');
        $this->view->PageRender('Manager/NewManager', self::$_main_title . ' جدید ');
    }

    public function Insert() {
        $_POST['manager_password'] = Password($_POST['manager_password']);
        $date = TDate::GetInstance();
//        $_POST['manager_register_time'] = time();
//        $_POST['manager_active_time'] = $date->Parsi2Timestamp($_POST['manager_active_time']);
        $id = $this->model->Create($_POST);
        Redirect(UR_MP . 'Manager/Edit/' . $id);
    }

    public function Edit($id) {
        $this->view->navigator->AddItem(_lg('Managers'), UR_MP . 'Manager/Index');
        $this->view->record = $this->model->GetRecord($id);
        $this->view->PageRender('Manager/Edit', self::$_main_title . ' ویرایش  - ' . $this->view->record['manager_username']);
    }

    public function Profile() {
        $this->view->navigator->AddItem(_lg('Managers'), UR_MP . 'Manager/Index');
        $this->view->record = $this->model->GetRecord(TMAC::GetSession('MN_ID'));
        $this->view->PageRender('Manager/Profile', self::$_main_title . ' - ' . _lg('Edit Profile'));
    }

    public function Update($id) {
        if ($_POST['manager_password'] == '') {
            unset($_POST['manager_password']);
        } else {
            $_POST['manager_password'] = Password($_POST['manager_password']);
        }
        if (isset($_POST['allow'])) {
            $_POST['manager_permission'] = implode(',', $_POST['allow']);
            unset($_POST['allow']);
        }
        if ($this->model->Edit($id, $_POST)) {
            Redirect(UR_MP . 'Manager/Edit/' . $id);
        } else {
            TNotification::Add(_lg("You can't edit this manager this protected"), NF_WARNING);
            Redirect(UR_MP . 'Manager/Edit/' . $id);
        }
    }

    public function UpdateProfile() {
        $id = TMAC::GetSession('MN_ID');
        $sys = TSystem::GetInstance();


        $real_password = $sys->GetProfileField('manager_password');

        if (Password($_POST['passwd']) !== $real_password) {
            TNotification::Add(_lg('Please insert your password correct for change profile', NF_ERROR));
            GoBack();
            die;
        }
        unset($_POST['passwd']);
        if ($_POST['manager_password'] == '') {
            unset($_POST['manager_password']);
        } else {
            if ($_POST['manager_password'] != $_POST['manager_password2']) {
                TNotification::Add(_lg('Two password not equal', NF_ERROR));
                GoBack();
                die;
                $_POST['manager_password'] = Password($_POST['manager_password']);
            }
        }
        unset($_POST['manager_password2']);
        if (isset($_POST['allow'])) {
            $_POST['manager_permission'] = implode(',', $_POST['allow']);
            unset($_POST['allow']);
        }
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $upload = new TUpload();
            $result = $upload->Save('avatar');
            $_POST['manager_avatar'] = str_replace('../upload/', UR_UPLOAD, $result['value']['path']);
        }

        if ($this->model->Edit($id, $_POST)) {
            GoBack();
        } else {
            TNotification::Add(_lg("You can't edit this manager this protected"), NF_WARNING);
            Redirect(UR_MP . 'Manager/Edit/' . $id);
        }
    }

    public static function Loader() {
        global $side_menu;


        $index = $side_menu->AddItem(_lg('Managers'), '#', 0, 'fa-user');
        $side_menu->AddItem(_lg('Managers list'), UR_MP .
                'Manager', $index);
        $side_menu->AddItem(_lg('New Manager'), UR_MP .
                'Manager/NewManager', $index);
        $side_menu->AddItem(_lg('Edit Profile'), UR_MP .
                'Manager/Profile', $index);
    }

}
