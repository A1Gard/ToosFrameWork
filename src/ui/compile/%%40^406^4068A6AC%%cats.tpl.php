<?php /* Smarty version 2.6.28, created on 2014-07-28 20:16:46
         compiled from cats.tpl */ ?>
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
                        <?php echo $this->_tpl_vars['cat']['category_title']; ?>

                    </h3>

                    <div class="text">

                        <ul class="icon">
                            
                            <?php $_from = $this->_tpl_vars['cats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>
                            <li>
                                <a href="/سرفصل/<?php echo $this->_tpl_vars['single']['category_id']; ?>
/<?php echo $this->_tpl_vars['single']['category_title']; ?>
">
                                    <img src="/upload/category/<?php echo $this->_tpl_vars['single']['category_id']; ?>
.png" alt="[<?php echo $this->_tpl_vars['single']['category_title']; ?>
]" />
                                    <br />
                                    <b><?php echo $this->_tpl_vars['single']['category_title']; ?>
</b>
                                </a>

                            </li>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>

                        <br />
                        <br />
                        <p>
                            <?php echo $this->_tpl_vars['cat']['category_description']; ?>

                        </p>

                    </div>
                </div>

            </div>


        </div>
    </div>
</section>
