var notificationForm = {
    open: function(){
        $('#notification-form').slideDown();
    },
            
    close: function(){
        $('#notification-form').slideUp();
    },
            
    create: function(){
        notificationForm.clear();
        $('#update-notification, #activate-notification, #delete-notification').hide();
        $('#create-notification').show();
        notificationForm.open();
    },
            
    update: function(){
        $('#create-notification').hide();
        $('#update-notification').show();
        notificationForm.open();
    },
    
    deleted: function(){
        $('#delete-notification').hide();
        $('#activate-notification').show();
    },
            
    active: function(){
        $('#activate-notification').hide();
        $('#delete-notification').show();
    },
            
    clear: function(){
        $('#notification-form input, #notification-form textarea').val('');
    }
};

$(function(){
    $('#new-notification').bind('click', function(){
        notificationForm.create();
    });
    
    $('#close-notification').bind('click', function(){
        notificationForm.close();
    });
    
    $(document).on('click', 'tr.notification', function(){
        var id = parseInt($(this).attr('data-id'));
            notification.getInfo(id);
    });
    
    $('#create-notification').bind('click', function(){
        notification.create();
    });
    
    $('#update-notification').bind('click', function(){
        notification.update();
    });
    
    $('#activate-notification').bind('click', function(){
        notification.activate();
    });
    
    $('#delete-notification').bind('click', function(){
        notification.delete();
    });
    
    $("#push-msg-help").dialog({
        width: 600,
        height: 300,
        autoOpen: false,
        title: 'HELP',
        open: function(event, ui) {
            //$('#editItem, #editVariable, #addItem').hide();
        }
    });
    
    $("#push-sql-help").dialog({
        width: 600,
        height: 300,
        autoOpen: false,
        title: 'HELP',
        open: function(event, ui) {
            //$('#editItem, #editVariable, #addItem').hide();
        }
    });
    
    $('span.push-msg-help').bind('click', function(){
        HelpPN.PMHelpOpen();
    });
    
    $('span.push-sql-help').bind('click', function(){
        HelpPN.PSQLHelpOpen();
    });
});

var HelpPN = {
    PMHelpOpen: function(){
        $("#push-msg-help").dialog('open');
    },
    
    PSQLHelpOpen: function(){
        $("#push-sql-help").dialog('open');
    }
};

var notification = {
    getInfo: function(id) {
        if(id <= 0)
            return;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'notification-info',
            'id': id})
         .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                try{
                    var pn = JSON.parse(inf);
                    notification.setInfo(pn['data']); //pn - push notification
                } catch(e){}
            }

        });
    },
            
    setInfo: function(pn){
        $('#push-id').val(pn.id);
        $('#push-name').val(pn.name);
        $('#push-message').val(pn.message);
        $('#push-db').val(pn.db_name);
        $('#push-sql').val(pn.sql_command);
        if(pn.isdeleted == 1){
            notificationForm.deleted();
        } else if(pn.isdeleted == 0){
            notificationForm.active();
        }
        notificationForm.update();
    },
            
    create: function(){
        var name = $('#push-name').val().replace(/^\s+|\s+$/g, ""),
            message = $('#push-message').val().replace(/^\s+|\s+$/g, ""),
            db_name = $('#push-db').val().replace(/^\s+|\s+$/g, ""),
            sql = $('#push-sql').val().replace(/^\s+|\s+$/g, ""),
            company = parseInt($('#com-id').val());
    
        if(!name || !message || !db_name || !sql || !company)
            return;
        
        notificationForm.close();
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'new-notification',
            'name': name,
            'message': message,
            'db_name': db_name,
            'sql': sql,
            'company': company})
                .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var pn = JSON.parse(inf);
                if (!pn['error']) {
                    var inner = '<tr class="notification" data-id="' + pn['data'] + '">' +
                            '<td>' +
                                '<strong>'+name+'</strong>' +
                            '</td>' +
                            '<td>' +
                                '<img class="is-online" src="img/accept.png">' +
                            '</td>' +
                        '</tr>';
                    $('table#push-list tbody').append(inner);
                }
            }
        });
    },
            
    update: function(){
        var name = $('#push-name').val().replace(/^\s+|\s+$/g, ""),
            message = $('#push-message').val().replace(/^\s+|\s+$/g, ""),
            db_name = $('#push-db').val().replace(/^\s+|\s+$/g, ""),
            sql = $('#push-sql').val().replace(/^\s+|\s+$/g, ""),
            company = parseInt($('#com-id').val()),
            id = parseInt($('#push-id').val());
    
        if(!name || !message || !db_name || !sql || !company || id <= 0)
            return;
        
        notificationForm.close();
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'update-notification',
            'name': name,
            'message': message,
            'db_name': db_name,
            'sql': sql,
            'company': company,
            'id': id})
                .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var pn = JSON.parse(inf);
                if (!pn['error']) {
                    $('table#push-list tbody>tr[data-id="'+id+'"] strong').text(name);
                }
            }
        });
    },
            
    delete: function(){
        var id = parseInt($('#push-id').val());
        if(id <= 0)
            return;
        
        notificationForm.close();
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'delete-notification',
            'id': id})
          .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                    $('table#push-list tbody>tr[data-id="'+id+'"] img.is-online').attr('src', 'img/cancel.png');
                }
            }
        });
    },
            
    activate: function(){
        var id = parseInt($('#push-id').val());
        if(id <= 0)
            return;
        
        notificationForm.close();
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'activate-notification',
            'id': id})
          .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                    $('table#push-list tbody>tr[data-id="'+id+'"] img.is-online').attr('src', 'img/accept.png');
                }
            }
        });
    }
};