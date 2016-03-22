<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   access_model.php
 * @todo : accessUR_MP_ASSETS page page
 */

/**
 * class for user accessUR_MP_ASSETS
 */
class AccessModel extends TModel {


    function __construct() {
        parent::__construct();
    }

    /**
     * check user login
     * @input post data
     * @return mixed  [0] 1:success | 2:login failed | 3:spamer [max|try|time] 
     */
    public function Check() {
        
        $registry = TRegistry::GetInstance();
        $trylog = new TTryLog();
        
        $time =  $registry->GetValue(ROOT_SYSTEM, 'login_ignore_time') ;
        // check login try
        $try = $trylog->Check(TRY_LOGIN, $time);
        
        // get max try ;
        
        $max_try = $registry->GetValue(ROOT_SYSTEM, 'login_max_try') ;
        
        // check is try more than max try
        if ($try <= $max_try) {
            // can login

            
            // log try
            $trylog->Log(TRY_LOGIN);
            
            // check input length
            if ( (strlen($_POST['manager_username']) < 3) || (empty($_POST['manager_password'])) )  {
                // take access
                TMAC::TakeAccess();
                $ret[0] = 2;
                return $ret;
            }
        
            $sql = "SELECT * FROM %table% WHERE 
                manager_username = :username AND manager_password = :password ;" ;

            $result = $this->db->Select($sql, array('manager'), 
                    array('type' => 'ss',":username" => $_POST['manager_username'],
                          ":password" => Password($_POST['manager_password'])));

            //manager access control init
            TMAC::Init();

            if (count($result) == 1) {
                //login

                // update last login
                $this->db->Update('manager',array('type' => 'i',"manager_lastlogin" => time()) ,
                        "manager_id = '{$result[0]['manager_id']}'");

                // make remenber
                isset($_POST['remenber'])? $remenber = TRUE : $remenber = FALSE;

                // give access
                TMAC::GiveAccess($result[0], $remenber);
                
                
                $ret[0] = 1;
                return $ret;

            }  else {
                //not login

                // take access
                TMAC::TakeAccess();
                $ret[0] = 2;
                return $ret;

            } 
            
       }  else {
           
           // can't login
           $ret[0] = 3 ;
           $ret['max']  = $max_try ;
           $ret['time'] = $time ;
           
           // and show error
           return $ret;
       }
        
    }
    /**
     * send new password 
     * @input post data
     * @return mixed  [0] 1:success | 2:login failed | 3:spamer [max|try|time] 
     */
    public function CheckEmail() {
        
        $registry = TRegistry::GetInstance();
        $trylog = new TTryLog();
        
        $time =  $registry->GetValue(ROOT_SYSTEM, 'login_ignore_time') ;
        // check login try
        $try = $trylog->Check(TRY_PASSWORD, $time);
        
        // get max try ;
        
        $max_try = $registry->GetValue(ROOT_SYSTEM, 'login_max_try') ;
        
        // check is try more than max try
        if ($try <= $max_try) {
            // can login

            
            // log try
            $trylog->Log(TRY_PASSWORD);
            
            // check input length
            if ( (strlen($_POST['manager_username']) < 3) || (empty($_POST['manager_email'])) )  {
                // take access
                $ret[0] = 2;
                return $ret;
            }
        
            $sql = "SELECT * FROM %table% WHERE 
                manager_username = :username AND manager_email = :email ;" ;

            $result = $this->db->Select($sql, array('manager'), 
                    array('type' => 'ss',":username" => $_POST['manager_username'],
                          ":email" => ($_POST['manager_email'])));

            //manager access control init

            if (count($result) == 1) {
                //sending
                $ret['passwd'] = (THash::SaltGenerator(8));
                // update last login
                $this->db->Update('manager',array('type' => 'i',"manager_password" => Password($ret['passwd'])) ,
                        "manager_id = '{$result[0]['manager_id']}'");
                $ret[0] = 1;
                return $ret;

            }  else {
                //not send
                $ret[0] = 2;
                return $ret;

            } 
            
       }  else {
           
           // can't login
           $ret[0] = 3 ;
           $ret['max']  = $max_try ;
           $ret['time'] = $time ;
           
           // and show error
           return $ret;
       }
        
    }

} 

?>