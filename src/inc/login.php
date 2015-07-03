<?php

if(isset($_POST['email']) && isset($_POST['password']) ){
    $m = new Model('member');
    $result = $m->db->Select('SELECT * FROM %table% WHERE member_email = :email AND member_password = :password AND member_type  > 0',
            array('member'),array(':email'=>$_POST['email'],':password' =>  Password($_POST['password'])));
    if($result != array()){
        //login
        setcookie('mid', $result[0]['member_id'], time()+(60*60*12*15));
        setcookie('mtype', $result[0]['member_type'], time()+(60*60*12*15));
        setcookie('mname', $result[0]['member_name'], time()+(60*60*12*15));
        setcookie('mchat', $result[0]['member_chat'], time()+(60*60*12*15));
        setcookie('mact', $result[0]['member_active_time'], time()+(60*60*12*15));
        Redirect('/msg/شما با موفقیت وارد شدید.');
    }else{
        // failed
        $_GET['msg'] = 'ایمیل یا گذرواژه اشتباه است و یا عضویت شما تایید نشده است.';
        setcookie('mid',  null, time()-300);
        setcookie('mtype', null, time()-300);
        setcookie('mname', null, time()-300);
        setcookie('mchat', null, time()-300);
        setcookie('mact', null, time()-300);
    
    }
}