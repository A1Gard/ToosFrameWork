<?php

if ( ($topic['topic_status']  ==  2) && (isset($_COOKIE['mtype'],$_COOKIE['mact'])) && ($_COOKIE['mtype'] != 1) && ($_COOKIE['mact'] < time() )  ){
    Redirect('/err');
}


$a = GetAttached($topic['topic_id']);

$r = TRelation::GetInstance();
$likes = $r->GetDestinationCount($topic['topic_id'],REALTION_LIKE);

if (isset($_COOKIE['mid'])){
    $liked = $r->Has($_COOKIE['mid'],$topic['topic_id'],REALTION_LIKE);
}else{
    $liked = FALSE;
}
if($liked){
    $likes--;
}

//$c = CommentChildCount($topic['topic_id'], 0);
$c = ShowCommentByParent($topic['topic_id'], 0, true);

$date = TDate::GetInstance();
 
$topic['topic_time'] = $date->PDate('Y F d H:i',$topic['topic_time']);;
$smarty->assign('topic',$topic);
$smarty->assign('is_attach',(count($a) > 0)?TRUE:FALSE);
$smarty->assign('attach',$a);
$smarty->assign('likes',$likes);
$smarty->assign('liked',$liked);
$smarty->assign('commentz',$c);