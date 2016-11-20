
/* Загрузка изображении с полем описания */
function multiImageDescription(input){
    if (input.files && input.files[0]) {   

        $(input.files).each(function(i) { 
            var fileExtension = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
            var fileType = this["type"];
            var fileName = this["name"];
            var fileSize = parseInt(this["size"]) / 1000;
            var content = $('#multi-image');

            if (jQuery.inArray(fileType, fileExtension) == -1) {
                alert('Error file extension');
                return;
            } 

            var reader = new FileReader();
            reader.readAsDataURL(this);

            reader.onload = function(e) { 
                content.show();   

                var dscp = parseInt($('#multi-image tbody tr').length); 

                    lang = ['ru', 'ro', 'en']; 
                    var open_lang = $('#change-content').find('.active').attr('data-lang');
                   
                    var textarea = "";
                    for (var i = lang.length - 1; i >= 0; i--) {
                        var none = lang[i] == open_lang ? 'display:block;' : 'display:none;';
                        textarea += '<textarea style="height:100px; '+none+'" class="lang-area form-control" id="field_'+lang[i]+'" name="mini_description['+lang[i]+']['+parseInt(dscp)+']" class="form-control" id="dscp" rows="3"></textarea>';               
                    };

                    var row = '<tr>'+
                                    '<td>'+
                                       '<a href="'+reader.result+'" class="fancybox-button" data-rel="fancybox-button">'+
                                       '<img class="img-responsive" src="'+reader.result+'" alt="">'+
                                       '<input type="hidden" id="hidden_related" name="multi_image[]" value="'+reader.result+'">'+
                                       '</a>'+
                                    '</td>'+
                                    '<td>'+ 
                                    textarea+
                                    '</td>'+  
                                    '<td>'+
                                        '<a href="javascript:;" onclick="deleteLoadItem(this)" class="btn default btn-sm">'+
                                        '<i class="fa fa-times"></i> Удалить </a> '+
                                    '</td>'+
                                 '</tr>';

                $("#multi-image tbody").append(row); 
                i++;
            }  

            $('.clear-multi').click(function(e){ 
                e.preventDefault();  
                $(input).val(null);
                $("#multi-image tbody tr").remove();
                $('#multi-image').hide(); 
            }); 
             
        });
    } 
}

/* Значения характеристик */
function addCharacteristics(){ 
    var content = $('#multi-image');    
    content.show();   

    var dscp = parseInt($("#multi-image tbody tr").length); 

    lang = ['ru', 'ro']; 
    var open_lang = $('#change-content').find('.active').attr('data-lang');
   
    var textarea = ""; 
    for (var i = lang.length - 1; i >= 0; i--) {
        var none = lang[i] == open_lang ? 'display:block;' : 'display:none;';
        textarea += '<input style="'+none+'" class="lang-area form-control" id="field_'+lang[i]+'" name="char_val['+lang[i]+']['+parseInt(dscp)+']" class="form-control" id="dscp">';               
    };

    var row = '<tr>'+ 
                    '<td>'+ 
                    textarea+
                    '</td>'+  
                    '<td>'+
                        '<a href="javascript:;" onclick="deleteLoadItem(this)" class="btn default btn-sm">'+
                        '<i class="fa fa-times"></i> Удалить </a> '+
                    '</td>'+
                 '</tr>';

    $("#multi-image tbody").append(row);   
} 

/* Загрузка акции */
function multiActionContent(input){
    if (input.files && input.files[0]) {   

        $(input.files).each(function(i) { 
            var fileExtension = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
            var fileType = this["type"];
            var fileName = this["name"];
            var fileSize = parseInt(this["size"]) / 1000;
            var content = $('#multi-action');

            if (jQuery.inArray(fileType, fileExtension) == -1) {
                alert('Error file extension');
                return;
            } 

            var reader = new FileReader();
            reader.readAsDataURL(this);

            reader.onload = function(e) { 
                content.show();   

                var dscp = parseInt($('#multi-action tbody tr').length); 

                    lang = ['ru', 'ro', 'en']; 
                    var open_lang = $('#change-content').find('.active').attr('data-lang');
                   
                    var textarea = ""; 
                    for (var i = lang.length - 1; i >= 0; i--) {
                        var none = lang[i] == open_lang ? 'display:block;' : 'display:none;';
                        textarea += '<textarea style="height:100px; '+none+'" class="lang-area form-control" id="field_'+lang[i]+'" name="action_description['+lang[i]+']['+parseInt(dscp)+']" class="form-control" id="dscp" rows="3"></textarea>';               
                    };

                    var row = '<tr>'+
                                    '<td>'+
                                       '<a href="'+reader.result+'" class="fancybox-button" data-rel="fancybox-button">'+
                                       '<img class="img-responsive" src="'+reader.result+'" alt="">'+
                                       '<input type="hidden" id="hidden_related" name="action_image[]" value="'+reader.result+'">'+
                                       '</a>'+
                                    '</td>'+
                                    '<td>'+ 
                                    textarea+
                                    '</td>'+ 
                                     '<td>'+ 
                                    '<div class="input-group input-large a-picker input-daterange" data-date-format="dd.mm.yyyy">'+
                                      '<input type="text" class="form-control" name="action_date_from['+dscp+']">'+
                                      '<span class="input-group-addon">'+
                                      'по </span>'+
                                      '<input type="text" class="form-control" name="action_date_to['+dscp+']">'+
                                    '</div> '+
                                    '</td>'+  
                                    '<td>'+
                                        '<a href="javascript:;" onclick="deleteLoadItem(this)" class="btn default btn-sm">'+
                                        '<i class="fa fa-times"></i> Удалить </a> '+
                                    '</td>'+
                                 '</tr>';

                $("#multi-action tbody").append(row); 

                $('.a-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true,
                    weekStart: 1,
                    language: 'ru-RU' 
                });

                i++;
            }  
  
        });
    } 
}   
 
function deleteLoadItem(item){
    $(item).closest('tr').remove();
}