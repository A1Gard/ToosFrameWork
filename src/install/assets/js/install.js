
$(function () {

    $("#dbchecker").bind('click', function () {
        $(this).attr('disabled', 'disabled');
        $.post('ajax/dbCheker.php', $("#install-form").serialize(), function (e) {
            $("#dbchecker").removeAttr('disabled');
            if ($.trim(e) == 'true') {
                $(".notification-bar").append("<div class='notification success' > Database connected</div>");
                $("#submit").show(300);
            } else {
//                alert(e);
                $(".notification-bar").append("<div class='notification error' > " + e + " </div>");
                setTimeout(function () {
                    $(".notification-bar .error").hide(900, function () {
                        $(".notification-bar .error").remove();
                    });
                }, 6000);
                $("#submit").hide(300);
            }
        });
        return  false;
    });

    $("#configchecker").bind('click', function () {
        $(this).attr('disabled', 'disabled');
        $.get('ajax/configChecker.php', function (e) {
            $("#configchecker").removeAttr('disabled');

            $(".notification-bar").append("<div class='notification error' > " + e + " </div>");
            setTimeout(function () {
                $(".notification-bar .error").hide(900, function () {
                    $(".notification-bar .error").remove();
                });
            }, 6000);
            $("#submit").hide(300);

        });
        return  false;
    });

});