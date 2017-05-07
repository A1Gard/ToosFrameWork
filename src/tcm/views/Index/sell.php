<?php
$frm = new TForm(UR_MP . 'Member/Insert', 'post', array('class' => 'ui form'));


$frm->AddField('startgroup');
$frm->AddField('text', 'نام', null, array('name' => 'member_name'));
$frm->AddField('email', 'ایمیل', null, array('name' => 'member_email'));
$frm->AddField('endgroup');

$frm->AddField('startgroup');
$frm->AddField('endgroup');
$frm->AddField('startgroup');
$frm->AddField('text', 'زمان تمدید', null, array('name' => 'member_active_time', 'class' => _lg('datepicker')));
//$frm->AddField('text', 'زمان تمدید', null, array('name' => 'member_active_time', 'class' => ('datepicker')));
$frm->AddField('text', ' ساعت', null, array('name' => 'member_active_time', 'class' => ('timepicker')));
$frm->AddField('endgroup');
$frm->AddField('startgroup');
$frm->AddField('text', 'رشته تحصیلی', null, array('name' => 'member_field'));
$frm->AddField('text', 'شماره تماس', null, array('name' => 'member_number'));
$frm->AddField('text', 'شهر', null, array('name' => 'member_city'));
$frm->AddField('endgroup');
$frm->AddField('select', 'نوع', null, array('name' => 'member_type'), array(0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    2 => array('2', 'اخراجی')));
$frm->AddField('startgroup');
$frm->AddField('select', 'نوع', null, array('name' => 'member_type', 'class' => 'choosen'), array(0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    2 => array('2', 'اخراجی')));
$frm->AddField('list', 'نوع', null, array('name' => 'member_type', 'class' => 'choosen'), array(
    0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    3 => array('3', ' ایران'),
    4 => array('4', ' جهان آرا'),
    5 => array('5', ' زمانی'),
    6 => array('6', ' بیات منش'),
    2 => array('2', 'احمد شاملو')
));
$frm->AddField('text', 'مبلغ', null, array('name' => 'member_city', 'class' => 'currency'));
$frm->AddField('endgroup');
?>

<div class="ui inverted segment">
    <div class="ui inverted accordion">
        <div class="active title">
            <i class="dropdown icon"></i>
            اطلاعات مشتری
        </div>
        <div class="active content">

            <?php $frm->Render(); ?>
        </div>
        <div class="title">
            <i class="dropdown icon"></i>
            اطلاعات محصول
        </div>
        <div class="content">
            <?php
            $prefix = GetLinkPrefix('order');

            $listview = new TListView('topic_id');
            $listview->SetList($this->cls_list);
            $listview->AddColum(_lg('Title'), 'topic_title', 12);
            $listview->AddColum(_lg('Status'), 'topic_status', 2);
            $listview->AddColum(_lg('VC'), 'topic_counter', 2);
            $pattern = '<a class="button ui delete red" href="' . UR_MP . 'Topic/Delete/%id%"> ' .
                    _lg('Delete') . ' </a>
            <a class="button ui blue" href="' . UR_MP . 'Topic/Edit/%id%"> ' .
                    _lg('Edit') . ' </a>';
            $listview->AddAction($pattern, 5, 'topic_status');

            $listview->AddFilter(_lg('Drafted'), 'topic_status', '0');
            $listview->AddFilter(_lg('Published'), 'topic_status', '1');
            $listview->AddFilter(_lg('For members'), 'topic_status', '2');
            $listview->AddFilter(_lg("Viewable"), 'topic_status', '0', 'gt');

            $listview->AddBulkAcction(_lg('Drafting'), 'Edit', 'topic_status,0');
            $listview->AddBulkAcction(_lg('Publishing'), 'Edit', 'topic_status,1');
            $listview->AddBulkAcction(_lg('Set for members'), 'Edit', 'topic_status,2');
            $listview->AddBulkAcction(_lg('Delete'), 'Delete', null);

            $listview->AddSearch('topic_title,topic_text');
            $listview->AddRelation('category_id', 'category_title', 'category', '2', 'book');

            $listview->Render('Topic');

            $this->pagination->Render();
            ?>
        </div>
        <div class="title">
            <i class="dropdown icon"></i>
            اطلاعات تکمیلی
        </div>
        <div class="content">

            <div class="ui form inverted">
                <div class="two fields">
                    <div class="field error">
                        <label>First Name</label>
                        <input placeholder="First Name" type="text">
                    </div>
                    <div class="field">
                        <label>Last Name</label>
                        <input placeholder="Last Name" type="text">
                    </div>
                </div>
                <div class="field error">
                    <label>Gender</label>
                    <div class="ui selection dropdown">
                        <div class="default text">Select</div>
                        <i class="dropdown icon"></i>
                        <input type="hidden" name="gender">
                        <div class="menu">
                            <div class="item" data-value="male">Male</div>
                            <div class="item" data-value="female">Female</div>
                        </div>
                    </div>
                </div>
                <div class="inline field error">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" class="hidden">
                        <label>  امضای الکترونیک و تایید نهایی     </label>
                    </div>
                </div>
                <button class="ui button positive">
                    ثبت اطلاعات
                </button>
                
            </div>
        </div>
    </div>
</div>
<style type="text/css" >
    .title{
        color:#0095dd !important;
        font-weight: 900;
        /*text-align: center;*/
    }
</style>