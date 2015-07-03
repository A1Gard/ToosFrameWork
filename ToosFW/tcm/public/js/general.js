
/* start constant */
var TEST = 900;
/* end constant */

// global values
var lastChecked = null;

// handle jquery
$(function() {
    
    $("#close-overlay").bind('click',function () {
        $("#overlay").fadeOut(600);
    });
    
    $("#font-list li").bind('click',function () {
        var cls  = $(this).find("i").clone().removeClass('fa').attr('class');
        $("#ico").attr("class",'fa fa-4x '+cls);
        $("#topic_icon").val(cls);
        $("#overlay").fadeOut(600);
    });
    
    $(document).on('click', "#drop-down-menu li .fa", function (e) {
        $(this).parent().toggleClass('active');
    });
    

    // close alert notficition
    $(".alert-close").bind('click', function() {
        $(this).parent().hide('slow');
    });


    // delete confrim
    $('.delete').click(function(e) {
        var c = confirm("آیا برای حذف مطمئن هستید؟");
        if (c == false)
            return false;

    });
    
    // delete confrim
    $('.rem').dblclick(function(e) {
        var c = confirm("آیا برای حذف مطمئن هستید؟");
        if (c == false)
            return false;
        else
            $(this).remove();

    });

    // pinnig the list header
    $(".listview .pinned").pin({
        containerSelector: ".listview",
        minWidth: '100%'
    });

    // display pagination overflow
    $('a[href="overflow-last"]').bind('click', function() {
        $("#overflow-last").css('top', (($(this).offset().top - $("#overflow-last").height() - 20) + 'px'));
        $("#overflow-last").fadeToggle(300);
        return false;
    });
    $('a[href="overflow-first"]').bind('click', function() {
        $("#overflow-first").css('top', (($(this).offset().top - $("#overflow-first").height() - 20) + 'px'));
        $("#overflow-first").fadeToggle(300);
        return false;
    });


    $(".tags").each(function() {

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


    $(".accordion").accordion({
        collapsible: true
        , active: 'none'
    });

    /**
     * all ajax forms
     */
    $('body').on('submit', 'form.ajax', function() {

        window.ret = false;

        var data = $(this).serialize();
        data += "&ajax=1";

        $.ajax({
            type: 'POST',
            data: data,
            url: $(this).attr('action'),
            success: function(e) {
                var result = JSON.parse(e);
                if (result.success == true) {
                     window.ret = true;
                }
            },
            error: function() {
                window.ret = false;
            }
        });

        return window.ret;
    });

});

// add tag
function onAddTag(tag) {
    $.post(window.ajax_tag_url,
            {tag: tag, action: 0, id: $("#id").val()},
    function(e) {
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
    function(e) {
        var result = JSON.parse(e);
        if (result.success == false) {
            alert(result.value);
        }
    });
}


// after load complete
$(window).load(function() {

    window.ajax_tag_url = $(".tags").attr('data-edit');
// checkbox group select begin
    // source: http://stackoverflow.com/questions/659508/how-can-i-shift-select-multiple-checkboxes-like-gmail
    var $chkboxes = $('.listview-checkbox');
    $chkboxes.click(function(e) {
        if (!lastChecked) {
            lastChecked = this;
            return;
        }

        if (e.shiftKey) {
            var start = $chkboxes.index(this);
            var end = $chkboxes.index(lastChecked);
            //$chkboxes.slice(Math.min(start, end), Math.max(start, end) + 1).attr('checked', lastChecked.checked);
            $chkboxes.slice(Math.min(start, end), Math.max(start, end) + 1).each(function() {
                var chk = $(this)[0];
                chk.checked = lastChecked.checked;
            });

        }

        lastChecked = this;
    });

    $(".chkall").click(function() {
        var chclass = $(this).attr('data-chekbox');

        $("." + chclass).each(function() {
            var chk = $(this)[0];
            chk.checked = true;
        });

    });
    $(".chknone").click(function() {
        var chclass = $(this).attr('data-chekbox');
        $("." + chclass).each(function() {
            var chk = $(this)[0];
            chk.checked = false;
        });

    });
    $(".chktoggle").click(function() {
        var chclass = $(this).attr('data-chekbox');
        $("." + chclass).each(function() {
            var chk = $(this)[0];
            chk.checked = chk.checked ? false : true;
        });

    });
// checkbox group select end

});

