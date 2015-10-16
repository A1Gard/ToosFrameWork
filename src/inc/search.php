<?php

$page = new TPagination($page_count);
if (isset($_GET['page'])){
    $pg = (int) $_GET['page'];
    $pg--;
    $limit = ($pg * PAGE_C) .','.PAGE_C;
}else{
    $limit = PAGE_C;
}
//
$topics = GetTopicBySearch($_GET['search'], $limit);

$smarty->assign('page_title','جستجو برای  ' . '"' .$_GET['search'] . '"');

$smarty->assign('topix',$topics);
$smarty->assign('page', $page->RenderX());