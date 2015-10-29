
<div class="row" >
    <div class="grd24"  style="min-height:200px;" >

        <?php echo $this->dropdown->DropDownOl(); ?>
    </div>
    <div class="grd8" >
        <div class="margin-h grd3">
            <h4><?php _lp('Widget templates') ?></h4>
            <div class="em-padding">
                <?php
                echo $this->widget_template;
                ?>
            </div>
        </div>    
    </div>
    <div class="grd8" >
        <div class="margin-h grd3">
            <h4><?php _lp('Widget prepared') ?></h4>
            <div class="em-padding">
                <?php echo  $this->widget_prepared ?>
            </div>
        </div>
    </div>
    <div class="grd8" >
        <div class="margin-h grd3">
            <h4><?php _lp('Trash') ?></h4>
            <div class="em-padding">
                <ol class="no-list drg" id="trash">
                    <li><?php _lp('Drag & drop here for remove widget') ?></li>
                </ol>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {

            
            // drop able  prepread from template
            $("#prepared").droppable({
                // class chnage
                activeClass: "ui-statistic-defaolt",
                hoverClass: "ui-statistic-hover",
                accept: ":not(.ui-sortable-helper)",
                drop: function(event, ui) {
                    //get ajax info.
                    $.post('<?php echo  UR_MP ?>Widget/Insert', {class: ui.draggable.attr('data-class'), type: 0, ajax: 1},
                    function(e) {
                        //console.log(e);return true;
                        var resolt = JSON.parse(e);
                        if (resolt.success == false) {
                            alert(resolt.value);
                        } else {
                            //if succss add to prepared
                            $("#prepared").append(resolt.value);
                            // accoordion refresg
                            $(".accordion").accordion('refresh');
                            // auto complete ajax reset
                            $(".autocomplete").autocomplete({
                                source: function(request, response) {

                                    $.ajax({
                                        url: "<?php echo  UR_MP ?>Search/AjaxSearchAll",
                                        dataType: "json",
                                        data: {
                                            q: request.term,
                                            mode: $(window.auto).parent().parent().find('select').val()
                                        },
                                        success: function(data) {
                                            response(data);
                                        },
                                    });
                                },
                                minLength: 2,
                                select: function(event, ui) {
                                    $(window.auto).parent().parent().find('.hidden').val(ui.item.id);
                                },
                            });

                        }
                    });
                }
            });

            $('body').on('focus', '.autocomplete', function() {
                // set last auto complete focusd 
                window.auto = $(this);
            });

            var gc = $("#trash").sortable({
                group: "DropDown"
                , drag: false
                , onDragStart: function(item, container, _super) {
                    // Duplicate items of the no drop area
                    if (!container.options.drop)
                        item.clone().insertAfter(item);
                    _super(item)
                }
                , onDrop: function(item, container, _super, event) {

                    if ($(item).parent().attr('id') == 'trash') {
                        if ($(item).attr('data-trash') == 'prepared') {
                            // delete widget from prepared

                            $.ajax({
                                type: 'POST',
                                data: {ajax: 1},
                                url: '<?php echo  UR_MP ?>Widget/Delete/' + $(item).attr('data-id'),
                                success: function(e) {
                                    //console.log(e);return true; 
                                    var result = JSON.parse(e);
                                    if (result.success != true) {
                                        alert(result.value);
                                    } else {
                                        $('#prepared [data-id="' + $(item).attr('data-id') + '"]').slideUp(300);
                                    }
                                },
                                error: function() {
                                    alert('error ajax.');
                                }
                            });
                        } else {
                            // delete widget from dropdown
                            $.ajax({
                                type: 'POST',
                                data: {ajax: 1},
                                url: '<?php echo  UR_MP ?>DropDownMenu/Delete/' + $(item).attr('data-id'),
                                success: function(e) {
                                    //console.log(e);return true; 
                                    var result = JSON.parse(e);
                                    if (result.success != true) {
                                        alert(result.value);
                                    } else {
                                        $('#drop-down-menu [data-id="' + $(item).attr('data-id') + '"]').slideUp(300);
                                    }
                                },
                                error: function() {
                                    alert('error ajax.');
                                }
                            });
                        }
                    } else {

                        //create widget
                        if ($(item).attr('data-class') == 'drop-down') {
                            // change parent 
                            sort = $(item).index();
                            if ($(item).parent().attr('data-id') != undefined) {
                                parent = $(item).parent().attr('data-id');
                            } else {
                                parent = $(item).parent().parent().attr('data-id');
                            }
                            $.ajax({
                                type: 'POST',
                                data: {ajax: 1, dropdown_sort_index: sort, dropdown_parent: parent},
                                url: '<?php echo  UR_MP ?>DropDownMenu/Update/' + $(item).attr('data-id'),
                                success: function(e) {
                                    //console.log(e);return true;
                                    var result = JSON.parse(e);
                                    if (result.success != true) {
                                        alert(result.value);
                                    } else {

                                    }
                                },
                                error: function() {
                                    alert('error ajax.');
                                }
                            });
                            
                        } else {

                            // new widget added to dropdown
                            sort = $(item).index();
                            id = $(item).attr('data-id');
                            if ($(item).parent().attr('data-id') != undefined) {
                                parent = $(item).parent().attr('data-id');
                            } else {
                                parent = $(item).parent().parent().attr('data-id');
                            }
                            //console.log(parent);return true;
                            $.ajax({
                                type: 'POST',
                                data: {ajax: 1, widget_id: id, parent_id: parent,sort:sort},
                                url: '<?php echo  UR_MP ?>DropDownMenu/Insert/' + $(item).attr('data-id'),
                                success: function(e) {
                                    //console.log(e);return true;
                                    var result = JSON.parse(e);
                                    if (result.success != true) {
                                        alert(result.value);
                                    } else {

                                        $(item).attr('data-id', result.id);
                                        $(item).attr('data-class', 'drop-down');
                                        $(item).html(result.value + '<ol></ol>');
                                    }
                                },
                                error: function() {
                                    alert('error ajax.');
                                }
                            });
                        }
                    }
                    _super(item, container);
                },
            });

            var ga = $(".sortable").sortable({
                group: "DropDown",
                onDragStart: function(item, container, _super, event) {

                    _super(item);
                }
            });
            var gb = $("#prepared").sortable({
                group: "DropDown",
                drop: false,
                onDragStart: function(item, container, _super, event) {
                    // Duplicate items of the no drop area
                    if (!container.options.drop)
                        item.clone().insertAfter(item);
                    _super(item);
                }
            });


            $(".autocomplete").autocomplete({
                source: function(request, response) {

                    $.ajax({
                        url: "<?php echo  UR_MP ?>Search/AjaxSearchAll",
                        dataType: "json",
                        data: {
                            q: request.term,
                            mode: $(window.auto).parent().parent().find('select').val()
                        },
                        success: function(data) {
                            response(data);
                        },
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                    $(window.auto).parent().parent().find('.hidden').val(ui.item.id);
                },
            });

        });
    </script>
    
</div>