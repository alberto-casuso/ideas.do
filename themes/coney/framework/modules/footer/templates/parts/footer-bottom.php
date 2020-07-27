<div class="qodef-footer-bottom-holder">
	<div class="qodef-footer-bottom-inner <?php echo esc_attr($footer_bottom_grid_class); ?>">
		<div class="qodef-columns-wrapper <?php echo esc_attr($footer_bottom_classes); ?>">
			<div class="qodef-columns-inner">
				<?php for($i = 1; $i <= $footer_bottom_columns; $i++) { ?>
					<div class="qodef-column-content qodef-column-content<?php echo esc_attr($i); ?>">
						<?php
							if(is_active_sidebar('footer_bottom_column_'.$i)) {
								dynamic_sidebar('footer_bottom_column_'.$i);
							}
						?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>