<?php
//var_dump($this->record);
$frm = new TForm(UR_MP . 'Topic/Update/' . $this->record['topic_id'], 'post', array('class' => 'form rtl'));



$topic_status = array(
    0 => array('0', 'پیش نویس'),
    1 => array('1', ' انتشار عمومی'),
    2 => array('2', 'ویژه اعضا'),
);

$frm->AddField('text', _lg('Title'), $this->record['topic_title'], array('name' => 'topic_title'));
$frm->AddField('text', _lg('Keywords'), $this->record['topic_keyword'], array('name' => 'topic_keyword'));

$frm->AddField('textarea', _lg('Abstract'), $this->record['topic_abstract'], array('name' => 'topic_abstract'));
$frm->AddField('textarea', _lg('Text'), $this->record['topic_text'], array('name' => 'topic_text', 'class' => 'ckeditor'));
//$frm->AddField('spliter', 'تست اسپیلتر');

$frm->AddField('select', _lg('Status'), $this->record['topic_status'], array('name' => 'topic_status'), $topic_status);

$frm->AddField('submit', '', _lg('Edit'));
?>

<h2>
    <?php echo $this->title ?>
</h2>
<div class="general-form">
    <div class="row">
    <?php echo $frm->FormHeader(); ?>
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

    <?php echo $frm->FormFooter(); ?>


        <div class="grd-secondary">
            <div class="ui inverted segment">
                <div class="ui inverted accordion">
                    <div class="active title">
                        <i class="dropdown icon"></i>
                        <?php _lp('Tags') ?>
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
                    'id': <?php echo $this->record['topic_id'] ?>,
                    'minLength': 2,
                    'searchUrl': "<?php echo UR_MP ?>Topic/Search",
                    'changeUrl': "<?php echo UR_MP ?>Topic/TagChange"
                });
            });
        </script>



        <div class="grd-secondary">
            <div class="ui inverted segment">
                <div class="ui inverted accordion">
                    <div class="active title">
                        <i class="dropdown icon"></i>
                        <?php _lp('Attached files') ?>
                    </div>
                    <div class="active content" style="min-height:150px">

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
                        <b>
                            <?php _lp('Attach new file') ?>
                        </b>
                        <br />
                        <form action="<?php echo UR_MP ?>Upload/UploadAttach/attach/<?php echo $this->record['topic_id'] ?>" method='post' enctype='multipart/form-data'>
                            <input type="text"  name="label" maxlength="250" class="input" placeholder="<?php echo _lg('file label'); ?>"/> <br /><br />

                            <input type="file"  name="attach" /> <br />
                            <button class="ui button" type="submit" >
                                <?php echo _lp('Aattch now'); ?>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="grd-secondary">
            <div class="ui inverted segment">
                <div class="ui inverted accordion">
                    <div class="active title">
                        <i class="dropdown icon"></i>
                        <?php _lp('Icon') ?>
                    </div>
                    <div class="active content" style="min-height:150px">
                        <div class="text-center margin">
                            <i class="fa fa-4x <?php echo $this->record['topic_icon'] ?>" id="ico"></i>
                        </div>
                        <br />
                        <button type="submit" class="ui button awesome-select" data-view="#ico" data-awesome="#topic_icon" value="select icon" >
                            <?php echo _lp('Select an icon'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>