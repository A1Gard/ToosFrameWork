<?php
/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   index.php
 * @todo : index - index page view
 */
?>

<div class="row autofit rtl" >
    <div class="grd-primary">

        <form class="real" method="post" action="<?php echo  UR_MP ?>/Index/SaveSentence" style="padding: 2em;">

            <?php
            if (count($this->sen) > 0) {
                foreach ($this->sen as $sen) {
                    echo '<input type="text" name="sen[]" value="' . $sen . '" class="rem" /> <br />';
                }
            }
            ?>
            <input type="text" name="sen[]" value=""/> <br /><br />
            <input type="submit"  value="ثبت" style="min-width: 120px;"/> <br />

        </form>

    </div>
    <div class="grd-secondary">
        <div class="temp" style="padding: 1em;">
            برای حذف جمله روی آن دابل کلیک کنید.
        </div>
    </div>
</div>
