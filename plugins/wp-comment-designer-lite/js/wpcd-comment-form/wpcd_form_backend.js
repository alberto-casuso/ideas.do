jQuery(document).ready(function ($) {

    $('.wpcd-backend-settings').on('click', '.form-menu-click', function () {
        $('.form-menu-click').removeClass('wpcd-form-menu-active');
        $(this).addClass('wpcd-form-menu-active');
        var menu_id = $(this).attr('id');
        var link = $(this).data('link');
        var pageURL = $(this).attr("href");

        $('.wpcd-form-hashtag-save').find('input[type="hidden"]').val(pageURL);
        if (menu_id == 'field-form-menu') {
            $('.field-form-menu-wrap').show();
            $('.wpcd-form-submit-button').show();
        }
    });
    
    $('.form-menu-click').each(function () {
        var pageURL = $(this).attr("href");
        //location.hash: Return the anchor part of a URL. Assume that the current URL is http://www.example.com/test.htm#part2:
        //var x = location.hash;
        //The result of x will be:
        //#part2
        if (pageURL == location.hash) {
            $(this).click();
        }
    });

    $('body').on('click', '.wpcd-form-field-sort', function (e) {
        var $target = $(event.target);
        if(!$target.hasClass('wpcd-elements-delete-trigger')){
            if ($(this).closest('.wpcd-default-elements-wrap').find('span').hasClass("fa-chevron-down") ) {
                    var selector = $(this);
                    $(this).addClass('wpcd-element-border');
                    selector.children('.wpcd-element-action-buttons').find('span').removeClass().addClass("fa fa-chevron-up");
                    $(this).closest('.wpcd-default-elements-wrap').find('.wpcd-elements-settings-wrap').slideDown(1000, function () {
                    });
            } else {
                var selector = $(this);
                
                selector.children('.wpcd-element-action-buttons').find('span').removeClass().addClass("fa fa-chevron-down");
                $(this).closest('.wpcd-default-elements-wrap').find('.wpcd-elements-settings-wrap').slideUp(1000, function () {

                });
                $(this).closest('.wpcd-element').removeClass('wpcd-element-border');

            }
        }
    });

    // for making the elements sortable
    $('.wpcd-fa').css('cursor', 'pointer');
    $('.wpcd-custom-wrapper').sortable({
        items: '.wpcd-sortable-elements-wrap',
        handle: '.wpcd-fa'
    });

    // for making the option value inside the element sortable
    $('.wpcd-drag').css('cursor', 'pointer');
    $('.wpcd-option-value-wrap').sortable({
        items: '.wpcd-each-option',
        handle: '.wpcd-drag'
    });
});