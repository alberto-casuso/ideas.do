<div class="qodef-single-image-holder">
    <div class="qodef-single-image">
        <?php if ($enable_lightbox) { ?>
        <a itemprop="image" href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
        <?php } else if (!empty($link)) { ?>
        <a itemprop="image" href="<?php echo esc_url($link)?>"  title="<?php echo esc_attr($image['alt']); ?>">
            <?php  } ?>
            <?php if(is_array($image_size) && count($image_size)) : ?>
                <?php echo coney_qodef_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            <?php endif; ?>
            <?php if ($enable_lightbox || !empty($link)) { ?>
        </a>
        <?php } ?>
    </div>
</div>