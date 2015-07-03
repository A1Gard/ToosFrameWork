<?php
//var_dump($this->record);
$frm = new TForm(UR_CM . 'Topic/Update/' . $this->record['topic_id'], 'post', array('class' => 'form rtl'));



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
$frm->AddField('hiddem', '', $this->record['topic_icon'], array('name' => 'topic_icon','id'=>'topic_icon'));
$frm->AddField('submit', '', 'ویرایش یادداشت');
?>

<br />
<h2 class="rtl">
    <?= $this->title ?>
</h2>
<br />
<br />
<?= $frm->FormHeader(); ?>
<div class="row">
    <div class="grd-primary">
        <?= $frm->FormBody(); ?>
    </div>
    <div class="grd-secondary" style="padding:1em;">

        <input class="tags" value="<?= $this->tags; ?>" data-ajax="<?= UR_CM ?>Topic/Search" data-edit="<?= UR_CM ?>Topic/TagChange" >
        <input id="id" type="hidden" value="<?= $this->record['topic_id'] ?>" />

        <div class="category">
            <h3>
                دسته بندی
            </h3>

            <?php
            $cat = new TCategory();
            echo $cat->GetCategories($this->record['topic_id']);
            ?>
            <input type="hidden" name="category[]" value="0" />
        </div>

        <div class="attach">
            <h3>
                فایل های پیوست شده
            </h3>

            <?php
            if (count($this->attach) > 0) {
                echo "<ul>";
                foreach ($this->attach as $attached) {
                    echo '<li><a class="delete" href="' . UR_CM . 'Upload/RemoveAttach/' .
                    $attached['attach_id'] . '/' . $this->record['topic_id'] . '">'
                    . $attached['attach_label'] . '</a></li>';
                }
                echo "</ul>";
            }
            ?>
            <?= $frm->FormFooter(); ?>
            <br />
            <br />
            <h3>
                افزودن پیوست
            </h3>
            <br />
            <form action="<?= UR_CM ?>Upload/UploadAttach/attach/<?= $this->record['topic_id'] ?>" method='post' enctype='multipart/form-data'>
                <input type="text"  name="label" maxlength="250" class="input" placeholder="<?= _lg('file label'); ?>"/> <br /><br />

                <input type="file"  name="attach" /> <br />
                <input type="submit"  value="پیوست کن" />

            </form>
        </div>
        <div class="attach">
            <h3>
                تصویر شاخص
            </h3>
            <img src="<?= $this->record['topic_image'] ?>" alt="[تصویر شاخص]" />
            <br />
            <form action="<?= UR_CM ?>Topic/Image/<?= $this->record['topic_id'] ?>" method='post' enctype='multipart/form-data'>
                <input type="file"  name="image" /> <br />
                <input type="submit"  value="عکس را قرار بده" />

            </form>

        </div>
        
        <div class="attach">
            <h3>
                Icon
            </h3>
            <div class="text-center margin">
                <i class="fa fa-4x <?= $this->record['topic_icon'] ?>" id="ico"></i>
            </div>
            <br />
            <input type="button" class="input" value="select icon" onclick="$('#overlay').fadeIn(600)" />

        </div>
        
    </div>
</div>
<div id="overlay">
    <div class="awesome">
        <input type="button" value="X" class="red" id="close-overlay" />
        <ul id="font-list">
            <li> <i class="fa fa-glass"></i> </li>
            <li> <i class="fa fa-music"></i> </li>
            <li> <i class="fa fa-search"></i> </li>
            <li> <i class="fa fa-envelope-o"></i> </li>
            <li> <i class="fa fa-heart"></i> </li>
            <li> <i class="fa fa-star"></i> </li>
            <li> <i class="fa fa-star-o"></i> </li>
            <li> <i class="fa fa-user"></i> </li>
            <li> <i class="fa fa-film"></i> </li>
            <li> <i class="fa fa-th-large"></i> </li>
            <li> <i class="fa fa-th"></i> </li>
            <li> <i class="fa fa-th-list"></i> </li>
            <li> <i class="fa fa-check"></i> </li>
            <li> <i class="fa fa-times"></i> </li>
            <li> <i class="fa fa-search-plus"></i> </li>
            <li> <i class="fa fa-search-minus"></i> </li>
            <li> <i class="fa fa-power-off"></i> </li>
            <li> <i class="fa fa-signal"></i> </li>
            <li> <i class="fa fa-gear"></i> </li>
            <li> <i class="fa fa-trash-o"></i> </li>
            <li> <i class="fa fa-home"></i> </li>
            <li> <i class="fa fa-file-o"></i> </li>
            <li> <i class="fa fa-clock-o"></i> </li>
            <li> <i class="fa fa-road"></i> </li>
            <li> <i class="fa fa-download"></i> </li>
            <li> <i class="fa fa-arrow-circle-o-down"></i> </li>
            <li> <i class="fa fa-arrow-circle-o-up"></i> </li>
            <li> <i class="fa fa-inbox"></i> </li>
            <li> <i class="fa fa-play-circle-o"></i> </li>
            <li> <i class="fa fa-rotate-right"></i> </li>
            <li> <i class="fa fa-refresh"></i> </li>
            <li> <i class="fa fa-list-alt"></i> </li>
            <li> <i class="fa fa-lock"></i> </li>
            <li> <i class="fa fa-flag"></i> </li>
            <li> <i class="fa fa-headphones"></i> </li>
            <li> <i class="fa fa-volume-off"></i> </li>
            <li> <i class="fa fa-volume-down"></i> </li>
            <li> <i class="fa fa-volume-up"></i> </li>
            <li> <i class="fa fa-qrcode"></i> </li>
            <li> <i class="fa fa-barcode"></i> </li>
            <li> <i class="fa fa-tag"></i> </li>
            <li> <i class="fa fa-tags"></i> </li>
            <li> <i class="fa fa-book"></i> </li>
            <li> <i class="fa fa-bookmark"></i> </li>
            <li> <i class="fa fa-print"></i> </li>
            <li> <i class="fa fa-camera"></i> </li>
            <li> <i class="fa fa-font"></i> </li>
            <li> <i class="fa fa-bold"></i> </li>
            <li> <i class="fa fa-italic"></i> </li>
            <li> <i class="fa fa-text-height"></i> </li>
            <li> <i class="fa fa-text-width"></i> </li>
            <li> <i class="fa fa-align-left"></i> </li>
            <li> <i class="fa fa-align-center"></i> </li>
            <li> <i class="fa fa-align-right"></i> </li>
            <li> <i class="fa fa-align-justify"></i> </li>
            <li> <i class="fa fa-list"></i> </li>
            <li> <i class="fa fa-dedent"></i> </li>
            <li> <i class="fa fa-indent"></i> </li>
            <li> <i class="fa fa-video-camera"></i> </li>
            <li> <i class="fa fa-picture-o"></i> </li>
            <li> <i class="fa fa-pencil"></i> </li>
            <li> <i class="fa fa-map-marker"></i> </li>
            <li> <i class="fa fa-adjust"></i> </li>
            <li> <i class="fa fa-tint"></i> </li>
            <li> <i class="fa fa-edit"></i> </li>
            <li> <i class="fa fa-share-square-o"></i> </li>
            <li> <i class="fa fa-check-square-o"></i> </li>
            <li> <i class="fa fa-arrows"></i> </li>
            <li> <i class="fa fa-step-backward"></i> </li>
            <li> <i class="fa fa-fast-backward"></i> </li>
            <li> <i class="fa fa-backward"></i> </li>
            <li> <i class="fa fa-play"></i> </li>
            <li> <i class="fa fa-pause"></i> </li>
            <li> <i class="fa fa-stop"></i> </li>
            <li> <i class="fa fa-forward"></i> </li>
            <li> <i class="fa fa-fast-forward"></i> </li>
            <li> <i class="fa fa-step-forward"></i> </li>
            <li> <i class="fa fa-eject"></i> </li>
            <li> <i class="fa fa-chevron-left"></i> </li>
            <li> <i class="fa fa-chevron-right"></i> </li>
            <li> <i class="fa fa-plus-circle"></i> </li>
            <li> <i class="fa fa-minus-circle"></i> </li>
            <li> <i class="fa fa-times-circle"></i> </li>
            <li> <i class="fa fa-check-circle"></i> </li>
            <li> <i class="fa fa-question-circle"></i> </li>
            <li> <i class="fa fa-info-circle"></i> </li>
            <li> <i class="fa fa-crosshairs"></i> </li>
            <li> <i class="fa fa-times-circle-o"></i> </li>
            <li> <i class="fa fa-check-circle-o"></i> </li>
            <li> <i class="fa fa-ban"></i> </li>
            <li> <i class="fa fa-arrow-left"></i> </li>
            <li> <i class="fa fa-arrow-right"></i> </li>
            <li> <i class="fa fa-arrow-up"></i> </li>
            <li> <i class="fa fa-arrow-down"></i> </li>
            <li> <i class="fa fa-mail-forward"></i> </li>
            <li> <i class="fa fa-expand"></i> </li>
            <li> <i class="fa fa-compress"></i> </li>
            <li> <i class="fa fa-plus"></i> </li>
            <li> <i class="fa fa-minus"></i> </li>
            <li> <i class="fa fa-asterisk"></i> </li>
            <li> <i class="fa fa-exclamation-circle"></i> </li>
            <li> <i class="fa fa-gift"></i> </li>
            <li> <i class="fa fa-leaf"></i> </li>
            <li> <i class="fa fa-fire"></i> </li>
            <li> <i class="fa fa-eye"></i> </li>
            <li> <i class="fa fa-eye-slash"></i> </li>
            <li> <i class="fa fa-warning"></i> </li>
            <li> <i class="fa fa-plane"></i> </li>
            <li> <i class="fa fa-calendar"></i> </li>
            <li> <i class="fa fa-random"></i> </li>
            <li> <i class="fa fa-comment"></i> </li>
            <li> <i class="fa fa-magnet"></i> </li>
            <li> <i class="fa fa-chevron-up"></i> </li>
            <li> <i class="fa fa-chevron-down"></i> </li>
            <li> <i class="fa fa-retweet"></i> </li>
            <li> <i class="fa fa-shopping-cart"></i> </li>
            <li> <i class="fa fa-folder"></i> </li>
            <li> <i class="fa fa-folder-open"></i> </li>
            <li> <i class="fa fa-arrows-v"></i> </li>
            <li> <i class="fa fa-arrows-h"></i> </li>
            <li> <i class="fa fa-bar-chart-o"></i> </li>
            <li> <i class="fa fa-twitter-square"></i> </li>
            <li> <i class="fa fa-facebook-square"></i> </li>
            <li> <i class="fa fa-camera-retro"></i> </li>
            <li> <i class="fa fa-key"></i> </li>
            <li> <i class="fa fa-gears"></i> </li>
            <li> <i class="fa fa-comments"></i> </li>
            <li> <i class="fa fa-thumbs-o-up"></i> </li>
            <li> <i class="fa fa-thumbs-o-down"></i> </li>
            <li> <i class="fa fa-star-half"></i> </li>
            <li> <i class="fa fa-heart-o"></i> </li>
            <li> <i class="fa fa-sign-out"></i> </li>
            <li> <i class="fa fa-linkedin-square"></i> </li>
            <li> <i class="fa fa-thumb-tack"></i> </li>
            <li> <i class="fa fa-external-link"></i> </li>
            <li> <i class="fa fa-sign-in"></i> </li>
            <li> <i class="fa fa-trophy"></i> </li>
            <li> <i class="fa fa-github-square"></i> </li>
            <li> <i class="fa fa-upload"></i> </li>
            <li> <i class="fa fa-lemon-o"></i> </li>
            <li> <i class="fa fa-phone"></i> </li>
            <li> <i class="fa fa-square-o"></i> </li>
            <li> <i class="fa fa-bookmark-o"></i> </li>
            <li> <i class="fa fa-phone-square"></i> </li>
            <li> <i class="fa fa-twitter"></i> </li>
            <li> <i class="fa fa-facebook"></i> </li>
            <li> <i class="fa fa-github"></i> </li>
            <li> <i class="fa fa-unlock"></i> </li>
            <li> <i class="fa fa-credit-card"></i> </li>
            <li> <i class="fa fa-rss"></i> </li>
            <li> <i class="fa fa-hdd-o"></i> </li>
            <li> <i class="fa fa-bullhorn"></i> </li>
            <li> <i class="fa fa-bell"></i> </li>
            <li> <i class="fa fa-certificate"></i> </li>
            <li> <i class="fa fa-hand-o-right"></i> </li>
            <li> <i class="fa fa-hand-o-left"></i> </li>
            <li> <i class="fa fa-hand-o-up"></i> </li>
            <li> <i class="fa fa-hand-o-down"></i> </li>
            <li> <i class="fa fa-arrow-circle-left"></i> </li>
            <li> <i class="fa fa-arrow-circle-right"></i> </li>
            <li> <i class="fa fa-arrow-circle-up"></i> </li>
            <li> <i class="fa fa-arrow-circle-down"></i> </li>
            <li> <i class="fa fa-globe"></i> </li>
            <li> <i class="fa fa-wrench"></i> </li>
            <li> <i class="fa fa-tasks"></i> </li>
            <li> <i class="fa fa-filter"></i> </li>
            <li> <i class="fa fa-briefcase"></i> </li>
            <li> <i class="fa fa-arrows-alt"></i> </li>
            <li> <i class="fa fa-group"></i> </li>
            <li> <i class="fa fa-chain"></i> </li>
            <li> <i class="fa fa-cloud"></i> </li>
            <li> <i class="fa fa-flask"></i> </li>
            <li> <i class="fa fa-cut"></i> </li>
            <li> <i class="fa fa-copy"></i> </li>
            <li> <i class="fa fa-paperclip"></i> </li>
            <li> <i class="fa fa-save"></i> </li>
            <li> <i class="fa fa-square"></i> </li>
            <li> <i class="fa fa-bars"></i> </li>
            <li> <i class="fa fa-list-ul"></i> </li>
            <li> <i class="fa fa-list-ol"></i> </li>
            <li> <i class="fa fa-strikethrough"></i> </li>
            <li> <i class="fa fa-underline"></i> </li>
            <li> <i class="fa fa-table"></i> </li>
            <li> <i class="fa fa-magic"></i> </li>
            <li> <i class="fa fa-truck"></i> </li>
            <li> <i class="fa fa-pinterest"></i> </li>
            <li> <i class="fa fa-pinterest-square"></i> </li>
            <li> <i class="fa fa-google-plus-square"></i> </li>
            <li> <i class="fa fa-google-plus"></i> </li>
            <li> <i class="fa fa-money"></i> </li>
            <li> <i class="fa fa-caret-down"></i> </li>
            <li> <i class="fa fa-caret-up"></i> </li>
            <li> <i class="fa fa-caret-left"></i> </li>
            <li> <i class="fa fa-caret-right"></i> </li>
            <li> <i class="fa fa-columns"></i> </li>
            <li> <i class="fa fa-unsorted"></i> </li>
            <li> <i class="fa fa-sort-down"></i> </li>
            <li> <i class="fa fa-sort-up"></i> </li>
            <li> <i class="fa fa-envelope"></i> </li>
            <li> <i class="fa fa-linkedin"></i> </li>
            <li> <i class="fa fa-rotate-left"></i> </li>
            <li> <i class="fa fa-legal"></i> </li>
            <li> <i class="fa fa-dashboard"></i> </li>
            <li> <i class="fa fa-comment-o"></i> </li>
            <li> <i class="fa fa-comments-o"></i> </li>
            <li> <i class="fa fa-flash"></i> </li>
            <li> <i class="fa fa-sitemap"></i> </li>
            <li> <i class="fa fa-umbrella"></i> </li>
            <li> <i class="fa fa-paste"></i> </li>
            <li> <i class="fa fa-lightbulb-o"></i> </li>
            <li> <i class="fa fa-exchange"></i> </li>
            <li> <i class="fa fa-cloud-download"></i> </li>
            <li> <i class="fa fa-cloud-upload"></i> </li>
            <li> <i class="fa fa-user-md"></i> </li>
            <li> <i class="fa fa-stethoscope"></i> </li>
            <li> <i class="fa fa-suitcase"></i> </li>
            <li> <i class="fa fa-bell-o"></i> </li>
            <li> <i class="fa fa-coffee"></i> </li>
            <li> <i class="fa fa-cutlery"></i> </li>
            <li> <i class="fa fa-file-text-o"></i> </li>
            <li> <i class="fa fa-building-o"></i> </li>
            <li> <i class="fa fa-hospital-o"></i> </li>
            <li> <i class="fa fa-ambulance"></i> </li>
            <li> <i class="fa fa-medkit"></i> </li>
            <li> <i class="fa fa-fighter-jet"></i> </li>
            <li> <i class="fa fa-beer"></i> </li>
            <li> <i class="fa fa-h-square"></i> </li>
            <li> <i class="fa fa-plus-square"></i> </li>
            <li> <i class="fa fa-angle-double-left"></i> </li>
            <li> <i class="fa fa-angle-double-right"></i> </li>
            <li> <i class="fa fa-angle-double-up"></i> </li>
            <li> <i class="fa fa-angle-double-down"></i> </li>
            <li> <i class="fa fa-angle-left"></i> </li>
            <li> <i class="fa fa-angle-right"></i> </li>
            <li> <i class="fa fa-angle-up"></i> </li>
            <li> <i class="fa fa-angle-down"></i> </li>
            <li> <i class="fa fa-desktop"></i> </li>
            <li> <i class="fa fa-laptop"></i> </li>
            <li> <i class="fa fa-tablet"></i> </li>
            <li> <i class="fa fa-mobile-phone"></i> </li>
            <li> <i class="fa fa-circle-o"></i> </li>
            <li> <i class="fa fa-quote-left"></i> </li>
            <li> <i class="fa fa-quote-right"></i> </li>
            <li> <i class="fa fa-spinner"></i> </li>
            <li> <i class="fa fa-circle"></i> </li>
            <li> <i class="fa fa-mail-reply"></i> </li>
            <li> <i class="fa fa-github-alt"></i> </li>
            <li> <i class="fa fa-folder-o"></i> </li>
            <li> <i class="fa fa-folder-open-o"></i> </li>
            <li> <i class="fa fa-smile-o"></i> </li>
            <li> <i class="fa fa-frown-o"></i> </li>
            <li> <i class="fa fa-meh-o"></i> </li>
            <li> <i class="fa fa-gamepad"></i> </li>
            <li> <i class="fa fa-keyboard-o"></i> </li>
            <li> <i class="fa fa-flag-o"></i> </li>
            <li> <i class="fa fa-flag-checkered"></i> </li>
            <li> <i class="fa fa-terminal"></i> </li>
            <li> <i class="fa fa-code"></i> </li>
            <li> <i class="fa fa-reply-all"></i> </li>
            <li> <i class="fa fa-mail-reply-all"></i> </li>
            <li> <i class="fa fa-star-half-empty"></i> </li>
            <li> <i class="fa fa-location-arrow"></i> </li>
            <li> <i class="fa fa-crop"></i> </li>
            <li> <i class="fa fa-code-fork"></i> </li>
            <li> <i class="fa fa-unlink"></i> </li>
            <li> <i class="fa fa-question"></i> </li>
            <li> <i class="fa fa-info"></i> </li>
            <li> <i class="fa fa-exclamation"></i> </li>
            <li> <i class="fa fa-superscript"></i> </li>
            <li> <i class="fa fa-subscript"></i> </li>
            <li> <i class="fa fa-eraser"></i> </li>
            <li> <i class="fa fa-puzzle-piece"></i> </li>
            <li> <i class="fa fa-microphone"></i> </li>
            <li> <i class="fa fa-microphone-slash"></i> </li>
            <li> <i class="fa fa-shield"></i> </li>
            <li> <i class="fa fa-calendar-o"></i> </li>
            <li> <i class="fa fa-fire-extinguisher"></i> </li>
            <li> <i class="fa fa-rocket"></i> </li>
            <li> <i class="fa fa-maxcdn"></i> </li>
            <li> <i class="fa fa-chevron-circle-left"></i> </li>
            <li> <i class="fa fa-chevron-circle-right"></i> </li>
            <li> <i class="fa fa-chevron-circle-up"></i> </li>
            <li> <i class="fa fa-chevron-circle-down"></i> </li>
            <li> <i class="fa fa-html5"></i> </li>
            <li> <i class="fa fa-css3"></i> </li>
            <li> <i class="fa fa-anchor"></i> </li>
            <li> <i class="fa fa-unlock-alt"></i> </li>
            <li> <i class="fa fa-bullseye"></i> </li>
            <li> <i class="fa fa-ellipsis-h"></i> </li>
            <li> <i class="fa fa-ellipsis-v"></i> </li>
            <li> <i class="fa fa-rss-square"></i> </li>
            <li> <i class="fa fa-play-circle"></i> </li>
            <li> <i class="fa fa-ticket"></i> </li>
            <li> <i class="fa fa-minus-square"></i> </li>
            <li> <i class="fa fa-minus-square-o"></i> </li>
            <li> <i class="fa fa-level-up"></i> </li>
            <li> <i class="fa fa-level-down"></i> </li>
            <li> <i class="fa fa-check-square"></i> </li>
            <li> <i class="fa fa-pencil-square"></i> </li>
            <li> <i class="fa fa-external-link-square"></i> </li>
            <li> <i class="fa fa-share-square"></i> </li>
            <li> <i class="fa fa-compass"></i> </li>
            <li> <i class="fa fa-toggle-down"></i> </li>
            <li> <i class="fa fa-toggle-up"></i> </li>
            <li> <i class="fa fa-toggle-right"></i> </li>
            <li> <i class="fa fa-euro"></i> </li>
            <li> <i class="fa fa-gbp"></i> </li>
            <li> <i class="fa fa-dollar"></i> </li>
            <li> <i class="fa fa-rupee"></i> </li>
            <li> <i class="fa fa-cny"></i> </li>
            <li> <i class="fa fa-ruble"></i> </li>
            <li> <i class="fa fa-won"></i> </li>
            <li> <i class="fa fa-bitcoin"></i> </li>
            <li> <i class="fa fa-file"></i> </li>
            <li> <i class="fa fa-file-text"></i> </li>
            <li> <i class="fa fa-sort-alpha-asc"></i> </li>
            <li> <i class="fa fa-sort-alpha-desc"></i> </li>
            <li> <i class="fa fa-sort-amount-asc"></i> </li>
            <li> <i class="fa fa-sort-amount-desc"></i> </li>
            <li> <i class="fa fa-sort-numeric-asc"></i> </li>
            <li> <i class="fa fa-sort-numeric-desc"></i> </li>
            <li> <i class="fa fa-thumbs-up"></i> </li>
            <li> <i class="fa fa-thumbs-down"></i> </li>
            <li> <i class="fa fa-youtube-square"></i> </li>
            <li> <i class="fa fa-youtube"></i> </li>
            <li> <i class="fa fa-xing"></i> </li>
            <li> <i class="fa fa-xing-square"></i> </li>
            <li> <i class="fa fa-youtube-play"></i> </li>
            <li> <i class="fa fa-dropbox"></i> </li>
            <li> <i class="fa fa-stack-overflow"></i> </li>
            <li> <i class="fa fa-instagram"></i> </li>
            <li> <i class="fa fa-flickr"></i> </li>
            <li> <i class="fa fa-adn"></i> </li>
            <li> <i class="fa fa-bitbucket"></i> </li>
            <li> <i class="fa fa-bitbucket-square"></i> </li>
            <li> <i class="fa fa-tumblr"></i> </li>
            <li> <i class="fa fa-tumblr-square"></i> </li>
            <li> <i class="fa fa-long-arrow-down"></i> </li>
            <li> <i class="fa fa-long-arrow-up"></i> </li>
            <li> <i class="fa fa-long-arrow-left"></i> </li>
            <li> <i class="fa fa-long-arrow-right"></i> </li>
            <li> <i class="fa fa-apple"></i> </li>
            <li> <i class="fa fa-windows"></i> </li>
            <li> <i class="fa fa-android"></i> </li>
            <li> <i class="fa fa-linux"></i> </li>
            <li> <i class="fa fa-dribbble"></i> </li>
            <li> <i class="fa fa-skype"></i> </li>
            <li> <i class="fa fa-foursquare"></i> </li>
            <li> <i class="fa fa-trello"></i> </li>
            <li> <i class="fa fa-female"></i> </li>
            <li> <i class="fa fa-male"></i> </li>
            <li> <i class="fa fa-gittip"></i> </li>
            <li> <i class="fa fa-sun-o"></i> </li>
            <li> <i class="fa fa-moon-o"></i> </li>
            <li> <i class="fa fa-archive"></i> </li>
            <li> <i class="fa fa-bug"></i> </li>
            <li> <i class="fa fa-vk"></i> </li>
            <li> <i class="fa fa-weibo"></i> </li>
            <li> <i class="fa fa-renren"></i> </li>
            <li> <i class="fa fa-pagelines"></i> </li>
            <li> <i class="fa fa-stack-exchange"></i> </li>
            <li> <i class="fa fa-arrow-circle-o-right"></i> </li>
            <li> <i class="fa fa-arrow-circle-o-left"></i> </li>
            <li> <i class="fa fa-toggle-left"></i> </li>
            <li> <i class="fa fa-dot-circle-o"></i> </li>
            <li> <i class="fa fa-wheelchair"></i> </li>
            <li> <i class="fa fa-vimeo-square"></i> </li>
            <li> <i class="fa fa-turkish-lira"></i> </li>
            <li> <i class="fa fa-plus-square-o"></i> </li>

        </ul>
    </div>
</div>

