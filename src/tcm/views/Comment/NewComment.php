<?php
$frm = new TForm(UR_MP . 'Comment/Insert', 'post', array('class' => 'form rtl'));

        $frm->AddField('textarea', _lg("Replay Text"), null, array('name' => 'comment_text','class'=>'ckeditor'));

$frm->AddField('hidden', '', ($_SESSION['MN_ID'] * -1), array('name' => 'comment_member_id'));
$frm->AddField('hidden', '', $this->prn, array('name' => 'comment_parent'));
$frm->AddField('hidden', '', $this->tid, array('name' => 'comment_topic_id'));
$frm->AddField('submit', '', 'ارسال');
?>
<br />
<h2 class="rtl">
    <?php echo  $this->title ?>
</h2>
<br />
<br />
<?php $frm->Render(); ?>
        
