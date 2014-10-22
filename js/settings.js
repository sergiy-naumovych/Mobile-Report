$(function(){
    //////////////////////////////////////////////////////////////////////////
    $('ul.app-links>li:first-child').addClass('selected');
    
    $('ul.app-links>li').bind('click', function(){
        $('ul.app-links>li.selected').removeClass('selected');
        $(this).addClass('selected');
        $('.right-block>div.right-block-content>div').hide();
        var id = $(this).attr('id');
        var form = '';
        
        switch (id) {
            case 'settings-menu':
                form = 'settingsForm';
                break;
            case 'distributors-menu':
                form = 'distributorsForm';
                break;
            case 'subdistributors-menu':
                form = 'subdistributorsForm';
                break;
            case 'serials-menu':
                form = 'serialsForm';
                break;
            case 'company-menu':
                form = 'companyForm';
                break;
            case 'categories-menu':
                form = 'categoriesForm';
                break;
            case 'content-menu':
                form = 'contentForm';
                break;
            case 'push-menu':
                form = 'pushForm';
                break;
            default:
                break;
        }
        
        $('#' + form).show();
    });
    
    $('ul.app-links>li.selected').click();
    ///////////////////////////////////////////////////////////////////////////
});

function none(){};