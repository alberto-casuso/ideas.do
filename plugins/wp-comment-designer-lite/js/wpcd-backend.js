jQuery(document).ready(function ($) {
    //For Working of the Tabs
    $('.wpcd-backend-settings').on('click', '.menu-click', function () {
        $('.menu-click').removeClass('wpcd-menu-active');
        $(this).addClass('wpcd-menu-active');
        var menu_id = $(this).attr('id');
        var link = $(this).data('link');
        var pageURL = $(this).attr("href");

        $('.wpcd-hashtag-save').find('input[type="hidden"]').val(pageURL);
        if (menu_id == 'general-menu') {
            $('.display-menu-wrap').hide();
            $('.pagination-menu-wrap').hide();
            $('.customization-menu-wrap').hide();
            $('.general-menu-wrap').show();
            $('.wpcd-submit-button').show();
        }
        if (menu_id == 'display-menu') {
            $('.general-menu-wrap').hide();
            $('.pagination-menu-wrap').hide();
            $('.customization-menu-wrap').hide();
            $('.display-menu-wrap').show();
            $('.wpcd-submit-button').show();
        }
        if (menu_id == 'pagination-menu') {
            $('.general-menu-wrap').hide();
            $('.display-menu-wrap').hide();
            $('.customization-menu-wrap').hide();
            $('.pagination-menu-wrap').show();
            $('.wpcd-submit-button').show();
        }
        if (menu_id == 'customization-menu') {
            $('.general-menu-wrap').hide();
            $('.display-menu-wrap').hide();
            $('.pagination-menu-wrap').hide();
            $('.customization-menu-wrap').show();
            $('.wpcd-submit-button').show();
        }
    });

    $('.menu-click').each(function () {
        var pageURL = $(this).attr("href");
        if (pageURL == location.hash) {
            //location.hash: Return the anchor part of a URL. Assume that the current URL is http://www.example.com/test.htm#part2:
            //var x = location.hash;
            //The result of x will be:
            //#part2
            $(this).click();
        }
    });

    //Comment form type
    $('.form_type_status_mode').change(function () {
        if ($(this).val() == 'custom') {
            $('.wpcd-custom-fields-drap-and-drop').show();
        } else {
            $('.wpcd-custom-fields-drap-and-drop').hide();
        }
    });
    
    $('.wpcd-show-hide-replies').change(function () {
        if ($(this).val() == 'enable') {
            $('.wpcd-show-replies-div').show();
            $('.wpcd-hide-replies-div').show();
        } else {
            $('.wpcd-show-replies-div').hide();
            $('.wpcd-hide-replies-div').hide();
        }
    });
    
    //comment list template
    $(".wpcd-common").first().addClass("temp-active");
    $('#icon-template').on('change', function () {
        template_value = $(this).val();
        var array_break = template_value.split('-');
        var current_id = array_break[1];

        if (current_id <= 15) {
            $('#wpcd-temp-demo-' + current_id).removeClass('temp-active');
            $('.wpcd-common').hide();
            $(this).addClass('temp-active');
            $('#wpcd-temp-demo-' + current_id).show();
        }
    });

    if ($("#icon-template option:selected")[0]) {
        cur_temp_val = $('#icon-template option:selected').val();
        var array_break = cur_temp_val.split('-');
        var current_id = array_break[1];
        $('.wpcd-common').hide();
        $('#wpcd-temp-demo-' + current_id).show();
    }
});