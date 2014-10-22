$(function() {
    $(document).on('click', 'li.category', function() {
        $('li.graph>div.selected-graph').removeClass('selected-graph');
        $('li.category>div.selected-category').removeClass('selected-category');
        $(this).find('div').addClass('selected-category');
        $('#createNewGraph').show();
        $('#previewForm').hide();
        $('#graphForm').slideUp(500);
        $('#editCategory').show();
    });

    $('#createNewCategory').bind('click', function() {
        $('#category-id').val(0);
        $('#saveNewCategory, #deleteCategory, #activateCategory').hide();
        $('#createCategory').show();
        $('#new-category').slideDown();
    });

    $('#closeNewCategory').bind('click', function() {
        $('#new-category').slideUp();
    });

    $('#saveNewCategory').bind('click', function() {
        var id = parseInt($('#category-id').val()),
                name = $('#category-name').val().replace(/^\s+|\s+$/g, ""),
                picture = parseInt($('.category-icon .addiconContainer').attr('data-id'));
        Categories.updateCategory(id, name, picture);
        $('#new-category').slideUp();
    });

    $('#createCategory').bind('click', function() {
        var company = parseInt($('#com-id').val()),
                name = $('#category-name').val().replace(/^\s+|\s+$/g, ""),
                picture = parseInt($('.category-icon .addiconContainer').attr('data-id'));
        Categories.createCategory(name, picture, company);
    });

    $('#editCategory').bind('click', function() {
        $('#saveNewCategory').show();
        $('#createCategory').hide();
           
        var id = parseInt($('div.selected-category').parent('li.category').attr('data-id'));
        if (id > 0)
            Categories.getCategoryInfo(id);
    });

    $('#categoriesForm .category-icon').bind('click', function() {
        image = $(this);
        $("#pictures-window").dialog('open');
    });
    
    $('#activateCategory').bind('click', function(){
        var id = parseInt($('div.selected-category').parent('li.category').attr('data-id'));
        Categories.activateCategory(id);
    });
    
    $('#deleteCategory').bind('click', function(){
        var id = parseInt($('div.selected-category').parent('li.category').attr('data-id'));
        Categories.deleteCategory(id);
    });

});

var Categories = {
    getCategoryInfo: function(id) {
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'category-info',
            'id': id})
                .success(function(inf) {
            if (inf) {
                var category = JSON.parse(inf);
                Categories.setCategoryInfo(category);
            }

        });
    },
    
    setCategoryInfo: function(category) {
        $('#category-name').val(category['group_name']);
        $('#category-id').val(category['id']);
        Categories.setCategoryPicture(category['image']);
        //$('#company-name').val(category['comp_name']);
        if(category['isdeleted'] == 1){
            $('#activateCategory').show();
            $('#deleteCategory').hide();
        } else {
            $('#activateCategory').hide();
            $('#deleteCategory').show();
        }
        
        
        $('div#loading').hide();
        $('#new-category').slideDown();

    },
    
    setCategoryPicture: function(picture) {
        var inner = $('#pictures-window .addiconContainer[data-id="' + picture + '"]').html();
        $('#categoriesForm .category-icon').find('.addiconContainer').html(inner).attr('data-id', picture);
    },
    
    updateCategory: function(id, name, picture) {
        if (!id || !name || !picture)
            return;

        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'update-category',
            'id': id,
            'name': name,
            'picture': picture})
                .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var company = JSON.parse(inf);
                if (!company['error']) {
                    $('li.category[data-id="' + id + '"]>div>span').text(name);
                }
                //Companies.setNewCompanyInfo(company['data'], name);
            }
        });
    },
    
    createCategory: function(name, picture, company) {
        if (!name || !picture || !company)
            return;

        $('#new-category').slideUp();
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'new-category',
            'name': name,
            'picture': picture,
            'company': company})
                .success(function(inf) {
            $('div#loading').hide();
            if (inf) {
                var company = JSON.parse(inf);
                if (!company['error']) {
                    var inner = '<li class="category" data-online="0" data-id="' + company['data'] + '">' +
                            '<div class="content-page-title">' +
                            '<img src="img/accept.png" class="is-online" align="right">' +
                            '<img src="http://d3mls36nlzebui.cloudfront.net/img/text_area.png" alt="icon" align="absbottom">' +
                            '<span class="page-title-span"> ' + name + '</span>' +
                            '</div>' +
                            '<ol>' +
                            '</ol>' +
                            '</li>';
                    $('ol#categories-list').append(inner);
                }
                //Companies.setNewCompanyInfo(company['data'], name);
            }
        });
    },
            
    deleteCategory: function(category){
        if (category <= 0)
            return;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'delete-category',
            'id': category})
          .success(function(inf) {
            $('div#loading').hide();
            $('#new-category').slideUp();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                    $('li.category[data-id="'+category+'"]').attr('data-online', '1');
                    $('li.category[data-id="'+category+'"]>div>img.is-online').attr('src', 'img/cancel.png');
                }
            }
        });
    },
            
    activateCategory: function(category){
        if (category <= 0)
            return;
        
        $('div#loading').show();
        $.post('index.php', {'ajax': true,
            'type': 'activate-category',
            'id': category})
          .success(function(inf) {
            $('div#loading').hide();
            $('#new-category').slideUp();
            if (inf) {
                var data = JSON.parse(inf);
                if (!data['error']){
                    $('li.category[data-id="'+category+'"]').attr('data-online', '0');
                    $('li.category[data-id="'+category+'"]>div>img.is-online').attr('src', 'img/accept.png');
                }
            }
        });
    }
};