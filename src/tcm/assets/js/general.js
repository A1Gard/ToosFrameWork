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


$(function () {


    responsiveControll();




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

    $('.menu.tabing .item')
            .tab()
            ;





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
    nice = $("#side-bar").niceScroll({
        scrollspeed: 60,
        mousescrollstep: 80,
        horizrailenabled: false
    });

});