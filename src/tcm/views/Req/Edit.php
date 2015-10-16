<?php
//var_dump($this->record);
$date = TDate::GetInstance();
$frm = new TForm(UR_MP . 'Req/Update/' . $this->record['req_id'], 'post', array('class' => 'form rtl'));
$frm->AddField('text', 'عنوان', $this->record['req_title'], array('name' => 'req_title'));
$frm->AddField('textarea', 'درخواست', $this->record['req_text'], array('name' => 'req_text','class'=>'ckeditor'));
$frm->AddField('textarea', 'پاسخ', $this->record['req_answer'], array('name' => 'req_answer','class'=>'ckeditor'));

$frm->AddField('select', 'نوع', $this->record['req_status'], array('name' => 'req_status'), 
        array(0 => array('0', 'تایید نشده'), 
              1 => array('1', 'تایید شده')
              ));
$frm->AddField('submit', '', 'ویرایش');

?>
<br />
<h2 class="rtl">
<?php echo  $this->title ?>
</h2>
<br />
<br />
<?php $frm->Render(); ?>
        


