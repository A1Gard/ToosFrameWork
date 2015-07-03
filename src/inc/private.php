<?php

if (!isset($_COOKIE['mid'])) {
    Redirect('/msg/شما وارد نشده اید');
}

$m = new Model('member', 'member_');
$record = $m->GetRecord($_COOKIE['mid']);


if (isset($_POST['member_email'])) {
    $clean = array_map('strip_tags', $_POST);
    if (Password($clean['password']) != $record['member_password']) {
        Redirect('/msg/گذرواژه ای که وارد کرده اید اشتباه می باشد.');
    } else {
        
        if (!filter_var($clean['member_email'], FILTER_VALIDATE_EMAIL)) {
            Redirect('/msg/ایمیل معتبر نمی باشد.');
        }
        $data = array('member_email'=>$clean['member_email']);
        if ($clean['pass1'] != ''){
            if ($clean['pass1'] != $clean['pass2']){
                Redirect('/msg/گذرواژه ها مطابقت ندارند.');
            }
            else{
                $data['member_password'] = Password($clean['pass1']);
            }
        }
        $m->Edit($_COOKIE['mid'], $data);
    }
    
}

$form = new TForm('', 'post', array('class' => 'form'));


$form->AddField('password', 'گذرواژه فعلی*', null, array('name' => 'password' ));
$form->AddField('email', 'ایمیل', $record['member_email'], array('name' => 'member_email' ));
$form->AddField('password', 'گذرواژه جدید', null, array('name' => 'pass1'));
$form->AddField('password', 'تکرار گذرواژه', null, array('name' => 'pass2'));

$form->AddField('submit', '', 'ویرایش');

$smarty->assign('form',$form->FormHeader().$form->FormBody().'</form>');