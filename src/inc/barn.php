<?php


if (!isset($_COOKIE['mid'])) {
    Redirect('/msg/شما وارد نشده اید');
}


$page_count = GetReqPageCount();
$page = new TPagination($page_count);
if (isset($_GET['page'])){
    $pg = (int) $_GET['page'];
    $pg--;
    $limit = ($pg * PAGE_C) .','.PAGE_C;
}else{
    $limit = PAGE_C;
}

$req = GetReq($limit);

$smarty->assign('page_title','فهرست برنامه های فردی');

$smarty->assign('reqz',$req);
$smarty->assign('page', $page->RenderX());