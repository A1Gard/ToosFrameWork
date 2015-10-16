<?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   access-controller.php | access controller
 * @todo : login | logout  
 */

class Access extends TController {
    
    
    function __construct() {
        
        parent::__construct() ;
        self::$_main_title = _lg('Access') ;
    }
    
    /**
     * @todo Show index without any thing
     */
    public function Index() {
        
        $this->view->msg = "We are in index......";
        $this->view->PageRender('Index/Index',self::$_main_title);
    }
    
    /**
     * @todo Show index without any thing
     */
    public function Login() {
        $this->view->navigator->AddItem(self::$_main_title ,UR_MP . 'Access');
        $this->view->PageRender('Access/Login',_lg('Login'),FALSE);
    }
    
    public function Check() {
        $login_result = $this->model->Check();
        
        $loaction =  UR_MP; 
        
        // check if logined go dashoard or not go back or default login page and show message
        switch ($login_result[0]) {
            // login ssuccess
            case 1:
                // get last page try to do
                $loaction = (TMAC::GetSession('request') === true)? TMAC::GetSession('redirect'): UR_MP; 
                Redirect($loaction);
                break;
            // login failed
            case 2:
                RedirectNotification($loaction . 'Access/Login',
                        'Login failed : Username or password incorrect.', NI_ERROR);
                break;
            // try failed tried more than max
            case 3:
                $args = array($login_result['max'], $login_result['time']);
                RedirectNotification($loaction . 'Access/Login',
                        'You have used up your failed login quota (%d)! Please wait %d minutes before trying again.', NI_ERROR, $args);
                break;

            default:
                if (_DBG_) {
                    echo 'unknow request';
                }
                break;
                return false;
        }
    }
    
    public function Logout() {
        TMAC::TakeAccess();
        Redirect(UR_MP.'Access/Login');
    }

}

