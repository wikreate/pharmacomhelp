$(document).ready(function() {

    $('input.search-question').typeahead({
        name: 'query',
        limit: 10,
        minLength : 2,
        remote: '/autocomplete/?query=%QUERY' 
    }).on('typeahead:selected',function(evt,data){ 
        if (data) { 
            $('#search-form').submit();
        } 
    }); 
 
    $('form.onsubmit').on('submit', (function(e) {
        e.preventDefault();
        var form = $(this);
        var button = $(form).find('button#submit-btn');
        var button_width = $(button).width();
        var button_height = $(button).height();
        var data_bg = $(button).attr('data-bg') ? 'style="background:' + $(button).attr('data-bg') + '"' : '';
        var button_txt = $(button).text();
        var loader = '<div class="loader-inner ball-pulse">' +
            '<div ' + data_bg + '></div>' +
            '<div ' + data_bg + '></div>' +
            '<div ' + data_bg + '></div>' +
            '</div>';
        $(button).html(loader);
        $(button).width(button_width);
        $(button).height(button_height);

        setTimeout(function() {
            onsubmit(form, button, button_txt);
        }, 1000);
    })); 

    function checkError(form) {
        var error = 0;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var names = ['name', 'text', 'town', 'message', 'phone', 'username', 'email'];
        $(form).find('input, textarea, select').attr('style', '');
        for (var key in names) {
            if ($(form).find('[name=' + names[key] + ']').length > 0) {

                var border = !$(form).find('button#submit-btn').attr('data-border') ? '1' : $(form).find('button#submit-btn').attr('data-border');

                if ($(form).find('[name=' + names[key] + ']').val().replace(/^\s+|\s+$/g, '') == '') {
                    error = 1;
                    $(form).find('[name=' + names[key] + ']').attr('style', 'border:' + border + 'px solid #ff5d5d;');
                }
                if (names[key] == 'email' && !emailReg.test($(this).find('[name=' + names[key] + ']').val())) {
                    error = 1;
                    $(form).find('[name=' + names[key] + ']').attr('style', 'border:' + border + 'px solid #ff5d5d;');
                }
            }
        }

        if (error) {
            return false;
        } else {
            return true;
        }
    }

    function onsubmit(form, button, button_txt) {

        var url = $(form).attr('action');
        var redirect = $(form).attr('data-redirect');

        $.ajax({
            url: url,
            type: 'POST',
            async: true,
            data: new FormData(form[0]),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            beforeSend: function() {},
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                if (XMLHttpRequest.status === 401) document.location.reload(true);
            },
            success: function(res, textStatus, request) {
                checkError(form);
                if (res.msg === 'error') {
                    $('#error-respond').fadeIn().html(res.cause);
                    setTimeout(function() {
                        $('#form-respond').fadeOut(700);
                    }, 1000);
 
                } else {
                    $('.fog').hide();
                    $('.popup').hide();
                    $('.fog2').hide();
                    $('#error-respond').hide();
                    $('#success-respond').fadeIn(500).html(res.msg);

                    setTimeout(function() {
                        $('#success-respond').fadeOut(500);
                    }, 4000);

                    $(form).find('input').attr('style', '');
                    $(form)[0].reset();
                }
            },
            complete: function() {
                $(button).css({
                    'padding-left': '0',
                    'padding-right': '0'
                });
                $(button).text(button_txt);
            }
        });
    } 

    function equalPerItem(content, children, item, lt) {

        lt = !lt ? '4' : lt;

        var $c = $(content);
        i = 1;
        while ($c.children(children + ':not(.row)').length) {
            $c.children(children + ':not(.row):lt(' + lt + ')').wrapAll('<div class="row" id="' + i + '">');
            i++;
        }
 
        $(content).find('.row').each(function() {
            var id = $(this).attr('id');
            $(this).find(children).each(function() {
                setEqualHeight($c.find('#' + id).find(item), 0);
            });
        }); 
    }
 

    function setEqualHeight(columns, px) {
        var tallestcolumn = 0;
        columns.each(
            function() {
                currentHeight = $(this).height();
                if (currentHeight > tallestcolumn) {
                    tallestcolumn = currentHeight;
                }
            }
        );
        columns.height(tallestcolumn + px);
    }

    function initEqualHeight() { 
        //setEqualHeight($('.site-content ul.fa-ul'), 0); 
        equalPerItem('.site-content', '.col-md-6', $('.box-categories').find('ul.fa-ul'), '2');
    }

    $(window).on('load', function() {
        initEqualHeight();
    });
 
}); 

$(window).on('load', function() { // makes sure the whole site is loaded 
    $('#status').fadeOut(); // will first fade out the loading animation 
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
    $('body').delay(350).css({'overflow':'visible'});
}); 