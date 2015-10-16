<?php /* Smarty version 2.6.28, created on 2014-07-28 01:29:25
         compiled from login.tpl */ ?>


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
                       ورود به سایت
                    </h3>

                    <div class="text">
                        <?php if (isset ( $_GET['msg'] )): ?> 
                            <h3>
                                <?php echo $_GET['msg']; ?>

                            </h3>
                        <?php endif; ?>
                        <div class="form" style="width:40%;margin:40px auto;"> 

                            <form method="post"  >
                                <input type="email" name="email" placeholder="ایمیل" style="width:100%;"/><br /><br />
                                <input type="password" name="password" placeholder="گذرواژه" style="width:100%;"/><br /><br />
                                <input type="submit" value="ورود به سایت" /> 
                            </form>

                        </div>

                    </div>
                </div>

            </div>


        </div>
    </div>
</section>