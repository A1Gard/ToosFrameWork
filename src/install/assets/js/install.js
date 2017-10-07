
// email validtor 
function ValidateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
// add notifi
function NotifNow(text, mode) {
    var el = "<div class='notification "+mode+"' > "+text+" </div>" ;
    $(".notification-bar").append( el );
    setTimeout(function () {
        $(".notification-bar .notification").slideUp(900, function () {
            $(".notification-bar .notification;").remove();
        });
    }, 6000);
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
                NotifNow(e,'error');
                $("#submit").hide(300);
            }
        });
        return  false;
    });

    $("#configchecker").bind('click', function () {
        $(this).attr('disabled', 'disabled');
        $.get('ajax/configChecker.php', function (e) {
            $("#configchecker").removeAttr('disabled');
            
            NotifNow(e,'error');
            $("#submit").hide(300);

        });
        return  false;
    });


    $("#nfocheck").bind('click', function () {
        $("#info-form input").removeClass('req-error');
        var elm = "#manager_username";
        var b = true;


        // username checker
        elm = "#manager_username";
        if ($(elm).val().length < 3) {
            NotifNow("Username is too short.",'error');
            $(elm).addClass('req-error');
            b = false;
        }
        // password checker
        elm = "#manager_password";
        if ($(elm).val().length < 6) {
            NotifNow("Password is too short.",'error');
            $(elm).addClass('req-error');
            b = false;
        }
        // password reapt chcker 
        elm = "#manager_password2";
        if ($(elm).val().length < 6) {
            NotifNow("Repeat password is too short.",'error');
            $(elm).addClass('req-error');
            b = false;
        }

        // email checker
        elm = "#email";
        if ($(elm).val().length < 6) {
            NotifNow("Email is too short.",'error');
            $(elm).addClass('req-error');
            b = false;
        }
        // email validator
        if (!ValidateEmail($(elm).val())) {
            NotifNow("email is invalid.",'error');
            $(elm).addClass('req-error');
            b = false;

        }
        // check is two password is equal or not
        if ($("#manager_password").val() !== $("#manager_password2").val()) {
            NotifNow('Repeated password is not equal with orginal password.','error');
            b = false;
        }

        // title checker
        elm = "#title";
        if ($(elm).val().length < 3) {
            NotifNow("title is too short.",'error');
            $(elm).addClass('req-error');
            b = false;
        }

        if (!b) {
            return false;
        }

        $("#info-form").submit();

    });
});