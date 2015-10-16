<section class="sec-single photo" data-stellar-background-ratio="0.5"  id="news" style="padding:30px 0px;">
    <div class="std-wrapper">
        <div class="row">
            <div class="grd6">
                {include file="sidebar.tpl"}
            </div>
            <div class="grd18">
                <div class="opact">
                    <h3>
                        صفحه شخصی: {$member.member_name}
                    </h3>
                    <div class="row">
                        <div class="grd12 ">
                            <div class="wh">
                                <h3>
                                    اطلاعات
                                </h3>
                                <div class="text">
                                    <img src="/upload/member/{$member.member_id}.jpg" alt="{$member.member_name}" class="avatar a64" />
                                    <br />
                                    <span class="rd" >نام: </span>{$member.member_name} <br />
                                    <span class="rd" >وضعیت:</span>{$member.member_status} <br />
                                    <span class="rd" >شهر:</span>{$member.member_city} <br />
                                    <span class="rd" >رشته تحصیلی:</span>{$member.member_field} <br />
                                    <span class="rd" >مقطع تحصیلی:</span>{$member.member_degree} <br />
                                    <span class="rd" >تعداد لایک ها:</span>{$member.likes} <br />
                                    <span class="rd" >تعداد دیدگاه ها:</span>{$member.comz} <br />
                                    <span class="rd" >تعداد دوستان:</span>{$member.frinds} <br />
                                </div>
                                <input type="hidden" id="id" value="{$member.member_id}" />
                            </div>
                        </div>
                        <div class="grd12">
                            <div class="wh">
                                <h3>
                                    10 یادداشت اخیر که توسط  {$member.member_name} لایک شده است
                                </h3>

                                <div class="text">


                                    {foreach from=$topix item=single}
                                        <div>
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
                        </div>

                        <div class="grd12">
                            <div class="wh">
                                <h3>
                                    فهرست برخی دوستان 
                                </h3>
                                <br />
                                <div class="text">

                                    {foreach from=$frindz item=friend}

                                        <a href="/member/{$friend.member_id}/{$friend.member_name}"  title="{$friend.member_name}">
                                            <img src="/upload/member/{$friend.member_id}.jpg" alt="{$friend.member_name}" class="avatar a64" />
                                        </a>

                                    {/foreach}
                                </div>

                            </div>
                        </div>
                        <div class="grd12">
                            <div class="wh">
                                <h3>
                                   شما و    {$member.member_name} 
                                </h3>
                                <br />
                                <div class="text">
                                    {if $is_f == true}
                                        شما    {$member.member_name}  به عنوان دوست انتخاب کرده اید.
                                    {else}
                                        <button class="addf btn" data-class="{$member.member_id}">افزودن به عنوان دوست</button>
                                    {/if}
                                </div>

                            </div>
                        </div>



                    </div>

                </div>


            </div>
        </div>
</section>

