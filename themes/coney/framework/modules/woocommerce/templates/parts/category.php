<?php

if ( $display_category === 'yes' ) {
	$product            = coney_qodef_return_woocommerce_global_variable();
	$product_categories = $product->get_categories( ', ' );

	if ( ! empty( $product_categories ) ) { ?>
        <p class="qodef-<?php echo esc_attr( $class_name ); ?>-category"><?php print coney_qodef_get_module_part( $product_categories ); ?></p>
	<?php } ?>
<?php } ?>