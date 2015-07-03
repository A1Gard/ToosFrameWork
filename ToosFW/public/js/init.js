
$(function() {
    $.stellar({
        horizontalScrolling: false,
        verticalOffset: 40
    });

    $('.vt1').totemticker({
        row_height: '47px',
        mousestop: true,
        max_items: 6,
        interval: 7000,
        next: '#btn', // ID of next button or link
        previous: '#ttn',
    });
    $('.vt2').totemticker({
        row_height: '47px',
        mousestop: true,
        max_items: 6,
        interval: 4000,
        next: '#btr', // ID of next button or link
        previous: '#ttr',
    });


    $(window).scroll(function() {
        if ($(window).scrollTop() > 150) {
            $("#menu").addClass('fixed');
        } else {
            $("#menu").removeClass('fixed');
        }
    })

    $("#login").hover(function() {
        $(this).css('left', '0px');
    }, function() {
        $(this).css('left', '-190px');
    });
});

$(document).ready(function() {
    $('#tli').roundabout({autoplay: true,
        autoplayInitialDelay: 3000,
        autoplayDuration: 5000}
    );

    $('.form').submit(function() {
        $(this).attr('action', $(this).find('.action').val());
    });

    $('.ajax').submit(function() {
        var url = $(this).find('.action').val();

        $("#facebook").show(300);
        window.els = $(this).find('input');

        window.ret = false;

        var data = $(this).serialize();
        data += "&ajax=1";
        $(window.els).prop('disabled', true);
        $.ajax({
            type: 'POST',
            data: data,
            url: url,
            success: function(e) {
//                console.log(e);
//                return   true;
                var result = JSON.parse(e);
                if (result.success == true) {
                    // alert(result.value);
                    window.location = result.value;

                    window.ret = true;
                } else {
                    alert(result.value);
                }
                $("#facebook").hide(300);
                $(window.els).prop('disabled', false);
            },
            error: function() {
                window.ret = false;
            }
        });

        return window.ret;

    });



    $('.ajaxx').submit(function() {
        var url = $(this).find('.action').val();

        $("#facebook").show(300);
        window.els = $(this).find('.input');
        window.ret = false;
        $(window.els).prop('disabled', true);
        window.par = $(this).parent();
        var data = $(this).serialize();
        data += "&ajax=1";
        data += "&comment_text=" + $("#text").val();

        $.ajax({
            type: 'POST',
            data: data,
            url: url,
            success: function(e) {

                var result = JSON.parse(e);
                if (result.success == true) {
                    $(window.par).find('form').slideUp(400);
                    $(window.par).append('<span> دیدگاه شما دریافت شد، به زودی پس از تایید نمایش داده میشود</span>')
                    window.ret = true;
                } else {
                    alert(result.value);
                }
                $("#facebook").hide(300);
                $(window.els).prop('disabled', false);
            },
            error: function() {
                window.ret = false;
            }
        });

        return window.ret;

    });

    // display pagination overflow
    $('a[href="overflow-last"]').bind('click', function() {
        $("#overflow-last").css('top', (($(this).offset().top - $("#overflow-last").height() - 150) + 'px'));
        $("#overflow-last").fadeToggle(300);
        return false;
    });
    $('a[href="overflow-first"]').bind('click', function() {
        $("#overflow-first").css('top', (($(this).offset().top - $("#overflow-first").height() - 150) + 'px'));
        $("#overflow-first").fadeToggle(300);
        return false;
    });

    $("#overflow-last").click(function() {
        $(this).fadeOut();
    });
    $("#overflow-first").click(function() {
        $(this).fadeOut();
    });

    $("#like").click(function() {
        $("#facebook").show(300);
        var url = '/form/like';
        $.ajax({
            type: 'POST',
            data: {id: $("#id").val(), like: 1},
            url: url,
            success: function(e) {


                var result = JSON.parse(e);
                if (result.success == true) {
                    $("#likebox").addClass('par-liked');
                    $("#facebook").hide(300);
                } else {
                    alert(result.value);
                    $("#facebook").hide(300);
                }

            },
            error: function() {
                alert('Error: ba modere site tamas begirid');
            }
        });

    });
    $("#unlike").click(function() {
        $("#facebook").show(300);
        var url = '/form/like';
        $.ajax({
            type: 'POST',
            data: {id: $("#id").val(), like: 0},
            url: url,
            success: function(e) {


                var result = JSON.parse(e);
                if (result.success == true) {
                    $("#likebox").removeClass('par-liked');
                    $("#facebook").hide(300);
                } else {
                    alert(result.value);
                    $("#facebook").hide(300);
                }

            },
            error: function() {
                alert('Error: ba modere site tamas begirid');
            }
        });
    });

    $('.reply').click(function() {
        $("#parent").val($(this).attr('data-id'));
        $("#text").focus();
    });


    $(".addf").click(function() {
        window.el = $(this);
        $(window.el).prop('disabled', true);
        $("#facebook").show(300);
        var url = '/form/friend';
        $.ajax({
            type: 'POST',
            data: {id: $('#id').val(), frnd: 1},
            url: url,
            success: function(e) {

                var result = JSON.parse(e);
                if (result.success == true) {
                    $(window.el).removeClass('addf');
                    $(window.el).text('به دوستان شما اضافه شد');

                    $("#facebook").hide(300);
                } else {
                    alert(result.value);
                    $("#facebook").hide(300);
                }

            },
            error: function() {
                alert('Error: ba modere site tamas begirid');
            }
        });
    });

    $(".delf").click(function() {
        window.el = $(this);
        $(window.el).prop('disabled', true);
        $("#facebook").show(300);
        var url = '/form/friend';
        var idd = $(window.el).attr('data-id');

        $.ajax({
            type: 'POST',
            data: {id: idd, frnd: 0},
            url: url,
            success: function(e) {

                var result = JSON.parse(e);
                if (result.success == true) {

                    $(window.el).parent().slideUp(500);

                    $("#facebook").hide(300);
                } else {
                    alert(result.value);
                    $("#facebook").hide(300);
                }

            },
            error: function() {
                alert('Error: ba modere site tamas begirid');
            }
        });
    });

});


window.onload = function() {
    try {
        TagCanvas.Start('myCanvas', 'tags', {
            textColour: '#000',
            outlineColour: '#ff0083',
            reverse: true,
            depth: 0.8,
            maxSpeed: 0.05,
            initial: [0.04, 0.04]
        });
    } catch (e) {
        // something went wrong, hide the canvas container
        document.getElementById('myCanvasContainer').style.display = 'none';
    }
};
