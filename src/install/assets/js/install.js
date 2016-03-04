function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

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


    $("#nfocheck").bind('click', function () {
        $("#info-form input").removeClass('req-error');
        var elm =  "#manager_username";
        var  b = true ;
        elm =  "#manager_username";
        if ($(elm).val().length < 3) {
            $(elm).addClass('req-error');
            b = false;
        }
        
        elm =  "#manager_password";
        if ($(elm).val().length < 6) {
            $(elm).addClass('req-error');
            b = false;
        }
        elm =  "#manager_password2";
        if ($(elm).val().length < 6) {
            $(elm).addClass('req-error');
            b = false;
        }
        
        elm =  "#email";
        if ($(elm).val().length < 6) {
            $(elm).addClass('req-error');
            b = false;
        }
        
        if (!validateEmail($(elm).val())) {
            $(elm).addClass('req-error');
            b = false;
             $(".notification-bar").append("<div class='notification error' > Invalid email. </div>");
            setTimeout(function () {
                $(".notification-bar .error").hide(900, function () {
                    $(".notification-bar .error").remove();
                });
            }, 6000);
        }
        if ($("#manager_password").val() !== $("#manager_password2").val()) {
             $(".notification-bar").append("<div class='notification error' > Repeated password is not equal. </div>");
            setTimeout(function () {
                $(".notification-bar .error").hide(900, function () {
                    $(".notification-bar .error").remove();
                });
            }, 6000);
            b = false;
        }
        
        
        elm =  "#title";
        if ($(elm).val().length < 3) {
            $(elm).addClass('req-error');
            b = false;
        }
        
        if (!b) {
            return false;
        }
        
        $("#info-form").submit();
        
    });
});