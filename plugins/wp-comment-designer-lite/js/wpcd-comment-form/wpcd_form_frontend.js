jQuery(document).ready(function ($) {

	// for removing unnecessary p tags from frontend
    $('.wp-comment-designer-lite-wrap p').filter(function () {
        return $.trim($(this).text()) === '' && $(this).children().length == 0
    }).remove()
    // for removing unnecessary br tags from frontend
    $('.wp-comment-designer-lite-wrap').find('br').remove()

});