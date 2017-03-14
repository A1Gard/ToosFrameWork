<?php

/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   calss-model.php
 * @todo : calssUR_MP_ASSETS page page
 */

/**
 * class for user accessUR_MP_ASSETS
 */

class IndexModel extends TModel {

    function __construct() {
        parent::__construct('regitery');
    }    
    
    public function Sentence() {
        $reg = TRegistry::GetInstance();
        return unserialize($reg->GetValue(ROOT_SYSTEM, 'sentence'));
    }

    public function SaveSentence() {
        $reg = TRegistry::GetInstance();
        $_POST['sen'] = array_filter($_POST['sen']);
        return $reg->SetValue(ROOT_SYSTEM, 'sentence', serialize($_POST['sen']));
    }
    
    public function Time() {
        return $this->db->Select("SELECT * FROM %table% ORDER BY s_id DESC", array("time"));
    }

    public function Sentence1() {
        $reg = TRegistry::GetInstance();
        return unserialize($reg->GetValue(ROOT_SYSTEM, 'sentence1'));
    }

    public function SaveSentence1() {
        $reg = TRegistry::GetInstance();
        $_POST['sen'] = array_filter($_POST['sen']);
        $_POST['sen']['txt'] = array_filter($_POST['senx']);
        return $reg->SetValue(ROOT_SYSTEM, 'sentence1', serialize($_POST['sen']));
    }

    public function SaveSetting() {
        $reg = TRegistry::GetInstance();

        $res = $reg->SetValue(ROOT_SYSTEM, 'title', ($_POST['title']));
        $res = $reg->SetValue(ROOT_SYSTEM, 'login_max_try', ($_POST['login_max_try']));
        $res = $reg->SetValue(ROOT_SYSTEM, 'login_ignore_time', ($_POST['login_ignore_time']));
        $res = $reg->SetValue(ROOT_SYSTEM, 'footer', ($_POST['footer']));
        $res = $reg->SetValue(ROOT_SYSTEM, 'links', ($_POST['links']));
        $res = $reg->SetValue(ROOT_SYSTEM, 'error', ($_POST['error']));
        $res = $reg->SetValue(ROOT_SYSTEM, 's', serialize($_POST['s']));
        return true;
    }

    public function Setting() {
        $reg = TRegistry::GetInstance();
        $result['title'] = ($reg->GetValue(ROOT_SYSTEM, 'title'));
        $result['login_max_try'] = ($reg->GetValue(ROOT_SYSTEM, 'login_max_try'));
        $result['login_ignore_time'] = ($reg->GetValue(ROOT_SYSTEM, 'login_ignore_time'));
        $result['footer'] = ($reg->GetValue(ROOT_SYSTEM, 'footer'));
        $result['links'] = ($reg->GetValue(ROOT_SYSTEM, 'links'));
        $result['error'] = ($reg->GetValue(ROOT_SYSTEM, 'error'));
        $result['s'] = unserialize($reg->GetValue(ROOT_SYSTEM, 's'));

        return $result;
    }

    public function All($setting) {
        try {
            $reg = TRegistry::GetInstance();
//            var_dump($reg->GetValue(ROOT_SYSTEM, $setting));
            return unserialize($reg->GetValue(ROOT_SYSTEM, $setting));
        } catch (Exception $exc) {
            return null;
        }
    }

    public function Save($setting) {
//        error_reporting(0);
        $reg = TRegistry::GetInstance();
        if (($reg->GetValue(ROOT_SYSTEM, $setting)) === FALSE) {
            $reg->AddValue(ROOT_SYSTEM, $setting, serialize($_POST[$setting]));
        } else {
            $reg->SetValue(ROOT_SYSTEM, $setting, serialize($_POST[$setting]));
        }
        //echo serialize($_POST[$setting]);




        if (is_array($_FILES)) {

            foreach ($_FILES as $key => $value) {

                $fname = str_replace('__', '.', $key);
                move_uploaded_file($_FILES[$key]['tmp_name'], '../assets/images/' . $fname);
            }
        }
        GoBack();
    }

}

