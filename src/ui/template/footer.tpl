
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
                            <td>{$memberz}</td>
                        </tr>
                        <tr>
                            <td>کل یادداشت ها</td>
                            <td>{$topiczz}</td>
                        </tr>
                        <tr>
                            <td>یادداشت های ويژه اعضا</td>
                            <td>{$stopic}</td>
                        </tr>
                        <tr>
                            <td>تعداد دیدگاهها</td>
                            <td>{$comment}</td>
                        </tr>
                        <tr>
                            <td> بازدید امروز</td>
                            <td>{$vss.visitcount}</td>
                        </tr>
                        <tr>
                            <td> بازدیدکننده گان امروز</td>
                            <td>{$vss.visitorcount}</td>
                        </tr>
                        <tr>
                            <td> بازدید دیروز</td>
                            <td>{$vss.y}</td>  
                        </tr>
                        <tr>
                            <td> افراد آنلاین</td>
                            <td>{$vss.online}</td>
                        </tr>
                        <tr>
                            <td> بازدیدکل </td>
                            <td>{$vss.totoal}</td>
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
                    {$links}
                </div>

            </div>
        </div>
        <div class="grd8">
            <div class="foot foot3 margin">
                <h3>
                    اطلاعات تماس
                </h3>
                <div class="mrg">
                    {$footer}
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
<div id="login" class="animate-slow{if isset($smarty.cookies.mid)} logiged {/if}"   >
    <form action="/ورود" method="post">
    {if isset($smarty.cookies.mid)} 
        <p> درود, {$smarty.cookies.mname}</p>
        <img alt="[avatar]" src="/upload/member/{$smarty.cookies.mid}.jpg" class="left avatar a64" />
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
    {else}    
    
        <input type="text" name="email" placeholder="email" />
        <input type="password" name="password" placeholder="password" />
        <br />
        <br />
        <input type="submit" value="ورود به سایت" />
    
    {/if}
    </form>
</div>
<script type="text/javascript" src="{$smarty.const.UR_BASE}public/js/init.js"></script>
</body>
</html>
