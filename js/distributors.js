$(function(){
    $(document).on('click', 'tr.distributor', function(){
        var id = parseInt($(this).attr('data-id'));
        $('#updateDistributor').show();
        $('#saveNewDistributor').hide();
        $('#distributor-password').attr('required', false);
        Distributors.getCompanyInfo(id);
    });
    
    $('#createNewDistributor').bind('click', function(){
        Distributors.clearCompanyForm();
        $('#updateDistributor').hide();
        $('#saveNewDistributor').show();
        $('#new-distributor').slideDown();
    });
    
    
    $('#closeNewDistributor').bind('click', function(){
        $('#new-distributor').slideUp();
    });
    
    $('#saveNewDistributor').bind('click', function(){
        Distributors.createNewCompany();
    });
    
    $('#updateDistributor').bind('click', function(){
        Distributors.updateCompany();
    });
    
    $(document).on('click', 'a.activate', function(event){
        var id = parseInt($(this).parent('td').parent('tr.distributor').attr('data-id'));
        Distributors.activateCompany(id);
        //alert('activated');
        event.stopPropagation();
    });
    
    $(document).on('click', 'a.delete', function(event){
        var id = parseInt($(this).parent('td').parent('tr.distributor').attr('data-id'));
        Distributors.deleteCompany(id);
        //alert('deleted');
        event.stopPropagation();
    });
});

String.prototype.trim = function(str) { return str.replace(/^\s+|\s+$/g, ""); };

var Distributors = {
    
    getCompanyInfo: function(id) {
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'company-info',
            'id': id})
                .success(function(inf) {
            if (inf) {
                var company = JSON.parse(inf);
                Distributors.setCompanyInfo(company);
            }

        });
    },
    
    setCompanyInfo: function(company) {
        $('#distributor-id').val(company['id']);
        $('#distributor-login').val(company['username']);
        $('#distributor-name').val(company['comp_name']);
        $('#distributor-password').val('');
        $('div#loading').hide();
        $('#new-distributor').slideDown();
    },
            
    clearCompanyForm: function() {
        $('#distributor-password').attr('required', true);
        $('#distributor-password').val('');
        $('#distributor-login').val('');
        $('#distributor-name').val('');
    },
            
    createNewCompany: function(){
        var name = $('#distributor-name').val().replace(/^\s+|\s+$/g, ""),
            login = $('#distributor-login').val().replace(/^\s+|\s+$/g, ""),
                pass = $('#distributor-password').val().replace(/^\s+|\s+$/g, ""),
                creator = parseInt($('#user-id').val());

        if (name && login && pass) {
            $('div#loading').show();
            $.post('index.php', {'ajax': true,
                'type': 'new-distributor',
                'name': name,
                'login': login,
                'pass': pass,
                'creator': creator})
                    .success(function(inf) {
                if (inf) {
                    var company = JSON.parse(inf);
                    if(!company['error'])
                        Distributors.setNewCompanyInfo(company['data'], name);
                    else{
                        alert(company['data']);
                        $('#distributor-login').val('').focus();
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
            inner = '<tr class="distributor" data-id="'+company+'">' +
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
        $('table#distributors-list tbody').append(inner);
        $('#new-distributor').slideUp();
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
                   $('tr.distributor[data-id="'+company+'"]').find('a.delete').removeClass('delete').addClass('activate').text('activate');
                    $('tr.distributor[data-id="'+company+'"]').find('img').attr('src', 'img/cancel.png');
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
                   $('tr.distributor[data-id="'+company+'"]').find('a.activate').removeClass('activate').addClass('delete').text('delete');
                   $('tr.distributor[data-id="'+company+'"]').find('img').attr('src', 'img/accept.png');
                }
            }
        });
    },
            
    updateCompany: function(){
        var name = $('#distributor-name').val().replace(/^\s+|\s+$/g, ""),
            login = $('#distributor-login').val().replace(/^\s+|\s+$/g, ""),
                pass = $('#distributor-password').val().replace(/^\s+|\s+$/g, ""),
                 id = parseInt($('#distributor-id').val());

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
                        $('tr.distributor[data-id="'+id+'"] td>strong').text(name);
                        $('#new-distributor').slideUp();
                    } else {
                        alert(company['data']);
                        $('#distributor-login').val('').focus();
                    }
                        //Companies.setNewCompanyInfo(company['data'], name);
                }
            });

        } else {
            return;
        }
    }
};