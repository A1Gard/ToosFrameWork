<?php /* Smarty version 2.6.28, created on 2014-08-16 12:47:43
         compiled from member.tpl */ ?>
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
                        صفحه شخصی: <?php echo $this->_tpl_vars['member']['member_name']; ?>

                    </h3>
                    <div class="row">
                        <div class="grd12 ">
                            <div class="wh">
                                <h3>
                                    اطلاعات
                                </h3>
                                <div class="text">
                                    <img src="/upload/member/<?php echo $this->_tpl_vars['member']['member_id']; ?>
.jpg" alt="<?php echo $this->_tpl_vars['member']['member_name']; ?>
" class="avatar a64" />
                                    <br />
                                    <span class="rd" >نام: </span><?php echo $this->_tpl_vars['member']['member_name']; ?>
 <br />
                                    <span class="rd" >وضعیت:</span><?php echo $this->_tpl_vars['member']['member_status']; ?>
 <br />
                                    <span class="rd" >شهر:</span><?php echo $this->_tpl_vars['member']['member_city']; ?>
 <br />
                                    <span class="rd" >رشته تحصیلی:</span><?php echo $this->_tpl_vars['member']['member_field']; ?>
 <br />
                                    <span class="rd" >مقطع تحصیلی:</span><?php echo $this->_tpl_vars['member']['member_degree']; ?>
 <br />
                                    <span class="rd" >تعداد لایک ها:</span><?php echo $this->_tpl_vars['member']['likes']; ?>
 <br />
                                    <span class="rd" >تعداد دیدگاه ها:</span><?php echo $this->_tpl_vars['member']['comz']; ?>
 <br />
                                    <span class="rd" >تعداد دوستان:</span><?php echo $this->_tpl_vars['member']['frinds']; ?>
 <br />
                                </div>
                                <input type="hidden" id="id" value="<?php echo $this->_tpl_vars['member']['member_id']; ?>
" />
                            </div>
                        </div>
                        <div class="grd12">
                            <div class="wh">
                                <h3>
                                    10 یادداشت اخیر که توسط  <?php echo $this->_tpl_vars['member']['member_name']; ?>
 لایک شده است
                                </h3>

                                <div class="text">


                                    <?php $_from = $this->_tpl_vars['topix']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>
                                        <div>
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
                        </div>

                        <div class="grd12">
                            <div class="wh">
                                <h3>
                                    فهرست برخی دوستان 
                                </h3>
                                <br />
                                <div class="text">

                                    <?php $_from = $this->_tpl_vars['frindz']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['friend']):
?>

                                        <a href="/member/<?php echo $this->_tpl_vars['friend']['member_id']; ?>
/<?php echo $this->_tpl_vars['friend']['member_name']; ?>
"  title="<?php echo $this->_tpl_vars['friend']['member_name']; ?>
">
                                            <img src="/upload/member/<?php echo $this->_tpl_vars['friend']['member_id']; ?>
.jpg" alt="<?php echo $this->_tpl_vars['friend']['member_name']; ?>
" class="avatar a64" />
                                        </a>

                                    <?php endforeach; endif; unset($_from); ?>
                                </div>

                            </div>
                        </div>
                        <div class="grd12">
                            <div class="wh">
                                <h3>
                                   شما و    <?php echo $this->_tpl_vars['member']['member_name']; ?>
 
                                </h3>
                                <br />
                                <div class="text">
                                    <?php if ($this->_tpl_vars['is_f'] == true): ?>
                                        شما    <?php echo $this->_tpl_vars['member']['member_name']; ?>
  به عنوان دوست انتخاب کرده اید.
                                    <?php else: ?>
                                        <button class="addf btn" data-class="<?php echo $this->_tpl_vars['member']['member_id']; ?>
">افزودن به عنوان دوست</button>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>



                    </div>

                </div>


            </div>
        </div>
</section>
