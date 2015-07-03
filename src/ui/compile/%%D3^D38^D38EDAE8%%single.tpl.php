<?php /* Smarty version 2.6.28, created on 2014-08-16 13:53:32
         compiled from single.tpl */ ?>
<section class="sec-single photo" data-stellar-background-ratio="0.5"  id="news" style="padding:30px 0px;">
    <div class="std-wrapper">
        <div class="row">
            <div class="grd6">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sidebar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
            <div class="grd18">
                <div class="opact">
                    <h3>
                        <?php echo $this->_tpl_vars['topic']['topic_title']; ?>

                    </h3>

                    <div class="text">

                        <?php echo $this->_tpl_vars['topic']['topic_text']; ?>

			<br />
<?php echo $this->_tpl_vars['topic']['topic_time']; ?>

                        <?php if ($this->_tpl_vars['is_attach'] == true): ?>
                            <div class="attach">
                                <h3>
                                    فایل های پیوستی
                                </h3>
                                <ul class="row">
                                    <?php $_from = $this->_tpl_vars['attach']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attached']):
?>
                                        <li class="grd12">
                                            <a href="<?php echo $this->_tpl_vars['attached']['attach_url']; ?>
">
                                                <img src="<?php echo @UR_BASE; ?>
public/img/attach.png" alt="[<?php echo $this->_tpl_vars['attached']['attach_filename']; ?>
]" class="right margin-h" />
                                                <?php echo $this->_tpl_vars['attached']['attach_filename']; ?>
 
                                            </a>
                                        </li>
                                    <?php endforeach; endif; unset($_from); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if (isset ( $_COOKIE['mid'] )): ?>
                            <div class="like<?php if ($this->_tpl_vars['liked'] == true): ?> par-liked<?php endif; ?>" id="likebox">


                                <div class="nliked">
                                    <?php echo $this->_tpl_vars['likes']; ?>
  لایک برای این یادداشت
                                    <button id="like"> Like </button>
                                </div>
                                <div class="liked">


                                    شما  و <?php echo $this->_tpl_vars['likes']; ?>
 دانش آموز دیگر این نوشته  را لایک کرده اید
                                    <button id="unlike"> Unlike </button>

                                </div>     
                            </div>
                        <?php endif; ?>
                        <h3 style=" margin: .7em !important;font-size: 12pt;">
                            دیدگاه ها
                        </h3>
                        <ul id="comment">

                            <?php echo $this->_tpl_vars['commentz']; ?>


                            <?php if (isset ( $_COOKIE['mid'] )): ?>
                                <li>
                                    <form class="ajaxx">
                                        <div class="head">
                                            <img alt="[avatar]" src="/upload/member/<?php echo $_COOKIE['mid']; ?>
.jpg" class="avatar">
                                            <span class="author">
                                                <?php echo $_COOKIE['mname']; ?>

                                            </span>
                                            <span class="date">
                                                همینک شما نیز یک دیدگاه ارسال کنید
                                            </span>
                                        </div>
                                        <textarea placeholder="دیدگاه شما ..."  id="text" class="input" name="comment_text"></textarea>
                                        <input type="hidden" id="parent" name="comment_parent" />
                                        <input type="hidden" class="action" value="/form/comment"/>
                                        <input type="submit" value="ارسال دیدگاه" class="send input" />
                                        <input type="hidden" id="id" value="<?php echo $this->_tpl_vars['topic']['topic_id']; ?>
" name="comment_topic_id" />
                                    </form>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>
