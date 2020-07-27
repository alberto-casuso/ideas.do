<div class="qodef-banner-holder">
    <div class="qodef-banner-image">
        <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>
	<div class="qodef-banner-table-holder">
		<div class="qodef-banner-text-holder">
			<div class="qodef-banner-text-inner">
				<?php if(!empty($title)) { ?>
					<<?php echo esc_attr($title_tag); ?> class="qodef-banner-title" <?php echo coney_qodef_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php if (!empty($link)) { ?>
        <a itemprop="url" class="qodef-banner-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
    <?php } ?>
</div>