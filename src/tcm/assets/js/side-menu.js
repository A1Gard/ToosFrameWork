// by :Prestaul
// http://stackoverflow.com/questions/123999
// return is element in viewport
function elementInViewport(el) {
    var top = el.offsetTop;
    var left = el.offsetLeft;
    var width = el.offsetWidth;
    var height = el.offsetHeight;

    while (el.offsetParent) {
        el = el.offsetParent;
        top += el.offsetTop;
        left += el.offsetLeft;
    }

    return (
            top >= window.pageYOffset &&
            left >= window.pageXOffset &&
            (top + height) <= (window.pageYOffset + window.innerHeight) &&
            (left + width) <= (window.pageXOffset + window.innerWidth)
            );
}

$(function () {

    // constants
    var defaults = {
        event: 'click',
        speed: 300
    };

    $("#sidemenu-show").bind('click', function () {
        
        $("#sidebar").toggleClass('show');
        $(document).bind('click.close', function (e) {
            //console.log(e);
           
            if ($(e.target).closest('#sidebar').length === 0 && 
                    !$(e.target).is('#sidebar') &&
                    $("#sidebar").hasClass('show')) {
                // do something
                $("#sidebar").removeClass('show');
                $(document).unbind('click.close');
            }
        });
        return  false;
    });



    // toggle sidebar show full
    $("#side-toggle").bind('click', function () {
        $("#sidebar").toggleClass('icon-only');
        $("#content").toggleClass('no-margin');
        $('.sub').attr('style', '');
        $('.sub').toggleClass('animate');
        $(".pinned").width($(".pinned").parent().width());
        $(".pinned").css('left', '');
    });

    // add expand icon
    $("#nav-accordion li:has(ul)").addClass("p-icon");


    // control menu in full width mode
    $('#nav-accordion .sub-menu').bind(defaults.event, function () {

        // find clicked child
        var el = $(this).find('.sub');
        // slide up all sub menus
        $('#nav-accordion .sub').slideUp(defaults.speed);

        // if slide active remove from this
        if ($(el).hasClass('sAct')) {
            $(this).removeClass('expand');
            $(el).removeClass('sAct');
            $("#nav-accordion").css("margin-top",0);
        } else { // else slide down
            $(el).slideDown(defaults.speed, function () {
                if (elementInViewport($(el)[0]) === false) {
                    // show overflow menu
                    $("#nav-accordion").css("margin-top", ('-' + ($(el).position().top - 110 ) + 'px'));
                }
            });
            // remove slide active from all
            $('#nav-accordion .sub').removeClass('sAct');
            $('.sub-menu').removeClass('expand');
            // add slide active to this
            $(el).addClass('sAct');
            $(this).addClass('expand');
        }
    });

    // disable redirect
    $("sub-menu a[href='#']").bind('click.no_redirect', function () {
        return false;
    });

    // control in mini width mode
    $('#nav-accordion .sub-menu').bind('mouseenter', function () {

    });

});