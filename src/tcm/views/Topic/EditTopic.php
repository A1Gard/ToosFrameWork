<?php
//var_dump($this->record);
$frm = new TForm(UR_MP . 'Topic/Update/' . $this->record['topic_id'], 'post', array('class' => 'form rtl'));



$topic_status = array(
    0 => array('0', 'پیش نویس'),
    1 => array('1', ' انتشار عمومی'),
    2 => array('2', 'ویژه اعضا'),
);

$frm->AddField('text', ('Title'), $this->record['topic_title'], array('name' => 'topic_title'));
$frm->AddField('hidden', '', $this->record['topic_image'], array('name' => 'topic_image', 'id' => 'topic_image'));
$frm->AddField('text', ('Keywords'), $this->record['topic_keyword'], array('name' => 'topic_keyword'));

$frm->AddField('textarea', ('Abstract'), $this->record['topic_abstract'], array('name' => 'topic_abstract'));
$frm->AddField('textarea', ('Text'), $this->record['topic_text'], array('name' => 'topic_text', 'class' => 'ckeditor'));
//$frm->AddField('spliter', 'تست اسپیلتر');

$frm->AddField('select', ('Status'), $this->record['topic_status'], array('name' => 'topic_status'), $topic_status);

$frm->AddField('submit', '', ('Edit'));
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
                        <button  class="ui button awesome-select" data-view="#ico" data-awesome="#topic_icon" value="<?php echo _lp('Select icon'); ?>" >
                            <?php echo _lp('Select an icon'); ?>
                        </button>
                        <input type="hidden" value="<?php echo $this->record['topic_icon'] ?>" id="topic_icon" name="topic_icon" />
                    </div>
                </div>
            </div>
        </div>


        <?php echo $frm->FormFooter(); ?>


        <div class="grd-secondary">
            <div class="ui inverted segment">
                <div class="ui inverted accordion">
                    <div class="active title">
                        <i class="dropdown icon"></i>
                        <?php _lp('Tags') ?>
                    </div>
                    <div class="ui form inverted">

                        <div class="active content" style="min-height:150px">
                            <input class="tags" value="<?php echo $this->tags; ?>" data-ajax="<?php echo UR_MP ?>Topic/Search" data-edit="<?php echo UR_MP ?>Topic/TagChange" >
                        </div>
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
                        <form class="ui form inverted" action="<?php echo UR_MP ?>Upload/UploadAttach/attach/<?php echo $this->record['topic_id'] ?>" method='post' enctype='multipart/form-data'>
                            <input type="text"  name="label" maxlength="250" class="input" placeholder="<?php echo ('file label'); ?>"/> <br /><br />

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
                        <?php _lp('Index image') ?>
                    </div>
                    <div class="active content" style="min-height:150px">

                        <img src="<?php echo $this->record['topic_image'] ?>" id="index-image" alt="[]"  class="img-responsive img-rounded"/>

                        <br />

                        <div class="ui button" id="index-img">
                            <?php echo _lp('Select index image'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grd24">
            <div class="ui segment inverted" style="overflow: hidden;">
                <h2>
                    <?php echo _lp('Gallery'); ?>
                </h2>

                <div class="">
                    <button class="ui button blue" id="add-to-gallery">
                        <?php echo _lp('Add images to gallery'); ?>
                    </button>
                    <br />
                    <br />

                </div>
                <div class="clearfix"></div>
                <div class="gallery">
                    <div class="ui six column grid" id="gallery-imeges">
                        <?php foreach ($this->gallery as $kimg => $vimg): ?>
                            <div class="column grid del" data-id="<?php echo $vimg['up_id'] ?>">

                                <div class="ui fluid card  selceted">
                                    <div class="image">
                                        <img src="<?php echo UR_BASE . $vimg['up_location'] ?>">
                                    </div> 
                                    <div class="content">
                                        <a class="header">
                                            <?php echo $vimg['up_filename'] ?>
                                        </a>
                                    </div>
                                    <div class="ui bottom attached button red">
                                        <i class="close icon"></i> 
                                        <?php echo _lp('Delete'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(function () {
        $("#index-img").click(function () {
            $.get(UR_MP + 'Upload/UploadList', function (e) {
                upload_list.items = e;
                $('#upload-modal').modal({
                    onApprove: function () {
                        var img_src = ($("#upload-modal .selceted").find('img').attr('src'));
                        $("#index-image").attr('src', img_src);
                        $("#topic_image").val(img_src);
                    },
                    onShow: function () {
                        $('#upload-modal .selceted').removeClass('selceted');
                    }}).modal('show');
                select_index = true;
            });
        });
//
//        $(document).on('click', '.card', function () {
//            if (select_index) {
//                var img_src = ($(this).find('img').attr('src'));
//                $("#index-image").attr('src', img_src);
//                $("#topic_image").val(img_src);
//                $('#upload-modal').modal('hide');
//                select_index = false;
//            }
//        });



        $("#add-to-gallery").click(function () {
            $.get(UR_MP + 'Upload/UploadList', function (e) {
                upload_list.items = e;
                $('#upload-modal').addClass('multiple');
                $('#upload-modal').modal({
                    onApprove: function () {
                        var selected_list = [];
                        $('#upload-modal .selceted').each(function () {
                            $(this).parent().clone().appendTo("#gallery-imeges");
                            selected_list.push($(this).parent().data('id'));
                        });
                        var src_list = selected_list.join(',');
                        $.get('<?php echo UR_MP . CURRENT_EXTENSION ?>/AddRelation/' + src_list + '/<?php echo $this->record['topic_id'] . '/' . REALTION_GALLERY; ?>', function (e) {
                        });
                        $("#gallery-imeges .column:not(.del)").addClass('del').find('.card').append('<div class="ui bottom attached button red"><i class="close icon"></i> <?php _lp('Delete') ?> </div>');
                    }, onHide: function () {
                        $('#upload-modal').removeClass('multiple');
                    },
                    onShow: function () {
                        $('#upload-modal .selceted').removeClass('selceted');
                    }}).modal('show');
            });
        });


        $(document).on('click', '#gallery-imeges .red', function () {
            $.get('<?php echo UR_MP . CURRENT_EXTENSION ?>/RemoveRelation/' + $(this).closest('.column').data('id') + '/<?php echo $this->record['topic_id'] . '/' . REALTION_GALLERY; ?>', function (e) {
            });
            $(this).closest('.column').slideDown(300).delay(300).remove();
        });
    });
</script>