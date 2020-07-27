<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
    <div class="wpcd-comment-gravatar">
        <img scr= "<?php echo esc_url($gravatar); ?>" srcset="<?php echo $gravatar; ?>" >
    </div>
    <div class="wpcd-body">
        <div class="wpcd-top">
            <div class="wpcd-author-name"><?php echo esc_html($author_name); ?></div>
            <div class="wpcd-date-time" data-time="<?php echo $time ?>">  
                <?php $date = date_create($time); ?>
                <div class="wpcd-date">
                    <?php echo  esc_html(date_format($date, 'j M Y')); ?>
                </div>
                <div class="wpcd-time">
                    <?php echo esc_html(date_format($date, 'g:ia')); ?>
                </div>
            </div>
            <div class="wpcd-comment wpcd-comment-content-<?php echo $comment_id; ?>" id="wpcd-comment-<?php echo $comment_id; ?>">
                <p><?php echo comment_text($comment_id); ?></p>
                <?php WPCD_LITE_CLASS::wpcd_comment_rating($comment_id);?>
            </div>
        </div>
        <div class="wpcd-comment-footer">
            <?php
            $args = array('reply_text' => $reply_button_label, 'depth' => 1, 'max_depth' => 10, 'add_below' => "wpcd-unique-comment" );
            if (comments_open()) { ?>
                <div class="wpcd-reply-button">
                    <?php comment_reply_link($args, $comment_id, $post_id); ?>
                </div> <?php
            }
            if (!empty($children)) {
                if($hide_replies == 'enable'){
                    ?>
                    <a href="javascript:void(0);" class="wpcd-show-replies-trigger wpcd-show-reply-trigger-<?php echo $comment_id; ?>" data-comment-id="<?php echo $comment_id; ?>"> <?php echo $show_reply_label  ?> </a>

                    <a href="javascript:void(0);" class="wpcd-hide-replies-trigger wpcd-hide-reply-trigger-<?php echo $comment_id; ?>" data-comment-id="<?php echo $comment_id; ?>" style="display:none;"> <?php echo $hide_reply_label ?> </a> <?php
                }
            }
            ?>
        </div>
    </div>