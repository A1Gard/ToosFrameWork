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

$(function() {
    
    // constants
    var defaults = {
        event: 'click',
        speed: 300
    };

    // toggle sidebar show full
    $("#side-toggle").bind('click', function() {
        $("#sidebar").toggleClass('icon-only');
        $("#content").toggleClass('no-margin');
        $('.sub').attr('style', '');
        $('.sub').toggleClass('animate');
        $(".pinned").width($(".pinned").parent().width());
        $(".pinned").css('left','');
    });

    // add expand icon
    $("#nav-accordion li:has(ul)").addClass("p-icon");


    // control menu in full width mode
    $('#nav-accordion .sub-menu').bind(defaults.event, function() {
        
        // reset styles if mini width before than
        if (($(window).width() > 768)) {
            $('.sub').attr('style', '');
        }
        // find clicked child
        var el = $(this).find('.sub');
        // slide up all sub menus
        $('#nav-accordion .sub').slideUp(defaults.speed);
        // reset nav accordion postion
        $("#nav-accordion").css("margin-top",'80px');
        // if slide active remove from this
        if ($(el).hasClass('sAct')) {
            $(this).removeClass('expand');
            $(el).removeClass('sAct');
        } else { // else slide down
            $(el).slideDown(defaults.speed, function() {
                if (elementInViewport($(el)[0]) === false) {
                    // show overflow menu
                    $("#nav-accordion").css("margin-top",('-'+($(el).height()-15)+'px'));
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
    $("sub-menu a[href='#']").bind('click.no_redirect', function() {
        return false;
    });

    // control in mini width mode
    $('#nav-accordion .sub-menu').bind('mouseenter', function() {
        // if mini width mode
        if ($(this).parent().parent().hasClass('icon-only') || ($(window).width() < 768)) {
            var elm = $(this).find('.sub');
            $(elm).css({
                "left": "30px",
                "height": "auto",
                "overflow": "visible",
                "position": "absolute",
                "opacity": "1"
            });
            // if have overflow show from bottom
            if (elementInViewport($(elm)[0]) === false) {
                $(elm).css({'bottom': "0"});
            }
        }
    });
    // control in mini width mode
    $('#nav-accordion .sub-menu').bind('mouseleave', function() {
        // if mini width mode
        if ($(this).parent().parent().hasClass('icon-only') || ($(window).width() < 768)) {
            var elm = $(this).find('.sub');
            $(elm).css({
                "opacity": "0"
            });
        }

    });
});