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

                    <div class="text">

                        <div class="row">

                            {foreach from=$topix item=single}
                                <div class="grd8">
                                    <div class="lst">
                                        <a href="/یادداشت/{$single.topic_id}/{$single.topic_title}">

                                            <img src="{$single.topic_image}" alt="{$single.topic_title}" />

                                            <h3>{$single.topic_title}</h3>

                                            <p>
                                                {$single.topic_abstract}
                                            </p>
                                        </a>
                                    </div>    
                                </div>

                            {/foreach}
                        </div>
                        {$page}
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>

