<?php
/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index.php
 * @todo : index - index page view
 */


$this->cat = new TCategory();
$frm = new TForm('', 'post');
$frm->AddField('select', 'دسته اول', $this->Setting['s']['1'], array('name' => 's[1]'),$this->cat->CategoryByExpect(0));
$frm->AddField('select', 'دسته دوم', $this->Setting['s']['2'], array('name' => 's[2]'),$this->cat->CategoryByExpect(0));


?>

<div class="row autofit rtl" >
    <div class="grd-primary">

        <form class="real" method="post" action="<?php echo  UR_MP ?>/Index/SaveSetting" style="padding: 2em;">
            <label>
                <span>
                    عنوان سایت
                </span>
                <input type="text" value="<?php echo  $this->Setting['title'] ?>" name="title" />
            </label>
            <br />
            <label>
                <span>
                    حداکثر تلاش
                </span>
                <input type="number" value="<?php echo  $this->Setting['login_max_try'] ?>" name="login_max_try" />
            </label>
            <br />
            <label>
                <span>
                    میزان محرومیت
                </span>
                <input type="number" value="<?php echo  $this->Setting['login_ignore_time'] ?>" name="login_ignore_time" />
            </label>
            <br />
            <label>
                <span>
                    پیوند ها: 
                </span>
                <textarea name="links" class="ckeditor" ><?php echo  $this->Setting['links'] ?></textarea>
            </label>
            <br />
            <label>
                <span>
                    پانوشت: 
                </span>
                <textarea name="footer" class="ckeditor" ><?php echo  $this->Setting['footer'] ?></textarea>
            </label>
            <br />
            <label>
                <span>
                    پیام خطای کابری: 
                </span>
                <textarea name="error" class="ckeditor" ><?php echo  $this->Setting['error'] ?></textarea>
            </label>
            <?php echo  $frm->FormBody(); ?>
            <br />
            <input type="submit" value="ذخیره" />
        </form>

    </div>
    <div class="grd-secondary">
        <div class="temp" style="padding: 1em;">
            حداکثر تلاش برای ورود به سیستم می باشد که اگر تعداد آن از حد بگذرد به اندازه تعداد مدت محرومیت دقیقه از تلاش برای ورود کاربر جلوگیری میشود
        </div>
    </div>
</div>
