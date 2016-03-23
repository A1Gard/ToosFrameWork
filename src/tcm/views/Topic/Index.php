<?php

$prefix = GetLinkPrefix('order');

$listview = new TListView('topic_id');
$listview->SetList($this->cls_list);
$listview->AddColum(_lg('Title'), 'topic_title', 12);
$listview->AddColum(_lg('Status'), 'topic_status', 2);
$listview->AddColum(_lg('View Counter'), 'topic_counter', 2);
$pattern = '<a class="button delete" href="' . UR_MP . 'Topic/Delete/%id%"> ' . 
        _lg('Delete') . ' </a>
            <a class="button" href="' . UR_MP . 'Topic/Edit/%id%"> ' . 
        _lg('Edit') . ' </a>';
$listview->AddAction($pattern, 4, 'topic_status');

$listview->AddFilter(_lg('Drafted'), 'topic_status', '0');
$listview->AddFilter(_lg('Published'), 'topic_status', '1');
$listview->AddFilter(_lg('For members'), 'topic_status', '2');
$listview->AddFilter(_lg("Viewable"), 'topic_status', '0','gt');

$listview->AddBulkAcction(_lg('Drafting'), 'Edit', 'topic_status,0');
$listview->AddBulkAcction(_lg('Publishing'), 'Edit', 'topic_status,1');
$listview->AddBulkAcction(_lg('Set for members'), 'Edit', 'topic_status,2');
$listview->AddBulkAcction(_lg('Delete'), 'Delete', null);

$listview->AddSearch('topic_title,topic_text');
$listview->AddRelation('category_id','category_title','category','2','book');

$listview->Render('Topic');

$this->pagination->Render();

