<?php
//var_dump($this->record);
$date = TDate::GetInstance();
$frm = new TForm(UR_CM . 'Member/Update/' . $this->record['member_id'], 'post', array('class' => 'form rtl'));
$frm->AddField('text', 'نام', $this->record['member_name'], array('name' => 'member_name'));
$frm->AddField('email', 'ایمیل', $this->record['member_email'], array('name' => 'member_email'));
$frm->AddField('password', 'گذرواژه', null, array('name' => 'member_password'));
$frm->AddField('text', 'استاتوس', $this->record['member_status'], array('name' => 'member_status'));
$frm->AddField('text', 'زمان تمدید',$date->PDate('Y/m/d',$this->record['member_active_time']) , array('name' => 'member_active_time'));
$frm->AddField('file', 'آواتار', $this->record['member_id'], array('name' => 'member_avatar'));
$frm->AddField('select', 'نوع', $this->record['member_type'], array('name' => 'member_type'), 
        array(0 => array('0', 'تایید نشده'), 
              1 => array('1', 'تایید شده'),
              2 => array('2','اخراجی')));

$frm->AddField('submit', '', 'ویرایش');
?>

<br />
<h2 class="rtl">
<?= $this->title ?>
</h2>
<br />
<br />
<?php $frm->Render(); ?>
        


