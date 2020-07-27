<?php
$excerpt_length = isset($params['excerpt_length']) ? $params['excerpt_length'] : '';
$excerpt = coney_qodef_excerpt($excerpt_length);
?>
<?php if($excerpt !== '') { ?>
    <div class="qodef-post-excerpt-holder">
        <p itemprop="description" class="qodef-post-excerpt">
            <?php echo wp_kses_post($excerpt); ?>
        </p>
    </div>
<?php } ?>
