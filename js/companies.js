$(function(){
    $(document).on('click', 'tr.company', function(){
        var id = parseInt($(this).attr('data-id'));
        $('#updateCompany').show();
        $('#saveNewCompany').hide();
        $('#company-password').attr('required', false);
        Companies.getCompanyInfo(id);
    });
    
    $('#createNewCompany').bind('click', function(){
        Companies.clearCompanyForm();
        $('#updateCompany').hide();
        $('#saveNewCompany').show();
        $('#new-company').slideDown();
    });
    
    
    $('#closeNewCompany').bind('click', function(){
        $('#new-company').slideUp();
    });
    
    $('#saveNewCompany').bind('click', function(){
        Companies.createNewCompany();
    });
    
    $('#updateCompany').bind('click', function(){
        Companies.updateCompany();
    });
    
    $(document).on('click', 'a.activate', function(event){
        var id = parseInt($(this).parent('td').parent('tr.company').attr('data-id'));
        Companies.activateCompany(id);
        //alert('activated');
        event.stopPropagation();
    });
    
    $(document).on('click', 'a.delete', function(event){
        var id = parseInt($(this).parent('td').parent('tr.company').attr('data-id'));
        Companies.deleteCompany(id);
        //alert('deleted');
        event.stopPropagation();
    });
});

String.prototype.trim = function(str) { return str.replace(/^\s+|\s+$/g, ""); };

var Companies = {
    
    getCompanyInfo: function(id) {
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'company-info',
            'id': id})
                .success(function(inf) {
            if (inf) {
                var company = JSON.parse(inf);
                Companies.setCompanyInfo(company);
            }

        });
    },
    
    setCompanyInfo: function(company) {
        $('#company-id').val(company['id']);
        $('#company-login').val(company['username']);
        $('#company-name').val(company['comp_name']);
        $('#company-password').val('');
        $('div#loading').hide();
        $('#new-company').slideDown();
    },
            
    clearCompanyForm: function() {
        $('#company-password').attr('required', true);
        $('#company-password').val('');
        $('#company-login').val('');
        $('#company-name').val('');
    },
            
    createNewCompany: function(){
        var name = $('#company-name').val().replace(/^\s+|\s+$/g, ""),
            login = $('#company-login').val().replace(/^\s+|\s+$/g, ""),
                pass = $('#company-password').val().replace(/^\s+|\s+$/g, ""),
                creator = parseInt($('#user-id').val());

        if (name && login && pass) {
            $('div#loading').show();
            $.post('index.php', {'ajax': true,
                'type': 'new-company',
                'name': name,
                'login': login,
                'pass': pass,
                'creator': creator})
                    .success(function(inf) {
                if (inf) {
                    var company = JSON.parse(inf);
                    if(!company['error'])
                        Companies.setNewCompanyInfo(company['data'], name);
                    else{
                        alert(company['data']);
                        $('#company-login').val('').focus();
                        $('div#loading').hide();
                    }
                }
            });

        } else {
            return;
        }
    },
            
    setNewCompanyInfo: function(company, name){
        var del = 'delete',
            inner = '<tr class="company" data-id="'+company+'">' +
                            '<td>' +
                                '<strong>'+name+'</strong>' +
                            '</td>' +
                            '<td>' +
                                '<a href="javascript:none();" class="'+del+'">'+del+'</a>' +
                            '</td>' +
                            '<td>' +
                                '<img class="is-online" src="img/accept.png">' +
                            '</td>' +
                        '</tr>';
        $('table#companies-list tbody').append(inner);
        $('#new-company').slideUp();
        $('div#loading').hide();
    },
            
    deleteCompany: function(company){
        if (company <= 0)
            return;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'delete-company',
            'id': company})
          .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                   $('tr.company[data-id="'+company+'"]').find('a.delete').removeClass('delete').addClass('activate').text('activate');
                    $('tr.company[data-id="'+company+'"]').find('img').attr('src', 'img/cancel.png');
                }
            }
        });
    },
            
    activateCompany: function(company){
        if (company <= 0)
            return;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'activate-company',
            'id': company})
          .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                   $('tr.company[data-id="'+company+'"]').find('a.activate').removeClass('activate').addClass('delete').text('delete');
                   $('tr.company[data-id="'+company+'"]').find('img').attr('src', 'img/accept.png');
                }
            }
        });
    },
            
    updateCompany: function(){
        var name = $('#company-name').val().replace(/^\s+|\s+$/g, ""),
            login = $('#company-login').val().replace(/^\s+|\s+$/g, ""),
                pass = $('#company-password').val().replace(/^\s+|\s+$/g, ""),
                 id = parseInt($('#company-id').val());

        if (name && login && id) {
            $('div#loading').show();
            $.post('index.php', {'ajax': true,
                'type': 'update-company',
                'id': id,
                'name': name,
                'login': login,
                'pass': pass})
                    .success(function(inf) {
                        $('div#loading').hide();
                if (inf) {
                    var company = JSON.parse(inf);
                    if(!company['error']){
                        $('tr.company[data-id="'+id+'"] td>strong').text(name);
                        $('#new-company').slideUp();
                    } else {
                        alert(company['data']);
                        $('#company-login').val('').focus();
                    }
                        //Companies.setNewCompanyInfo(company['data'], name);
                }
            });

        } else {
            return;
        }
    }
};