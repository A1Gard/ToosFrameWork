<?php
    
$frm = new TForm(UR_MP . 'Member/RIns', 'post', array('class' => 'form rtl'));

$frm->AddField('text', 'عنوان ', null, array('name' => 'report_title'));
$frm->AddField('hidden', '', $this->id , array('name' => 'report_member_id'));
$frm->AddField('textarea', 'کارنامه', null, array('name' => 'report_text', 'class' => 'ckeditor'));
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

