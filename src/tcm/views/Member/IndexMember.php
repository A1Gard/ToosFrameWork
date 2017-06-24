<?php

$prefix = GetLinkPrefix('order');

global  $m_type ;
$m_type = array(0 => 'تایید نشده',
    1  => 'تایید شده',
    2  => 'اخراجی');

$listview = new TListView('member_id');
$listview->SetList($this->cls_list);
$listview->AddColum(('Name'), 'member_name', 4);
$listview->AddColum(('Time'), '%umember_register_time', 4);
$listview->AddColum(('Email'), 'member_email', 4);
$listview->AddColum(('Status'), '%am_type|member_type', 2);
$pattern = '<a class="ui button delete" href="' . UR_MP . 'Member/Delete/%id%"> ' . 
        _lg('Delete') . ' </a>
            <a class="ui button" href="' . UR_MP . 'Member/Edit/%id%"> ' . 
        _lg('Edit') . ' </a>';
$listview->AddAction($pattern, 4, 'member_type');

$listview->AddFilter(('Pending'), 'member_type', '0');
$listview->AddFilter(('Approved'), 'member_type', '1');
$listview->AddFilter(('Banned'), 'member_type', '2');

$listview->AddBulkAcction(('Pending'), 'Edit', 'member_type,0');
$listview->AddBulkAcction(('Approving'), 'Edit', 'member_type,1');
$listview->AddBulkAcction(('Banning'), 'Edit', 'member_type,2');
$listview->AddBulkAcction(('Delete'), 'Delete', null);

$listview->AddSearch('member_name,member_email,member_number');

$listview->Render('Member');

$this->pagination->Render();

