<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   Member-controller.php | topics controller
 * @todo :   
 */
class Member extends TController {

    function __construct() {

        parent::__construct();
        self::$_main_title = _lg('Members');
        $this->report = new TModel('report', 'report_');
    }

    /**
     * @todo Show index without any thing
     */
    public function Index() {


        $this->view->cls_list = $this->model->Read('member_id, member_name, member_email, member_type, member_register_time');
        $this->view->pagination = new TPagination($this->model->GetPageCount());
        $this->view->PageRender('Member/Index', self::$_main_title);
    }

    public function NewMember() {
        $this->view->navigator->AddItem(_lg('Members'), UR_MP . 'Member/Index');
        $this->view->PageRender('Member/NewMember', self::$_main_title . ' جدید ');
    }

    public function RIns() {
        $this->report->Create($_POST);
        Redirect(UR_MP . 'Member/Edit/' . $_POST['report_member_id']);
    }

    public function Report($id) {
        $this->view->navigator->AddItem(_lg('Members'), UR_MP . 'Member/Index');
        $this->view->navigator->AddItem('  بازگشت به صفحه عضو', UR_MP . 'Member/Edit/' . $id);
        $this->view->id = $id;
        $this->view->PageRender('Member/Report', '  کارنامه جدید');
    }

    public function Insert() {
        $_POST['member_password'] = Password($_POST['member_password']);
        $date = TDate::GetInstance();
        $_POST['member_register_time'] = time();
        $_POST['member_active_time'] = $date->Parsi2Timestamp($_POST['member_active_time']);
        $id = $this->model->Create($_POST);
        Redirect(UR_MP . 'Member/Edit/' . $id);
    }

    public function Edit($id) {
        $this->view->navigator->AddItem(_lg('Members'), UR_MP . 'Member/Index');
        $this->view->record = $this->model->GetRecord($id);
        $_GET['filter'] = 'report_member_id,' . $id;
//        $this->view->reports = $this->report->Read('report_id,report_title', 99);
        $this->view->PageRender('Member/Edit', self::$_main_title . ' ویرایش  - ' . $this->view->record['member_name']);
    }

    public function Update($id) {
        if ($_POST['member_password'] == '') {
            unset($_POST['member_password']);
        } else {
            $_POST['member_password'] = Password($_POST['member_password']);
        }
        $date = TDate::GetInstance();
        $_POST['member_active_time'] = $date->Parsi2Timestamp($_POST['member_active_time']);
        $this->model->Edit($id, $_POST);
        Redirect(UR_MP . 'Member/Edit/' . $id);
    }

    public function Search() {
        $this->view->PageRender('Member/Search', self::$_main_title . ' جستجو   ');
    }

    /**
     * approver or unapprove user change tyoe directly
     * @param int $id
     * @param int $new_type
     */
    public function Type($id, $new_type) {
        //die($new_type);
        $this->model->Edit($id, array('member_type' => $new_type));
        GoBack();
    }

    public function Delete($id) {
        $this->model->Delete(intval($id));
        GoBack();
    }

    public function RemoveReport($id) {
        $this->report->Delete($id);
        GoBack();
    }

    public static function Loader() {
        global $side_menu;

        $index = $side_menu->AddItem(_lg('Members'), '#', 0, 'fa-group');

        $side_menu->AddItem(_lg('Members list'), UR_MP .
                'Member', $index);
        $side_menu->AddItem(_lg("New member"), UR_MP .
                'Member/NewMember', $index);
    }

}
