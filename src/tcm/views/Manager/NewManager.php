<?php
global $MANAGER_TYPE;
$frm = new TForm(UR_MP . 'Manager/Insert', 'post', array('class' => 'form'));

$frm->AddField('text', ('Username'), null, array('name' => 'manager_username'));
$frm->AddField('email', ('Email'), null, array('name' => 'manager_email'));
$frm->AddField('password', ('password'), null, array('name' => 'manager_password'));
$frm->AddField('text', ('Display name'), null, array('name' => 'manager_displayname'));

$frm->AddField('select', ('Type'), null, array('name' => 'manager_type'), $MANAGER_TYPE);
$frm->AddField('checkbox', ('Protected'), 1, array('name' => 'manager_protected'));

$frm->AddField('submit', '', ('Submit'));
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