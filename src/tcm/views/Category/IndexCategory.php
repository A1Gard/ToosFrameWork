<?php
$frm = new TForm(UR_MP . 'Category/Insert', 'post', array('class' => 'form rtl'));

$frm->AddField('text', ('title'), null, array('name' => 'category_title', 'class' => 'full-width'));
$frm->AddField('select', ('Parent'), null, array('name' => 'category_parent'), $this->cat->CategoryByExpect());
$frm->AddField('textarea', ('Description'), null, array('name' => 'category_description', "rows" => '10', 'class' => 'ckeditor'));
$frm->AddField('submit', '', ('Submit'));
?>


<div class="row">

    <div class="grd12">
        <div class="margin">

            <ul class="listview">
                <li class="list-header"> 
                    <div  class="row">
                        <div class="grd2"><?php echo _lp('no.'); ?></div>
                        <div class="grd16"> <?php echo _lp('title'); ?></div>
                        <div class="grd6">
                            <?php echo _lp('Opration'); ?>
                        </div>
                    </div>
                </li>
                <?php foreach ($this->cls_list as $cls): ?>
                    <li> 
                        <div  class="row">
                            <div class="grd2"><?php echo $cls['category_id'] ?></div>
                            <div class="grd16"><?php echo $cls['category_title'] ?></div>
                            <div class="grd6">
                                <a class="ui button delete negative" href="<?php echo UR_MP ?>Category/Delete/<?php echo $cls['category_id'] ?>"> <?php echo _lp('Delete'); ?> </a>
                                <a class="ui button blue" href="<?php echo UR_MP ?>Category/Edit/<?php echo $cls['category_id'] ?>"> <?php _lp('Edit'); ?> </a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="grd12 em-padding">
        <div style="padding:1em">
            <?php $frm->Render(); ?>
        </div>
    </div>
</div>

