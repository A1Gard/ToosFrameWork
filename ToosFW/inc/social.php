<?php

if (!isset($_COOKIE['mid'])) {
    Redirect('/msg/شما وارد نشده اید');
}

$topix = GetTopicByLiker($_COOKIE['mid'], 10);
$a = new Model('member','member_');
$mem = $a->GetRecord($_COOKIE['mid']);

$rep = new Model('report', 'report_');
$repz = $rep->Read('report_id,report_title',99,'report','report_');


$smarty->assign('topix',$topix);
$smarty->assign('left',  floor(($_COOKIE['mact'] - time()) / (60*60*24)));
$smarty->assign('frindz',GetFrienz($_COOKIE['mid'],999));
$smarty->assign('mem',$mem);
$smarty->assign('repz',$repz);

