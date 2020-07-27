<?php if($display_blog_widget_area) { ?>
	<div class="qodef-blog-widget-area">
		<div class="qodef-blog-widget-area-inner <?php echo esc_attr($blog_widget_area_grid_class); ?>">
			<div class="qodef-columns-wrapper <?php echo esc_attr($blog_widget_area_classes); ?>">
				<div class="qodef-columns-inner">
					<?php for($i = 1; $i <= $blog_widget_area_columns; $i++) { ?>
						<div class="qodef-column-content qodef-column-content<?php echo esc_attr($i); ?>">
							<?php
								if(is_active_sidebar('blog_widget_area_'.$i)) {
									dynamic_sidebar('blog_widget_area_'.$i);
								}
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>