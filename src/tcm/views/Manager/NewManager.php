<?php

global  $MANAGER_TYPE;
$frm = new TForm(UR_MP . 'Manager/Insert', 'post', array('class' => 'form'));

$frm->AddField('text', 'نام کاربری', null, array('name' => 'manager_username'));
$frm->AddField('email', 'ایمیل', null, array('name' => 'manager_email'));
$frm->AddField('password', 'گذرواژه', null, array('name' => 'manager_password'));
$frm->AddField('text', 'نام نمایشی', null, array('name' => 'manager_displayname'));

$frm->AddField('select', 'نوع', null, array('name' => 'manager_type'),$MANAGER_TYPE);
$frm->AddField('checkbox', 'محاظت شده', 1, array('name' => 'manager_protected'));

$frm->AddField('submit', '', 'ارسال');
?>

        
<br />
<h2 class="rtl">
    <?php echo  $this->title ?>
</h2>
<br />
<br />
<div class="row">
    <div class="grd-primary">
        <?php  $frm->Render();  ?>
    </div>
    <div class="grd-secondary">
        
    </div>
</div>