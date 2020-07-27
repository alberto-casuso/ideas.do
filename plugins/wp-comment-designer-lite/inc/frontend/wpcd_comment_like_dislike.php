<?php defined('ABSPATH') or die("No script kiddies please!");

$total_like_count = get_comment_meta($comment_id, 'wpcd_like_count', true);
$total_like_count = apply_filters('wpcd_like_count', $total_like_count, $comment_id);
$total_like_count = WPCD_LITE_CLASS::wpcd_number_format($total_like_count);

$total_dislike_count = get_comment_meta($comment_id, 'wpcd_dislike_count', true);
$total_dislike_count = apply_filters('wpcd_dislike_count', $total_dislike_count, $comment_id);
$total_dislike_count = WPCD_LITE_CLASS::wpcd_number_format($total_dislike_count);

$wpcd_settings = get_option('wpcd_settings');
$template = (isset($wpcd_settings['template_number']) && $wpcd_settings['template_number'] != '') ? esc_attr($wpcd_settings['template_number']) : 'template_1';

if(isset($_COOKIE['wpcd_like_'.$comment_id])) {
    $liked = 'wpcd-already-liked';
    $disliked = '';
} else if (isset($_COOKIE['wpcd_dislike_'.$comment_id])){
    $disliked = 'wpcd-already-disliked';
    $liked = '';
} else {
    $liked = '';
    $disliked = '';
}
?>

<div class="wpcd-message" id= "wpcd-message-<?php echo esc_attr($comment_id); ?>"></div>

<div class="wpcd-like-dislike-wrapper wpcd-clearfix">
    <div class="wpcd-like-wrap  wpcd-common-wrap">
        <a href="javascript:void(0);" class="wpcd-like-trigger wpcd-like-dislike-trigger <?php echo $liked; ?>" data-comment-id="<?php echo $comment_id; ?>" data-trigger-type="like" title="like">
            <?php $likeicon = 'fa fa-thumbs-o-up'; ?>
            <span class = "<?php echo $likeicon; ?> wpcd-liked-wrap" > </span>
        </a> 
        <div class="wpcd-count-wrap  wpcd-common-wrap ">
            <span class="wpcd-like-count-wrap wpcd-count-wrapper" id="wpcd-like-count-<?php echo $comment_id; ?>"><?php echo (empty($total_like_count)) ? 0 : $total_like_count; ?>
            </span>

        </div>
    </div>
    <div class="wpcd-dislike-wrap  wpcd-common-wrap">
        <a href="javascript:void(0);" class="wpcd-dislike-trigger wpcd-like-dislike-trigger <?php echo $disliked; ?> " data-comment-id="<?php echo $comment_id; ?>" data-trigger-type="dislike" title="dislike">
            <?php $dislikeicon = 'fa fa-thumbs-o-down'; ?>
            <span class="<?php echo $dislikeicon ?> wpcd-disliked-wrap" ></span>
        </a>
        <div class="wpcd-count-wrap  wpcd-common-wrap ">
            <span class="wpcd-dislike-count-wrap wpcd-count-wrapper" id="wpcd-dislike-count-<?php echo $comment_id; ?>"><?php echo (empty($total_dislike_count)) ? 0 : $total_dislike_count; ?>
            </span>
        </div>
    </div>
</div>