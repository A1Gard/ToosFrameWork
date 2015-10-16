<?php

$topix = GetTopicByLiker($url[1], 10);
$smarty->assign('topix',$topix);

$r = TRelation::GetInstance();

$member['likes'] = $r->GetSourceCount($url[1], REALTION_LIKE);
$member['frinds'] = $r->GetSourceCount($url[1], REALTION_FRIEND);
$member['comz'] = GetCount('comment',' comment_member_id = ' . ( (int) $_COOKIE['mid']  ));

$smarty->assign('member',$member);

$smarty->assign('frindz',GetFrienz($url[1]));
$idd = (isset($_COOKIE['mid'])?$_COOKIE['mid']:0);
$smarty->assign('is_f',$r->Has($idd,$url[1],REALTION_FRIEND));