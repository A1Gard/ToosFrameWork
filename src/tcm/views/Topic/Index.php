<?php

$prefix = GetLinkPrefix('order');

$listview = new TListView('topic_id');
$listview->SetList($this->cls_list);
$listview->AddColum('عنوان', 'topic_title', 12);
$listview->AddColum('وضعیت', 'topic_status', 2);
$listview->AddColum('تعداد نمایش', 'topic_counter', 2);
$pattern = '<a class="button delete" href="' . UR_MP . 'Topic/Delete/%id%"> حذف </a>
            <a class="button" href="' . UR_MP . 'Topic/Edit/%id%"> ویرایش </a>';
$listview->AddAction($pattern, 4, 'topic_status');

$listview->AddFilter('پیش نویس', 'topic_status', '0');
$listview->AddFilter(' انتشار عمومی', 'topic_status', '1');
$listview->AddFilter(' ویژه اعضا', 'topic_status', '2');

$listview->AddBulkAcction(' پیش نویس کردن', 'Edit', 'topic_status,0');
$listview->AddBulkAcction(' انتشار جمعی', 'Edit', 'topic_status,1');
$listview->AddBulkAcction(' ویژه اعضا کردن جمعی', 'Edit', 'topic_status,2');
$listview->AddBulkAcction(' حذف', 'Delete', null);

$listview->Render('Topic');

$this->pagination->Render();

