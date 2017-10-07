<?php
$frm = new TForm(UR_MP . 'Member/Insert', 'post', array('class' => 'form rtl'));

$frm->AddField('spliter','person detail');
$frm->AddField('startgroup');
$frm->AddField('email', 'Email', null, array('name' => 'member_email'));
$frm->AddField('password', 'Password', null, array('name' => 'member_password'));
$frm->AddField('endgroup');
$frm->AddField('startgroup');
$frm->AddField('text', 'Status', null, array('name' => 'member_status'));
$frm->AddField('text', 'Active Time', null, array('name' => 'member_active_time', 'class' => _lg('datepicker')));
$frm->AddField('endgroup');
$frm->AddField('startgroup');
$frm->AddField('text', 'Degree', null, array('name' => 'member_degree'));
$frm->AddField('text', 'Field', null, array('name' => 'member_field'));
$frm->AddField('text', 'City', null, array('name' => 'member_city'));
$frm->AddField('endgroup');
$frm->AddField('startgroup');
$frm->AddField('file', 'Avatar', null, array('name' => 'member_avatar'));
$frm->AddField('select', 'Type', null, array('name' => 'member_type'), array(0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    2 => array('2', 'اخراجی')));
$frm->AddField('endgroup');

$frm->AddField('spliter','اطلاعات پدر');
$frm->AddField('startgroup');
$frm->AddField('text', 'Name', null, array('name' => 'member_parent1_name'));
$frm->AddField('text', 'Phone', null, array('name' => 'member_parent1_mobile'));
$frm->AddField('endgroup');

$frm->AddField('spliter','اطلاعات مادر');
$frm->AddField('startgroup');
$frm->AddField('text', 'Name', null, array('name' => 'member_parent2_name'));
$frm->AddField('text', 'Phone', null, array('name' => 'member_parent2_mobile'));
$frm->AddField('endgroup');

$frm->AddField('spliter','Other');
$frm->AddField('textarea', 'Comment admin', null , array('name' => 'member_comment'));

$frm->AddField('submit', '', 'Submit');
?>
<br />
<h2 class="rtl">
    <?php echo $this->title ?>
</h2>
<br />
<br />
<div class="row">
    <div class="grd-primary">
        <?php
        $frm->Render();
        ?>

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

