
// global values
var lastChecked = null;


function responsiveControll() {
    if ($(window).width() <= 960) {
        $('body').addClass('collapse-menu');
        $('#side-bar').removeClass('visible');
    } else {
        if ($('body').hasClass('non-menu') == false) {
            $('#side-bar').addClass('visible');
            $('body').removeClass('collapse-menu');
        }
    }
}


function nocomma(num) {
    a = num.replace(/\,/g, ''); // 1125, but a string, so convert it to number
    return a.toString();

}



function commafy(num) {

    num = nocomma(num);

    var str = num.toString().split('.');

    if (str[0].length >= 5) {

        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
    }

    if (str[1] && str[1].length >= 5) {

        str[1] = str[1].replace(/(\d{3})/g, '$1 ');
    }


    return str.join('.');

}

$(function () {


    responsiveControll();




//#############################################################################
//                               class control
//#############################################################################

    $(".currency").each(function () {
        $(this).val(commafy($(this).val()));
    });

    $(document).on('keyup focus','.currency', function () {
        $(this).val(commafy($(this).val()));
    });
//    $(".currency").bind('blur', function () {
//        $(this).val(nocomma($(this).val()));
//    });

    $(document).on('submit','form', function () {
        $(this).find(".currency").each(function () {
            $(this).val(nocomma($(this).val()));
        });
    });


//sematic ui
    $('.ui.dropdown').dropdown({
        on: 'hover'
    });

    $('.message .close')
            .on('click', function () {
                $(this)
                        .closest('.message')
                        .transition('vertical flip')
                        ;
            });


    $('.ui.accordion')
            .accordion()
            ;

    $('.progress').progress('increment');


    $('.ui.rating').rating();

    $('.menu.tabing .item').tab();


    $('.ui.checkbox').checkbox();


    $('.ui.radio.checkbox').checkbox();


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

    $(".checkall").bind("click chanage", function () {
        $(this).closest('ul')
                .find("input[type='checkbox']")
                .prop('checked', this.checked);
    });

// checkbox group select end


    // delete confrim
    $(document).on('click', 'a.delete', function (e) {
        var c = confirm("آیا برای حذف مطمئن هستید؟");
        if (c == false)
            return false;

    });



//#############################################################################
//                               meni control
//#############################################################################

    $("#menu-control").bind('click', function () {
        $('#side-bar').sidebar('toggle');
    });

//#############################################################################
//                               window scrolling 
//#############################################################################

    $(window).bind('scroll', function (e) {
        if ($(window).scrollTop() > 30) {
            if (!$("#side-bar").hasClass('scrolled')) {
                $("#side-bar").addClass('scrolled');
            }
        } else {

            $("#side-bar").removeClass('scrolled');
        }

    });

//#############################################################################
//                               window resize 
//#############################################################################

    $(window).bind('resize', function (e) {

        responsiveControll();
    });


//#############################################################################
//                               nice scroll
//#############################################################################

    nice = $("body").niceScroll({
        scrollspeed: 60,
        mousescrollstep: 80,
        horizrailenabled: false
    });
    nice2 = $("#side-bar").niceScroll({
        scrollspeed: 60,
        mousescrollstep: 80,
        horizrailenabled: false
    });
    nice3 = $(".nice_scroll").niceScroll({
        scrollspeed: 60,
        mousescrollstep: 80,
        horizrailenabled: false
    });

});