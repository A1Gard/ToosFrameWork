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
        <?php
        // load js libs
        $public_libs = new TPublicLibrary();
        $public_libs->LoadPublicLibs();
        // style sheet
        $public_libs->LoadTemplateCMCSS(array('style', 'object','byekan'));
        // load js
        $public_libs->LoadCMJS(array('general', 'side-menu'));
        ?>
    </head>
    <body style="background:#32323a;">
        <div style="position: fixed;bottom: 10px;left: 0;right: 0;text-align: center;">
            <a href="#">copyright 2013 - 2014 - Toos FrameWork </a>
        </div>
        <br />
        <br />
        <section id="login-sec">
            <div id="brand">
                <img src="<?php echo  UR_MP_ASSETS ?>images/wlogo.png" alt="[logo]" class="center" />
            </div>
            <div class="clearfix clr"></div>
            <div id="login">
                <?php
                // if is set
                if (isset($_GET['msg_id']) && isset($_GET['ni'])) {
                    $msg = TLanguage::Index($_GET['msg_id']);
                    ?>
                    <p class="error">
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
                        <a class="alert-close" href="#"></a>
                    </p>
                    <?php
                }
                ?>

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
                <a href="?" class="text-center block"><?php _lp('Forget your password ?') ?></a>
            </div>
        </section>
    </body>
</html>
