<?php
$frm = new TForm(UR_CM . 'Category/Insert', 'post', array('class' => 'form rtl'));

$frm->AddField('text', 'عنوان دسته ', null, array('name' => 'category_title', 'size' => 90));
$frm->AddField('select', 'مادر', null, array('name' => 'category_parent'), $this->cat->CategoryByExpect());
$frm->AddField('textarea', 'توضیح', null, array('name' => 'category_description', 'cols' => '90', "rows" => '10', 'class' => 'ckeditor'));
$frm->AddField('submit', '', 'ارسال');
?>


<div class="row">
    <div class="grd12 em-padding">
        <?php $frm->Render(); ?>
    </div>
    <div class="grd12">
        <ul class="listview">
            <li class="pinned animate"> 
                <div  class="row">
                    <div class="grd2">ش</div>
                    <div class="grd16"> عنوان</div>
                    <div class="grd6">
                        عملیات
                    </div>
                </div>
            </li>
            <?php foreach ($this->cls_list as $cls): ?>
                <li> 
                    <div  class="row">
                        <div class="grd2"><?= $cls['category_id'] ?></div>
                        <div class="grd16"><?= $cls['category_title'] ?></div>
                        <div class="grd6">
                            <a class="button delete" href="<?= UR_CM ?>Category/Delete/<?= $cls['category_id'] ?>"> حذف </a>
                            <a class="button" href="<?= UR_CM ?>Category/Edit/<?= $cls['category_id'] ?>"> ویرایش </a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

