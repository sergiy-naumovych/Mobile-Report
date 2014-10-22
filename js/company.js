$(function(){
    $(".accordion").accordion({
        heightStyle: "content",
        collapsible: true,
        active: true
    });
    
    $('#saveCompany').bind('click', function(){
        Company.updateCompany();
    });
    
    $("#dc-help-dialog").dialog({
        width: 600,
        height: 800,
        autoOpen: false,
        title: 'HELP',
        open: function(event, ui) {
            //$('#editItem, #editVariable, #addItem').hide();
        }
    });
    
    $('span.dc-help').bind('click', function(){
        HelpDC.dcHelpOpen();
    });
    
});

var Company = {
    
    updateCompany: function(){
        var name = $('#com-name').val().replace(/^\s+|\s+$/g, ""),
            login = $('#com-login').val().replace(/^\s+|\s+$/g, ""),
                pass = $('#com-password').val().replace(/^\s+|\s+$/g, ""),
                 id = parseInt($('#com-id').val()),
                 ip = $('#com-ipaddress').val().replace(/^\s+|\s+$/g, ""),
                 db_login = $('#com-dbusername').val().replace(/^\s+|\s+$/g, ""),
                 db_pass = $('#com-dbpassword').val().replace(/^\s+|\s+$/g, ""),
                 direct_connection = ($('#direct-connection').prop('checked')) ? 1 : 0;

        if (name && login && id && ip && db_login) {
            $('div#loading').show();
            $.post('index.php', {'ajax': true,
                'type': 'update-com',
                'id': id,
                'name': name,
                'login': login,
                'pass': pass,
                'ip': ip,
                'db_login': db_login,
                'db_pass': db_pass,
                'direct_connection': direct_connection})
                    .success(function(inf) {
                        $('div#loading').hide();
                if (inf) {
                    var company = JSON.parse(inf);
                    if(!company['error']){
                        
                    }else{
                        $('#com-login').val('').focus();
                        alert(company['data']);
                        $('div#loading').hide();
                    }
                        //Companies.setNewCompanyInfo(company['data'], name);
                }
            });

        } else {
            return;
        }
    }
};

var HelpDC = {
    dcHelpOpen: function(){
        $("#dc-help-dialog").dialog('open');
    }
};