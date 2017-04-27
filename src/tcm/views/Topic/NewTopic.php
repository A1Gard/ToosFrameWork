<?php
$topic_status = array(
    0 => array('0', 'پیش نویس'),
    1 => array('1', ' انتشار عمومی'),
    2 => array('2', 'ویژه اعضا'),
);

$frm = new TForm(UR_MP . 'Topic/Insert', 'post', array('class' => 'form rtl'));

$frm->AddField('text', _lg('Title'), null, array('name' => 'topic_title'));
$frm->AddField('text', _lg('Keywords'), null, array('name' => 'topic_keyword'));

$frm->AddField('textarea', _lg('Abstract'), null, array('name' => 'topic_abstract'));
$frm->AddField('textarea', _lg('Text'), null, array('name' => 'topic_text', 'class' => 'ckeditor'));
//$frm->AddField('spliter', 'تست اسپیلتر');

$frm->AddField('select', _lg('Status'), null, array('name' => 'topic_status'), $topic_status);
$frm->AddField('submit', '', _lg('Submit'));
//    $frm->AddField('text', 'label', null, array('name' => ''));
?>

<br />
<h2 class="rtl">
    <?php echo $this->title ?>
</h2>
<br />
<br />
<div class="row">
    <div class="grd-primary">
        <?php $frm->Render(); ?>
    </div>
    <div class="grd-secondary">

    </div>
</div>
