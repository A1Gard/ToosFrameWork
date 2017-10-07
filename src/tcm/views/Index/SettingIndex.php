<?php
/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index.php
 * @todo : index - index page view
 */
//$this->Setting['s'] = unserialize($this->Setting['s']);
$this->cat = new TCategory();
global $price_mode;
$frm = new TForm(UR_MP . 'Index/SaveSetting"', 'post');
$frm->AddField('text', 'title', $this->Setting['title'], array('name' => 'title'));
$frm->AddField('startgroup');
$frm->AddField('number', 'Max try', $this->Setting['login_max_try'], array('name' => 'login_max_try'));
$frm->AddField('number', 'Ignore Time', $this->Setting['login_ignore_time'], array('name' => 'login_ignore_time'));
$frm->AddField('endgroup');
$frm->AddField('textarea', 'Footer', $this->Setting['footer'], array('name' => 'footer'));
$frm->AddField('textarea', 'User error', $this->Setting['error'], array('name' => 'error', 'class' => 'ckeditor'));

//$frm->AddField('select', 'دسته دوم', $this->Setting['s']['2'], array('name' => 's[2]'), $this->cat->CategoryByExpect(0));

$frm->AddField('submit', '', ('Save'));
?>

<div class="row autofit rtl" >
    <div class="grd-primary">

        <?php echo $frm->Render(); ?>

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
                        حداکثر تلاش برای ورود به سیستم می باشد که اگر تعداد آن از حد بگذرد به اندازه تعداد مدت محرومیت دقیقه از تلاش برای ورود کاربر جلوگیری میشود
                    </p>
                    <p>
                        پیام خطای کاربری پیامی است که اگر دسترسی کاربر مجاز نبود به آن نمایش داده میشود
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>