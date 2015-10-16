<section class="sec-single photo" data-stellar-background-ratio="0.5"  id="news" style="padding:30px 0px;">
    <div class="std-wrapper">
        <div class="row">
            <div class="grd6">
                {include file="sidebar.tpl"}
            </div>
            <div class="grd18">
                <div class="opact">
                    <h3>
                        {$cat.category_title}
                    </h3>

                    <div class="text">

                        <ul class="icon">
                            
                            {foreach from=$cats item=single}
                            <li>
                                <a href="/سرفصل/{$single.category_id}/{$single.category_title}">
                                    <img src="/upload/category/{$single.category_id}.png" alt="[{$single.category_title}]" />
                                    <br />
                                    <b>{$single.category_title}</b>
                                </a>

                            </li>
                            {/foreach}
                        </ul>

                        <br />
                        <br />
                        <p>
                            {$cat.category_description}
                        </p>

                    </div>
                </div>

            </div>


        </div>
    </div>
</section>

