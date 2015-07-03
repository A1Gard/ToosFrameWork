<?php /* Smarty version 2.6.28, created on 2014-07-28 22:38:51
         compiled from list.tpl */ ?>
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

                    <div class="text">

                        <div class="row">

                            <?php $_from = $this->_tpl_vars['topix']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>
                                <div class="grd8">
                                    <div class="lst">
                                        <a href="/یادداشت/<?php echo $this->_tpl_vars['single']['topic_id']; ?>
/<?php echo $this->_tpl_vars['single']['topic_title']; ?>
">

                                            <img src="<?php echo $this->_tpl_vars['single']['topic_image']; ?>
" alt="<?php echo $this->_tpl_vars['single']['topic_title']; ?>
" />

                                            <h3><?php echo $this->_tpl_vars['single']['topic_title']; ?>
</h3>

                                            <p>
                                                <?php echo $this->_tpl_vars['single']['topic_abstract']; ?>

                                            </p>
                                        </a>
                                    </div>    
                                </div>

                            <?php endforeach; endif; unset($_from); ?>
                        </div>
                        <?php echo $this->_tpl_vars['page']; ?>

                    </div>
                </div>

            </div>


        </div>
    </div>
</section>
