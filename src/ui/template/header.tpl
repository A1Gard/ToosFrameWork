<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="{$smarty.const.UR_BASE}public/css/top-grid.css" />
        <link rel="stylesheet" type="text/css" href="{$smarty.const.UR_BASE}public/css/byekan.css" />
        <link rel="stylesheet" type="text/css" href="{$smarty.const.UR_BASE}public/css/flip.css" />
        <link rel="stylesheet" type="text/css" href="{$smarty.const.UR_BASE}public/css/style.css" />

        <script type="text/javascript" src="{$smarty.const.UR_BASE}public/js/jquery.min.js"></script>	
        <script type="text/javascript" src="{$smarty.const.UR_BASE}public/js/jquery.stellar.min.js"></script>
        <script type="text/javascript" src="{$smarty.const.UR_BASE}public/js/jquery.totemticker.min.js"></script>
        <script type="text/javascript" src="{$smarty.const.UR_BASE}public/js/jquery.roundabout.min.js"></script>
        <script type="text/javascript" src="{$smarty.const.UR_BASE}public/js/jquery.ticker.js"></script>
        <script type="text/javascript" src="{$smarty.const.UR_BASE}public/js/jquery.easing.1.3.js"></script>	
        <script type="text/javascript" src="{$smarty.const.UR_BASE}public/js/modernizr.2.5.3.min.js"></script>	
        <script type="text/javascript" src="{$smarty.const.UR_BASE}public/js/jquery.tagcanvas.js"></script>	
        <script type="text/javascript" src="{$smarty.const.UR_BASE}public/js/flip.js"></script>
    </head>
    <body>
        <div id='facebook' >
            <div id='block_1' class='facebook_block'></div>
            <div id='block_2' class='facebook_block'></div>
            <div id='block_3' class='facebook_block'></div>
        </div>    
        <div id="header">
            <div class="std-wrapper">
                <img src="{$smarty.const.UR_BASE}public/img/logo.png" alt="[logo]" style="float: left" />
                <img class="" alt="[title]" src="{$smarty.const.UR_BASE}public/img/title.png" />
            </div>
            <div id="menu" class="margin-v">
                <ul class="std-wrapper" >
                    <li>
                        <a href="{$smarty.const.UR_BASE}" >
                            صفحه نخست
                        </a>
                    </li>
                    {if !isset($smarty.cookies.mid)} 
                        <li>
                        <a href="{$smarty.const.UR_BASE}ثبت-نام" >
                            ثبت نام
                        </a>
                    </li>
<li>
                        <a href="{$smarty.const.UR_BASE}ورود" >
ورود
                        </a>
                    </li>
		    {else}
			<li>
                        <a href="{$smarty.const.UR_BASE}chat" >
                            اتاق گفتمان
                        </a>
                    </li>
                    {/if}
                    {$menu}
                </ul> 
            </div>

        </div>