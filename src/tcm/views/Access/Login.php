<?php
/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   login.php 
 * @todo : login view page
 */
$is_rtl = (_lg('dir') == 'rtl');
TMAC::Init();
$dt = TDate::GetInstance();
require_once PA_LIBS .'TNotification.php';
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


        <?php if ($is_rtl): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP_ASSETS; ?>libs/semantic-ui-rtl/semantic.rtl.min.css" />
        <?php else: ?>
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP_ASSETS; ?>libs/semantic-ui/semantic.min.css" />
        <?php endif; ?>
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP_ASSETS; ?>css/element.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP_ASSETS; ?>css/general.css" />


        <?php if ($is_rtl): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP_ASSETS; ?>css/element-rtl.css" />
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP_ASSETS; ?>css/general-rtl.css" />

        <?php endif; ?>

        <script type="text/javascript" src="<?php echo UR_MP_ASSETS; ?>js/jquery-2.2.4.min.js"></script>
        <script type="text/javascript" src="<?php echo UR_MP_ASSETS; ?>js/jquery-migrate-1.4.1.min.js"></script>

        <script type="text/javascript" src="<?php echo UR_MP_ASSETS; ?>libs/semantic-ui/semantic.min.js"></script> 


        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <style type="text/css">
            body > .grid {
                height: 100%;
            }
            .image {
                margin-top: -100px;
            }
            .column {
                max-width: 450px;
            }

            input{
                font-size: 11pt;
            }

            .text-left{
                text-align: left;
            }
            .text-right{
                text-align: right;
            }

            .header .content{
                color: #fff; 
                font-size: 16pt;

            }
            .ui.form .error.message.notification, .ui.form .success.message.notification, .ui.form .warning.message.notification{
                display: block ;
                font-size:8.5pt;
                margin-bottom: 10px;
            }
            

        </style>
        <script>
            $(document)
                    .ready(function () {
                        $('.ui.form')
                                .form({
                                    fields: {
                                        username: {
                                            identifier: 'manager_username',
                                            rules: [
                                                {
                                                    type: 'empty',
                                                    prompt: 'Please enter your username'
                                                },
                                                {
                                                    type: 'length[3]',
                                                    prompt: 'Your username must be at least 3 characters'
                                                }
                                            ]
                                        },
                                        password: {
                                            identifier: 'password',
                                            rules: [
                                                {
                                                    type: 'empty',
                                                    prompt: 'Please enter your password'
                                                },
                                                {
                                                    type: 'length[6]',
                                                    prompt: 'Your password must be at least 6 characters'
                                                }
                                            ]
                                        }
                                    }
                                })
                                ;
                    })
                    ;
        </script>
    </head>
    <body>

        <div class="ui middle aligned center aligned grid">
            <div class="column">
                <h2 class="ui teal image header ">
                    <img src="<?= UR_MP_ASSETS ?>img/wlogo.png" alt="[]" class="image" />
                    <div class="content">
                        <?php echo _lp('Login to your account'); ?>
                    </div>
                </h2>
                <form class="ui large form" action="<?php echo UR_MP; ?>Access/Check" method="post">
                    <div class="ui stacked segment">
                        <div class="">
                            <?php TNotification::Show(); ?>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="manager_username" class="input" placeholder="<?php _lp('Username') ?>">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="manager_password"  class="input" placeholder="<?php _lp('Password') ?>">
                            </div>
                        </div>
                        <div class="field <?php _lp('text-left'); ?>">
                            <div class="ui checkbox toggle">
                                <input tabindex="0" type="checkbox" name="remenber" class="hidden" />
                                <label>
                                    <?php _lp('Remenber me') ?>
                                </label>
                            </div>
                            <label> 

                            </label>
                        </div>
                        <button class="ui fluid large teal submit button" tabindex="0"><?php _lp('Login') ?></button>
                    </div>

                    <div class="ui error message">

                    </div>

                </form>

                <div class="ui message">
                    <a href="<?php echo UR_MP ?>Access/Forget" class="text-center" style="color:black;display: block"><?php _lp('Forget your password ?') ?></a>
                </div>
                <div class="copyright">
                    <?php
                    _lp('Powered by ');
                    _lp('Toos Framework');
                    ?>  <?php echo $dt->Sdate('Y', strtotime('2013/03/22')); ?> &copy; <?php echo $dt->Sdate('Y') ?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                  $('.ui.checkbox').checkbox();
            });
        </script>
        <script type="text/javascript" src="<?php echo UR_MP_ASSETS; ?>js/general.js"></script>
    </body>

</html>

