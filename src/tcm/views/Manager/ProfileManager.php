<?php
//var_dump($this->record);
//$date = TDate::GetInstance();
global $MANAGER_TYPE;

$frm = new TForm(UR_MP . 'Manager/UpdateProfile', 'post', array('class' => ''));
$registry = TRegistry::GetInstance();
$frm->AddField('text', ('Name'), $this->record['manager_username'], array('name' => 'manager_username'));
$frm->AddField('email', ('Email'), $this->record['manager_email'], array('name' => 'manager_email'));
$frm->AddField('password', ('Current password'), '', array('name' => 'passwd','required'=>''));
$frm->AddField('password', ('New password'), '', array('name' => 'manager_password'));
$frm->AddField('password', ('Repeat password'), '', array('name' => 'manager_password2'));
$frm->AddField('text', ('Display name'), $this->record['manager_displayname'], array('name' => 'manager_displayname'));
$frm->AddField('number', ('Page record count'), $registry->GetValueEx(ROOT_USER, 'record_list_limit', GetManagerId()), array('name' => 'record_list_limit'));
$frm->AddField('file', ('Avatar'), null, array('name' => 'avatar'));


//$frm->AddField('select', 'نوع', $this->record['manager_type'], array('name' => 'manager_type'), $MANAGER_TYPE);


$frm->AddField('submit', '', 'submit');
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
        <div class="ui segment inverted">
            &nbsp;
            <img src="<?php echo $this->record['manager_avatar'] ?>" alt="[]" class="img-responsive img-rounded" />
            <br />

        </div>
    </div>
    <?php echo $frm->FormFooter(); ?>



