
<div class="row">
    <div class="grd24"  style="min-height:200px;margin-bottom:40px" >

        <form action="<?php echo UR_MP ?>DropDownMenu/Sync" method="post" id="sort_form" onsubmit="return false;" >

            <?php echo $this->dropdown->DropDownOl(); ?>

            <input type="hidden" id="sorted" name="sorted" />

            <button type="submit" > 
                <span class="fa fa-save"></span> 
                &nbsp;
                <?php _lp('Save'); ?> 
            </button>
        </form>

        <!--        <ol class="drg drop-down-menu" id="drop-down-menu">
                    <li> <i class="fa fa-plus"></i> wduhjwhd1</li>
                    <li> <i class="fa fa-plus"></i> wduhjwhd2</li>
                    <li> <i class="fa fa-plus"></i> wduhjwhd3
                        <ol>
                            <li> <i class="fa fa-plus"></i> wduhjwhd4</li>
                            <li> <i class="fa fa-plus"></i> wduhjwhd5</li>
                            <li> <i class="fa fa-plus"></i> wduhjwhd6</li>
                            <li> <i class="fa fa-plus"></i> wduhjwhd7</li>
                            <li> <i class="fa fa-plus"></i> 123
                                <ol>
        
                                </ol>
                            </li>
                            <li> <i class="fa fa-plus"></i> wduhjwhd8</li>
                            <li> <i class="fa fa-plus"></i> wduhjwhd9</li>
                            <li> <i class="fa fa-plus"></i> wduhjwhd0</li>
                        </ol>
                    </li>
                    <li> <i class="fa fa-plus"></i> wduhjwhdz</li>
                    <li> <i class="fa fa-plus"></i> wduhjwhdx</li>
                    <li> <i class="fa fa-plus"></i> wduhjwhdc</li>
                    <li> <i class="fa fa-plus"></i> wduhjwhdv</li>
                    <li> <i class="fa fa-plus"></i> wduhjwhdn</li>
                </ol>-->
    </div>
    <div class="grd12">
        <h4 class="text-center"><?php _lp('Menu Widget') ?></h4>
        <div class="margin grdx3 widget">

            <ol class="drga" id="un">
                <li id="preview">
                    untitled
                </li>
            </ol>

            <label>
                <span>

                    <?php _lp('Item mode') ?>:
                </span>

                <select name="dropown_mode" id="mode">
                    <option value="0"> <?php _lp('Direct Link') ?> </option>
                    <option value="1"> <?php _lp('Topic') ?> </option>
                    <option value="2"> <?php _lp('Tag') ?> </option>
                    <option value="3"> <?php _lp('Category') ?> </option>
                    <option value="4"> <?php _lp('Category & subcat') ?> </option>
                    <option value="5"> <?php _lp('Category & subtopic') ?> </option>

                </select>
            </label>
            <label>
                <span>

                    <?php _lp('Title') ?>:

                </span>
                <input type="text" maxlength="255" name="dropdown_title" id="title" />
            </label>
            <label>
                <span>

                    <?php _lp('Search') ?>:
                </span>
                <input type="text" maxlength="255"  id="term"   disabled="" class="autocomplete"/>
            </label>
            <label>
                <span>

                    <?php _lp('Link') ?>:
                </span>
                <input type="text" maxlength="4096" name="dropdown_link" id="link" />
            </label>
        </div>
    </div>
    <div class="grd12">
        <h4 class="text-center"><?php _lp('Trash') ?></h4>
        <div class="trash">
            <ol class="grdx3 trsh" style="list-style: none">
                <li>
                    <i class="fa fa-trash-o fa-5x"></i>
                    <br />
                    <br />
                    <?php _lp("Drop to remove item") ?>
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />

                </li>
            </ol>
        </div>
    </div>
    <input type="hidden" id="no-result" value="true" />
    <script type="text/javascript">
        $(function () {




            $("#sort_form").bind('submit', function () {

                var data = group.sortable("serialize").get();


                var jsonString = JSON.stringify(data, null, ' ');


                $("#sorted").val(jsonString);


                window.ret = false;

                $.ajax({
                    type: 'POST',
                    data: $(this).serialize(),
                    url: $(this).attr('action'),
                    success: function (data) {
                        window.ret = true;

                    },
                    error: function () {
                        window.ret = false;
                    }
                });

                return window.ret;
            });



            $(document).on('contextmenu', ".drg li", function (e) {

                window.th = this;
                var txt = ($(this).clone()    //clone the element
                        .children() //select all the children
                        .remove()   //remove all the children
                        .end()  //again go back to selected element
                        //.find('.fa')
                        //.remove()
                        .text()).trim();

                var newtxt = prompt("new title :", txt);

                if (newtxt != txt && newtxt != null) {
                    var id = $(this).attr('data-id');
                    $.ajax({
                        type: 'POST',
                        data: {
                            ajax: 1,
                            dropdown_title: newtxt
                        },
                        url: '<?php echo UR_MP ?>DropDownMenu/Update/' + id,
                        success: function (e) {
                            //console.log(e);
                            //return true;
                            var result = JSON.parse(e);
                            if (result.success != true) {
                                alert(result.value);
                            } else {
                                $(window.th).html($(window.th).html().replace(txt, newtxt));
                            }
                        },
                        error: function () {
                            alert('error ajax.');
                            $(".last").remove();
                        }
                    });
                }

                return  false;

            });


            $("#title").bind("input keyup blur", function () {
                $("#preview").text($(this).val());
            });
            $("#mode").bind("change", function () {
                if ($(this).val() == 0) {
                    $("#link").removeAttr('disabled');
                    $("#term").attr('disabled', 'disabled');
                    $("#term").val('');
                    $("#link").val('');
                } else {
                    $("#term").removeAttr('disabled');
                    $("#link").attr('disabled', 'disabled');
                    $("#link").val('');
                }
            });
            var adjustment

            var group = $(".drg").sortable({
                group: 'drg',
                // animation on drop
                onDrop: function (item, targetContainer, _super) {


                    $(item).addClass('last');
                    // trash 
                    if ($(item).parent().parent().hasClass('trash')) {


                        var id = $(item).attr('data-id');

                        $.ajax({
                            type: 'POST',
                            data: {
                                ajax: 1
                            },
                            url: '<?php echo UR_MP ?>DropDownMenu/Delete/' + id,
                            success: function (e) {
                                //console.log(e);
                                //return true;
                                var result = JSON.parse(e);
                                if (result.success != true) {
                                    alert(result.value);
                                } else {
                                    $('.last').attr('data-id', result.id);
                                    $(".last").remove();
                                }
                            },
                            error: function () {
                                alert('error ajax.');
                                $('.last').removeClass('.last');
                            }
                        });

                        _super(item);
                        return false;
                    }

                    // drop down
                    var attr = $(item).attr('id');


                    if (typeof attr !== typeof undefined && attr !== false) {
                        var sort = 0;
                        var parent = 0;
                        sort = $(item).index();
                        if ($(item).parent().attr('data-id') != undefined) {
                            parent = $(item).parent().attr('data-id');
                        } else {
                            parent = $(item).parent().parent().attr('data-id');
                        }

                        $("#preview").prepend("<i class=\"fa fa-plus\"></i>");
                        $("#preview").append('<ol></ol>');
                        $("#preview").removeAttr('id');
                        $("#un").html('<li id="preview"> untitled </li>');


                        $.ajax({
                            type: 'POST',
                            data: {
                                ajax: 1,
                                dropdown_mode: $("#mode").val(),
                                dropdown_title: $("#title").val(),
                                dropdown_link: $("#link").val(),
                                dropdown_sort_index: sort,
                                dropdown_parent: parent
                            },
                            url: '<?php echo UR_MP ?>DropDownMenu/Insert',
                            success: function (e) {
                                //console.log(e);
                                //return true;
                                var result = JSON.parse(e);
                                if (result.success != true) {
                                    alert(result.value);
                                } else {
                                    $('.last').attr('data-id', result.id);
                                    $('.last').removeClass('.last');
                                }
                            },
                            error: function () {
                                alert('error ajax.');
                                $(".last").remove();
                            }
                        });

                    }

                    _super(item);
                }});

            $(".trsh").sortable({
                group: 'drg',
                drag: false});
            $(".drga").sortable({
                group: 'drg',
                drop: false
            });
            $("#drop-down-menu").bind("dblclick", function () {
                $(this).toggleClass('drop-down-menu');
                $(this).toggleClass('gray-ol');
                $(this).toggleClass('highlite');
            });


            $(".autocomplete").autocomplete({
                source: function (request, response) {

                    var rmode = <?php echo SEARCH_MODE_CATEGORY ?>;
                    if ($("#mode").val() == 1) {
                        rmode = <?php echo SEARCH_MODE_TOPIC ?>;
                    } else if ($("#mode").val() == 2) {
                        rmode = <?php echo SEARCH_MODE_TAG ?>;
                    }
                    $.ajax({
                        url: "<?php echo UR_MP ?>Search/AjaxSearchAll",
                        dataType: "json",
                        data: {
                            q: request.term,
                            mode: rmode
                        },
                        success: function (data) {
                            response(data);
                        },
                    });
                },
                minLength: 2,
                select: function (event, ui) {
                    $("#link").val(ui.item.id + '/' + ui.item.label)
                },
            });
        });
    </script>
</div>