<section class="sec-single photo" data-stellar-background-ratio="0.5"  id="news" style="padding:30px 0px;">
    <div class="std-wrapper">
        <div class="row">
            <div class="grd6">
                {include file="sidebar.tpl"}
            </div>
            <div class="grd18">
                <div class="opact">
                    <h3>
                        {$page_title}
                    </h3>


                    <br />
                    <br />
                    <hr />
                    <br />

                    {foreach from=$reqz item=single}

                        <a href="/برنامه/{$single.req_id}/{$single.req_title}">


                            <h3>{$single.req_title}</h3>

                        </a>



                    {/foreach}

                    {$page}


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

