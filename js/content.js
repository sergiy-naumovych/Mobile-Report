$(function() {
    $( '#pictures-window .addiconTrash' ).remove();
    
    $('#fileupload').fileupload({
        dataType: 'json',
        add: function(e, data) {
            $('div#loading').show();
            data.submit();
        },
        done: function(e, data) {
            try {
                var files = JSON.parse(data.jqXHR.responseText);
                files.files.forEach(function(item, index) {
                    console.log(item.thumbnailUrl);
                    var inner = '<div class="addiconContainer" data-id="' + item.id + '">' +
                            '<div data-picturetype="LogoImage512x512" class="addicon filebox">' +
                            '<img src="' + item.thumbnailUrl + '" />' +
                            '</div>' +
                            '<div data-picturetype="LogoImage512x512" data-name="' + item.name + '" data-id="' + item.id + '" class="addiconTrash"></div>' +
                            '</div>';
                    $('#contentForm #pictures .pictures-list').append(inner);
                    $( "#pictures-window" ).append(inner);
                });
            } catch (e) {
                alert(e);
            }


            $('div#loading').hide();
        },
        progressall: function(e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css('width', progress + '%');
        }
    });

    $(document).on('click', '#pictures .addiconTrash', function() {
        var id = parseInt($(this).attr('data-id')),
                name = $(this).attr('data-name');
        Content.deleteImage(id, name);
    });
    
    $( "#pictures-window" ).dialog({
        width: 748, 
        height: 631, 
        autoOpen: false,
        title: 'CONTENT',
        open: function( event, ui ) {
            $( '#pictures-window .addiconTrash' ).remove();
        }
    });
    
    $(document).on('click', '#pictures-window .addiconContainer', function(){
        var id = $(this).attr('data-id');
        $(image).find('.addiconContainer').html($(this).html()).attr('data-id', id);
        $( "#pictures-window" ).dialog('close');
    });
});

var Content = {
    deleteImage: function(image, name) {
        if (image <= 0)
            return;

        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'delete-image',
            'id': image,
            'name': name})
                .success(function(inf) {
                    $('div#loading').hide();
                    if (inf) {
                        var data = JSON.parse(inf);
                        if (!data['error']) {
                            $('#pictures .addiconContainer[data-id="' + image + '"]').remove();
                            $( '#pictures-window .addiconContainer[data-id="' + image + '"]' ).remove();
                        }
                    }
                });
    }
};