<?php
$page_count = GetPageByTag($url[1]);
$page = new TPagination($page_count);
if (isset($_GET['page'])){
    $pg = (int) $_GET['page'];
    $pg--;
    $limit = ($pg * PAGE_C) .','.PAGE_C;
}else{
    $limit = PAGE_C;
}

$topics = GetTopicByTag($url[1],$limit);

$smarty->assign('page_title',$tag['tag_label']);

$smarty->assign('topix',$topics);
$smarty->assign('page', $page->RenderX());