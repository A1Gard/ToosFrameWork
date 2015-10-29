<?php
/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   login.php 
 * @todo : login view page
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php
            echo $this->title . " | ";
            _lp('Toos Framework');
            ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex, nofollow">
        <?php
        $public_libs = new TPublicLibrary();
        $public_libs->LoadPublicLibs();
        // style sheet
        $public_libs->LoadExtedentLib();
//        $public_libs->LoadTemplateCMCSS(array('style', 'object', 'byekan'));
        // load js
        $public_libs->LoadCMJS(array('general', 'side-menu', 'jquery.pin', 'jquery.nicescroll.min'));

        if (_lg("DIR") == "rtl") {
            $public_libs->LoadCMCSS(array('general-rtl', 'element-rtl', 'byekan'));
        }
        ?>
    </head>
    <body class="login">


        <!-- section login start -->
        <section id="login">
            <form action="<?php echo UR_MP; ?>Access/Check" method="post">
                <div class="logo">
                    <img src="<?= UR_MP_ASSETS ?>img/wlogo.png" alt="[]" />
                </div>
                <span class="notification-bar">  
                    <?php
// if is set
                    if (isset($_GET['msg_id']) && isset($_GET['ni'])) {
                        $msg = TLanguage::Index($_GET['msg_id']);
                        ?>
                        <p class="notification error text-center">
                            <!--<span class="fa fa-times-circle"></span>-->
                            <?php
                            // check array for show with argumans or not
                            if (isset($_GET['args'])) {
                                // show with argumans
                                $args = explode(',', $_GET['args']);
                                vprintf($msg, $args);
                            } else {
                                echo $msg;
                            }
                            ?>
                        </p>
                        <?php
                    }
                    ?>
                </span>
                <label>
                    <b>
                        <?php _lp('Username') ?>:
                    </b>
                    <br />
                    <input type="text" name="manager_username" placeholder="<?php _lp('Username') ?>" class="full-width"/>
                </label>
                <label>
                    <b>
                        <?php _lp('Password') ?>:
                    </b>
                    <br />
                    <input type="password" name="manager_password" placeholder="<?php _lp('Password') ?>" class="full-width"/>
                </label>

                <label> <input type="checkbox" name="remenber"  /> <?php _lp('Remenber me') ?> </label>
                <label><input type="submit" value="<?php _lp('log in') ?>" class="full-width btn" /></label>
                <br />

                <a href="?" class="text-center" style="color:black;display: block"><?php _lp('Forget your password ?') ?></a>
            </form>
            <span style="color:white;">  
                <?php
                _lp('Powered by ');
                _lp('Toos Framework');
                ?>  2013 &copy; <?php echo date('Y') ?>
            </span>
        </section> <!-- section login end -->

        <!--        
                
                <section id="login-sec">
                    <div id="brand">
                        <img src="<?php echo UR_MP_ASSETS ?>images/wlogo.png" alt="[logo]" class="center" />
                    </div>
                    <div class="clearfix clr"></div>
                    <div id="login">
        
        
                        <form action="<?php echo UR_MP; ?>Access/Check" method="post">
                            <label>
<?php _lp('Username') ?>:
                                <br />
                                <input type="text" name="manager_username" placeholder="<?php _lp('Username') ?>" class="full-width"/>
                            </label>
                            <label>
<?php _lp('Password') ?>:
                                <br />
                                <input type="password" name="manager_password" placeholder="<?php _lp('Password') ?>" class="full-width"/>
                            </label>
        
                            <label> <input type="checkbox" name="remenber"  /> <?php _lp('Remenber me') ?> </label>
                            <label><input type="submit" value="<?php _lp('log in') ?>" class="full-width" /></label>
        
                        </form>
                        <br />
                        
                    </div>
                </section>-->
    </body>
</html>
