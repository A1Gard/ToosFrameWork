<?php /* Smarty version 2.6.28, created on 2014-10-11 09:53:28
         compiled from social.tpl */ ?>
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
                        شبکه دپارتمان 
                    </h3>

                    <br />
                    <div class="text">
                        <?php if ($this->_tpl_vars['left'] > 0): ?>
                            شما تا <?php echo $this->_tpl_vars['left']; ?>
 روز دیگر در دپارتمان عضو فعال ویژه می باشید.
                        <?php else: ?>
                            شما همکنون یک عضو عادی می باشید
                            <br />
                            <br />
                            <a href="#"><button class="btn">تمدید عضویت به مدت یک سال </button></a>

                        <?php endif; ?>
                    </div>
                    <br />
                    <h3>
                        فهرست 10 یادداشت لایک شده اخیر    توسط شما
                    </h3>
                    <br />
                    <div class="text">
                        <div class="row">

                            <?php $_from = $this->_tpl_vars['topix']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>
                                <div class="grd12">
                                    <div class="lk">
                                        <a href="/یادداشت/<?php echo $this->_tpl_vars['single']['topic_id']; ?>
/<?php echo $this->_tpl_vars['single']['topic_title']; ?>
">

                                            <img src="<?php echo $this->_tpl_vars['single']['topic_image']; ?>
" alt="<?php echo $this->_tpl_vars['single']['topic_title']; ?>
" />

                                            <h6><?php echo $this->_tpl_vars['single']['topic_title']; ?>
</h6>

                                            <p>
                                                <?php echo $this->_tpl_vars['single']['topic_abstract']; ?>

                                            </p>
                                        </a>
                                    </div>    
                                </div>

                            <?php endforeach; endif; unset($_from); ?>
                        </div>
                    </div>

                    <h3>
                        فهرست همه دوستان 
                    </h3>
                    <br />
                    <div class="text">
                        <?php $_from = $this->_tpl_vars['frindz']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['friend']):
?>
                            <div class="right">
                                <a href="/member/<?php echo $this->_tpl_vars['friend']['member_id']; ?>
/<?php echo $this->_tpl_vars['friend']['member_name']; ?>
"  title="<?php echo $this->_tpl_vars['friend']['member_name']; ?>
">
                                    <img src="/upload/member/<?php echo $this->_tpl_vars['friend']['member_id']; ?>
.jpg" alt="<?php echo $this->_tpl_vars['friend']['member_name']; ?>
" class="avatar a64" />
                                </a>
                                <br/>
                                <button class="delf btn" data-id="<?php echo $this->_tpl_vars['friend']['member_id']; ?>
">حذف</button>

                            </div>
                        <?php endforeach; endif; unset($_from); ?>
                    </div>
                    <br />
                    <h3>
                        توصیه مشاور / پشتیبان:
                    </h3>
                    <div class="text">
                        <?php echo $this->_tpl_vars['mem']['member_comment']; ?>

                    </div>
                    <br />

                    <h3>
                       کارنامه: 
                    </h3>
                    <br />
                    <div class="attach">
                    <ul class="row">
                        <?php $_from = $this->_tpl_vars['repz']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rep']):
?>
                            <li class="grd12">
                                <a href="<?php echo @UR_BASE; ?>
کارنامه/<?php echo $this->_tpl_vars['rep']['report_id']; ?>
">
                                    <img src="<?php echo @UR_BASE; ?>
public/img/attach.png" alt="[<?php echo $this->_tpl_vars['rep']['report_title']; ?>
]" class="right margin-h" />
                                    <?php echo $this->_tpl_vars['rep']['report_title']; ?>
 
                                </a>
                            </li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>
