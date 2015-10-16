<?php
/**
 * @package Toos FrameWork
 * @author Phoenix Tech <info@pxt.ir> 
 * @date : 22-March-2013 (2-1-1392) 
 * @time : 16:32 
 * @subpackage   header.php
 * @todo : cotntrol panel header
 */
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

        <?php
        // load js libs
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
        // pakage load
        $public_libs->LoadPackageJS(array('ckeditor/ckeditor',
            'jquery-ui/jquery-ui.min', 'tagsinput/jquery.tagsinput',
            'sortable/jquery-sortable-min', 'chart/Chart'));
        $public_libs->LoadPackageCSS(array('jquery-ui/jquery-ui.min',
            'tagsinput/jquery.tagsinput'));
        ?>


    </head>
    <body>
        <div>
            <section id="header">

                <div id="logo"></div>

                <div id="nav-header">
                    <ul>
                        <li class="suggest-bg mobile-visble">
                            <a href="#" id="sidemenu-show">
                                <span class="fa fa-bars"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa fa-bell-o"></span>
                            </a>
                            <i class="notify"> 3 </i>
                        </li>
                        <li>
                            <a href="<?php echo UR_MP ?>Index/State">
                                <span class="fa fa-bar-chart"></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo UR_MP . 'Comment/Index' ?>">
                                <span class="fa fa-envelope-o"></span>
                            </a>
                            <?php $a = TSystem::GetInstance();
                            echo $a->GetPenddlingCommentCount();
                            ?>
                        </li>

                    </ul>

                </div>
                <div id="admin-bar">
                    <div id="you" class="pre-actived">
                        <img src="<?php echo UR_MP_ASSETS ?>img/anonymous.gif" alt="[your avatar]" />
                        <span class="hello">
                            <?php _lp('Hello'); ?>, 
                            <?php
                            $s = new TSystem();
                            echo $s->GetField('manager', 'manager_', 'manager_displayname', $_SESSION['MN_ID'])
                            ?>
                        </span>
                        <span class="fa fa-angle-down" ></span>
                        <ul class="mini-dropdown animate">
                            <li>
                                <a href="#">
                                    <span class="fa fa-android"></span>
                                    text1
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fa fa-bell-o"></span>
                                    text2
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    text3
                                </a>
                            </li>
                        </ul>
                    </div>
                    <input type="text" id="admin-search" placeholder="search..."
                           class="animate-slow"/>
                </div>
            </section>
            <?php
            // include side bar
            require 'side.php';
            ?>
            <section id="content">
                <div class="view-port">
                    <div class="navigation animate-fast" >
                        <?php
                        // render Navigator for view to user
                        $this->navigator->Render();
                        ?>              
                    </div>

                    <div class="notification-bar">
<?php TNotification::Show(); ?>
                    </div>