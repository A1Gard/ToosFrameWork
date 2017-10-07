<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 13-Juan-2014
 * @time : 17:31 
 * @subpackage   Topic-controller.php | topics controller
 * @todo :   
 */
class Plugin extends TController {

    function __construct() {

        parent::__construct('Topic');
        self::$_main_title = _lg('Plugin');
    }

    /**
     * @todo Show index without any thing
     */
    public function Index() {
        $this->view->plugins = $this->model->PluginFinder();

        $this->view->PageRender('Plugin/Index'. __CLASS__, self::$_main_title);
    }

    public function Status($id, $new_staus) {
        $p_name = $this->model->GetPlugInName($id, true);
        if ($new_staus == 1) {
            $p_name::Active();
        } else {
            $p_name::Deactive();
        }
        $this->model->Edit($id, array('plugin_status' => $new_staus));
        GoBack();
    }

    public static function Loader() {
        global $side_menu;

        $index = $side_menu->AddItem(_lg('Plugin'), UR_MP . 'Plugin', 0, 'fa-plug');
    }

    public function BulkAction() {
        $arr = explode(',', $_POST['action']);
        switch ($arr[0]) {
            case 'Delete':
                foreach ($_POST['id'] as $id) {
                    $p_name = $this->model->GetPlugInName($id, true);
                    $p_name::Remove();
                    TPath::DeleteDirectory(PLUGIN_DIR . $p_name);
                    $this->model->Delete($id);
                }

                break;
            case 'Edit':


                $data = array($arr[1] => $arr[2]);

                foreach ($_POST['id'] as $id) {
                    if ($arr[1] == 'plugin_status') {
                        $p_name = $this->model->GetPlugInName($id, true);
                        if ($arr[2] == 1) {
                            $p_name::Active();
                        } else {
                            $p_name::Deactive();
                        }
                    }
                    $this->model->Edit($id, $data);
                }
                break;

            default:
                return 'error';
                break;
        }
        GoBack('/do');
    }

    public function Delete($id) {
        $p_name = $this->model->GetPlugInName($id, true);
        $p_name::Remove();
        TPath::DeleteDirectory(PLUGIN_DIR . $p_name);
        $this->model->Delete(intval($id));
        GoBack('/delete');
    }

    public function Upload() {
        if (file_exists($_FILES['file']['tmp_name'])) {

            $zip = new TCompress();
//        print_r();
            $zip->ZipExtract(PLUGIN_DIR, $_FILES['file']['tmp_name']);
            unlink($_FILES['file']['tmp_name']);
        }
        GoBack();
    }

}
