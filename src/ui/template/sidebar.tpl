

<div class="opact side">
    <h3>
        سر فصل ها
    </h3>
    {$cat_list}
    <h3>
        جستجو
    </h3>
    <form method="get" action="/search/" id="search">
        <input placeholder="کلمه کلیدی..." type="text" name="search" />
        <input type="submit" value="بگرد" />
    </form>

    <h3>
            برچسب
    </h3>
    {*<div id="myCanvasContainer">
        <canvas width="200" height="200" id="myCanvas">
            <p>Anything in here will be replaced on browsers that support the canvas element</p>
        </canvas>
    </div>
    <div id="tags">
        <ul>
            {foreach from=$rtag item=single}
                <li>
                    <a href="/برچسب/{$single.tag_id}/{$single.tag_label}">
                       {$single.tag_label}
                    </a>
                </li>
            {/foreach} 
        </ul>
    </div>*}
</div>