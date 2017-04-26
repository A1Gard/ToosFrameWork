<?php
//var_dump($this->record);
//$date = TDate::GetInstance();
global $MANAGER_TYPE;

$frm = new TForm(UR_MP . 'Manager/UpdateProfile', 'post', array('class' => ''));

        $frm->AddField('text', _lg('Name'), $this->record['manager_username'], array('name' => 'manager_username'));
        $frm->AddField('email',_lg('Email'), $this->record['manager_email'], array('name' => 'manager_email'));
        $frm->AddField('password', _lg('Current password'), '', array('name' => 'passwd'));
        $frm->AddField('password', _lg('New password'), '', array('name' => 'manager_password'));
        $frm->AddField('password', _lg('Repeat password'), '', array('name' => 'manager_password2'));
        $frm->AddField('text', _lg('Display name'), $this->record['manager_displayname'], array('name' => 'manager_displayname'));
        $frm->AddField('file',_lg('Avatar'), null, array('name' => 'avatar'));

//$frm->AddField('select', 'نوع', $this->record['manager_type'], array('name' => 'manager_type'), $MANAGER_TYPE);


$frm->AddField('submit', '', 'ویرایش');
//print_r($this->reports);
$promise = explode(',', $this->record['manager_permission']);
?>
<h2>
    <?php echo $this->title ?>
</h2>
<?php echo $frm->FormHeader(); ?>
<div class="row">
    <div class="grd-primary">
        <?php echo $frm->FormBody(); ?>
    </div>
    <div class="grd-secondary">
        <div class="ui segment inverted"  style="padding:0.5em 1.5em;margin-left: 1em;">
            &nbsp;
            <img src="<?php echo  $this->record['manager_avatar'] ?>" alt="[]" class="img-responsive img-rounded" />
            <br />

    </div>
</div>
<?php echo $frm->FormFooter(); ?>



