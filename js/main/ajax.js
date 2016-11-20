$(document).ready(function() {
    //for ajax path adn redirect event
    var sitename = $.url('protocol') + '://' + $.url('hostname') + '/';
    //loader gif 

    var i = 1;
    $('.ckeditor').each(function() {
        $(this).attr('id', 'ckeditor_' + i);
        i = i + 1;
    });
    var nr = $('.ckeditor').length;
    if (nr > 0) {
        setInterval(function() {
            $('.ckeditor').each(function() {
                var thatid = $(this).attr("id");
                for (var i = 1; i <= nr; i = i + 1) {
                    var valueCkeditor = CKEDITOR.instances[thatid].getData();
                    $("#" + thatid).val(valueCkeditor);
                }
            });
        }, 500);
    }

    $('.onsubmit').on('submit', (function(e) {
        e.preventDefault(); 
        var form = $(this);
        var button = $(form).find('button[type="submit"]');
        var button_width = $(button).width(); 
        var button_txt = $(button).text();
        var loader = '<div class="loader-inner ball-pulse">'+
                          '<div></div>'+
                          '<div></div>'+
                          '<div></div>'+
                        '</div>';  
        $(button).html(loader); 
        $(button).width(button_width);

        setTimeout(function(){
            onsubmit(form, button, button_txt);
        }, 1000);
    }));
 
    function onsubmit(form, button, button_txt) {  
         
        var url = $(form).attr('action'); 
        var ckeditor = $(form).attr('data-ck'); 
        var redirect = $(form).attr('data-redirect');  
   
        if (ckeditor === true) { 
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            } 
        };  
 
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
                if (res.msg === 'error') {
                    $('#fade-respond').fadeIn(500).html(res.cause);
                    $('#fade-respond').removeClass('success-respond').addClass('alert-danger');
                    setTimeout(function() {
                        $('#fade-respond').fadeOut(700);
                    }, 3000);
                } else {
                    //if exist redirect on other page
                    if (redirect) {
                        function replace_page() {
                            window.location.replace(redirect);
                        }
                        setTimeout(replace_page, 500);
                    } else {
                        $('.modal, .modal-backdrop, .modal-scrollable').hide();
                        $('#fade-respond').fadeIn(500).html(res.msg);
                        $('#fade-respond').removeClass('alert-danger').addClass('success-respond');
                        setTimeout(function() {
                            $('#fade-respond').fadeOut(700);
                        }, 3000);
                    } 
                }
            },
            complete: function() { 
                $(button).text(button_txt);
            }
        });
    }  
  
 
    /*-------------------- ajax sort element --------------------*/

    var fixHelper = function(e, ui) {  
      ui.children().each(function() {  
        $(this).width($(this).width());  
      });  
      return ui;  
    };

    function check_sort(idElement, url) {   
        $(function() {
            $(idElement).sortable({
                helper: fixHelper, 
                // containment:'table',
                forcePlaceholderSize: true,
                placeholder: 'group_move_placeholder',
                handle: ".handle", 
                revert: 300,
                start:function(){ 
                    $('.group_move_placeholder').height($(idElement).find('tr').height());
                },
                stop: function() { 
                    var arr = $(idElement).sortable('toArray');
                    var table = $(idElement).attr('data-table'); 
                    jQuery.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: {
                            arr: arr,
                            table: table
                        },
                        beforeSend: function() {},
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            if (XMLHttpRequest.status === 401) document.location.reload(true);
                        },
                        success: function(res) {
                            if (res.msg === 'error') {
                                //alert(res.cause); 
                                $('#fade-respond').removeClass().addClass('alert-danger');
                                $('#fade-respond').fadeIn(500).html(res.cause).setTimeout(1000).hide();
                            } else {
                                //alert(res.msg);       
                                $('#fade-respond').fadeIn(500).html(res.msg);
                                $('#fade-respond').removeClass().addClass('success-respond');
                                setTimeout(function() {
                                    $('#fade-respond').fadeOut(700);
                                }, 1000);
                            }
                        },
                        complete: function() {}
                    });
                }
            });
        });
    };

    $('.col-md-12 #sort-items').each(function(i){
        var id='sort-'+i;
        $(this).attr('id', id);
        check_sort("#"+id, sitename + "cp/sortElement/");  
    }); 
    // check_sort("#sort-items2", sitename + "cp/sortElement/");  

    
    /*-------------------- ajax input status --------------------*/
    function button_data(click, action, table, bg) {
        $(click).change(function(event, state) {
            event.preventDefault();
            var el = $(this);
            var state = $(this).prop('checked');
            var id = $(this).attr('data-id');
            if (state === true) {
                var status = '1';
            } else {
                var status = '0';
            }
            $.ajax({
                type: "POST",
                url: action,
                data: {
                    'id': id,
                    'status': status,
                    'table': table
                },
                dataType: 'json',
                beforeSend: function() {},
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.status === 401) document.location.reload(true);
                },
                success: function(res) {
                    if (res.msg === 'error') {
                        $('#fade-respond').fadeIn(500).html(res.cause);
                        $('#fade-respond').removeClass().addClass('alert-danger');
                        setTimeout(function() {
                            $('#fade-respond').fadeOut(700);
                        }, 1000);
                    } else {
                        $('#fade-respond').fadeIn(500).html(res.msg);
                        $('#fade-respond').removeClass().addClass('success-respond');
                        setTimeout(function() {
                            $('#fade-respond').fadeOut(700);
                        }, 1000);
                        if (bg) {
                            $(el).closest('tr').css({
                                'background-color': '#F9F9F9'
                            });
                            $(el).attr('disabled', true);
                        }
                    }
                }
            });
        });
    }

    $('select#change_status').on('change', function(){
        var status = $(this).val();
        var id = $(this).attr('data-id');
        var table = $(this).attr('data-table');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: sitename + 'cp/changeStatus/',
            data: {'status': status, 'id': id, 'table': table},
            success: function(jsonRespond){
                if (jsonRespond.msg !== 'error') {
                    
                } 
            }
        });
    }); 
  
    /*-------------------- ajax nestable category --------------------*/
  
        $('#nestable').nestable({
            collapsedClass: 'dd-collapsed',
            maxDepth:3 
        }).nestable('expandAll').on('change', function() {
            var arr = $(this).nestable('serialize');
            var table = $(this).attr('data-table'); 
            jQuery.ajax({
                type: 'POST',
                url: '/cp/sortMultiLevel/',
                dataType: 'json',
                data: {
                    arr: arr,
                    table: table
                },
                beforeSend: function() {},
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.status === 401) document.location.reload(true);
                },
                success: function(res) {
                    if (res.msg === 'error') {
                        //alert(res.cause); 
                        $('#fade-respond').removeClass().addClass('alert-danger');
                        $('#fade-respond').fadeIn(500).html(res.cause).setTimeout(1000).hide();
                    } else {
                        //alert(res.msg);       
                        $('#fade-respond').fadeIn(500).html(res.msg);
                        $('#fade-respond').removeClass().addClass('success-respond');
                        setTimeout(function() {
                            $('#fade-respond').fadeOut(700);
                        }, 1000);
                    }
                },
                complete: function() {

                }
            });

        }); 
});

function toDelete(element, path, id, table) {
    $.ajax({
        type: "POST",
        url: path,
        data: {
            'id': id,
            'table': table
        },
        dataType: 'json',
        success: function(res) {
            if (res.msg === 'error') {
                $('#fade-respond').fadeIn(500).html(res.cause);
                $('#fade-respond').removeClass().addClass('alert-danger');
                setTimeout(function() {
                    $('#fade-respond').fadeOut(700);
                }, 1500);
            } else {
                $('.modal, .modal-backdrop').fadeOut(100);
                $('#fade-respond').fadeIn(500).html(res.msg);
                $('#fade-respond').removeClass().addClass('success-respond');
                setTimeout(function() {
                    $('#fade-respond').fadeOut(700);
                }, 1500);
                $(element).closest('tr').fadeOut(200);
            }
        }
    });
}


function toDeleteNestable(element, path, id, table) {
    $.ajax({
        type: "POST",
        url: path,
        data: {
            'id': id,
            'table': table
        },
        dataType: 'json',
        success: function(res) {
            if (res.msg === 'error') {
                $('#fade-respond').fadeIn(500).html(res.cause);
                $('#fade-respond').removeClass().addClass('alert-danger');
                setTimeout(function() {
                    $('#fade-respond').fadeOut(700);
                }, 1500);
            } else {
                $('.modal, .modal-backdrop').fadeOut(100);
                $('#fade-respond').fadeIn(500).html(res.msg);
                $('#fade-respond').removeClass().addClass('success-respond');
                setTimeout(function() {
                    $('#fade-respond').fadeOut(700);
                }, 1500);
                $(element).closest('.dd-item').fadeOut(200);
            }
        }
    });
}
  


function toDeleteImg(element, path, id, table, multi, name, intable) {
    $.ajax({
        type: "POST",
        url: path,
        data: {
            'id': id,
            'table': table,
            'name' : !name ? null : name
        },
        dataType: 'json',
        success: function(res) {
            if (res.msg === 'error') {
                $('#fade-respond').fadeIn(500).html(res.cause);
                $('#fade-respond').removeClass().addClass('alert-danger');
                setTimeout(function() {
                    $('#fade-respond').fadeOut(700);
                }, 1500);
            } else {
                $(element).closest('.fileupload').find('.modal').fadeOut(100);
                $('.modal-backdrop').fadeOut(100);

                $('#fade-respond').fadeIn(500).html(res.msg);
                $('#fade-respond').removeClass().addClass('success-respond');

                setTimeout(function() {
                    $('#fade-respond').fadeOut(700);
                }, 1500);

                $(element).closest('.fileupload').find('.modal').fadeOut(100);
                if (multi) {
                    $('#'+id).hide();
                } else { 
                    if (name == 'swf') {
                        $(element).closest('.fileupload').find('#thumb-img').remove();
                        $('#swf-file').html('<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>');
                    }else{
                        $(element).closest('.fileupload').find('#thumb-img').attr('src', 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image');
                    }
                     
                    $(element).closest('.fileupload').find('.del_btn').hide();
                }
                 
            }
        }
    });
}

function buttonView(click, table, id, row) { 

    row = !row ? 'view' : row;
    
    var el = $(this);
    var state = $(this).prop('checked');  
    if (state === true) {
        var status = '1';
    } else {
        var status = '0';
    }  
    $.ajax({
        type: "POST",
        url: '/cp/viewElement/',
        data: {
            'id': id,
            'status': status,
            'table': table,
            'row' : row
        },
        dataType: 'json',
        beforeSend: function() {},
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            if (XMLHttpRequest.status === 401) document.location.reload(true);
        },
        success: function(res) {
            if (res.msg === 'error') {
                $('#fade-respond').fadeIn(500).html(res.cause);
                $('#fade-respond').removeClass().addClass('alert-danger');
                setTimeout(function() {
                    $('#fade-respond').fadeOut(700);
                }, 1000);
            } else {
                $('#fade-respond').fadeIn(500).html(res.msg);
                $('#fade-respond').removeClass().addClass('success-respond');
                setTimeout(function() {
                    $('#fade-respond').fadeOut(700);
                }, 1000); 
            }
        }
    }); 
}
 
