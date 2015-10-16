 <?php

/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   footer.php
 * @todo : cotntrol panel footer
 */
?>   
                </div>
            </section>
            <section id="footer" class="animate">
                <?php _lp('Powered by '); _lp('Toos Framework'); ?>  2013 &copy; <?php echo date('Y') ?>
            </section>
            <div class="preloader">
                <img src="<?php echo  UR_MP_ASSETS ?>img/preloader.gif" alt="[pre loader]" />
            </div>
            <div id="ajax-result">
                <h4>
                    <?php _lp('Action result') ?>
                </h4>
                <div>
                    <span class="true">
                        <?php _lp('The operation was successful') ?>
                    </span>
                    <span class="false">
                        <?php _lp('Operation failed') ?>
                    </span>
                    <span class="result">
                        
                    </span>
                    
                </div>
            </div>
        </div>
    </body>
</html>