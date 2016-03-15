
/* start constant */
var TEST = 900;
/* end constant */

// global values
var lastChecked = null;

// handle jquery
$(function () {


    // ajax trigger

    $(document).ajaxStart(function () {
        $(".preloader").fadeIn(200);

    });
    $(document).ajaxComplete(function (event, XMLHttpRequest, ajaxOptions) {
        if (XMLHttpRequest.status >= 400) {
            return false;
        }
        $(".preloader").delay(100).fadeOut(220);
        if ($("#no-result").val() == 'true') {
            return  false;
        }

        console.log($("#no-result").val());


        $("#ajax-result span").fadeOut();
        try {
            var result = JSON.parse(XMLHttpRequest.responseText);
            $("#ajax-result span.result").html(result.value);
            $("#ajax-result span.result").delay(500).fadeIn(100);
        } catch (e) {
            console.log('catch');
            $("#ajax-result span.true").delay(500).fadeIn(100);
        }

        $("#ajax-result").delay(800).fadeIn(500);
        setTimeout(function () {
            $("#ajax-result").fadeOut(900);
        }, 7800);

    });
    $(document).ajaxError(function () {
        $(".preloader").delay(100).fadeOut(220);
        $("#ajax-result span").fadeOut();
        $("#ajax-result span.false").delay(500).fadeIn(100);
        $("#ajax-result").delay(800).fadeIn(500);
        setTimeout(function () {
            $("#ajax-result").fadeOut(900);
        }, 7800);
    });

    $("#ajax-result").bind('click.close', function () {
        $("#ajax-result").fadeOut(900);
    });

    // load plugin 

    var align = 'right';

    if ($("body").css('direction') == 'rtl') {
        align = 'left';
    }


    $("html").niceScroll({'autohidemode': false, railalign: align});
    $("#sidebar").niceScroll({railalign: align});
    $(".nice_scroll").niceScroll({railalign: align});

    $('.pre-actived').bind('click', function () {
        $(this).addClass('actived');
        $(document).bind('click.close-pre', function (e) {
            //console.log(e);

            if ($(e.target).closest('.pre-actived').length === 0 &&
                    !$(e.target).is('.pre-actived') &&
                    $(".pre-actived").hasClass('actived')) {
                // do something
                $(".pre-actived").removeClass('actived');
                $(document).unbind('click.close-pre');
            }
        });
    });

    $('.notification .fa-close').bind('click', function () {
        $(this).parent().slideUp(200);
    });

    $(".notification").bind("dblclick", function () {
        $(this).slideUp(200);
    });

    $(".close-overlay").bind('click', function () {
        $(this).parent().parent().fadeOut(600);
    });

    $('.overlay').on('click', function (e) {
        if (e.target != this)
            return;
        $(this).fadeOut(600);
    });


    $(".awesome-select").bind('click', function () {
        window.awesome_target = $(this).attr('data-awesome');
        window.awesome_view = $(this).attr('data-view');
        if ($("#font-list li").length == 0) {
            $.get($("#awesome-font").attr('href'), function (e) {
//                console.log(e);
                x = e.toString();
                z = x.match(/(\.)(fa\-)([a-z]+|\-)(\:before\{)/g);
                $(z).each(function (k, v) {
                    $("#font-list").append('<li><i class="fa ' + v.substr(1, v.length - 9) + '"></i></li>');
                });

                $("#font-list li").bind('click', function () {
                    var cls = $(this).find("i").clone().removeClass('fa').attr('class');
                    $(window.awesome_view).attr("class", 'fa fa-4x ' + cls);
                    $(window.awesome_target).val(cls);
                    $(".overlay").fadeOut(600);
                });
            });
        }
    });



    $(document).on('click', "#drop-down-menu li .fa", function (e) {
        $(this).parent().toggleClass('active');
    });


    // close alert notficition
    $(".alert-close").bind('click', function () {
        $(this).parent().hide('slow');
    });


    // delete confrim
    $('.delete').click(function (e) {
        var c = confirm("آیا برای حذف مطمئن هستید؟");
        if (c == false)
            return false;

    });

    // delete confrim
    $('.rem').dblclick(function (e) {
        var c = confirm("آیا برای حذف مطمئن هستید؟");
        if (c == false)
            return false;
        else {
            $(this).parent().remove();
        }


    });

//    // pinnig the list header
//    $(".listview .pinned").pin({
//        containerSelector: ".listview",
//        minWidth: '100%'
//    });
//
//    // display pagination overflow
//    $('a[href="overflow-last"]').bind('click', function() {
//        $("#overflow-last").css('top', (($(this).offset().top - $("#overflow-last").height() - 20) + 'px'));
//        $("#overflow-last").fadeToggle(300);
//        return false;
//    });
//    $('a[href="overflow-first"]').bind('click', function() {
//        $("#overflow-first").css('top', (($(this).offset().top - $("#overflow-first").height() - 20) + 'px'));
//        $("#overflow-first").fadeToggle(300);
//        return false;
//    });
//
//

//
//
//    $(".accordion").accordion({
//        collapsible: true
//        , active: 'none'
//    });

    /**
     * all ajax forms
     */
    $('body').on('submit', 'form.ajax', function () {

        window.ret = false;

        var data = $(this).serialize();
        data += "&ajax=1";

        $.ajax({
            type: 'POST',
            data: data,
            url: $(this).attr('action'),
            success: function (e) {
                var result = JSON.parse(e);
                if (result.success == true) {
                    window.ret = true;
                }
            },
            error: function () {
                window.ret = false;
            }
        });

        return window.ret;
    });

    try {

        $('.jdatpicker').datepicker();

    } catch (e) {
        console.log('jquery ui date picker error');
    }
    try {
        $('.datepicker').Zebra_DatePicker();

    } catch (e) {
        console.log('zebra date picker error');
    }
    try {
        $('.Pdatepicker').persianDatepicker({formatDate: "YYYY/MM/DD"});

    } catch (e) {
        console.log('persian date picker error');
    }

});

// add tag
function onAddTag(tag) {
    $.post(window.ajax_tag_url,
            {tag: tag, action: 0, id: $("#id").val()},
            function (e) {
                var result = JSON.parse(e);
                if (result.success == false) {
                    alert(result.value);
                }
            });
}
// remove tags
function onRemoveTag(tag) {
    $.post(window.ajax_tag_url,
            {tag: tag, action: 2, id: $("#id").val()},
            function (e) {
                var result = JSON.parse(e);
                if (result.success == false) {
                    alert(result.value);
                }
            });
}


// after load complete
$(window).load(function () {

    window.ajax_tag_url = $(".tags").attr('data-edit');
// checkbox group select begin
    // source: http://stackoverflow.com/questions/659508/how-can-i-shift-select-multiple-checkboxes-like-gmail
    var $chkboxes = $('.listview-checkbox');
    $chkboxes.click(function (e) {
        if (!lastChecked) {
            lastChecked = this;
            return;
        }

        if (e.shiftKey) {
            var start = $chkboxes.index(this);
            var end = $chkboxes.index(lastChecked);
            //$chkboxes.slice(Math.min(start, end), Math.max(start, end) + 1).attr('checked', lastChecked.checked);
            $chkboxes.slice(Math.min(start, end), Math.max(start, end) + 1).each(function () {
                var chk = $(this)[0];
                chk.checked = lastChecked.checked;
            });

        }

        lastChecked = this;
    });

    $(".chkall").click(function () {
        var chclass = $(this).attr('data-chekbox');

        $("." + chclass).each(function () {
            var chk = $(this)[0];
            chk.checked = true;
        });

    });
    $(".chknone").click(function () {
        var chclass = $(this).attr('data-chekbox');
        $("." + chclass).each(function () {
            var chk = $(this)[0];
            chk.checked = false;
        });

    });
    $(".chktoggle").click(function () {
        var chclass = $(this).attr('data-chekbox');
        $("." + chclass).each(function () {
            var chk = $(this)[0];
            chk.checked = chk.checked ? false : true;
        });

    });
// checkbox group select end

    $(".tags").each(function () {

        var attr = $(this).attr('data-edit');
        // For some browsers, `attr` is undefined; for others,
        // `attr` is false.  Check for both.
        if (typeof attr !== typeof undefined && attr !== false) {
            var url = $(this).attr('data-ajax');
            $(this).tagsInput({
                width: 'auto'
                , autocomplete_url: url// jquery ui autocomplete requires a json endpoint
                , onAddTag: onAddTag
                , onRemoveTag: onRemoveTag
                , ajaxChange: $(this).attr('data-edit')
            });


        } else {


            var url = $(this).attr('data-ajax');
            $(this).tagsInput({
                width: 'auto'
                , autocomplete_url: url// jquery ui autocomplete requires a json endpoint
            });
        }
    });
});



