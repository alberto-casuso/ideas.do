<?php
$product = coney_qodef_return_woocommerce_global_variable();

if ( $display_price === 'yes' && $price_html = $product->get_price_html() ) { ?>
    <div class="qodef-<?php echo esc_attr( $class_name ); ?>-price"><?php print coney_qodef_get_module_part( $price_html ); ?></div>
<?php } ?>