<?php /* Smarty version 2.6.28, created on 2014-09-09 13:57:56
         compiled from header.tpl */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->_tpl_vars['title']; ?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?php echo @UR_BASE; ?>
public/css/top-grid.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo @UR_BASE; ?>
public/css/byekan.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo @UR_BASE; ?>
public/css/flip.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo @UR_BASE; ?>
public/css/style.css" />

        <script type="text/javascript" src="<?php echo @UR_BASE; ?>
public/js/jquery.min.js"></script>	
        <script type="text/javascript" src="<?php echo @UR_BASE; ?>
public/js/jquery.stellar.min.js"></script>
        <script type="text/javascript" src="<?php echo @UR_BASE; ?>
public/js/jquery.totemticker.min.js"></script>
        <script type="text/javascript" src="<?php echo @UR_BASE; ?>
public/js/jquery.roundabout.min.js"></script>
        <script type="text/javascript" src="<?php echo @UR_BASE; ?>
public/js/jquery.ticker.js"></script>
        <script type="text/javascript" src="<?php echo @UR_BASE; ?>
public/js/jquery.easing.1.3.js"></script>	
        <script type="text/javascript" src="<?php echo @UR_BASE; ?>
public/js/modernizr.2.5.3.min.js"></script>	
        <script type="text/javascript" src="<?php echo @UR_BASE; ?>
public/js/jquery.tagcanvas.js"></script>	
        <script type="text/javascript" src="<?php echo @UR_BASE; ?>
public/js/flip.js"></script>
    </head>
    <body>
        <div id='facebook' >
            <div id='block_1' class='facebook_block'></div>
            <div id='block_2' class='facebook_block'></div>
            <div id='block_3' class='facebook_block'></div>
        </div>    
        <div id="header">
            <div class="std-wrapper">
                <img src="<?php echo @UR_BASE; ?>
public/img/logo.png" alt="[logo]" style="float: left" />
                <img class="" alt="[title]" src="<?php echo @UR_BASE; ?>
public/img/title.png" />
            </div>
            <div id="menu" class="margin-v">
                <ul class="std-wrapper" >
                    <li>
                        <a href="<?php echo @UR_BASE; ?>
" >
                            صفحه نخست
                        </a>
                    </li>
                    <?php if (! isset ( $_COOKIE['mid'] )): ?> 
                        <li>
                        <a href="<?php echo @UR_BASE; ?>
ثبت-نام" >
                            ثبت نام
                        </a>
                    </li>
<li>
                        <a href="<?php echo @UR_BASE; ?>
ورود" >
ورود
                        </a>
                    </li>
		    <?php else: ?>
			<li>
                        <a href="<?php echo @UR_BASE; ?>
chat" >
                            اتاق گفتمان
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php echo $this->_tpl_vars['menu']; ?>

                </ul> 
            </div>

        </div>