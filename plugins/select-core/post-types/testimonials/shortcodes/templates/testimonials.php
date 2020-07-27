<div class="qodef-testimonial-content" id="qodef-testimonials-<?php echo esc_attr($current_id) ?>">
    <?php if(has_post_thumbnail()) { ?>
        <div class="qodef-testimonial-image">
            <?php echo get_the_post_thumbnail(get_the_ID(), array(83, 83)); ?>
        </div>
    <?php } ?>
    <div class="qodef-testimonial-text-holder">
        <?php if(!empty($title)) { ?>
            <h5 class="qodef-testimonial-title"><?php echo esc_html($title); ?></h5>
        <?php } ?>
        <?php if(!empty($text)) { ?>
            <p class="qodef-testimonial-text"><?php echo esc_html($text); ?></p>
        <?php } ?>
        <?php if(!empty($author)) { ?>
            <span class="qodef-testimonial-author">&ndash; <?php echo esc_html($author); ?></span>
        <?php } ?>
    </div>
    
</div>