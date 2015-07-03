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
        <title> <?php
            echo $this->title . " | ";
            _lp('Toos Conetent mangement');
            ?> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        // load js libs
        $public_libs = new TPublicLibrary();
        $public_libs->LoadPublicLibs();
        // style sheet
        $public_libs->LoadTemplateCMCSS(array('style', 'object', 'byekan'));
        // load js
        $public_libs->LoadCMJS(array('general', 'side-menu', 'jquery.pin'));
        // pakage load
        $public_libs->LoadPackageJS(array('ckeditor/ckeditor',
            'jquery-ui/jquery-ui.min', 'tagsinput/jquery.tagsinput',
            'sortable/jquery-sortable-min','chart/Chart'));
        $public_libs->LoadPackageCSS(array('jquery-ui/jquery-ui.min',
            'tagsinput/jquery.tagsinput'));
        ?>

    </head>
    <body dir="<?php _lp('DIR') ?>" >
        <section id="container" class="animate-fast">
            <header id="header" class="animate-fast clearfix">
                <div id="brand">
                    <img src="<?= UR_CM_PUB ?>images/wlogo.png" alt="[logo]" class="center" />
                </div>
                <nav>
                    <div id="user">
                        <input type="text" placeholder="search..." class="search animate" />
                        <div id="user-info" >
                            <img src="<?= UR_CM_PUB ?>images/tmp-avatar.jpg" alt="[avatar]" /><span>Admin <i class="fa fa-arrow-circle-o-down"></i></span>
                        </div>
                    </div>
                    <ul class="circle margin-v">
                        <li id="side-toggle"><i class="fa fa-bars"></i></li>
                        <li>
                            <a href="<?=  UR_CMT ?>Index/State">    
                                <i class="fa fa-bar-chart-o"></i>
                            </a>
                        </li>
                        <li><i class="fa fa-bell-o"></i></li>
                        <li>
                            <a href="<?=  UR_CMT . 'Comment/Index' ?>">
                                <i class="fa fa-envelope-o"></i>
                            </a>
                        </li>
                        <a href="<?=  UR_CMT . 'Comment/Index' ?>" id="comment-count">
                            <?php $a = TSystem::GetInstance(); echo $a->GetPenddlingCommentCount() ; ?>
                        </a>

                    </ul>
                </nav>

            </header>
            <?php
            // include side bar
            require 'side.php';
            ?>
            <section id="content">
                <div id="wrapper">
                    <div class="navigation animate-fast" >
                        <?php
                        // render Navigator for view to user
                        $this->navigator->Render();
                        ?>
                    </div>
