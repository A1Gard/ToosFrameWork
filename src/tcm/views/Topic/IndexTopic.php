<?php

$prefix = GetLinkPrefix('order');

$listview = new TListView('topic_id');
$listview->SetList($this->cls_list);
$listview->AddColum(('Title'), 'topic_title', 12);
$listview->AddColum(('Status'), 'topic_status', 2);
$listview->AddColum(('VC'), 'topic_counter', 2);
$pattern = '<a class="button ui delete red" href="' . UR_MP . 'Topic/Delete/%id%"> ' . 
        ('Delete') . ' </a>
            <a class="button ui blue" href="' . UR_MP . 'Topic/Edit/%id%"> ' . 
        ('Edit') . ' </a>';
$listview->AddAction($pattern, 5, 'topic_status');

$listview->AddFilter(('Drafted'), 'topic_status', '0');
$listview->AddFilter(('Published'), 'topic_status', '1');
$listview->AddFilter(('For members'), 'topic_status', '2');
$listview->AddFilter(("Viewable"), 'topic_status', '0','gt');

$listview->AddBulkAcction(('Drafting'), 'Edit', 'topic_status,0');
$listview->AddBulkAcction(('Publishing'), 'Edit', 'topic_status,1');
$listview->AddBulkAcction(('Set for members'), 'Edit', 'topic_status,2');
$listview->AddBulkAcction(('Delete'), 'Delete', null);

$listview->AddSearch('topic_title,topic_text');
$listview->AddRelation('category_id','category_title','category','2','book');

$listview->Render('Topic');

$this->pagination->Render();

