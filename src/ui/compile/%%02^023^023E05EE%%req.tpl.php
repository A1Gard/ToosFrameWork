<?php /* Smarty version 2.6.28, created on 2014-08-02 00:08:01
         compiled from req.tpl */ ?>
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
                        <?php echo $this->_tpl_vars['req']['req_title']; ?>

                    </h3>

                    <div class="text">

                        <?php echo $this->_tpl_vars['req']['req_text']; ?>


                    </div>
                    <h3>
                        پاسخ: 
                    </h3> 
                        <div class="text">

                        <?php echo $this->_tpl_vars['req']['req_answer']; ?>


                    </div>
                </div>

            </div>


        </div>
    </div>
</section>
