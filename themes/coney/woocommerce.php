<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php
$qodef_sidebar_layout  = coney_qodef_sidebar_layout();
$qodef_sidebar_classes = coney_qodef_sidebar_columns_class();

get_header();
coney_qodef_get_title();
get_template_part('slider');

//Woocommerce content
if ( ! is_singular('product') ) { ?>
	<div class="qodef-container">
		<div class="qodef-container-inner clearfix">
			<div class="qodef-columns-wrapper <?php echo esc_attr($qodef_sidebar_classes); ?>">
				<div class="qodef-columns-inner">
					<div class="qodef-column-content qodef-column-content1">
						<?php coney_qodef_woocommerce_content(); ?>
					</div>
					<?php if($qodef_sidebar_layout !== 'no-sidebar') { ?>
						<div class="qodef-column-content qodef-column-content2">
							<?php get_sidebar(); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>			
<?php } else { ?>
	<div class="qodef-container">
		<div class="qodef-container-inner clearfix">
			<?php coney_qodef_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>