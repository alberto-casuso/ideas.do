jQuery(document).ready(function ($) {
    // for removing unnecessary p tags from frontend
    $('.wp-comment-designer-lite-wrap p').filter(function () {
        return $.trim($(this).text()) === '' && $(this).children().length == 0
    }).remove()

    $('.wp-comment-designer-lite-wrap small').filter(function () {
        return $.trim($(this).text()) === '' && $(this).children().length == 0
    }).remove()
    // for removing unnecessary br tags from frontend
    $('.wp-comment-designer-lite-wrap').find('br').remove()
    
    // Control Like/Dislike using Cookies for comment rating
    function wpcd_setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }

    function wpcd_getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
         for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function wpcd_deleteCookie(name) {
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }

    $('body').on('click', '.wpcd-like-dislike-trigger', function(e) {
        var $this = $(this);
        e.preventDefault();
        var comment_id = $(this).data('comment-id');
        var trigger_type = $(this).data('trigger-type');
        var wpcd_like_cookie = wpcd_getCookie('wpcd_like_' + comment_id);
        var wpcd_dislike_cookie = wpcd_getCookie('wpcd_dislike_' + comment_id);
        var current_like_count = $this.closest('.wpcd-like-dislike-wrapper').find('.wpcd-like-count-wrap').html();
        var current_dislike_count = $this.closest('.wpcd-like-dislike-wrapper').find('.wpcd-dislike-count-wrap').html();

        //when clicked on like
        if(trigger_type == 'like' && wpcd_like_cookie == '' ){
            if (!$this.hasClass('wpcd-dislike-trigger')) {
                var cookie_name = 'wpcd_' + trigger_type + '_' + comment_id;
                wpcd_setCookie(cookie_name, 1, 365);
                if (wpcd_dislike_cookie == '') {
                    var end_character = current_like_count.slice(-1);
                    if(end_character=="K" || end_character=="M" || end_character=="B" || end_character=="T")
                    {
                        var new_like_count = parseInt(current_like_count);
                        var new_dislike_count = parseInt(current_dislike_count);
                    }
                    else{
                        var new_like_count = parseInt(current_like_count) + 1;
                        var new_dislike_count = parseInt(current_dislike_count);
                    }
                }
                if (wpcd_dislike_cookie != '') {
                    var end_character = current_like_count.slice(-1);
                    if(end_character=="K" || end_character=="M" || end_character=="B" || end_character=="T")
                    {
                        var new_like_count = parseInt(current_like_count);
                        var new_dislike_count = parseInt(current_dislike_count);
                    }
                    else{
                        var new_dislike_count = parseInt(current_dislike_count) - 1;
                        if (new_dislike_count < 0){
                            new_dislike_count = 0;
                        }
                        var new_like_count = parseInt(current_like_count) + 1;
                    }
                }
                $('#wpcd-like-count-' + comment_id).html(new_like_count);
                $('#wpcd-dislike-count-' + comment_id).html(new_dislike_count);
                var not_trigger_type = 'dislike';
                wpcd_like_dislike_cookie(trigger_type, comment_id, $this, not_trigger_type);
            }
        }
        //when clicked on dislike
        if (wpcd_dislike_cookie == '' && trigger_type == 'dislike') {
            var cookie_name = 'wpcd_' + trigger_type + '_' + comment_id;
            wpcd_setCookie(cookie_name, 1, 365);
            if (!$this.hasClass('wpcd-like-trigger')) {
                if (wpcd_like_cookie == '') {
                    var end_character = current_dislike_count.slice(-1);
                    if(end_character=="K" || end_character=="M" || end_character=="B" || end_character=="T")
                    {
                        var new_like_count = parseInt(current_like_count);
                        var new_dislike_count = parseInt(current_dislike_count);
                    }else{
                        var new_dislike_count = parseInt(current_dislike_count) + 1;
                        var new_like_count = parseInt(current_like_count);
                    }
                }
                if (wpcd_like_cookie != '') {
                    var end_character = current_dislike_count.slice(-1);
                    if(end_character=="K" || end_character=="M" || end_character=="B" || end_character=="T")
                    {
                        var new_like_count = parseInt(current_like_count);
                        var new_dislike_count = parseInt(current_dislike_count);
                    }else{
                        var new_like_count = parseInt(current_like_count) - 1;
                        if (new_like_count < 0){
                            new_like_count = 0;
                        }
                        var new_dislike_count = parseInt(current_dislike_count) + 1;
                    }
                }
                $('#wpcd-like-count-' + comment_id).html(new_like_count);
                $('#wpcd-dislike-count-' + comment_id).html(new_dislike_count);
                var not_trigger_type = 'like';
                wpcd_like_dislike_cookie(trigger_type, comment_id, $this, not_trigger_type);
            }
        }
    });

    function wpcd_like_dislike_cookie(trigger_type, comment_id, $this, not_trigger_type) {
        var wpcd_like_cookie = wpcd_getCookie('wpcd_like_' + comment_id);
        var wpcd_dislike_cookie = wpcd_getCookie('wpcd_dislike_' + comment_id);

        if ($this.hasClass('wpcd-like-trigger')) {
            $('.wpcd-dislike-trigger', $this.closest(".wpcd-like-dislike-wrapper")).removeClass("wpcd-already-disliked");
            $this.addClass("wpcd-already-liked");
        }

        if ($this.hasClass('wpcd-dislike-trigger')) {
            $('.wpcd-like-trigger', $this.closest(".wpcd-like-dislike-wrapper")).removeClass("wpcd-already-liked");
            $this.addClass("wpcd-already-disliked");
        }
        
        $.ajax({
            type: 'post',
            url: wpcd_frontend_js_obj.ajax_url,
            data: {
                comment_id: comment_id,
                wpcd_like_cookie: wpcd_like_cookie,
                wpcd_dislike_cookie:wpcd_dislike_cookie,
                action: 'wpcd_comment_ajax_action',
                type: trigger_type,
                _wpnonce: wpcd_frontend_js_obj.ajax_nonce
            },
            beforeSend: function (xhr) {
            },
            success: function (res) {
                console.log(res);
                res = $.parseJSON(res);
                var cookie_name = 'wpcd_' + trigger_type + '_' + comment_id;
                var del_cookie = 'wpcd_' + not_trigger_type + '_' + comment_id;
                wpcd_deleteCookie(del_cookie);
                wpcd_setCookie(cookie_name, 1, 365);
                var latest_like_count = res.latest_like_count;
                var latest_dislike_count = res.latest_dislike_count;
                $('#wpcd-like-count-' + comment_id).html(latest_like_count);
                $('#wpcd-dislike-count-' + comment_id).html(latest_dislike_count);
            }
        });
    }

    $('.wp-comment-designer-lite-wrap').on('click', '.wpcd-page-link', function (e) {
        $(this).closest('.wpcd-comment-pagination-wrapper').find('.wpcd-page-link').removeClass('wpcd-current-page');
        $(this).addClass('wpcd-current-page');
        var post_id = $('#wpcd-current-post-id').val();
        var page_number = $(this).data('page-number');
        var total_page = $(this).data('total-page');
        var pagination_type = $(this).data('pagination-type');
        var template = $(this).closest('.wp-comment-designer-lite-wrap').attr('data-template-demo');
        $.ajax({
            type: 'post',
            url: wpcd_frontend_js_obj.ajax_url,
            data: {
                page_number: page_number,
                template:template,
                post_id: post_id,
                action: 'wpcd_comment_pagination_ajax_action',
                _wpnonce: wpcd_frontend_js_obj.ajax_nonce
            },
            cache:false,
            beforeSend: function (xhr) {
                $('.wpcd-page-number-loader').show();
            },
            success: function (res) {
                $('.wpcd-page-number-loader').hide();
                var pagination_html = pagination_html_function(page_number, total_page, pagination_type);
                $('.wpcd-comment-list-inner').replaceWith(res);
                $('.wpcd-comment-pagination-wrapper').replaceWith(pagination_html);
                $('html, body').animate({
                    scrollTop: $(".wpcd-comment-listing-wrap").offset().top
                }, 1000);
            }
        });
    });

    $('body').on('click', '.wpcd-next-page,.wpcd-previous-page', function () {
        var post_id = $('#wpcd-current-post-id').val();
        var total_page = $(this).data('total-page');
        var pagination_type = $(this).data('pagination-type');
        var current_page = $(this).closest('.wpcd-comment-pagination-wrapper').find('.wpcd-current-page').data('page-number');
        var next_page = parseInt(current_page) + 1;
        var previous_page = parseInt(current_page) - 1;
        var template = $(this).closest('.wp-comment-designer-lite-wrap').attr('data-template-demo');

        if ($(this).hasClass('wpcd-previous-page')) {
            current_page = previous_page;
        } else {
            current_page = next_page;
        }

        $.ajax({
            type: 'post',
            url: wpcd_frontend_js_obj.ajax_url,
            data: {
                page_number: current_page,
                template:template,
                post_id: post_id,
                action: 'wpcd_comment_pagination_ajax_action',
                 _wpnonce: wpcd_frontend_js_obj.ajax_nonce
            },
            beforeSend: function (xhr) {
                $('.wpcd-page-number-loader').show();
            },
            success: function (res) {
                $('.wpcd-page-number-loader').hide();
                var pagination_html = pagination_html_function(current_page, total_page, pagination_type);
                $('.wpcd-comment-list-inner').replaceWith(res);
                $('.wpcd-comment-pagination-wrapper').replaceWith(pagination_html);
                $('html, body').animate({
                    scrollTop: $(".wpcd-comment-listing-wrap").offset().top
                }, 1000);
            }
        });
    });

    function pagination_html_function(page_number, total_page, pagination_type) {
        var pagination_html = '';
        var current_page = page_number;
        var page_number_loader= wpcd_frontend_js_obj.page_number_loader;
        pagination_html += '<div class="wpcd-comment-pagination-wrapper wpcd-' + pagination_type + '"> <ul>';

        if (current_page > 1) {
            pagination_html += '<li class="wpcd-previous-page-wrap">' +
                '<a href="javascript:void(0);" class="wpcd-previous-page" data-total-page="' + total_page + '" data-pagination-type="page-number">' +
                '<i class="fa fa-angle-left"></i>' +
                '</a>' +
                '</li>';
        }
        var lower_limit = current_page;
        var upper_limit = total_page;

        for (var page_count = lower_limit; page_count <= upper_limit; page_count++) {
            var page_class = (current_page == page_count) ? 'wpcd-current-page wpcd-page-link' : 'wpcd-page-link';
            pagination_html += '<li class="wpcd-fa">' +
                '<a href="javascript:void(0);" data-total-page="' + total_page + '" data-page-number="' + page_count + '" class="' + page_class + '" data-pagination-type="page-number" >' +
                page_count 
                '</a>' +
                '</li>';
        }

        if (current_page < total_page) {
            pagination_html += '<li class="wpcd-next-page-wrap">' +
                '<a href="javascript:void(0);" data-total-page="' + total_page + '" class="wpcd-next-page"' + '" data-pagination-type="' + pagination_type + '">' +
                '<i class="fa fa-angle-right"></i>' +
                '</a>' +
                '</li>';
        }

        pagination_html += '</ul> <img src="'+ page_number_loader +'" class="wpcd-page-number-loader" style="display:none;"></div>';
        return pagination_html;
    }

    $('body').on('click', '.wpcd-show-replies-trigger', function () {
        var comment_id = $(this).data('comment-id');
        $(this).closest('.wpcd-comment-template').siblings("ul").slideDown(400, function () { });
        $('.wpcd-hide-reply-trigger-'+comment_id).show();
        $('.wpcd-show-reply-trigger-'+comment_id).hide();
    });

    $('body').on('click', '.wpcd-hide-replies-trigger', function () {
        var comment_id = $(this).data('comment-id');
        $(this).closest('.wpcd-comment-template').siblings("ul").slideUp(400, function () { });
        $('.wpcd-hide-reply-trigger-'+comment_id).hide();
        $('.wpcd-show-reply-trigger-'+comment_id).show();
    });
        
});