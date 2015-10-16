<?php /* Smarty version 2.6.28, created on 2014-09-21 11:00:19
         compiled from footer.tpl */ ?>

<div id="footer">
    <div class="row"> 
        <div class="grd8">
            <div class="foot foot2 margin">
                <h3>
                    آمار سایت
                </h3>
                <div class="mrg">
                    <table>
                        <tr>
                            <td>تعداد اعضا</td>
                            <td><?php echo $this->_tpl_vars['memberz']; ?>
</td>
                        </tr>
                        <tr>
                            <td>کل یادداشت ها</td>
                            <td><?php echo $this->_tpl_vars['topiczz']; ?>
</td>
                        </tr>
                        <tr>
                            <td>یادداشت های ويژه اعضا</td>
                            <td><?php echo $this->_tpl_vars['stopic']; ?>
</td>
                        </tr>
                        <tr>
                            <td>تعداد دیدگاهها</td>
                            <td><?php echo $this->_tpl_vars['comment']; ?>
</td>
                        </tr>
                        <tr>
                            <td> بازدید امروز</td>
                            <td><?php echo $this->_tpl_vars['vss']['visitcount']; ?>
</td>
                        </tr>
                        <tr>
                            <td> بازدیدکننده گان امروز</td>
                            <td><?php echo $this->_tpl_vars['vss']['visitorcount']; ?>
</td>
                        </tr>
                        <tr>
                            <td> بازدید دیروز</td>
                            <td><?php echo $this->_tpl_vars['vss']['y']; ?>
</td>  
                        </tr>
                        <tr>
                            <td> افراد آنلاین</td>
                            <td><?php echo $this->_tpl_vars['vss']['online']; ?>
</td>
                        </tr>
                        <tr>
                            <td> بازدیدکل </td>
                            <td><?php echo $this->_tpl_vars['vss']['totoal']; ?>
</td>
                        </tr>
                        
                        
                
                    </table>
                </div>
            </div>
        </div>

        <div class="grd8">
            <div class="foot foot1 margin">
                <h3>
                    پیوند ها
                </h3>
                <div class="mrg">
                    <?php echo $this->_tpl_vars['links']; ?>

                </div>

            </div>
        </div>
        <div class="grd8">
            <div class="foot foot3 margin">
                <h3>
                    اطلاعات تماس
                </h3>
                <div class="mrg">
                    <?php echo $this->_tpl_vars['footer']; ?>

                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="text-center"> طراحی و بهینه سازی : 
	<a href="http://phoenixtech.ir" style="color:red;"> فونیکس تکنولوژی</a>
    </div>
<br />
</div>
<div id="login" class="animate-slow<?php if (isset ( $_COOKIE['mid'] )): ?> logiged <?php endif; ?>"   >
    <form action="/ورود" method="post">
    <?php if (isset ( $_COOKIE['mid'] )): ?> 
        <p> درود, <?php echo $_COOKIE['mname']; ?>
</p>
        <img alt="[avatar]" src="/upload/member/<?php echo $_COOKIE['mid']; ?>
.jpg" class="left avatar a64" />
        <ul>
            <li>
                <a href="/پروفایل">
                    پروفایل کاربری
                </a>
            </li>
            <li>
                <a href="/شبکه">
                    شبکه دپارتمان
                </a>
            </li>
            <li>
                <a href="/خصوصی">
                    حریم خصوصی
                </a>
            </li>
            <li>
                <a href="/برنامه-فردی">
                    برنامه فردی
                </a>
            </li>
            <li>
                <a href="/خروج">
                    خروج
                </a>
            </li>
        </ul>
    <?php else: ?>    
    
        <input type="text" name="email" placeholder="email" />
        <input type="password" name="password" placeholder="password" />
        <br />
        <br />
        <input type="submit" value="ورود به سایت" />
    
    <?php endif; ?>
    </form>
</div>
<script type="text/javascript" src="<?php echo @UR_BASE; ?>
public/js/init.js"></script>
</body>
</html>