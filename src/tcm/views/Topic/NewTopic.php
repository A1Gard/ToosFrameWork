<?php
$topic_status = array(
    0 => ( 'Drafts'),
    1 => ( 'Publics'),
    2 => ( 'Only member'),
);


$frm = new TForm(UR_MP . 'Topic/Insert', 'post', array('class' => 'form rtl'));

$frm->AddField('text', ('Title'), null, array('name' => 'topic_title'));
$frm->AddField('text', ('Keywords'), null, array('name' => 'topic_keyword'));

$frm->AddField('textarea', ('Abstract'), null, array('name' => 'topic_abstract'));
$frm->AddField('textarea', ('Text'), null, array('name' => 'topic_text', 'class' => 'ckeditor'));
//$frm->AddField('spliter', 'تست اسپیلتر');

$frm->AddField('select', ('Status'), null, array('name' => 'topic_status'), $topic_status);
$frm->AddField('submit', '', ('Submit'));
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
        <div class="ui inverted segment">
            <div class="ui inverted accordion">
                <div class="active title">
                    <i class="dropdown icon"></i>
                    <?php _lp('Guide') ?>
                </div>
                <div class="active content" style="min-height:150px">
                    <p>
                        <?php _lp('Lorem ipsum dolor sit amet short') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
