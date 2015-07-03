<?php

$page_count = GetPageByCat($url[1]);
$page = new TPagination($page_count);
if (isset($_GET['page'])){
    $pg = (int) $_GET['page'];
    $pg--;
    $limit = ($pg * PAGE_C) .','.PAGE_C;
}else{
    $limit = PAGE_C;
}

$topics = GetTopicByCategory($url[1],$limit);
$cat = $database_handle->Select("SELECT * FROM %table%"
            . " WHERE category_id = :par" ,array('category'),array(':par'=>$url[1]));

$smarty->assign('page_title',$cat[0]['category_title']);
$title = $cat[0]['category_title'] .' - '. $title;
$smarty->assign('topix',$topics);
$smarty->assign('page', $page->RenderX());