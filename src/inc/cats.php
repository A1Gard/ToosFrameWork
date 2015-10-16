<?php

$cats = $database_handle->Select("SELECT * FROM %table%"
            . " WHERE category_parent = :par " ,array('category'),array(':par'=>$url[1]));
   
$cat = $database_handle->Select("SELECT * FROM %table%"
            . " WHERE category_id = :par " ,array('category'),array(':par'=>$url[1]));
   
$title = $cat[0]['category_title']  .' - '. $title;
$smarty->assign('cat',$cat[0]);
$smarty->assign('cats',$cats);