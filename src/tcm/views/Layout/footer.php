<?php
/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   footer.php
 * @todo : cotntrol panel footer
 */
?>   

</div>
</div>
</div>
<div class="copyright">
    <?php
    _lp('Powered by ');
    _lp('Toos Framework');
    ?>  <?php echo $dt->Sdate('Y', strtotime('2013/03/22')); ?> &copy; <?php echo $dt->Sdate('Y') ?>
</div>
<script type="text/javascript" src="<?php echo UR_MP_ASSETS; ?>/js/side-menu.js"></script>
<script type="text/javascript" src="<?php echo UR_MP_ASSETS; ?>/js/general.js"></script>
<?php if ($reg->GetValue(ROOT_USER, 'sidebarstatus') == 0 && HOT_CORNER): ?>
    <script type="text/javascript">
        var lastevent = new Date();
        $(function () {

            $('body').bind('mousemove', function (e) {
                var now = new Date();
                var difference = (now - lastevent) / 1000;
                if (<?php if ($is_rtl): ?> $(window).width() - <?php endif; ?> e.pageX <= 10 && $(window).height() - e.pageY <= 10 && difference >= 1) {
                    lastevent = new Date();
                    $("#menu-control").click();
                }
                //        console.log(e.pageY);
            });

        });
    </script>
<?php endif; ?>


<div class="ui modal fullscreen" id="upload-modal">
    <div class="header"><?php echo _lp('Upload modal'); ?></div>
    <div class="content">
        <div class="ui top attached tabular menu">
            <a class="active item" data-tab="first" id="uploaded">
                <?php echo _lp('Upload list'); ?>

            </a>
            <a class="item" data-tab="second">
                <?php echo _lp('Upload new file'); ?>
            </a>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="first">
            <div class="ui six column grid" id="upload-list">
                <div class="column" v-for="item in items" :data-id="item.up_id">
                    <div class="ui fluid card ">
                        <div class="image">
                            <img :src="'<?php echo UR_BASE ?>'+ item.up_location" />
                        </div>
                        <div class="content">
                            <a class="header">{{ item.up_filename }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="ui bottom attached tab segment" data-tab="second">

            <form action="" method="POST" id="drg-upload">

                <?php echo _lp('For upload drag & drop here'); ?>
            </form>
            <input type="file" id="hide-file-selector" class="hidden"  multiple="" />
            <div class="ui indicating progress" id="upload-progress">
                <div class="bar">
                    <div class="progress"></div>
                </div>
                <div class="label"> <?php echo _lp('Uploading'); ?></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var upload_list = new Vue({
            el: '#upload-list',
            data: {
                items: [
                ]
            }
        });
    </script>
    <div class="actions">
        <div class="ui cancel button negative"><?php echo _lp('Cancel'); ?></div>
        <div class="ui button positive" id="upload-ok"><?php echo _lp('Ok'); ?></div>
    </div>
</div>
</body>
</html>
