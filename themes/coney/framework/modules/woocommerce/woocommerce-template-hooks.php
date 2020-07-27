<?php

if ( ! function_exists( 'coney_qodef_woocommerce_products_per_page' ) ) {
	/**
	 * Function that sets number of products per page. Default is 9
	 * @return int number of products to be shown per page
	 */
	function coney_qodef_woocommerce_products_per_page() {

		$products_per_page = 12;

		if ( coney_qodef_options()->getOptionValue( 'qodef_woo_products_per_page' ) ) {
			$products_per_page = coney_qodef_options()->getOptionValue( 'qodef_woo_products_per_page' );
		}
		if ( isset( $_GET['woo-products-count'] ) && $_GET['woo-products-count'] === 'view-all' ) {
			$products_per_page = 9999;
		}

		return $products_per_page;
	}
}

if ( ! function_exists( 'coney_qodef_woocommerce_thumbnails_per_row' ) ) {
	/**
	 * Function that sets number of thumbnails on single product page per row. Default is 4
	 * @return int number of thumbnails to be shown on single product page per row
	 */
	function coney_qodef_woocommerce_thumbnails_per_row() {

		return 3;
	}
}

if ( ! function_exists( 'coney_qodef_woocommerce_related_products_args' ) ) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 *
	 * @param $args array array of args for the query
	 *
	 * @return mixed array of changed args
	 */
	function coney_qodef_woocommerce_related_products_args( $args ) {
		$related = coney_qodef_options()->getOptionValue( 'qodef_woo_product_list_columns' );

		if ( ! empty( $related ) ) {
			switch ( $related ) {
				case 'qodef-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'qodef-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}
		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;
	}
}

if ( ! function_exists( 'coney_qodef_woocommerce_template_loop_product_title' ) ) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function coney_qodef_woocommerce_template_loop_product_title() {

		$tag = coney_qodef_options()->getOptionValue( 'qodef_products_list_title_tag' );
		if ( $tag === '' ) {
			$tag = 'h5';
		}
		the_title( '<' . $tag . ' class="qodef-product-list-title"><a href="' . get_the_permalink() . '">', '</a></' . $tag . '>' );
	}
}

if ( ! function_exists( 'coney_qodef_woocommerce_template_single_title' ) ) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function coney_qodef_woocommerce_template_single_title() {

		$tag = coney_qodef_options()->getOptionValue( 'qodef_single_product_title_tag' );
		if ( $tag === '' ) {
			$tag = 'h3';
		}
		the_title( '<' . $tag . '  itemprop="name" class="qodef-single-product-title">', '</' . $tag . '>' );
	}
}

if ( ! function_exists( 'coney_qodef_woocommerce_sale_flash' ) ) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function coney_qodef_woocommerce_sale_flash() {

		return '<span class="qodef-onsale">' . esc_html__( 'SALE', 'coney' ) . '</span>';
	}
}

if ( ! function_exists( 'coney_qodef_woocommerce_product_out_of_stock' ) ) {
	/**
	 * Function for adding Out Of Stock Template
	 *
	 * @return string
	 */
	function coney_qodef_woocommerce_product_out_of_stock() {

		global $product;

		if ( ! $product->is_in_stock() ) {
			print '<span class="qodef-out-of-stock">' . esc_html__( 'OUT OF STOCK', 'coney' ) . '</span>';
		}
	}
}

if ( ! function_exists( 'coney_qodef_woocommerce_view_all_pagination' ) ) {
	/**
	 * Function for adding New WooCommerce Pagination Template
	 *
	 * @return string
	 */
	function coney_qodef_woocommerce_view_all_pagination() {

		global $wp_query;

		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		$html = '';

		if ( get_option( 'woocommerce_shop_page_id' ) ) {
			$html .= '<div class="qodef-woo-view-all-pagination">';
			$html .= '<a href="' . get_permalink( get_option( 'woocommerce_shop_page_id' ) ) . '?woo-products-count=view-all">' . esc_html__( 'View All', 'coney' ) . '</a>';
			$html .= '</div>';
		}

		print coney_qodef_get_module_part( $html );
	}
}

if ( ! function_exists( 'coney_qodef_woo_view_all_pagination_additional_tag_before' ) ) {
	function coney_qodef_woo_view_all_pagination_additional_tag_before() {

		print '<div class="qodef-woo-pagination-holder"><div class="qodef-woo-pagination-inner">';
	}
}

if ( ! function_exists( 'coney_qodef_woo_view_all_pagination_additional_tag_after' ) ) {
	function coney_qodef_woo_view_all_pagination_additional_tag_after() {

		print '</div></div>';
	}
}

if ( ! function_exists( 'coney_qodef_woocommerce_product_thumbnail_column_size' ) ) {
	function coney_qodef_woocommerce_product_thumbnail_column_size() {

		return 3;
	}
}

if ( ! function_exists( 'coney_qodef_single_product_content_additional_tag_before' ) ) {
	function coney_qodef_single_product_content_additional_tag_before() {

		print '<div class="qodef-single-product-content">';
	}
}

if ( ! function_exists( 'coney_qodef_single_product_content_additional_tag_after' ) ) {
	function coney_qodef_single_product_content_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'coney_qodef_single_product_summary_additional_tag_before' ) ) {
	function coney_qodef_single_product_summary_additional_tag_before() {

		print '<div class="qodef-single-product-summary">';
	}
}

if ( ! function_exists( 'coney_qodef_single_product_summary_additional_tag_after' ) ) {
	function coney_qodef_single_product_summary_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'coney_qodef_pl_holder_additional_tag_before' ) ) {
	function coney_qodef_pl_holder_additional_tag_before() {

		print '<div class="qodef-pl-main-holder">';
	}
}

if ( ! function_exists( 'coney_qodef_pl_holder_additional_tag_after' ) ) {
	function coney_qodef_pl_holder_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'coney_qodef_pl_inner_additional_tag_before' ) ) {
	function coney_qodef_pl_inner_additional_tag_before() {

		print '<div class="qodef-pl-inner">';
	}
}

if ( ! function_exists( 'coney_qodef_pl_inner_additional_tag_after' ) ) {
	function coney_qodef_pl_inner_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'coney_qodef_pl_image_additional_tag_before' ) ) {
	function coney_qodef_pl_image_additional_tag_before() {

		print '<div class="qodef-pl-image">';
	}
}

if ( ! function_exists( 'coney_qodef_pl_image_additional_tag_after' ) ) {
	function coney_qodef_pl_image_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'coney_qodef_pl_inner_text_additional_tag_before' ) ) {
	function coney_qodef_pl_inner_text_additional_tag_before() {

		print '<div class="qodef-pl-text"><div class="qodef-pl-text-outer"><div class="qodef-pl-text-inner">';
	}
}

if ( ! function_exists( 'coney_qodef_pl_inner_text_additional_tag_after' ) ) {
	function coney_qodef_pl_inner_text_additional_tag_after() {

		print '</div></div></div>';
	}
}

if ( ! function_exists( 'coney_qodef_pl_text_wrapper_additional_tag_before' ) ) {
	function coney_qodef_pl_text_wrapper_additional_tag_before() {

		print '<div class="qodef-pl-text-wrapper">';
	}
}

if ( ! function_exists( 'coney_qodef_pl_text_wrapper_additional_tag_after' ) ) {
	function coney_qodef_pl_text_wrapper_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'coney_qodef_pl_rating_additional_tag_before' ) ) {
	function coney_qodef_pl_rating_additional_tag_before() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {

			$rating_html = wc_get_rating_html( $product->get_average_rating() );

			if ( $rating_html !== '' ) {
				print '<div class="qodef-pl-rating-holder">';
			}
		}
	}
}

if ( ! function_exists( 'coney_qodef_pl_rating_additional_tag_after' ) ) {
	function coney_qodef_pl_rating_additional_tag_after() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {

			$rating_html = wc_get_rating_html( $product->get_average_rating() );

			if ( $rating_html !== '' ) {
				print '</div>';
			}
		}
	}
}

if ( ! function_exists( 'coney_qodef_woocommerce_single_add_pretty_photo_for_images' ) ) {
	/**
	 * Function that add necessary html attributes for prettyPhoto
	 */
	function coney_qodef_woocommerce_single_add_pretty_photo_for_images( $html, $attachment_id ) {
		$our_html = '';

		if ( ! empty( $html ) ) {
			$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );

			$attributes = array(
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);

			$our_html .= '<div class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" data-rel="prettyPhoto[woo_single_pretty_photo]">';
			$our_html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
			$our_html .= '</a></div>';

			$html = $our_html;
		}

		return $html;
	}

	add_filter( 'woocommerce_single_product_image_thumbnail_html', 'coney_qodef_woocommerce_single_add_pretty_photo_for_images', 10, 2 );
}

if ( ! function_exists( 'coney_qodef_woocommerce_share_list' ) ) {
	/**
	 * Function that social share for product page
	 */
	function coney_qodef_woocommerce_share_list() {
		$params = array(
			'share_font' => 'font-awesome'
		);
		coney_qodef_get_module_template_part( 'templates/parts/share', 'woocommerce', '', $params );
	}
}

if ( ! function_exists( 'coney_qodef_woocommerce_share_single' ) ) {
	/**
	 * Function that social share for product page
	 */
	function coney_qodef_woocommerce_share_single() {
		$params = array(
			'show_label'   => true,
			'share_circle' => 'yes'
		);
		coney_qodef_get_module_template_part( 'templates/parts/share', 'woocommerce', '', $params );
	}
}