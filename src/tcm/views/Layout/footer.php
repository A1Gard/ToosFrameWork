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
<script type="text/javascript" src="<?php echo UR_MP ?>assets/js/side-menu.js"></script>
<script type="text/javascript" src="<?php echo UR_MP ?>assets/js/general.js"></script>
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
</body>
</html>
