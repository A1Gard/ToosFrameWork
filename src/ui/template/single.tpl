<section class="sec-single photo" data-stellar-background-ratio="0.5"  id="news" style="padding:30px 0px;">
    <div class="std-wrapper">
        <div class="row">
            <div class="grd6">
                {include file="sidebar.tpl"}
            </div>
            <div class="grd18">
                <div class="opact">
                    <h3>
                        {$topic.topic_title}
                    </h3>

                    <div class="text">

                        {$topic.topic_text}
			<br />
{$topic.topic_time}
                        {if $is_attach == true}
                            <div class="attach">
                                <h3>
                                    فایل های پیوستی
                                </h3>
                                <ul class="row">
                                    {foreach from=$attach item=attached}
                                        <li class="grd12">
                                            <a href="{$attached.attach_url}">
                                                <img src="{$smarty.const.UR_BASE}public/img/attach.png" alt="[{$attached.attach_filename}]" class="right margin-h" />
                                                {$attached.attach_filename} 
                                            </a>
                                        </li>
                                    {/foreach}
                                </ul>
                            </div>
                        {/if}
                        {if isset($smarty.cookies.mid)}
                            <div class="like{if $liked eq true} par-liked{/if}" id="likebox">


                                <div class="nliked">
                                    {$likes}  لایک برای این یادداشت
                                    <button id="like"> Like </button>
                                </div>
                                <div class="liked">


                                    شما  و {$likes} دانش آموز دیگر این نوشته  را لایک کرده اید
                                    <button id="unlike"> Unlike </button>

                                </div>     
                            </div>
                        {/if}
                        <h3 style=" margin: .7em !important;font-size: 12pt;">
                            دیدگاه ها
                        </h3>
                        <ul id="comment">

                            {$commentz}

                            {if isset($smarty.cookies.mid)}
                                <li>
                                    <form class="ajaxx">
                                        <div class="head">
                                            <img alt="[avatar]" src="/upload/member/{$smarty.cookies.mid}.jpg" class="avatar">
                                            <span class="author">
                                                {$smarty.cookies.mname}
                                            </span>
                                            <span class="date">
                                                همینک شما نیز یک دیدگاه ارسال کنید
                                            </span>
                                        </div>
                                        <textarea placeholder="دیدگاه شما ..."  id="text" class="input" name="comment_text"></textarea>
                                        <input type="hidden" id="parent" name="comment_parent" />
                                        <input type="hidden" class="action" value="/form/comment"/>
                                        <input type="submit" value="ارسال دیدگاه" class="send input" />
                                        <input type="hidden" id="id" value="{$topic.topic_id}" name="comment_topic_id" />
                                    </form>
                                </li>
                            {/if}
                        </ul>
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>

