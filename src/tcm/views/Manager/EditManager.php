<?php
//var_dump($this->record);
//$date = TDate::GetInstance();
global $MANAGER_TYPE;

$frm = new TForm(UR_MP . 'Manager/Update/' . $this->record['manager_id'], 'post', array('class' => 'form rtl'));

$frm->AddField('text', 'نام', $this->record['manager_username'], array('name' => 'manager_username'));
$frm->AddField('email', 'ایمیل', $this->record['manager_email'], array('name' => 'manager_email'));
$frm->AddField('password', 'گذرواژه', '', array('name' => 'manager_password'));
$frm->AddField('text', 'نام نمایشی', $this->record['manager_displayname'], array('name' => 'manager_displayname'));

$frm->AddField('select', 'نوع', $this->record['manager_type'], array('name' => 'manager_type'), $MANAGER_TYPE);


$frm->AddField('submit', '', 'ویرایش');
//print_r($this->reports);
$promise = explode(',', $this->record['manager_permission']);
?>
<br />
<h2 class="rtl">
    <?php echo $this->title ?>
</h2>
<br />
<br />
<?php echo $frm->FormHeader(); ?>
<div class="row">
    <div class="grd-primary">
        <?php echo $frm->FormBody(); ?>
    </div>
    <div class="grd-secondary">
        <div class="attach" dir="rtl" style="padding:0.5em 1.5em">
            راهنما
            <hr />
            <?php
            if ($this->record['manager_type'] == $MANAGER_TYPE['DEFINED']):

                global $loaded_extensions;

                foreach ($loaded_extensions as $ext) :
                    ?>
                    <label> 
                        <?php _lp($ext); ?>
                        <input type="checkbox" name="allow[]" <?php echo (in_array($ext, $promise)?'checked=""':'') ?> value="<?php echo $ext; ?>"  />
                    </label>
                    <?php
                endforeach;
            endif; // promisition  
            ?>
        </div>
    </div>
</div>
<?php echo $frm->FormFooter(); ?>



