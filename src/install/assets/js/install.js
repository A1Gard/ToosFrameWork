
$(function () {
    $("#dbchecker").bind('click',function () {
        $.post('dbCheker.php',$("#install-form").serialize(),function (e) {
            if ($.trim(e)=='true') {
                alert('ok');
            }else{
                alert(e);
            }
        });
        return  false;
    });
});