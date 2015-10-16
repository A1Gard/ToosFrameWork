<?php
$frm = new TForm(UR_MP . 'Req/Insert', 'post', array('class' => 'form rtl'));

$frm->AddField('text', 'نام', null, array('name' => 'member_name'));
$frm->AddField('email', 'ایمیل', null, array('name' => 'member_email'));
$frm->AddField('password', 'گذرواژه', null, array('name' => 'member_password'));
$frm->AddField('text', 'استاتوس', null, array('name' => 'member_status'));
$frm->AddField('text', 'زمان تمدید', null, array('name' => 'member_active_time'));
$frm->AddField('file', 'آواتار', null, array('name' => 'member_avatar'));
$frm->AddField('text', 'مقطع', null, array('name' => 'member_degree'));
$frm->AddField('text', 'رشته تحصیلی', null, array('name' => 'member_field'));
$frm->AddField('text', 'شماره تماس', null, array('name' => 'member_number'));
$frm->AddField('text', 'شهر', null, array('name' => 'member_city'));
$frm->AddField('select', 'نوع', null, array('name' => 'member_type'), 
        array(0 => array('0', 'تایید نشده'), 
              1 => array('1', 'تایید شده'),
              2 => array('2','اخراجی')));

$frm->AddField('submit', '', 'ارسال');
?>
<br />
<h2 class="rtl">
    <?php echo  $this->title ?>
</h2>
<br />
<br />
<?php 
    $frm->Render(); 
?>
        
