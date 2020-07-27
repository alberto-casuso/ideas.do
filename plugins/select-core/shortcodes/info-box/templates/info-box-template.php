<div <?php coney_qodef_class_attribute($holder_classes); ?>>
    <div class="qodef-info-box-holder" <?php coney_qodef_inline_style($box_style); ?>>
        <div class="qodef-info-box-inner">
            <div class="qodef-info-box-icon">
                <span class="qodef-icon">
                    <?php echo coney_qodef_execute_shortcode('qodef_icon', $icon_parameters); ?>
                </span>
            </div>
            <div class="qodef-info-box-title">
                <<?php echo esc_attr($title_tag); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
            </div>
        </div>
        <div class="qodef-info-box-text">
            <p><?php echo esc_html($text); ?></p>
        </div>
        <?php
        if($show_button == "yes" && $button_text !== ''){ ?>
            <div class="qodef-info-box-button">
                <?php echo coney_qodef_get_button_html(array(
                    'link' => $link,
                    'text' => $button_text,
                    'target' => $target
                )); ?>
            </div>
        <?php } ?>
    </div>
</div>