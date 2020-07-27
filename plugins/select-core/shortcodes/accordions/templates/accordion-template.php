<<?php echo esc_attr($title_tag); ?> class="qodef-title-holder">
    <span class="qodef-accordion-mark">
		<span class="qodef_icon_plus ion-plus"></span>
		<span class="qodef_icon_minus ion-minus"></span>
	</span>
	<span class="qodef-tab-title"><?php echo esc_html($title); ?></span>
</<?php echo esc_attr($title_tag); ?>>
<div class="qodef-accordion-content">
	<div class="qodef-accordion-content-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>