<?php

$prefix = GetLinkPrefix('order');

global  $m_type ;
$m_type = array(0 => 'تایید نشده',
    1  => 'تایید شده',
    2  => 'اخراجی');

$listview = new TListView('member_id');
$listview->SetList($this->cls_list);
$listview->AddColum(_lg('Name'), 'member_name', 8);
$listview->AddColum(_lg('Email'), 'member_email', 4);
$listview->AddColum(_lg('Status'), '%am_type|member_type', 2);
$pattern = '<a class="button delete" href="' . UR_MP . 'Member/Delete/%id%"> ' . 
        _lg('Delete') . ' </a>
            <a class="button" href="' . UR_MP . 'Member/Edit/%id%"> ' . 
        _lg('Edit') . ' </a>';
$listview->AddAction($pattern, 4, 'member_type');

$listview->AddFilter(_lg('Pending'), 'member_type', '0');
$listview->AddFilter(_lg('Approved'), 'member_type', '1');
$listview->AddFilter(_lg('Banned'), 'member_type', '2');

$listview->AddBulkAcction(_lg('Pending'), 'Edit', 'member_type,0');
$listview->AddBulkAcction(_lg('Approving'), 'Edit', 'member_type,1');
$listview->AddBulkAcction(_lg('Banning'), 'Edit', 'member_type,2');
$listview->AddBulkAcction(_lg('Delete'), 'Delete', null);

$listview->AddSearch('member_name,member_email,member_number');

$listview->Render('Member');

$this->pagination->Render();

