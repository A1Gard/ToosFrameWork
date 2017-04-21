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

        <?php if ($is_rtl): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/semantic-ui-rtl/semantic.rtl.min.css" />
        <?php else: ?>
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/libs/semantic-ui/semantic.min.css" />
        <?php endif; ?>
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/element.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/general.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/topstrap.css" />


        <?php if ($is_rtl): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/element-rtl.css" />
            <link type="text/css" rel="stylesheet" href="<?php echo UR_MP ?>assets/css/general-rtl.css" />

        <?php endif; ?>

        <script type="text/javascript" src="<?php echo UR_MP ?>assets/js/jquery-2.2.4.min.js"></script>
        <script type="text/javascript" src="<?php echo UR_MP ?>assets/js/jquery-migrate-1.4.1.min.js"></script>

        <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/semantic-ui/semantic.min.js"></script> 
        <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs/nicescroll/jquery.nicescroll.min.js"></script> 
        <script type="text/javascript" src="<?php echo UR_MP ?>assets/libs//ckeditor/ckeditor.js"></script> 
    </head>
    <body> <!--  class="collapse-menu non-menu" -->

        <div class="ui inverted menu" id="header">
            <div class="ui container" style="max-width: none;width:100%;">
                <a href="#" class="item" id="menu-control">  
                    <i class="icon bars"></i>
                </a>
                <a href="#" class="header item">
                    <img class="logo" src="<?php echo UR_MP ?>assets/img/wlogo.png" alt="logo">
                    <?php
                    _lp('Toos Framework');
                    ?>
                </a>
                <a href="#" class="item">Home</a>
                <div class="ui simple dropdown item">
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
                </div>
            </div>
        </div>
        <div id="body-content">
            <aside id="side-bar" class="ui sidebar inverted left">
                <div class="ui header">
                    <div class="ui list">
                        <div class="item">
                            <img class="ui avatar image" src="<?php echo UR_MP ?>assets/img/avatar.jpg"> 
                            <div class="content">
                                <a class="header">
                                    <?php _lp('Hello'); ?>, 
                                    <?php
                                    $s = new TSystem();
                                    echo $s->GetField('manager', 'manager_', 'manager_displayname', $_SESSION['MN_ID'])
                                    ?>
                                </a>
                                <div class="description"> last visit: 2017-02-16 </div>
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

