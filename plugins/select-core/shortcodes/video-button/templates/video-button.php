<?php
$rand = rand(0, 1000);
?>
<div class="qodef-video-button-holder">
	<div class="qodef-video-button-image">
		<?php echo wp_get_attachment_image($video_image, 'full'); ?>
	</div>
	<a class="qodef-video-button-link" href="<?php echo esc_url($video_link); ?>" target="_self" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
		<div class="qodef-video-button-shape">
			<div class="qodef-video-button-play" <?php echo coney_qodef_get_inline_style($play_button_styles); ?>>
				<span class="fa fa-caret-right"></span>
			</div>
		</div>
	</a>
</div>