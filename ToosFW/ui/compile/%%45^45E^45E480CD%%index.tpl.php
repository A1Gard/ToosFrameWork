<?php /* Smarty version 2.6.28, created on 2014-08-02 09:45:13
         compiled from index.tpl */ ?>
<section class="section1 photo" data-stellar-background-ratio="0.5"  id="news">
    <div class="row">
        <div class="grd8 text-center">
            <img alt="[soheil]" src="<?php echo @UR_BASE; ?>
public/img/soheil.jpg" id="soheil" />
        </div>
        <div class="grd8">
            <a href="">
                <h3>
                    مشاوره و برنامه ریزی 
                </h3>
            </a>
            <ul class="vt1 scrol margin">
                <?php $_from = $this->_tpl_vars['secs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>
                    <li>
                        <a href="/یادداشت/<?php echo $this->_tpl_vars['single']['topic_id']; ?>
/<?php echo $this->_tpl_vars['single']['topic_title']; ?>
">
                            <?php echo $this->_tpl_vars['single']['topic_title']; ?>
    
                        </a>
                    </li>
                <?php endforeach; endif; unset($_from); ?> 
            </ul>
            <div class="text-center">
                <img src="<?php echo @UR_BASE; ?>
public/img/bt.png" id="btn" alt="btn" class="cp" />
                <img src="<?php echo @UR_BASE; ?>
public/img/tt.png" id="ttn" alt="ttn" class="cp" />
            </div>
        </div>
        <div class="grd8">
            <a href="">
                <h3>
                    آخرین اخبار
                </h3>
            </a>
            <ul class="vt2 scrol margin">
                <?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>
                    <li>
                        <a href="/یادداشت/<?php echo $this->_tpl_vars['single']['topic_id']; ?>
/<?php echo $this->_tpl_vars['single']['topic_title']; ?>
">
                            <?php echo $this->_tpl_vars['single']['topic_title']; ?>
    
                        </a>
                    </li>
                <?php endforeach; endif; unset($_from); ?>  
            </ul>
            <div class="text-center">
                <img src="<?php echo @UR_BASE; ?>
public/img/bt.png" id="btr" alt="btn" class="cp" />
                <img src="<?php echo @UR_BASE; ?>
public/img/tt.png" id="ttr" alt="ttn" class="cp" />
            </div>
        </div>

    </div>
</section>
<section style="background-color: #ff0083;padding:15px;" >
    <div class="std-wrapper">
        <b>
            جملات انگیزشی: 
        </b>
        <span id='jtype' >

        </span>
    </div>
    <script type="text/javascript">
        <?php echo ' 
        $(function() {

            $("#jtype").typed({
                strings: ["'; ?>
<?php echo $this->_tpl_vars['sen']; ?>
<?php echo ' "],
                typeSpeed: 30,
                backDelay: 7000,
                loop: true,
                // defaults to false for infinite loop
                loopCount: false
            });
        });
        '; ?>

    </script>
</section>
<section class="section3 photo" data-stellar-background-ratio="0.5" id="tools">

    <div class="std-wrapper">

        <ul class="roundabout-holder" style="padding: 0px;min-height:600px;max-width:800px;"   id="tli">

            <?php $_from = $this->_tpl_vars['sec_b']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>
                <li>
                    <a href="/یادداشت/<?php echo $this->_tpl_vars['single']['topic_id']; ?>
/<?php echo $this->_tpl_vars['single']['topic_title']; ?>
">
                        <img src="<?php echo $this->_tpl_vars['single']['topic_image']; ?>
" alt="<?php echo $this->_tpl_vars['single']['topic_title']; ?>
" title="<?php echo $this->_tpl_vars['single']['topic_title']; ?>
">
                    </a>
                </li>
            <?php endforeach; endif; unset($_from); ?> 

        </ul>

    </div>

</section>
<section id="tutorials" class="section2 photo" data-stellar-background-ratio="0.5" style="min-height:70vh">

    <div class="std-wrapper" style="padding-top:0"> 
        <br>
        <div class="std-wrapper">
            <div class="row" >
                
                
                <div class="grd24">
                    <h3>اخبار سازمان سنجش</h3>
                </div>

                <?php $_from = $this->_tpl_vars['sec_c1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>
                    <div class="grd6">
                        <div class="margin">
                            <div class="thumb scroll">
                                <div class="thumb-wrapper">
                                    <img src="<?php echo $this->_tpl_vars['single']['topic_image']; ?>
" alt="<?php echo $this->_tpl_vars['single']['topic_title']; ?>
" />
                                    <div class="thumb-detail">
                                        <a href="/یادداشت/<?php echo $this->_tpl_vars['single']['topic_id']; ?>
/<?php echo $this->_tpl_vars['single']['topic_title']; ?>
">
                                            <?php echo $this->_tpl_vars['single']['topic_title']; ?>

                                        </a>
                                        <p>
                                            <?php echo $this->_tpl_vars['single']['topic_abstract']; ?>

                                        </p>
                                    </div>
                                </div>
                            </div>		
                        </div>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
                <div class="grd24">
                    <h3> مصاحبه با رتبه های برتر</h3>
                </div>

                <?php $_from = $this->_tpl_vars['sec_c2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>
                    <div class="grd6">
                        <div class="margin">
                            <div class="thumb scroll">
                                <div class="thumb-wrapper">
                                    <img src="<?php echo $this->_tpl_vars['single']['topic_image']; ?>
" alt="<?php echo $this->_tpl_vars['single']['topic_title']; ?>
" />
                                    <div class="thumb-detail">
                                        <a href="/یادداشت/<?php echo $this->_tpl_vars['single']['topic_id']; ?>
/<?php echo $this->_tpl_vars['single']['topic_title']; ?>
">
                                            <?php echo $this->_tpl_vars['single']['topic_title']; ?>

                                        </a>
                                        <p>
                                            <?php echo $this->_tpl_vars['single']['topic_abstract']; ?>

                                        </p>
                                    </div>
                                </div>
                            </div>		
                        </div>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
                
                <div class="grd24">
                    <h3> سایر</h3>
                </div>

                <?php $_from = $this->_tpl_vars['sec_c3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['single']):
?>
                    <div class="grd6">
                        <div class="margin">
                            <div class="thumb scroll">
                                <div class="thumb-wrapper">
                                    <img src="<?php echo $this->_tpl_vars['single']['topic_image']; ?>
" alt="<?php echo $this->_tpl_vars['single']['topic_title']; ?>
" />
                                    <div class="thumb-detail">
                                        <a href="/یادداشت/<?php echo $this->_tpl_vars['single']['topic_id']; ?>
/<?php echo $this->_tpl_vars['single']['topic_title']; ?>
">
                                            <?php echo $this->_tpl_vars['single']['topic_title']; ?>

                                        </a>
                                        <p>
                                            <?php echo $this->_tpl_vars['single']['topic_abstract']; ?>

                                        </p>
                                    </div>
                                </div>
                            </div>		
                        </div>
                    </div>
                <?php endforeach; endif; unset($_from); ?>


            </div>
        </div>

    </div>

</section>