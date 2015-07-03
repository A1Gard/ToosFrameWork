<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   calss-model.php
 * @todo : calss model page page
 */

/**
 * class for user access model
 */

class IndexModel extends Model {

    function __construct() {
        parent::__construct('regitery');
    }    
    
    public function Sentence() {
        $reg = TRegistry::GetInstance();
        return unserialize($reg->GetValue(ROOT_SYSTEM,'sentence'));
    }
    
    public function SaveSentence() {
        $reg = TRegistry::GetInstance();
        $_POST['sen'] = array_filter($_POST['sen']);
        return $reg->SetValue(ROOT_SYSTEM,'sentence',  serialize($_POST['sen']));
    }
    public function SaveSetting() {
        $reg = TRegistry::GetInstance();

        $res = $reg->SetValue(ROOT_SYSTEM,'title',($_POST['title']));
        $res = $reg->SetValue(ROOT_SYSTEM,'login_max_try',($_POST['login_max_try']));
        $res = $reg->SetValue(ROOT_SYSTEM,'login_ignore_time',($_POST['login_ignore_time']));
        $res = $reg->SetValue(ROOT_SYSTEM,'footer',($_POST['footer']));
        $res = $reg->SetValue(ROOT_SYSTEM,'links',($_POST['links']));
        $res = $reg->SetValue(ROOT_SYSTEM,'error',($_POST['error']));
        $res = $reg->SetValue(ROOT_SYSTEM,'s',  serialize($_POST['s']));
        return true;
    }
    public function Setting() {
        $reg = TRegistry::GetInstance();
        $result['title'] = ($reg->GetValue(ROOT_SYSTEM,'title'));
        $result['login_max_try'] = ($reg->GetValue(ROOT_SYSTEM,'login_max_try'));
        $result['login_ignore_time'] = ($reg->GetValue(ROOT_SYSTEM,'login_ignore_time'));
        $result['footer'] = ($reg->GetValue(ROOT_SYSTEM,'footer'));
        $result['links'] = ($reg->GetValue(ROOT_SYSTEM,'links'));
        $result['error'] = ($reg->GetValue(ROOT_SYSTEM,'error'));
        $result['s'] = unserialize($reg->GetValue(ROOT_SYSTEM,'s'));
        
        return $result;
    }
    
} 

?>