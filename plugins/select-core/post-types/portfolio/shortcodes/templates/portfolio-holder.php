<div class="qodef-portfolio-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php echo qodef_core_get_shortcode_module_template_part('portfolio', 'parts/filter', '', $params); ?>
	
	<div class="qodef-pl-inner clearfix">
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo qodef_core_get_shortcode_module_template_part('portfolio', 'portfolio-item', $item_style, $params);
				endwhile;
			else:
				echo qodef_core_get_shortcode_module_template_part('portfolio', 'parts/posts-not-found');
			endif;
		
			wp_reset_postdata();
		?>
	</div>
	
	<?php echo qodef_core_get_shortcode_module_template_part('portfolio', 'pagination/'.$pagination_type, '', array(), $additional_params); ?>
</div>