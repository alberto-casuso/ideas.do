<?php defined('ABSPATH') or die("No script kiddies please!");

$wpcd_form_settings = get_option('wpcd_form_settings');
$wpcd_settings = get_option('wpcd_settings');
$hide_replies = (isset($wpcd_settings['hide_replies']) && $wpcd_settings['hide_replies'] == 'enable') ? 'enable' : 'disable';
$show_reply_label = (isset($wpcd_settings['show_reply_label']) && $wpcd_settings['show_reply_label'] != '') ? esc_attr($wpcd_settings['show_reply_label']) : 'Show Replies';
$hide_reply_label = (isset($wpcd_settings['hide_reply_label']) && $wpcd_settings['hide_reply_label'] != '') ? esc_attr($wpcd_settings['hide_reply_label']) : 'Hide Replies';
$reply_button_label = (isset($wpcd_settings['reply_button_label']) && $wpcd_settings['reply_button_label'] != '') ? esc_attr($wpcd_settings['reply_button_label']) : 'Reply';
?>
<ul class="<?php echo $class; ?> " data-comment-id="<?php echo $comment_id; ?>" <?php echo $css ?>>
    <?php
    if($template == 'template-1' || $template == 'template-2' || $template =='template-4'){
        $clearfix= 'wpcd-clearfix';
    }else{
        $clearfix= '';
    }
    ?>
    <div class="wpcd-comment-template wpcd-comment-<?php echo $template ?> <?php echo $clearfix ?>" id= "wpcd-unique-comment-<?php echo $comment_id; ?>" >
        <?php include(WPCD_LITE_PLUGIN_PATH . 'inc/frontend/templates/' . $template . '.php'); ?>
    </div>
    <?php 
        if (!empty($children)) {
            $c = 'wpcd-children' . ' ' . 'wpcd-comment-list';
            if($hide_replies == 'enable'){
                $css= "style='display:none;'";
            }else{
                $css="style='display:block;'";
            }
            WPCD_LITE_CLASS::wpcd_list_comments($children, $c, $css, $template); 
        }else{
            $css="style='display:block;'";
        } 
    ?> 
</ul>
<?php
    $css="style='display:block;'";
?> 