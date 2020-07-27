<?php
$product_image_size = 'shop_thumbnail';

if(has_post_thumbnail()) {
	the_post_thumbnail( get_the_ID(), apply_filters( 'coney_qodef_product_list_image_simple_size', $product_image_size ));
}