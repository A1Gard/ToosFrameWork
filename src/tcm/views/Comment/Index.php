<?php

$prefix = GetLinkPrefix('order');

$listview = new TListView('comment_id');
$listview->SetList($this->cls_list);
$listview->SetPattern(1, '<img src="' . UR_MP_ASSETS . 'images/comment%s.png" alt="[comment status]" />');
$listview->AddColum(_lg('Status'), '%1comment_status', 2);
$listview->AddColum(_lg('ip'), '%icomment_ip', 3);
$listview->AddColum(_lg("Datetime"), '%ucomment_time', 3);
$listview->AddColum(_lg('Commenter'), 'manager_displayname,member_name', 3);
$listview->AddColum(_lg('title'), 'topic_title', 7);
$listview->AddColum('', 'comment_text', 16);
$pattern = '<a class="button delete" href="' . UR_MP . 'Comment/Delete/%id%"> ' . _lg('Delete') . ' </a>
                <a class="button approve" href="' . UR_MP . 'Comment/Status/%id%/1"> ' . _lg('Approve') . ' </a>
                <a class="button unapprove" href="' . UR_MP . 'Comment/Status/%id%/2">  ' . _lg('Unapprove') . '    </a>
                <a class="button pendding" href="' . UR_MP . 'Comment/Status/%id%/0"> ' . _lg('Return to pendding') . '</a>
                <a class="button reply" href="' . UR_MP . 'Comment/NewComment/%id%/%topic%">' . _lg('Replay') . '</a>';
$listview->AddAction($pattern, 8, 'comment_status');


$listview->AddFilter('در انتظار بررسی ', 'comment_status', '0');
$listview->AddFilter('تاییده شده', 'comment_status', '1');
$listview->AddFilter('  رد شده ', 'comment_status', '2');

$listview->AddBulkAcction('  بازگشت به بررسی', 'Edit', 'comment_status,0');
$listview->AddBulkAcction('  تایید کردن', 'Edit', 'comment_status,1');
$listview->AddBulkAcction('    رد کردن', 'Edit', 'comment_status,2');
$listview->AddBulkAcction(' حذف', 'Delete', null);

$listview->Render('Comment');

$this->pagination->Render();


