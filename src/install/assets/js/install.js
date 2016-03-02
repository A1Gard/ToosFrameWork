
$(function () {
    $("#dbchecker").bind('click', function () {
        $(this).attr('disabled','disabled');
        $.post('dbCheker.php', $("#install-form").serialize(), function (e) {
            $("#dbchecker").removeAttr('disabled');
            if ($.trim(e) == 'true') {
                $(".notification-bar").append("<div class='notification success' > Database connected</div>");
            } else {
//                alert(e);
                $(".notification-bar").append("<div class='notification error' > " + e + " </div>");
                setTimeout(function () {
                    $(".notification-bar .error").hide(900, function () {
                        $(".notification-bar .error").remove();
                    });
                }, 6000);
            }
        });
        return  false;
    });
});