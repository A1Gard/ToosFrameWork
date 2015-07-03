<?php /* Smarty version 2.6.28, created on 2014-08-02 00:07:11
         compiled from barn.tpl */ ?>
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
                        <?php echo $this->_tpl_vars['page_title']; ?>

                    </h3>


                    <br />
                    <br />
                    <hr />
                    <br />

                    <?php $_from = $this->_tpl_vars['reqz']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>

                        <a href="/برنامه/<?php echo $this->_tpl_vars['single']['req_id']; ?>
/<?php echo $this->_tpl_vars['single']['req_title']; ?>
">


                            <h3><?php echo $this->_tpl_vars['single']['req_title']; ?>
</h3>

                        </a>



                    <?php endforeach; endif; unset($_from); ?>

                    <?php echo $this->_tpl_vars['page']; ?>



                    <br />

                    <h3>ارسال درخواست برنامه</h3>

                    <div class="text">
                        اگر برنامه درخواستی شما در بین برنامه های فعلی نیست می توانید آن را ارسال کنید
                    </div>
                    <form class="form" method="post" style="margin:30px;" action="/form/barname">
                        <label>
                            <input type="text" name="req_title" placeholder="عنوان" />
                        </label>
                        <label>
                            <textarea name="req_text" placeholder="درخواست..." class="full-width" rows="7"></textarea>
                        </label>
                        <input type="submit" value="ارسال" />
                    </form>
                </div>

            </div>


        </div>
    </div>
</section>
