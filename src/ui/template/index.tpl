<section class="section1 photo" data-stellar-background-ratio="0.5"  id="news">
    <div class="row">
        <div class="grd8 text-center">
            <img alt="[soheil]" src="{$smarty.const.UR_BASE}public/img/soheil.jpg" id="soheil" />
        </div>
        <div class="grd8">
            <a href="">
                <h3>
                    مشاوره و برنامه ریزی 
                </h3>
            </a>
            <ul class="vt1 scrol margin">
                {foreach from=$secs item=single}
                    <li>
                        <a href="/یادداشت/{$single.topic_id}/{$single.topic_title}">
                            {$single.topic_title}    
                        </a>
                    </li>
                {/foreach} 
            </ul>
            <div class="text-center">
                <img src="{$smarty.const.UR_BASE}public/img/bt.png" id="btn" alt="btn" class="cp" />
                <img src="{$smarty.const.UR_BASE}public/img/tt.png" id="ttn" alt="ttn" class="cp" />
            </div>
        </div>
        <div class="grd8">
            <a href="">
                <h3>
                    آخرین اخبار
                </h3>
            </a>
            <ul class="vt2 scrol margin">
                {foreach from=$news item=single}
                    <li>
                        <a href="/یادداشت/{$single.topic_id}/{$single.topic_title}">
                            {$single.topic_title}    
                        </a>
                    </li>
                {/foreach}  
            </ul>
            <div class="text-center">
                <img src="{$smarty.const.UR_BASE}public/img/bt.png" id="btr" alt="btn" class="cp" />
                <img src="{$smarty.const.UR_BASE}public/img/tt.png" id="ttr" alt="ttn" class="cp" />
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
        {literal} 
        $(function() {

            $("#jtype").typed({
                strings: ["{/literal}{$sen}{literal} "],
                typeSpeed: 30,
                backDelay: 7000,
                loop: true,
                // defaults to false for infinite loop
                loopCount: false
            });
        });
        {/literal}
    </script>
</section>
<section class="section3 photo" data-stellar-background-ratio="0.5" id="tools">

    <div class="std-wrapper">

        <ul class="roundabout-holder" style="padding: 0px;min-height:600px;max-width:800px;"   id="tli">

            {foreach from=$sec_b item=single}
                <li>
                    <a href="/یادداشت/{$single.topic_id}/{$single.topic_title}">
                        <img src="{$single.topic_image}" alt="{$single.topic_title}" title="{$single.topic_title}">
                    </a>
                </li>
            {/foreach} 

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

                {foreach from=$sec_c1 item=single}
                    <div class="grd6">
                        <div class="margin">
                            <div class="thumb scroll">
                                <div class="thumb-wrapper">
                                    <img src="{$single.topic_image}" alt="{$single.topic_title}" />
                                    <div class="thumb-detail">
                                        <a href="/یادداشت/{$single.topic_id}/{$single.topic_title}">
                                            {$single.topic_title}
                                        </a>
                                        <p>
                                            {$single.topic_abstract}
                                        </p>
                                    </div>
                                </div>
                            </div>		
                        </div>
                    </div>
                {/foreach}
                <div class="grd24">
                    <h3> مصاحبه با رتبه های برتر</h3>
                </div>

                {foreach from=$sec_c2 item=single}
                    <div class="grd6">
                        <div class="margin">
                            <div class="thumb scroll">
                                <div class="thumb-wrapper">
                                    <img src="{$single.topic_image}" alt="{$single.topic_title}" />
                                    <div class="thumb-detail">
                                        <a href="/یادداشت/{$single.topic_id}/{$single.topic_title}">
                                            {$single.topic_title}
                                        </a>
                                        <p>
                                            {$single.topic_abstract}
                                        </p>
                                    </div>
                                </div>
                            </div>		
                        </div>
                    </div>
                {/foreach}
                
                <div class="grd24">
                    <h3> سایر</h3>
                </div>

                {foreach from=$sec_c3 item=single}
                    <div class="grd6">
                        <div class="margin">
                            <div class="thumb scroll">
                                <div class="thumb-wrapper">
                                    <img src="{$single.topic_image}" alt="{$single.topic_title}" />
                                    <div class="thumb-detail">
                                        <a href="/یادداشت/{$single.topic_id}/{$single.topic_title}">
                                            {$single.topic_title}
                                        </a>
                                        <p>
                                            {$single.topic_abstract}
                                        </p>
                                    </div>
                                </div>
                            </div>		
                        </div>
                    </div>
                {/foreach}


            </div>
        </div>

    </div>

</section>