;
(function ($) {

    $.fn.tagautocomplete = function (options) {

        $.hanfle = this;

        var settings = $.extend({
            minLength: 3,
            delay: 1,
            searchUrl: '#',
            changeUrl: '#',
            id: 0,
            resultTitle: 'label',
            resultId: 'id'

        }, options);


        this.each(function () {
            /// add auto complete box for once time
            if ($("#tagautocomplete-box").length == 0) {

                $('body').append('<ul id="tagautocomplete-box"></ul>');



                // ta selecting event
                $(document).on('click', '.tag-loaded', function () {
                    $.hanfle.tag = this;

                    $.post(settings.changeUrl, {tag: $.trim($(this).text()),
                        id: settings.id, action: 0}, function (e) {
                        if (e.success == true) {
                            $($.hanfle.current).parent().find('.tag-list').append(
                                    ' <a class="ui label" data-id="' + $($.hanfle.tag).data('id') + '">' +
                                    $($.hanfle.tag).text() +
                                    '<i class="delete icon"></i>' +
                                    '</a>');
                            $($.hanfle.current).val('');

                        } else {
                            // alertify error ;
                        }
                    });
                });

                // ta remove tag event
                $(document).on('click', '.tag-list .delete', function () {

                    $.hanfle.tag = this;

                    $.post(settings.changeUrl, {tag: $.trim($(this).parent().text()),
                        id: settings.id, action: 2}, function (e) {
                        if (e.success == true) {
                            $($.hanfle.tag).parent().hide(300, function () {
                                $(this).remove();
                            });
                        } else {
                            // alertify error ;
                        }
                    });

                });


            }

            // add selecting box tag 
            if ($(this).parent().find('.tag-list').length == 0) {
                $(' <div class="tag-list"></div>').insertBefore(this);
                // update old tags in this element
                var str = $(this).val();
                var tagRepo = $(this).parent().find('.tag-list');
                var tags = str.split(',');

                for (var i in tags) {
                    if (tags[i].length !== 0) {

                        $(tagRepo).append(' <a class="ui label">' +
                                tags[i] +
                                '<i class="delete icon"></i>' +
                                '</a>');
                    }
                }
                $(this).val('');
            }


            // add tag auto complete class to input 
            $(this).addClass('tagautocomplete');

            // on enter new tag
            $(this).bind('keypress', function (e) {

                str = $(this).val();
                $.hanfle.current = this;

                var keycode = event.keyCode || event.which;
                if (keycode == 13) {
                    $.post(settings.changeUrl, {tag: $.trim(str),
                        id: settings.id, action: 0}, function (e) {
                        if (e.success == true) {
                            $($.hanfle.current).parent().find('.tag-list').append(
                                    ' <a class="ui label" data-id="' + $($.hanfle.tag).data('id') + '">' +
                                    str +
                                    '<i class="delete icon"></i>' +
                                    '</a>');
                            $($.hanfle.current).val('');

                        } else {
                            // alertify error ;
                        }
                    });
                    return false;
                }
            });

            // on search
            $(this).bind('keyup focus', function (e) {

                str = $(this).val();
                $.hanfle.current = this;

                if (str.length >= settings.minLength) {
                    $.get(settings.searchUrl, {term: $(this).val()}, function (e) {
                        var content = '';
                        for (var k in e) {
                            content += '<li class="tag-loaded" data-id="' + e[k][settings.resultId] + '">' +
                                    e[k][settings.resultTitle] + "</li>";
                        }

                        $("#tagautocomplete-box").html(content).css({
                            'left': $($.hanfle.current).offset().left,
                            'top': $($.hanfle.current).offset().top + 20,
                            'width': $($.hanfle.current).outerWidth()
                        }).slideDown(300);
                    });
                    $("#tagautocomplete-box").css({
                        'left': $($.hanfle.current).offset().left,
                        'top': $($.hanfle.current).offset().top + 20,
                        'width': $($.hanfle.current).outerWidth()
                    }).slideDown(300);
                } else {
                    $("#tagautocomplete-box").slideUp(220);
                }
            });

            // on leaver the tag selector input
            $(this).bind('blur', function () {
                setTimeout(function () {
                    $("#tagautocomplete-box").slideUp(220);
                }, 200);
            });

        });


    };

}(jQuery));