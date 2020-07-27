<div <?php coney_qodef_class_attribute($holder_class) ?>>
	<<?php echo esc_attr($title_tag);?> class="qodef-pb-title-holder clearfix">
		<span class="qodef-pb-title"><?php echo esc_html($title)?></span>
        <span class="qodef-pb-number-wrapper">
            <span class="qodef-pb-number-box">
               <span class="qodef-pb-number">0</span>
            <span class="qodef-pb-down-arrow"></span>
            </span>
        </span>
	</<?php echo esc_attr($title_tag)?>>
	<div class="qodef-pb-content-holder" <?php echo coney_qodef_inline_style($inactive_bar_style) ?>>
		<div data-percentage=<?php echo esc_attr($percent)?> class="qodef-pb-content" <?php echo coney_qodef_inline_style($active_bar_style) ?>></div>
	</div>
</div>