<?php

$prefix = GetLinkPrefix('order');

$listview = new TListView('manager_id');
$listview->SetList($this->cls_list);
$listview->AddColum(('Username'), 'manager_username', 6);
$listview->AddColum(('Display name'), 'manager_displayname', 5);
$listview->AddColum(('Email'), 'manager_email', 5);
        $pattern = '<a class="ui button delete negative" href="' . UR_MP . 'Manager/Delete/%id%"> '._lg('Delete').' </a>
            <a class="ui button blue" href="' . UR_MP . 'Manager/Edit/%id%">  '._lg('Edit').'</a>';
$listview->AddAction($pattern, 4, '');

$listview->AddFilter(('Protected'), 'manager_protected', '1');
$listview->AddFilter(('Unprotected'), 'manager_protected', '0');
//$listview->AddFilter(' ویژه اعضا', 'topic_status', '2');
//$listview->AddFilter(' قابل نمایش', 'topic_status', '0','gt');
//$listview->AddBulkAcction(' پیش نویس کردن', 'Edit', 'topic_status,0');
//$listview->AddBulkAcction(' انتشار جمعی', 'Edit', 'topic_status,1');
//$listview->AddBulkAcction(' ویژه اعضا کردن جمعی', 'Edit', 'topic_status,2');
$listview->AddBulkAcction( ('Delete'), 'Delete', null);

$listview->Render('Manager');

$this->pagination->Render();

