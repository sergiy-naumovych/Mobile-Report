$(function() {

    //$( "#variables-list" ).accordion({ heightStyle: "content" });

    $(document).on('click', 'li.graph', function(event) {
        $('li.graph>div.selected-graph').removeClass('selected-graph');
        $('li.category>div.selected-category').removeClass('selected-category');

        $(this).find('div').addClass('selected-graph');
        event.stopPropagation();
        $('#createNewGraph').hide();
        $('#previewForm').hide();
        $('#graphForm').slideUp(500);
        $('#editCategory').hide();
        $('#btnGraphSave, #btnGraphVariables').show();
        $('#btnGraphCreate').hide();
        var id = parseInt($(this).attr('data-id'));

        Graph.getGraphInfo(id);
    });


    $('#createNewGraph').bind('click', function() {
        var id = parseInt($('div.selected-category').parent('li.category').attr('data-id'));
        $('#graph_group_id').val(id);
        $('#btnGraphSave, #btnGraphVariables').hide();
        $('#btnGraphCreate').show();
        $('#graphForm').slideDown(500);
    });

    $('#btnPreview').click(function() {
        chart_type = parseInt($('#graphForm select#type option:selected').val());
        setOptions();
        $('#graphForm').hide();
        $('#previewForm').show();
    });

    $('#btnBack').click(function() {
        $('#previewForm').hide();
        $('#graphForm').show();
    });

    $('#categoriesForm .graph-icon').bind('click', function() {
        image = $(this);
        $("#pictures-window").dialog('open');
    });

    $('#btnGraphSave').click(function() {
        $('#image').val($('.graph-icon .addiconContainer').attr('data-id'));
        Graph.updateGraph();
    });

    $('#btnGraphCreate').click(function() {
        Graph.createGraph();
    });

    $("#variables-window").dialog({
        width: 520,
        height: 390,
        autoOpen: false,
        title: 'FILTERS <span class="filter-help"><img src="img/info.png" width="18" height="18" /></span>',
        open: function(event, ui) {
            $('#editItem, #editVariable, #addItem').hide();
        }
    });
    
    $("#help-dialog").dialog({
        width: 520,
        height: 390,
        autoOpen: false,
        title: 'HELP',
        open: function(event, ui) {
            //$('#editItem, #editVariable, #addItem').hide();
        }
    });
    
    $("#filter-help").dialog({
        width: 520,
        height: 390,
        autoOpen: false,
        title: 'HELP',
        open: function(event, ui) {
            //$('#editItem, #editVariable, #addItem').hide();
        }
    });

    $('#btnGraphVariables').bind('click', function() {
        Variables.init();
    });

    $('#addVariable').bind('click', function() {
        $('#filter-name, #var-name').val('');
        $('#activateFilter, #updateFilter, #deleteFilter').hide();
        $('#saveNewFilter').show();
        $('#filter-form').slideDown();
    });
    
    $('#closeFilterForm').bind('click', function() {
        $('#filter-form').slideUp();
    });

    $('#addVarItem').bind('click', function() {
        var name = prompt('Item name?'),
                value = prompt('Value?');
        if (name && value) {
            var inner = '<tr class="var-item"><td>' + name + '</td><td>' + value + '</td><td>delete</td></tr>';
            $('#var-items-list tbody').append(inner);
        }
    });

    $(document).on('click', '#variables-list>li.variable', function() {
        $('.selected-item').removeClass('selected-item');
        $(this).addClass('selected-item');
        $('#editVariable, #addItem').show();
        $('#editItem').hide();
        Variables.filter = parseInt($(this).attr('data-id'));
        $(this).find('ol').toggle(500);
    });

    $(document).on('click', '#variables-list li.item', function(event) {
        $('.selected-item').removeClass('selected-item');
        $(this).addClass('selected-item');
        $('#editVariable, #addItem').hide();
        $('#editItem').show();
        Variables.item = parseInt($(this).attr('data-id'));
        event.stopPropagation();
    });
    
    $('#saveNewFilter').bind('click', function(){
        Variables.addFilter();
    });
    
    ////////////////////////////////////////////////////////////////////////////
    $('#addItem').bind('click', function() {
        $('#list-value, #display-value').val('');
        $('#activateItem, #updateItem, #deleteItem').hide();
        $('#saveNewItem').show();
        $('#item-form').slideDown();
    });
    
    $('#editItem').bind('click', function() {
        Items.edit();
    });
    
    $('#closeItemForm').bind('click', function() {
        $('#item-form').slideUp();
    });
    
    $('#deleteFilter').bind('click', function() {
        Variables.deleteFilter();
    });
    
    $('#activateFilter').bind('click', function() {
        Variables.activateFilter();
    });
    
    $('#deleteItem').bind('click', function() {
        Items.deleteItem();
    });
    
    $('#activateItem').bind('click', function() {
        Items.activateItem();
    });
    
    $('#updateFilter').bind('click', function() {
        Variables.updateFilter();
    });
    
    $('#updateItem').bind('click', function() {
        Items.updateItem();
    });
    
    $('#saveNewItem').bind('click', function() {
        Items.addItem();
    });
    
    $('#btnGraphDelete').bind('click', function() {
        var id = parseInt($('#graph-form #id').val());
        Graph.deleteGraph(id);
    });
    
    $('#btnGraphActivate').bind('click', function() {
        var id = parseInt($('#graph-form #id').val());
        Graph.activateGraph(id);
    });
    
    $('#editVariable').bind('click', function() {
        $('#updateFilter').show();
        Variables.edit();
    });
    
    $('span.sql-help').bind('click', function(){
        Help.sqlHelpOpen();
    });

    $('span.filter-help').bind('click', function(){
        Help.filterHelpOpen();
    });

});

var selects = ['type', 'show_axes', 'legend_align', 'legend_enabled',
    'legend_floating', 'legend_layout', 'legend_reversed', 'legend_shadow',
    'legend_vertical_align', 'enableMouseTracking', 'markerEnabled',
    'title_align', 'xAxis_align', 'yAxis_align'];

function none() {};





var Graph = {
    getGraphInfo: function(id) {
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'graph-info',
            'id': id})
                .success(function(inf) {
            if (inf) {
                var graph = JSON.parse(inf);
                Graph.setGraphInfo(graph);
            }

        });
    },
    setGraphInfo: function(graph) {
        for (var key in graph) {
            if (selects.indexOf(key) == -1)
                $('#graphForm #' + key).val(graph[key]);
            else {
                $('select#' + key + ' option:selected').attr('selected', '');
                $('select#' + key + ' option[value="' + graph[key] + '"]').attr('selected', 'selected');
            }
        }
        if(graph['isdeleted'] == 0){
            $('#btnGraphDelete').show();
            $('#btnGraphActivate').hide();
        } else {
            $('#btnGraphDelete').hide();
            $('#btnGraphActivate').show();
        }
        
        var id = graph.image;
        if(id > 0)
            $('.graph-icon .addiconContainer').html($('#pictures-window .addiconContainer[data-id="'+id+'"]').html()).attr('data-id', id);
        else {
            var inner = '<div class="addicon filebox"></div>';
            $('.graph-icon .addiconContainer').html(inner).attr('data-id', id);
        }
        $('div#loading').hide();
        $('#graphForm').slideDown(500);

    },
    setGraphOptions: function() {
        var options = {},
            expr = new RegExp("'", "g");
        for (var item in defaultOptions) {
            var val = $('#graph-form *[name=' + item + ']').val();
            if ($('#graph-form *[name=' + item + ']').attr('type') == 'number') {
                val = parseInt(val);
            } else if (item === 'colors' && val) {
                val = val.replace(/\s+/g, '').split(",");
                val = $.grep(val, function(n) {
                    return(n)
                });
                val = val.toString();
            }
            if ((!val && val !== 0 && val !== '0') || val === undefined) {
                options[item] = defaultOptions[item];
            } else {
                options[item] = (val === '0') ? 0 : val;
            }
            //if(item)
        }
        options.sql_command = $('#graph-form #sql_command').val().replace(expr, "\'");
        console.log(options.sql_command.replace(expr, "\'"));
        options.colors = options.colors.toString();
        return options;
    },
    updateGraph: function() {
        var data = JSON.stringify(Graph.setGraphOptions());
        if (!data)
            return;
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'update-graph',
            'data': data})
                .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']) {
                    var name = $('#graph_name').val(),
                            id = $('#graph-form #id').val();
                    $('li.graph[data-id="' + id + '"] span').text(' ' + name);
                }
            }
        });
    },
    createGraph: function() {
        var data = JSON.stringify(Graph.setGraphOptions());
        if (!data)
            return;
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'create-graph',
            'data': data})
                .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']) {
                    var group = $('#graph_group_id').val(),
                            name = $('#graph_name').val(),
                            inner = '<li data-id="' + data['data'] + '" data-online="0" class="graph">' +
                            '<div class="content-page-title">' +
                            '<img align="right" class="is-online" src="img/accept.png">' +
                            '<img align="absbottom" alt="icon" src="http://d3mls36nlzebui.cloudfront.net/img/text_area.png">' +
                            '<span class="page-title-span"> ' + name + '</span>' +
                            '</div>' +
                            '<ol></ol>' +
                            '</li>';
                    $('li.category[data-id="' + group + '"]>ol').append(inner);
                    $('#graphForm').slideUp();
                }
            }
        });
    },
    deleteGraph: function(graph){
        if (graph <= 0)
            return;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'delete-graph',
            'id': graph})
          .success(function(inf) {
            $('div#loading').hide();
//            $('#new-category').slideUp();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                    $('#btnGraphDelete').hide();
                    $('#btnGraphActivate').show();
                    $('li.graph[data-id="'+graph+'"]').attr('data-online', '1');
                    $('li.graph[data-id="'+graph+'"]>div>img.is-online').attr('src', 'img/cancel.png');
                }
            }
        });
    },
            
    activateGraph: function(graph){
        if (graph <= 0)
            return;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'activate-graph',
            'id': graph})
          .success(function(inf) {
            $('div#loading').hide();
//            $('#new-category').slideUp();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                    $('#btnGraphDelete').show();
                    $('#btnGraphActivate').hide();
                    $('li.graph[data-id="'+graph+'"]').attr('data-online', '0');
                    $('li.graph[data-id="'+graph+'"]>div>img.is-online').attr('src', 'img/accept.png');
                }
            }
        });
    }
};

var Variables = {
    graph: 0,
    filter: 0,
    item: 0,
    init: function() {
        Variables.graph = parseInt($('#graph-form #id').val());
        var id = Variables.graph;
        if (id < 0)
            return;

        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'graph-filter-info',
            'id': id})
                .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var graph = JSON.parse(inf);
                if (!graph['error']) {
                    Variables.createFilterList(graph['data']);
                    Variables.open();
                }
            }

        });
    },
    open: function() {
        $("#variables-window").dialog('open');
    },
            
    close: function() {
        $("#variables-window").dialog('close');
    },
            
    createFilterList: function(data){
        console.log(data);
        var inner = '',
            del = '';
        data.forEach(function(item, index){
            del = (item.isdeleted == 0) ? 'img/accept.png' : 'img/cancel.png';
            inner += '<li class="variable" data-id="'+item.id+'" data-online="'+item.isdeleted+'">' +
                    '<div class="var-page-title">' +
                        '<img align="right" class="is-online" src="'+del+'">' +
                        '<span class="page-title-span">'+item.name+'</span>' +
                    '</div>' +
                    '<ol>' +
                      Variables.createItemsList(item.items) +  
                    '</ol>' +
                '</li>';
        });
        
        $('ol#variables-list').html(inner);
    },
            
    createItemsList: function(data){
        var inner = '',
            del = '';
        data.forEach(function(item, index){
            del = (item.isdeleted == 0) ? 'img/accept.png' : 'img/cancel.png';
            inner += '<li class="item" data-id="'+item.id+'" data-online="'+item.isdeleted+'">' +
                            '<div class="item-page-title">' +
                                '<img align="right" class="is-online" src="'+del+'">' +
                                '<span class="page-title-span">'+item.display_value+'</span>' +
                            '</div>' +
                        '</li>';
        });
        return inner;
    },
            
    addFilter: function(){
        var name = $('#filter-name').val().replace(/^\s+|\s+$/g, ""),
            var_name = $('#var-name').val().replace(/^\s+|\s+$/g, ""),
            filter_type = $('select#var-type option:selected').val(),
            graph = Variables.graph;

        if (name && var_name) {
            $('div#loading').show();
            $.post('index.php', {'ajax': true,
                'type': 'new-filter',
                'name': name,
                'var_name': var_name,
                'graph': graph,
                'filter_type': filter_type})
                    .success(function(inf) {
                if (inf) {
                    $('div#loading').hide();
                    var company = JSON.parse(inf);
                    if(!company['error']){
                        var inner = '<li class="variable" data-id="'+company['data']+'">' +
                                    '<div class="var-page-title">' +
                                        '<img align="right" class="is-online" src="img/cancel.png">' +
                                        '<span class="page-title-span">'+name+'</span>' +
                                    '</div>' +
                                    '<ol>' +
                                    '</ol>' +
                                '</li>';
                        $('ol#variables-list').append(inner);
                    }
                    $('#filter-form').slideUp();    
                }
            });

        } else {
            return;
        }
    },
            
    edit: function(){
        if(Variables.filter < 0)
            return;
        
        var id = Variables.filter;
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'filter-info',
            'id': id})
                .success(function(inf) {
            if (inf) {
                $('div#loading').hide();
                var category = JSON.parse(inf);
                if(!category['error'])
                    Variables.setFilterInfo(category['data']);
            }

        });
    },
            
    setFilterInfo: function(data){
        if(!data)
            return;
        
        $('select#var-type option:selected').attr('selected', false);
        $('select#var-type option[value="'+data['filter_type']+'"]').attr('selected', true);
        
        $('#filter-name').val(data['name']);
        $('#var-name').val(data['var_name']);
        if(data['isdeleted'] == 0){
            $('#activateFilter, #saveNewFilter').hide();
            $('#deleteFilter').show();
        } else {
            $('#activateFilter').show();
            $('#deleteFilter, #saveNewFilter').hide();
        }
        
        $('#filter-form').slideDown();
    },
            
    updateFilter: function() {
        var filter_name = $('#filter-name').val(),
                var_name = $('#var-name').val(),
                filter_type = $('select#var-type option:selected').val(),
                id = Variables.filter;
        if (id <= 0 || !filter_name || !var_name)
            return;

        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'update-filter',
            'id': id,
            'filter_name': filter_name,
            'var_name': var_name,
            'filter_type': filter_type})
                .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var company = JSON.parse(inf);
                if (!company['error']) {
                    $('li.variable[data-id="' + id + '"]>div>span').text(filter_name);
                }
            }
            $('#filter-form').slideUp();
        });
    },
            
    deleteFilter: function(){
        if(Variables.filter < 0)
            return;
        
        var id = Variables.filter;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'delete-filter',
            'id': id})
          .success(function(inf) {
            $('div#loading').hide();
            $('#filter-form').slideUp();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                    $('li.variable[data-id="'+id+'"]').attr('data-online', '1');
                    $('li.variable[data-id="'+id+'"]>div>img.is-online').attr('src', 'img/cancel.png');
                }
            }
            $('#filter-form').slideUp();
        });
    },
            
    activateFilter: function(){
        if(Variables.filter < 0)
            return;
        
        var id = Variables.filter;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'activate-filter',
            'id': id})
          .success(function(inf) {
            $('div#loading').hide();
            $('#filter-form').slideUp();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                    $('li.variable[data-id="'+id+'"]').attr('data-online', '0');
                    $('li.variable[data-id="'+id+'"]>div>img.is-online').attr('src', 'img/accept.png');
                }
            }
            $('#filter-form').slideUp();
        });
    }
};

var Items = {
    addItem: function(){
        var list_value = $('#list-value').val().replace(/^\s+|\s+$/g, ""),
            display_value = $('#display-value').val().replace(/^\s+|\s+$/g, ""),
            graph_filter = Variables.filter;

        if (list_value && display_value && graph_filter > 0) {
            $('div#loading').show();
            $.post('index.php', {'ajax': true,
                'type': 'new-item',
                'list_value': list_value,
                'display_value': display_value,
                'graph_filter': graph_filter})
                    .success(function(inf) {
                if (inf) {
                    $('div#loading').hide();
                    var company = JSON.parse(inf);
                    if(!company['error']){
                        var inner = '<li class="item" data-id="'+company['data']+'">' +
                            '<div class="item-page-title">' +
                                '<img align="right" class="is-online" src="img/cancel.png">' +
                                '<span class="page-title-span">'+display_value+'</span>' +
                            '</div>' +
                        '</li>';
                        $('li.variable[data-id="'+graph_filter+'"] ol').append(inner);
                    }
                    $('#item-form').slideUp();    
                }
            });

        } else {
            return;
        }
    },
            
    edit: function(){
        if(Variables.item < 0)
            return;
        
        var id = Variables.item;
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'item-info',
            'id': id})
                .success(function(inf) {
            if (inf) {
                $('div#loading').hide();
                var category = JSON.parse(inf);
                if(!category['error'])
                    Items.setItemInfo(category['data']);
            }

        });
    },
            
    setItemInfo: function(data){
        if(!data)
            return;
        
        $('#display-value').val(data['display_value']);
        $('#list-value').val(data['list_value']);
        if(data['isdeleted'] == 0){
            $('#activateItem, #saveNewItem').hide();
            $('#deleteItem').show();
        } else {
            $('#activateItem').show();
            $('#deleteItem, #saveNewItem').hide();
        }
        
        $('#item-form').slideDown();
    },
            
    updateItem: function() {
        var list_value = $('#list-value').val(),
                display_value = $('#display-value').val(),
                id = Variables.item;
        if (id <= 0 || !list_value || !display_value)
            return;

        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'update-item',
            'id': id,
            'list_value': list_value,
            'display_value': display_value})
                .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var company = JSON.parse(inf);
                if (!company['error']) {
                    $('li.item[data-id="' + id + '"]>div>span').text(display_value);
                }
            }
            $('#item-form').slideUp();
        });
    },
            
    deleteItem: function(){
        if(Variables.item < 0)
            return;
        
        var id = Variables.item;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'delete-item',
            'id': id})
          .success(function(inf) {
            $('div#loading').hide();
            $('#filter-form').slideUp();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                    $('li.item[data-id="'+id+'"]').attr('data-online', '1');
                    $('li.item[data-id="'+id+'"]>div>img.is-online').attr('src', 'img/cancel.png');
                }
            }
            $('#item-form').slideUp();
        });
    },
            
    activateItem: function(){
        if(Variables.item < 0)
            return;
        
        var id = Variables.item;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'activate-item',
            'id': id})
          .success(function(inf) {
            $('div#loading').hide();
            $('#filter-form').slideUp();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                    $('li.item[data-id="'+id+'"]').attr('data-online', '0');
                    $('li.item[data-id="'+id+'"]>div>img.is-online').attr('src', 'img/accept.png');
                }
            }
            $('#item-form').slideUp();
        });
    }
};

var Help = {
    sqlHelpOpen: function(){
        $("#help-dialog").dialog('open');
    },
    
    filterHelpOpen: function(){
        $("#filter-help").dialog('open');
    }
};