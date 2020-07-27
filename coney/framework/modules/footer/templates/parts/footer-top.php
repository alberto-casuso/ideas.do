<div class="qodef-footer-top-holder">
	<div class="qodef-footer-top-inner <?php echo esc_attr($footer_top_grid_class); ?>">
		<div class="qodef-columns-wrapper <?php echo esc_attr($footer_top_classes); ?>">
			<div class="qodef-columns-inner">
				<?php for($i = 1; $i <= $footer_top_columns; $i++) { ?>
					<div class="qodef-column-content qodef-column-content<?php echo esc_attr($i); ?>">
						<?php
							if(is_active_sidebar('footer_top_column_'.$i)) {
								dynamic_sidebar('footer_top_column_'.$i);
							}
						?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>