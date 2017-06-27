
// global values
var lastChecked = null;

var fontaswsome_items = '';
var fontawesome_target = '';
var fontawesome_view = '';
var upload_file_list;



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


function nocomma(num) {
    a = num.replace(/\,/g, ''); // 1125, but a string, so convert it to number
    return a.toString();
    
}



function commafy(num) {
    
    num = nocomma(num);
    
    var str = num.toString().split('.');
    
    if (str[0].length >= 5) {
        
        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
    }
    
    if (str[1] && str[1].length >= 5) {
        
        str[1] = str[1].replace(/(\d{3})/g, '$1 ');
    }
    
    
    return str.join('.');
    
}




// add tag
function onAddTag(tag) {
    $.post(window.ajax_tag_url,
            {tag: tag, action: 0, id: $("#id").val()},
            function (e) {
                var result = JSON.parse(e);
                if (result.success == false) {
                    alert(result.value);
                }
            });
}
// remove tags
function onRemoveTag(tag) {
    $.post(window.ajax_tag_url,
            {tag: tag, action: 2, id: $("#id").val()},
            function (e) {
                var result = JSON.parse(e);
                if (result.success == false) {
                    alert(result.value);
                }
            });
}



// start upload ajax ;

function startUpload() {
    $('#upload-progress').show();
    var fd = new FormData;
    for (var f in upload_file_list) {
        var file = upload_file_list[f];
        fd.append('file[' + f + ']', file);
    }
    var xhr = new XMLHttpRequest();
    (xhr.upload || xhr).addEventListener('progress', function (e) {
        var done = e.position || e.loaded
        var total = e.totalSize || e.total;
        $('#upload-progress').progress({
            percent: Math.round(done / total * 100)
        });
    });
    xhr.addEventListener('load', function (e) {
        $('#upload-progress').hide();
        $.get(UR_MP + 'Upload/UploadList', function (e) {
            upload_list.items = e;
            $("#uploaded").click();
        });
    });
    xhr.open('post', UR_MP + 'Upload/MultiAdd/file', true);
    xhr.send(fd);
    
    
}




$(function () {
    
    
    responsiveControll();
    
    
    
    
//#############################################################################
//                               class control
//#############################################################################
    
    $(".currency").each(function () {
        $(this).val(commafy($(this).val()));
    });
    
    $(document).on('keyup focus', '.currency', function () {
        $(this).val(commafy($(this).val()));
    });
//    $(".currency").bind('blur', function () {
//        $(this).val(nocomma($(this).val()));
//    });
    
    $(document).on('submit', 'form', function () {
        $(this).find(".currency").each(function () {
            $(this).val(nocomma($(this).val()));
        });
    });
    
    
//sematic ui
    $('.choosen').select2();
    
    $('.ui.dropdown').dropdown({
        on: 'hover'
    });
    $('.menu .item')
            .tab()
            ;
    
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
    
    $('.menu.tabing .item').tab();
    
    
    $('.ui.checkbox').checkbox();
    
    
    $('.ui.radio.checkbox').checkbox();
    
    $('.clockpicker,.timepicker').clockpicker({
        placement: 'bottom',
        align: 'left',
        donetext: 'Done'
    });
    
    
    // checkbox group select begin
    // source: http://stackoverflow.com/questions/659508/how-can-i-shift-select-multiple-checkboxes-like-gmail
    var $chkboxes = $('.listview-checkbox');
    $chkboxes.click(function (e) {
        if (!lastChecked) {
            lastChecked = this;
            return;
        }
        
        if (e.shiftKey) {
            var start = $chkboxes.index(this);
            var end = $chkboxes.index(lastChecked);
            //$chkboxes.slice(Math.min(start, end), Math.max(start, end) + 1).attr('checked', lastChecked.checked);
            $chkboxes.slice(Math.min(start, end), Math.max(start, end) + 1).each(function () {
                var chk = $(this)[0];
                chk.checked = lastChecked.checked;
            });
            
        }
        
        lastChecked = this;
    });
    
    $(".chkall").click(function () {
        var chclass = $(this).attr('data-chekbox');
        
        $("." + chclass).each(function () {
            var chk = $(this)[0];
            chk.checked = true;
        });
        
    });
    
    $(".chknone").click(function () {
        var chclass = $(this).attr('data-chekbox');
        $("." + chclass).each(function () {
            var chk = $(this)[0];
            chk.checked = false;
        });
        
    });
    $(".chktoggle").click(function () {
        var chclass = $(this).attr('data-chekbox');
        $("." + chclass).each(function () {
            var chk = $(this)[0];
            chk.checked = chk.checked ? false : true;
        });
        
    });
    
    $(".checkall").bind("click chanage", function () {
        $(this).closest('ul')
                .find("input[type='checkbox']")
                .prop('checked', this.checked);
    });
    
// checkbox group select end
    
    
    // delete confrim
    $(document).on('click', 'a.delete', function (e) {
        var c = confirm("آیا برای حذف مطمئن هستید؟");
        if (c == false)
            return false;
        
    });
    
    
    $(".awesome-select").bind('click', function () {
//        console.log(fontaswsome_items.length);
//        var len =  ;
        var title = $(this).val();
        fontawesome_target = $(this).data('awesome');
        fontawesome_view = $(this).data('view');
        if ('' == fontaswsome_items) {
            $.get(UR_MP + 'assets/css/font-awesome.min.css', function (r) {
                var b = false;
                var result = r.match(/fa\-([a-z]|-|[0-9])*/g);
                fontaswsome_items = '<div class="ui modal awmodal">' +
                        '<div class="header">' + title + '</div>' +
                        '<div class="content"><ul id="fontawesome-items">';
                
                
                for (var i in result) {
                    if (b == false && result[i] != 'fa-glass') {
                        continue;
                    }
                    b = true;
                    if (result[i].length > 3) {
                        
                    }
                    fontaswsome_items += '<li data-icon="' + result[i] + '"> <i class="fa ' + result[i] + '"></i> </li>';
                }
                fontaswsome_items += ' </ul> </div></div> ';
                $("body").append(fontaswsome_items);
                $('.awmodal.modal').modal('show');
                fontaswsome_items = 'true';
            });
        } else {
            $('.awmodal.modal').modal('show');
        }
        
        return false;
        
    });
    
    $(document).on('click', '#fontawesome-items li', function () {
        var icon = $(this).data('icon');
        $(fontawesome_target).val(icon);
        $(fontawesome_view).attr('class', 'fa fa-4x ' + icon);
        $('.awmodal.modal').modal('hide');
    });
    
//#############################################################################
//                               Drag and drop | click upload modal
//#############################################################################
    
    $('#drg-upload').on(
            'dragover',
            function (e) {
//                $(this).removeClass('dragenter');
                e.preventDefault();
                e.stopPropagation();
            }
    );
    
    $('#drg-upload').on(
            'dragleave',
            function (e) {
                $(this).removeClass('dragenter');
                e.preventDefault();
                e.stopPropagation();
            }
    );
    $('#drg-upload').on(
            'dragenter',
            function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass('dragenter');
            }
    );
    
    $('#drg-upload').on(
            'drop',
            function (e) {
                if (e.originalEvent.dataTransfer) {
                    if (e.originalEvent.dataTransfer.files.length) {
                        e.preventDefault();
                        e.stopPropagation();
                        /*UPLOAD FILES HERE*/
//                        console.log(e.originalEvent.dataTransfer.files);
                        upload_file_list = e.originalEvent.dataTransfer.files;
                        startUpload();
                    }
                }
                $(this).removeClass('dragenter');
            }
    );
    $('#drg-upload').bind('click', function () {
        $("#hide-file-selector").trigger('click');
    });
    
    $("#hide-file-selector").bind('change', function () {
//        console.log($(this)[0].files);
        upload_file_list = $(this)[0].files;
        startUpload();
    });
    
    
    $("#upload-modal .actions .button").bind('click.rem', function () {
    });
    
    
    
    $(document).on('click', "#upload-modal:not(.multiple) .card", function () {
        $("#upload-modal .card").removeClass('selceted');
        $(this).addClass('selceted');
    });
    
    $(document).on('click', "#upload-modal.multiple .card", function () {
        $(this).toggleClass('selceted');
    });
//#############################################################################
//                               meni control
//#############################################################################
    
    $("#menu-control").bind('click', function () {
        $('#side-bar').sidebar('toggle');
    });
//#############################################################################
//                               bulk action confirm
//#############################################################################
    
    $(".listview-form").bind('submit', function () {
        var value = $(this).find("select").val();
        if (value.indexOf('Delete') !== -1 || value.indexOf('delete') !== -1) {
            if (!confirm('Are you sure for delete?')) {
                return false;
            }
        }
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
    nice2 = $("#nscroll").niceScroll({
        scrollspeed: 60,
        mousescrollstep: 80,
        horizrailenabled: false
    });
    nice3 = $(".nice_scroll").niceScroll({
        scrollspeed: 60,
        mousescrollstep: 80,
        horizrailenabled: false
    });
    
});



// after load complete
$(window).load(function () {
    $("#toggle-menu").bind('click', function () {
        if ($('body').hasClass('non-menu')) {
            
            $.get(UR_MP + 'Manager/ToggleSideBar/show', function (e) {
                if (e.result == true) {
                    $('body').removeClass('collapse-menu');
                    $('body').removeClass('non-menu');
//            responsiveControll() ;
                    $('#side-bar').sidebar('hide');
                    setTimeout(function () {
                        $('#side-bar').addClass('visible');
                    }, 100);
                } else {
                    alertify.success('error');
                }
            });
            
            
        } else {
            
            $.get(UR_MP + 'Manager/ToggleSideBar/hide', function (e) {
                if (e.result == true) {
                    $('body').click();
                    $('body').addClass('collapse-menu');
                    $('body').addClass('non-menu');
                    $('#side-bar').removeClass('visible');
                } else {
                    alertify.success('error');
                }
            });
        }
        
    });
//
//    $('#upload-modal')
//            .modal('show')
//            ;
    $('input[required]').each(function () {
        $(this).closest('.field').addClass('required');
    });
});

