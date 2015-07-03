<?php

if(!isset($_COOKIE['mid'])){
    Redirect('/ورود');
}

$m = new model("member",'member_');
$record = $m->GetRecord($_COOKIE['mid']);

$frm = new TForm('', 'post', array('class' => 'form'));
$frm->AddField('text', 'نام', $record['member_name'], array('name' => 'member_name'));

$frm->AddField('text', 'استاتوس', $record['member_status'], array('name' => 'member_status'));
$frm->AddField('file', 'آواتار', $record['member_id'], array('name' => 'member_avatar'));

$frm->AddField('text', 'مقطع', $record['member_degree'], array('name' => 'member_degree'));
$frm->AddField('text', 'رشته تحصیلی', $record['member_field'], array('name' => 'member_field'));
$frm->AddField('text', 'شماره تماس', $record['member_number'], array('name' => 'member_number'));
$frm->AddField('text', 'شهر', $record['member_city'], array('name' => 'member_city'));
$frm->AddField('hidden', '', '/form/profile', array('class'=>'action'));


$frm->AddField('submit', '', 'ویرایش');

$reg_frm = $frm->FormHeader();
$reg_frm .= $frm->FormBody();
$reg_frm .= $frm->FormFooter();

$smarty->assign('reg_frm', $reg_frm);