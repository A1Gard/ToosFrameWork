<?php
$frm = new TForm(UR_CM . 'Comment/Insert', 'post', array('class' => 'form rtl'));

$frm->AddField('textarea', 'متن پاسخ', null, array('name' => 'comment_text','class'=>'ckeditor'));

$frm->AddField('hidden', '', ($_SESSION['MN_ID'] * -1), array('name' => 'comment_member_id'));
$frm->AddField('hidden', '', $this->prn, array('name' => 'comment_parent'));
$frm->AddField('hidden', '', $this->tid, array('name' => 'comment_topic_id'));
$frm->AddField('submit', '', 'ارسال');
?>
<br />
<h2 class="rtl">
    <?= $this->title ?>
</h2>
<br />
<br />
<?php $frm->Render(); ?>
        
