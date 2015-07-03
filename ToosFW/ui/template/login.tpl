

<section class="sec-single photo" data-stellar-background-ratio="0.5"  id="news" style="padding:30px 0px;">
    <div class="std-wrapper">
        <div class="row">
            <div class="grd6">
                {include file="sidebar.tpl"}
            </div>
            <div class="grd18">
                <div class="opact">
                    <h3>
                       ورود به سایت
                    </h3>

                    <div class="text">
                        {if isset($smarty.get.msg)} 
                            <h3>
                                {$smarty.get.msg}
                            </h3>
                        {/if}
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
