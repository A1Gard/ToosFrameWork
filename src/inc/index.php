<?php


// sentes
$sen = $reg->GetValue(ROOT_SYSTEM,'sentence');

$arr = unserialize($sen);
$sentes[] = $arr[array_rand($arr)];
$sentes[] = $arr[array_rand($arr)];
$sentes[] = $arr[array_rand($arr)];
$sentes[] = $arr[array_rand($arr)];
$sentes[] = $arr[array_rand($arr)];
$sentes = implode('", "', $sentes);

$news = GetTopicByCategory(1);
$secs = GetTopicByCategory(6);

$ss = unserialize($reg->GetValue(ROOT_SYSTEM,'s'));

$sec_c1 = GetTopicByCategory($ss['1'],4);
$sec_c2 = GetTopicByCategory($ss['2'],4);
$sec_c3 = GetTopic('topic_id DESC',8);


$sec_b = GetTopic('topic_counter DESC',6);

$smarty->assign('sen', $sentes);
$smarty->assign('news', $news);
$smarty->assign('secs', $secs);
$smarty->assign('sec_b', $sec_b);

$smarty->assign('sec_c1', $sec_c1);
$smarty->assign('sec_c2', $sec_c2);
$smarty->assign('sec_c3', $sec_c3);