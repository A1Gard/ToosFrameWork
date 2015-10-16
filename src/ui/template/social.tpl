<section class="sec-single photo" data-stellar-background-ratio="0.5"  id="news" style="padding:30px 0px;">
    <div class="std-wrapper">
        <div class="row">
            <div class="grd6">
                {include file="sidebar.tpl"}
            </div>
            <div class="grd18">
                <div class="opact">
                    <h3>
                        شبکه دپارتمان 
                    </h3>

                    <br />
                    <div class="text">
                        {if $left > 0}
                            شما تا {$left} روز دیگر در دپارتمان عضو فعال ویژه می باشید.
                        {else}
                            شما همکنون یک عضو عادی می باشید
                            <br />
                            <br />
                            <a href="#"><button class="btn">تمدید عضویت به مدت یک سال </button></a>

                        {/if}
                    </div>
                    <br />
                    <h3>
                        فهرست 10 یادداشت لایک شده اخیر    توسط شما
                    </h3>
                    <br />
                    <div class="text">
                        <div class="row">

                            {foreach from=$topix item=single}
                                <div class="grd12">
                                    <div class="lk">
                                        <a href="/یادداشت/{$single.topic_id}/{$single.topic_title}">

                                            <img src="{$single.topic_image}" alt="{$single.topic_title}" />

                                            <h6>{$single.topic_title}</h6>

                                            <p>
                                                {$single.topic_abstract}
                                            </p>
                                        </a>
                                    </div>    
                                </div>

                            {/foreach}
                        </div>
                    </div>

                    <h3>
                        فهرست همه دوستان 
                    </h3>
                    <br />
                    <div class="text">
                        {foreach from=$frindz item=friend}
                            <div class="right">
                                <a href="/member/{$friend.member_id}/{$friend.member_name}"  title="{$friend.member_name}">
                                    <img src="/upload/member/{$friend.member_id}.jpg" alt="{$friend.member_name}" class="avatar a64" />
                                </a>
                                <br/>
                                <button class="delf btn" data-id="{$friend.member_id}">حذف</button>

                            </div>
                        {/foreach}
                    </div>
                    <br />
                    <h3>
                        توصیه مشاور / پشتیبان:
                    </h3>
                    <div class="text">
                        {$mem.member_comment}
                    </div>
                    <br />

                    <h3>
                       کارنامه: 
                    </h3>
                    <br />
                    <div class="attach">
                    <ul class="row">
                        {foreach from=$repz item=rep}
                            <li class="grd12">
                                <a href="{$smarty.const.UR_BASE}کارنامه/{$rep.report_id}">
                                    <img src="{$smarty.const.UR_BASE}public/img/attach.png" alt="[{$rep.report_title}]" class="right margin-h" />
                                    {$rep.report_title} 
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>

