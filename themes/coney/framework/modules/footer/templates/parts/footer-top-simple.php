<div class="qodef-footer-top-simple-holder">
	<div class="qodef-footer-top-simple-inner <?php echo esc_attr($footer_top_grid_class); ?>">
			<?php
				if(is_active_sidebar('footer_top_simple')) {
					dynamic_sidebar('footer_top_simple');
				}
			?>
	</div>
</div>