<!DOCTYPE html>
<html>
    <?php
//        define('__MP__', true);
        include_once '../tconfig.php';
        include_once '../tconstant.php';
        include_once '../libs/TLanguage.php';
        include_once '../libs/TMagicFunctions.php';
    ?>
    <head>
        <meta charset="UTF-8">
        <title>  <?php echo _lg('System message') . ' - ' . _lg($_GET['title']); ?> </title>
        <link type="text/css" rel="stylesheet" href="assets/css/topstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/genreal.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/element.css" />
        <?php if(_lg('DIR') == 'rtl'):  ?>
        <link type="text/css" rel="stylesheet" href="assets/css/element-rtl.css" />
        <?php endif; ?>
        <style type="text/css">
            #message:before{
                content:"<?php echo _lg($_GET['title']); ?>";
            }
        </style>
    </head>
    <body <?php if(_lg('DIR') == 'rtl'):  ?>
        dir='rtl'
        <?php endif; ?>> 
        <section id="message">
            <h2>
                <?php echo _lg($_GET['text']); ?>
            </h2>
        </section>
    </body>
</html>
