<?php

    

$frm = new TForm('', 'post', array('class' => 'form ajax'));

$frm->AddField('text', 'نام کامل', null, array('name' => 'member_name'));
$frm->AddField('email', 'ایمیل', null, array('name' => 'member_email'));
$frm->AddField('password', 'گذرواژه', null, array('name' => 'member_password'));
$frm->AddField('password', 'تکرار گذرواژه', null, array('name' => 'member_password2'));
$frm->AddField('text', 'مقطع', null, array('name' => 'member_degree'));
$frm->AddField('text', 'رشته تحصیلی', null, array('name' => 'member_field'));
$frm->AddField('text', 'شماره تماس', null, array('name' => 'member_number'));
$frm->AddField('text', 'شهر', null, array('name' => 'member_city'));
$frm->AddField('hidden', '', '/form/regiter', array('class'=>'action'));

$frm->AddField('submit', '', 'ارسال');

$reg_frm = $frm->FormHeader();
$reg_frm .= $frm->FormBody();
$reg_frm .= $frm->FormFooter();

$smarty->assign('reg_frm', $reg_frm);