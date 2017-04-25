<?php
//var_dump($this->record);
$frm = new TForm(UR_MP . 'Topic/Update/' . $this->record['topic_id'], 'post', array('class' => 'form rtl'));



$topic_status = array(
    0 => array('0', 'پیش نویس'),
    1 => array('1', ' انتشار عمومی'),
    2 => array('2', 'ویژه اعضا'),
);

$frm->AddField('text', 'عنوان ', $this->record['topic_title'], array('name' => 'topic_title'));
$frm->AddField('text', ' کلمه کلیدی', $this->record['topic_keyword'], array('name' => 'topic_keyword'));

$frm->AddField('textarea', 'چکیده', $this->record['topic_abstract'], array('name' => 'topic_abstract'));
$frm->AddField('textarea', 'متن', $this->record['topic_text'], array('name' => 'topic_text', 'class' => 'ckeditor'));

$frm->AddField('select', 'وضعیت', $this->record['topic_status'], array('name' => 'topic_status'), $topic_status);
$frm->AddField('hidden', '', $this->record['topic_icon'], array('name' => 'topic_icon', 'id' => 'topic_icon'));
$frm->AddField('submit', '', 'ویرایش یادداشت');
?>

<h2>
    <?php echo $this->title ?>
</h2>
<?php echo $frm->FormHeader(); ?>
<div class="general-form">
    <div class="row">
        <div class="grd-primary">
            <?php echo $frm->FormBody(); ?>
        </div>
        <div class="grd-secondary">
            <div class="ui inverted segment">
                <div class="ui inverted accordion">
                    <div class="active title">
                        <i class="dropdown icon"></i>
                        <?php echo _lp('Categories'); ?>
                    </div>
                    <div class="active content category">
                        <div class="nice_scroll">
                            <?php
                            $cat = new TCategory();
                            echo $cat->GetCategories($this->record['topic_id']);
                            ?>
                        </div>
                        <input type="hidden" name="category[]" value="0" />
                    </div>
                </div>
            </div>

            <input id="id" type="hidden" value="<?php echo $this->record['topic_id'] ?>" />

        </div>



        <div class="grd-secondary">
            <div class="ui inverted segment">
                <div class="ui inverted accordion">
                    <div class="active title">
                        <i class="dropdown icon"></i>
                        برچسب ها

                    </div>
                    <div class="active content" style="min-height:150px">
                        <input class="tags" value="<?php echo $this->tags; ?>" data-ajax="<?php echo UR_MP ?>Topic/Search" data-edit="<?php echo UR_MP ?>Topic/TagChange" >
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo UR_MP ?>assets/js/tag.autocomplete.js"></script>
        <script type="text/javascript">
            $(function () {
                $(".tags").tagautocomplete({
                    'id' : <?php echo $this->record['topic_id'] ?>, 
                    'minLength': 2,
                    'searchUrl': "<?php echo UR_MP ?>Topic/Search",
                    'changeUrl': "<?php echo UR_MP ?>Topic/TagChange"
                });
            });
        </script>
        <div class="grd-secondary" style="padding:1em;">

            <div class="attach">
                <h3>
                    فایل های پیوست شده
                </h3>

                <?php
                if (count($this->attach) > 0) {
                    echo "<ul>";
                    foreach ($this->attach as $attached) {
                        echo '<li><a class="delete" href="' . UR_MP . 'Upload/RemoveAttach/' .
                        $attached['attach_id'] . '/' . $this->record['topic_id'] . '">'
                        . $attached['attach_label'] . '</a></li>';
                    }
                    echo "</ul>";
                }
                ?>
                <?php echo $frm->FormFooter(); ?>
                <br />
                <br />
                <h3>
                    افزودن پیوست
                </h3>
                <br />
                <form action="<?php echo UR_MP ?>Upload/UploadAttach/attach/<?php echo $this->record['topic_id'] ?>" method='post' enctype='multipart/form-data'>
                    <input type="text"  name="label" maxlength="250" class="input" placeholder="<?php echo _lg('file label'); ?>"/> <br /><br />

                    <input type="file"  name="attach" /> <br />
                    <input type="submit"  value="پیوست کن" />

                </form>
            </div>
            <div class="attach">
                <h3>
                    تصویر شاخص
                </h3>
                <img src="<?php echo $this->record['topic_image'] ?>" alt="[تصویر شاخص]" />
                <br />
                <form action="<?php echo UR_MP ?>Topic/Image/<?php echo $this->record['topic_id'] ?>" method='post' enctype='multipart/form-data'>
                    <input type="file"  name="image" /> <br />
                    <input type="submit"  value="عکس را قرار بده" />

                </form>

            </div>

            <div class="attach">
                <h3>
                    Icon
                </h3>
                <div class="text-center margin">
                    <i class="fa fa-4x <?php echo $this->record['topic_icon'] ?>" id="ico"></i>
                </div>
                <br />
                <input type="button" class="input awesome-select" data-view="#ico" data-awesome="#topic_icon" value="select icon" onclick="$('.overlay').fadeIn(600)" />

            </div>

        </div>
    </div>
</div>