<?php
//var_dump($this->record);
$date = TDate::GetInstance();
$frm = new TForm(UR_MP . 'Member/Update/' . $this->record['member_id'], 'post', array('class' => 'form rtl'));
$frm->AddField('text', 'نام', $this->record['member_name'], array('name' => 'member_name'));
$frm->AddField('email', 'ایمیل', $this->record['member_email'], array('name' => 'member_email'));
$frm->AddField('password', 'گذرواژه', null, array('name' => 'member_password'));
$frm->AddField('text', 'استاتوس', $this->record['member_status'], array('name' => 'member_status'));
$frm->AddField('text', 'زمان تمدید', $date->PDate('Y/m/d', $this->record['member_active_time']), array('name' => 'member_active_time','class'=>'Pdatepicker'));
$frm->AddField('file', 'آواتار', $this->record['member_id'], array('name' => 'member_avatar'));

$frm->AddField('text', 'مقطع', $this->record['member_degree'], array('name' => 'member_degree'));
$frm->AddField('text', 'رشته تحصیلی', $this->record['member_field'], array('name' => 'member_field'));
$frm->AddField('text', 'شماره تماس', $this->record['member_number'], array('name' => 'member_number'));
$frm->AddField('text', 'شهر', $this->record['member_city'], array('name' => 'member_city'));
$frm->AddField('textarea', 'توصیه مشاور/ پشتیبان', $this->record['member_comment'], array('name' => 'member_comment', 'class' => 'full-width'));
$frm->AddField('select', 'نوع', $this->record['member_type'], array('name' => 'member_type'), array(0 => array('0', 'تایید نشده'),
    1 => array('1', 'تایید شده'),
    2 => array('2', 'اخراجی')));
$frm->AddField('select', 'وضعیت چت', $this->record['member_chat'], array('name' => 'member_chat'), array(0 => array('1', ' فعال'),
    1 => array('0', 'اخراجی')));

$frm->AddField('submit', '', 'ویرایش');
//print_r($this->reports);
?>
<br />
<h2 class="rtl">
    <?php echo  $this->title ?>
</h2>
<br />
<br />
<div class="row">
    <div class="grd-primary">
        <?php $frm->Render(); ?>
    </div>
    <div class="grd-secondary">
        <div class="attach" dir="rtl">
            <b>لیست کارنامه ها:</b>

            <ul>
                <?php
                foreach ($this->reports as $rep) {
                    echo '<li><a class="delete" href="' . UR_MP . 'Member/RemoveReport/' .
                    $rep['report_id'] . '">'
                    . $rep['report_title'] . '</a></li>';
                }
                ?>
                <li>
                    <a href="<?php echo  UR_MP . 'Member/Report/'.$this->record['member_id'] ?>">
                        افزودن کارنامه
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>



