<?php
/**
 * @package Toos FrameWork
 * @author A1Gard <a1gard@4xmen.ir>
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   header.php
 * @todo : cotntrol panel header
 */
$is_rtl = (_lg('dir') == 'rtl');

$dt = TDate::GetInstance();
$s = new TSystem();
$reg = TRegistry::GetInstance();


//$is_rtl = false;
?><!DOCTYPE html>
<html>
    <head>

        <title>
            <?php
            echo $this->title . " | ";
            _lp('Toos Framework');
            ?>
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">




        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/topstrap.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/clock-pick/jquery-clockpicker.min.css" />

        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/alertifyjs/css/alertify.min.css" />

        <?php if ($is_rtl): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/semantic-ui-rtl/semantic.rtl.min.css" />
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/alertifyjs/css/alertify.rtl.min.css" />
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/mpdatepicker/jquery.mpdatepicker.css" />
        <?php else: ?>
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/semantic-ui/semantic.min.css" />
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/pickadate/themes/default.css" />
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/pickadate/themes/default.date.css" />
        <?php endif; ?>
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/select2/css/select2.min" />
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/element.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/general.css" />




        <?php if ($is_rtl): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/element-rtl.css" />
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/general-rtl.css" />

        <?php endif; ?>

        <script type="text/javascript" src="<?php echo UR_MP ?>assets/js/jquery-2.2.4.min.js"></script>
        <script type="text/javascript" src="<?php echo UR_MP ?>assets/js/jquery-migrate-1.4.1.min.js"></script>

        <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/semantic-ui/semantic.min.js"></script> 
        <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/nicescroll/jquery.nicescroll.min.js"></script> 
        <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/ckeditor/ckeditor.js"></script> 
        <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/alertifyjs/alertify.min.js"></script> 
        <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/select2/js/select2.min.js"></script> 
        <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/clock-pick/jquery-clockpicker.min.js"></script> 

        <?php if ($is_rtl): ?>
            <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/mpdatepicker/jquery.mpdatepicker.js"></script>
            <script type="text/javascript">
                $(function () {
                    $(".Pdatepicker").mpdatepicker({});

                });
            </script>
        <?php else: ?>
            <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/pickadate/picker.js"></script> 
            <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/pickadate/picker.date.js"></script> 
            <script type="text/javascript">
                $(function () {
                    $('.datepicker').pickadate({
                        format: "<?php echo DT_JS_SHORT_DATE; ?>",
                        selectYears: true,
                        selectMonths: true
                    });
                });
            </script>
        <?php endif; ?>


        <?php echo TAseetLoader::AssetsLoad(); ?>
            
        <script type="text/javascript">
            var UR_MP = "<?php echo UR_MP ?>";
            var UR_BASE = "<?php echo UR_BASE ?>";
            var ajax_diable = false;
        </script>


        <script type="text/javascript" src="<?php echo UR_MP ?>assets/js/vue.min.js"></script>
    </head>
    <body class="<?php
    if ($reg->GetValue(ROOT_USER, 'sidebarstatus') == 0) {
        echo 'collapse-menu non-menu';
    }
    ?>"> <!--  class="collapse-menu non-menu" -->

        <div id="preloader">
            <div class="ui segment inverted">
                <div class="ui active loader blue"></div>
            </div>
        </div>

        <div class="ui inverted menu" id="header">
            <div class="ui container" style="max-width: none;width:100%;">
                <a href="#" class="item" id="menu-control">  
                    <i class="icon bars"></i>
                </a>
                <a href="#" class="header item">
                    <img class="logo" src="<?php echo UR_MP ?>assets/img/wlogo.png" alt="logo">
                    &nbsp;
                    <?php
                    _lp('Toos Framework');
                    ?>
                </a>
                <a href="<?php echo UR_MP ?>" class="item"><?php echo _lp('Desktop'); ?></a>
                <a href="<?php echo UR_BASE; ?>" target="_blank" class="item">
                    <i class="icon firefox"></i>
                    <?php echo _lp('Website'); ?>
                </a>
                <!--                <div class="ui simple dropdown item">
                                    Dropdown <i class="dropdown icon"></i>
                                    <div class="menu">
                                        <a class="item" href="#">Link Item</a>
                                        <a class="item" href="#">Link Item</a>
                                        <div class="divider"></div>
                                        <div class="header">Header Item</div>
                                        <div class="item">
                                            <i class="dropdown icon"></i>
                                            Sub Menu
                                            <div class="menu">
                                                <a class="item" href="#">Link Item</a>
                                                <a class="item" href="#">Link Item</a>
                                            </div>
                                        </div>
                                        <a class="item" href="#">Link Item</a>
                                    </div>
                                </div>-->
            </div>
        </div>
        <div id="body-content">
            <aside id="side-bar" class="ui sidebar inverted left">
                <div class="ui header">
                    <div class="ui list">
                        <div class="item">
                            <img class="ui avatar image" src="<?php
                            $avatar = $s->GetProfileField('manager_avatar');
                            echo ($avatar == '' ? UR_MP . 'assets/img/avatar.jpg' : $avatar);
                            ?>"> 
                            <div class="content">
                                <a class="header white-text" href="<?php echo UR_MP ?>Manager/Profile">
                                    <?php _lp('Hello'); ?>, 
                                    <?php
                                    echo $s->GetField('manager', 'manager_', 'manager_displayname', $_SESSION['MN_ID'])
                                    ?>
                                </a>
                                <div class="description"> <?php _lp('Login date'); ?>: <?php echo $dt->SDate(DT_SHORT_DATE, $s->GetProfileField('manager_lastlogin')) ?> </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
// include side bar
                require 'side.php';
                ?>
            </aside>

            <div class="pusher">

                <div class="viewport">

                    <div class="navigation animate-fast" >
                        <?php
// render Navigator for view to user
                        $this->navigator->Render();
                        ?>              
                    </div>

                    <div class="notification-bar">
                        <?php TNotification::Show(); ?>
                    </div>

