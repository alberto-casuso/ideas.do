<?php
do_action('coney_qodef_before_slider_action');

//$qodef_slider_shortcode = get_post_meta(coney_qodef_get_page_id(), 'qodef_page_slider_meta', true);
if (!empty($qodef_slider_shortcode)) { ?>
	<div class="qodef-slider slide-mcyy">
		<div class="qodef-slider-inner slide-mcyy">
			<?php echo do_shortcode('[rev_slider alias="front-page"]'); // XSS OK ?>
		</div>
	</div>
<?php }

do_action('coney_qodef_after_slider_action');
?>