$(function(){
    $(document).on('click', 'tr.serial', function(){
        $('#new-serial').slideDown();
        var id = parseInt($(this).attr('data-id'));
        Serials.getSerialInfo(id);
        
    });
    
    $('#createNewSerial').bind('click', function(){
        Serials.createNewSerial();
    });
    
    
    $('#closeNewSerial').bind('click', function(){
        $('#new-serial').slideUp();
    });
    
    $('#saveNewSerial').bind('click', function(){
        Serials.updateSerial();
    });
    
  

});

String.prototype.trim = function(str) { return str.replace(/^\s+|\s+$/g, ""); };

var Serials = {
    
    createNewSerial: function(){
        try {
            $('div#loading').show();
            $.post('index.php', {'ajax': true,
                'type': 'new-serial'
                })
                  .success(function(inf) {
                if (inf) {
                    var serial = JSON.parse(inf);
                    Serials.setNewSerial(serial);
                }

            });
        } catch(e) {
            $('div#loading').hide();
        }
    },
    
    setNewSerial: function(serial){
        if(serial['error']){
            $('div#loading').hide();
            return;
        } 
        var inner = '<tr class="serial" data-id="' + serial['data'] + '">' +
                            '<td>' +
                                '<strong>' + serial['serial'] + '</strong>' +
                            '</td>' +
                            '<td>' +
                                '<strong> </strong>' +
                            '</td>' +
                            '<td>' +
                                '<strong> </strong>' +
                            '</td>' +
                            '<td>' +
                                '<strong> </strong>' +
                            '</td>' +
                            '<td>' +
                                '<strong>open</strong>' +
                            '</td>' +
                        '</tr>';
        $('table#serials-list tbody').append(inner);
        $('div#loading').hide();
    },
    
    getSerialInfo: function(id){
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'serial-info',
            'id': id})
                .success(function(inf) {
            if (inf) {
                var serial = JSON.parse(inf);
                if (!serial['error'])
                    Serials.setSerialInfo(serial['data']);
                else
                    $('div#loading').show();
            }

        });
    },
    
    setSerialInfo: function(serial){
        if(serial == ''){
            $('div#loading').hide();
            return;
        }
        //console.log(serial);
        //setting serial id
        $('#serial-id').val(serial.id);
        
        
        
        $("#distributors-select option:selected").prop("selected", false);
        $("#subdistributors-select option:selected").prop("selected", false);
        $("#customers-select option:selected").prop("selected", false);
        $("#statuses-select option:selected").prop("selected", false);
    
        $('#distributors-select option[value="'+serial.distributor+'"]')
                .prop("selected", true);
        
      
        $('#subdistributors-select option[value="'+serial.subdistributor+'"]')
                .prop("selected", true);
        
        $('#customers-select option[value="'+serial.customer+'"]')
                .prop("selected", true);
        
       
        $('#statuses-select option[value="'+serial.status+'"]')
                .prop("selected", true);
    
    
        $('#new-serial').slideDown();
        $('div#loading').hide();
    },
    
    updateSerial: function(){
        var id = parseInt($('#serial-id').val()),
            distributor = parseInt($('#distributors-select option:selected').val()),
            subdistributor = parseInt($('#subdistributors-select option:selected').val()),
            status = parseInt($('#statuses-select option:selected').val()),
            customer = parseInt($('#customers-select option:selected').val());
            
    
        //console.log(id + ' ' + distributor + ' ' + subdistributor + ' '+ status);
        
        subdistributor = (subdistributor >= 0) ? subdistributor : 0;
        distributor = (distributor >= 0) ? distributor : 0;
        customer = (customer >= 0) ? customer : 0;
        
        var options = {
                status: $('#statuses-select option:selected').text(),
                distributor: $('#distributors-select option:selected').text(),
                subdistributor: $('#subdistributors-select option:selected').text(),
                customer: $('#customers-select option:selected').text()
            };
        
        if (id > 0) {
            $('div#loading').show();
            $.post('index.php', {'ajax': true,
                'type': 'update-serial',
                'id': id,
                'distributor': distributor,
                'subdistributor': subdistributor,
                'customer': customer,
                'status': status})
                    .success(function(inf) {
                        $('div#loading').hide();
                var error = JSON.parse(inf);
                //console.log(error);
                if (!error['error']) {
                    var obj = $('tr.serial[data-id="'+id+'"]');
                    $(obj).find('td.sdistributor').html('<b>' + options.distributor + '</b>').attr('data-id', distributor);
                    $(obj).find('td.ssubdistributor').html('<b>' + options.subdistributor + '</b>').attr('data-id', subdistributor);
                    $(obj).find('td.sstatus').html('<b>' + options.status + '</b>').attr('data-id', status);
                    $(obj).find('td.scustomer').html('<b>' + options.customer + '</b>').attr('data-id', customer);
                }
                
                $('#new-serial').slideUp();
            });

        } else {
            return;
        }
    }
    
};