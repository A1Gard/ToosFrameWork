<?php
//var_dump($this->record);
$frm = new TForm(UR_MP . 'Category/Update/' . $this->record['category_id'], 'post', array('class' => 'form rtl'));

$frm->AddField('text', _lg('Title'), $this->record['category_title'], array('name' => 'category_title', 'size' => 90));
$frm->AddField('select', _lg('Parent'), $this->record['category_parent'], array('name' => 'category_parent'), $this->cat->CategoryByExpect($this->record['category_id']));
$frm->AddField('textarea', _lg('Description'), $this->record['category_description'], array('name' => 'category_description', 'cols' => '90', "rows" => '10', 'class' => 'ckeditor'));
$frm->AddField('file', _lg('Image'), null, array('name' => 'image'));
$frm->AddField('submit', '', _lg('Submit'));
?>

<br />
<h2 class="rtl">
    <?php echo $this->title ?>
    <img alt="[category_image]" src="<?php echo UR_UPLOAD ?>category/<?php echo $this->record['category_id'] ?>.png" />
</h2>
<br />
<br />
<?php $frm->Render(); ?>
        


