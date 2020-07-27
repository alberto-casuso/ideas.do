<?php

if ( ! function_exists( 'coney_qodef_get_portfolio_category_list' ) ) {
	function coney_qodef_get_portfolio_category_list( $category = '' ) {

		$number_of_items        = 12;
		$number_of_items_option = coney_qodef_options()->getOptionValue( 'portfolio_archive_number_of_items' );
		if ( ! empty( $number_of_items_option ) ) {
			$number_of_items = $number_of_items_option;
		}

		$number_of_columns        = 4;
		$number_of_columns_option = coney_qodef_options()->getOptionValue( 'portfolio_archive_number_of_columns' );
		if ( ! empty( $number_of_columns_option ) ) {
			$number_of_columns = $number_of_columns_option;
		}

		$space_between_items        = 'normal';
		$space_between_items_option = coney_qodef_options()->getOptionValue( 'portfolio_archive_space_between_items' );
		if ( ! empty( $space_between_items_option ) ) {
			$space_between_items = $space_between_items_option;
		}

		$image_size        = 'landscape';
		$image_size_option = coney_qodef_options()->getOptionValue( 'portfolio_archive_image_size' );
		if ( ! empty( $image_size_option ) ) {
			$image_size = $image_size_option;
		}

		$item_layout        = 'standard-shader';
		$item_layout_option = coney_qodef_options()->getOptionValue( 'portfolio_archive_item_layout' );
		if ( ! empty( $item_layout_option ) ) {
			$item_layout = $item_layout_option;
		}

		$params = array(
			'type'                => 'gallery',
			'number_of_items'     => $number_of_items,
			'number_of_columns'   => $number_of_columns,
			'space_between_items' => $space_between_items,
			'image_proportions'   => $image_size,
			'category'            => $category,
			'item_layout'         => $item_layout,
			'pagination_type'     => 'load-more'
		);

		$html = coney_qodef_execute_shortcode( 'qodef_portfolio_list', $params );

		print coney_qodef_get_module_part( $html );
	}
}

if ( ! function_exists( 'coney_qodef_get_portfolio_tag_list' ) ) {
	function coney_qodef_get_portfolio_tag_list( $tag = '' ) {

		$number_of_items        = 12;
		$number_of_items_option = coney_qodef_options()->getOptionValue( 'portfolio_archive_number_of_items' );
		if ( ! empty( $number_of_items_option ) ) {
			$number_of_items = $number_of_items_option;
		}

		$number_of_columns        = 4;
		$number_of_columns_option = coney_qodef_options()->getOptionValue( 'portfolio_archive_number_of_columns' );
		if ( ! empty( $number_of_columns_option ) ) {
			$number_of_columns = $number_of_columns_option;
		}

		$space_between_items        = 'normal';
		$space_between_items_option = coney_qodef_options()->getOptionValue( 'portfolio_archive_space_between_items' );
		if ( ! empty( $space_between_items_option ) ) {
			$space_between_items = $space_between_items_option;
		}

		$image_size        = 'landscape';
		$image_size_option = coney_qodef_options()->getOptionValue( 'portfolio_archive_image_size' );
		if ( ! empty( $image_size_option ) ) {
			$image_size = $image_size_option;
		}

		$item_layout        = 'standard-shader';
		$item_layout_option = coney_qodef_options()->getOptionValue( 'portfolio_archive_item_layout' );
		if ( ! empty( $item_layout_option ) ) {
			$item_layout = $item_layout_option;
		}

		$params = array(
			'type'                => 'gallery',
			'number_of_items'     => $number_of_items,
			'number_of_columns'   => $number_of_columns,
			'space_between_items' => $space_between_items,
			'image_proportions'   => $image_size,
			'tag'                 => $tag,
			'item_layout'         => $item_layout,
			'pagination_type'     => 'load-more'
		);

		$html = coney_qodef_execute_shortcode( 'qodef_portfolio_list', $params );

		print coney_qodef_get_module_part( $html );
	}
}

if ( ! function_exists( 'coney_qodef_set_portfolio_single_info_follow_body_class' ) ) {
	/**
	 * Function that adds follow portfolio info class to body if sticky sidebar is enabled on portfolio single layouts
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with follow portfolio info class body class added
	 */
	function coney_qodef_set_portfolio_single_info_follow_body_class( $classes ) {
		if ( is_singular( 'portfolio-item' ) && coney_qodef_options()->getOptionValue( 'portfolio_single_sticky_sidebar' ) == 'yes' ) {
			$classes[] = 'qodef-follow-portfolio-info';
		}

		return $classes;
	}

	add_filter( 'body_class', 'coney_qodef_set_portfolio_single_info_follow_body_class' );
}

if ( ! function_exists( 'coney_qodef_single_portfolio' ) ) {
	function coney_qodef_single_portfolio() {
		$portfolio_template = coney_qodef_get_meta_field_intersect( 'portfolio_single_template' );

		$params = array(
			'holder_classes' => 'qodef-ps-' . $portfolio_template . '-layout',
			'item_layout'    => $portfolio_template
		);

		coney_qodef_get_module_template_part( 'templates/single/holder', 'portfolio', $portfolio_template, $params );
	}
}

if ( ! function_exists( 'coney_qodef_single_portfolio_style' ) ) {
	/**
	 * Function that return padding for content
	 */
	function coney_qodef_single_portfolio_style( $style ) {
		$id           = coney_qodef_get_page_id();
		$class_prefix = coney_qodef_get_unique_page_class( $id );

		$current_styles = '';
		$current_style  = array();

		$current_selector = array(
			$class_prefix . ' .qodef-portfolio-single-holder .qodef-ps-info-holder'
		);

		$info_padding_top = get_post_meta( $id, 'portfolio_info_top_padding', true );

		if ( ! empty( $info_padding_top ) ) {
			$current_style['padding-top'] = coney_qodef_filter_px( $info_padding_top ) . 'px';

			$current_styles .= coney_qodef_dynamic_css( $current_selector, $current_style );
		}

		$current_style = $current_styles . $style;

		return $current_style;
	}

	add_filter( 'coney_qodef_add_page_custom_style', 'coney_qodef_single_portfolio_style' );
}

if ( ! function_exists( 'coney_qodef_add_portfolio_attachment_custom_field' ) ) {
	function coney_qodef_add_portfolio_attachment_custom_field( $form_fields, $post = null ) {
		if ( wp_attachment_is_image( $post->ID ) ) {
			$field_value = get_post_meta( $post->ID, 'portfolio_single_masonry_image_size', true );

			$form_fields['portfolio_single_masonry_image_size'] = array(
				'input' => 'html',
				'label' => esc_html__( 'Image Size', 'coney' ),
				'helps' => esc_html__( 'Choose image size for portfolio single item - Masonry layout', 'coney' )
			);

			$form_fields['portfolio_single_masonry_image_size']['html'] = "<select name='attachments[{$post->ID}][portfolio_single_masonry_image_size]'>";
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'qodef-default-masonry-item', false ) . ' value="qodef-default-masonry-item">' . esc_html__( 'Default Size', 'coney' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'qodef-large-masonry-item', false ) . ' value="qodef-large-masonry-item">' . esc_html__( 'Large Size', 'coney' ) . '</option>';
			$form_fields['portfolio_single_masonry_image_size']['html'] .= '</select>';
		}

		return $form_fields;
	}

	add_filter( 'attachment_fields_to_edit', 'coney_qodef_add_portfolio_attachment_custom_field', 10, 2 );
}

if ( ! function_exists( 'coney_qodef_image_portfolio_attachment_fields_to_save' ) ) {
	/**
	 * @param array $post
	 * @param array $attachment
	 *
	 * @return array
	 */
	function coney_qodef_image_portfolio_attachment_fields_to_save( $post, $attachment ) {

		if ( isset( $attachment['portfolio_single_masonry_image_size'] ) ) {
			update_post_meta( $post['ID'], 'portfolio_single_masonry_image_size', $attachment['portfolio_single_masonry_image_size'] );
		}

		return $post;
	}

	add_filter( 'attachment_fields_to_save', 'coney_qodef_image_portfolio_attachment_fields_to_save', 10, 2 );
}

if ( ! function_exists( 'coney_qodef_get_portfolio_single_media' ) ) {
	function coney_qodef_get_portfolio_single_media() {
		$image_ids       = get_post_meta( get_the_ID(), 'qodef-portfolio-image-gallery', true );
		$videos          = get_post_meta( get_the_ID(), 'qode_portfolio_images', true );
		$portfolio_media = array();

		if ( $image_ids !== '' ) {
			$image_ids = explode( ',', $image_ids );

			foreach ( $image_ids as $image_id ) {
				$media                   = array();
				$media['title']          = get_the_title( $image_id );
				$media['type']           = 'image';
				$media['description']    = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				$media['image_src']      = wp_get_attachment_image_src( $image_id, 'full' );
				$media['holder_classes'] = '';

				$image_size = get_post_meta( $image_id, 'portfolio_single_masonry_image_size', true );

				switch ( $image_size ) {
					case 'qodef-default-masonry-item':
						$media['holder_classes'] = 'qodef-ps-masonry-normal-item';
						break;
					case 'qodef-large-masonry-item':
						$media['holder_classes'] = 'qodef-ps-masonry-large-item';
						break;
				}

				$portfolio_media[] = $media;
			}
		}

		if ( is_array( $videos ) && count( $videos ) ) {
			usort( $videos, 'coney_qodef_compare_portfolio_videos' );
			foreach ( $videos as $video ) {
				$media = array();

				if ( ! empty( $video['portfoliovideotype'] ) ) {
					$media['title']       = $video['portfoliotitle'];
					$media['type']        = $video['portfoliovideotype'];
					$media['description'] = 'video';
					$media['video_url']   = coney_qodef_portfolio_get_video_url( $video );

					if ( $video['portfoliovideotype'] == 'self' ) {
						$media['video_cover'] = ! empty( $video['portfoliovideoimage'] ) ? $video['portfoliovideoimage'] : '';
					}

					if ( $video['portfoliovideotype'] !== 'self' ) {
						$media['video_id'] = $video['portfoliovideoid'];
					}
				} elseif ( ! empty( $video['portfolioimgtype'] ) ) {
					$media['title']     = $video['portfoliotitle'];
					$media['type']      = $video['portfolioimgtype'];
					$media['image_src'] = $video['portfolioimg'];
				}

				$portfolio_media[] = $media;
			}
		}

		return $portfolio_media;
	}
}

if ( ! function_exists( 'coney_qodef_portfolio_get_video_url' ) ) {
	function coney_qodef_portfolio_get_video_url( $video ) {
		switch ( $video['portfoliovideotype'] ) {
			case 'youtube':
				return 'https://www.youtube.com/embed/' . $video['portfoliovideoid'] . '?wmode=transparent';
				break;
			case 'vimeo';
				return 'https://player.vimeo.com/video/' . $video['portfoliovideoid'] . '?title=0&amp;byline=0&amp;portrait=0';
				break;
			case 'self':
				$return_array = array();

				if ( ! empty( $video['portfoliovideomp4'] ) ) {
					$return_array['mp4'] = $video['portfoliovideomp4'];
				}

				return $return_array;

				break;
		}
	}
}

if ( ! function_exists( 'coney_qodef_portfolio_get_media_html' ) ) {
	function coney_qodef_portfolio_get_media_html( $media ) {
		global $wp_filesystem;
		$params = array();

		if ( $media['type'] == 'image' ) {
			$params['lightbox'] = coney_qodef_options()->getOptionValue( 'portfolio_single_lightbox_images' ) == 'yes';

			$media['image_url'] = is_array( $media['image_src'] ) ? $media['image_src'][0] : $media['image_src'];
			if ( empty( $media['description'] ) ) {
				$media['description'] = $media['title'];
			}
		}

		if ( in_array( $media['type'], array( 'youtube', 'vimeo' ) ) ) {
			$params['lightbox'] = coney_qodef_options()->getOptionValue( 'portfolio_single_lightbox_videos' ) == 'yes';

			if ( $params['lightbox'] ) {
				switch ( $media['type'] ) {
					case 'vimeo':
						WP_Filesystem();
						$url      = 'https://vimeo.com/api/v2/video/' . $media['video_id'] . '.php';
						$response = unserialize( $wp_filesystem->get_contents( $url ) );

						$params['video_title']    = $response[0]['title'];
						$params['lightbox_thumb'] = $response[0]['thumbnail_large'];
						break;
					case 'youtube':
						$params['video_title'] = $media['title'];

						$params['lightbox_thumb'] = 'https://img.youtube.com/vi/' . trim( $media['video_id'] ) . '/maxresdefault.jpg';
						break;
				}
			}
		}

		$params['media'] = $media;

		coney_qodef_get_module_template_part( 'templates/single/media/' . $media['type'], 'portfolio', '', $params );
	}
}

if ( ! function_exists( 'coney_qodef_compare_portfolio_videos' ) ) {
	/**
	 * Function that compares two portfolio image for sorting
	 *
	 * @param $a int first image
	 * @param $b int second image
	 *
	 * @return int result of comparison
	 */
	function coney_qodef_compare_portfolio_videos( $a, $b ) {
		if ( isset( $a['portfolioimgordernumber'] ) && isset( $b['portfolioimgordernumber'] ) ) {
			if ( $a['portfolioimgordernumber'] == $b['portfolioimgordernumber'] ) {
				return 0;
			}

			return ( $a['portfolioimgordernumber'] < $b['portfolioimgordernumber'] ) ? - 1 : 1;
		}

		return 0;
	}
}

if ( ! function_exists( 'coney_qodef_compare_portfolio_options' ) ) {
	/**
	 * Function that compares two portfolio options for sorting
	 *
	 * @param $a int first option
	 * @param $b int second option
	 *
	 * @return int result of comparison
	 */
	function coney_qodef_compare_portfolio_options( $a, $b ) {
		if ( isset( $a['optionlabelordernumber'] ) && isset( $b['optionlabelordernumber'] ) ) {
			if ( $a['optionlabelordernumber'] == $b['optionlabelordernumber'] ) {
				return 0;
			}

			return ( $a['optionlabelordernumber'] < $b['optionlabelordernumber'] ) ? - 1 : 1;
		}

		return 0;
	}
}

if ( ! function_exists( 'coney_qodef_get_portfolio_single_related_posts' ) ) {
	/**
	 * Function for returning portfolio single related posts
	 *
	 * @param $post_id
	 *
	 * @return WP_Query
	 */
	function coney_qodef_get_portfolio_single_related_posts( $post_id ) {
		//Get tags
		$tags = wp_get_object_terms( $post_id, 'portfolio-tag' );

		//Get categories
		$categories = wp_get_object_terms( $post_id, 'portfolio-category' );

		$tag_ids = array();
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}
		}

		$category_ids = array();
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$category_ids[] = $category->term_id;
			}
		}

		$hasRelatedByTag = false;

		if ( $tag_ids ) {
			$related_by_tag = coney_qodef_get_portfolio_single_related_posts_by_param( $post_id, $tag_ids, 'portfolio-tag' );

			if ( ! empty( $related_by_tag->posts ) ) {
				$hasRelatedByTag = true;

				return $related_by_tag;
			}
		}

		if ( $categories && ! $hasRelatedByTag ) {
			$related_by_category = coney_qodef_get_portfolio_single_related_posts_by_param( $post_id, $category_ids, 'portfolio-category' );

			if ( ! empty( $related_by_category->posts ) ) {
				return $related_by_category;
			}
		}
	}
}

if ( ! function_exists( 'coney_qodef_get_portfolio_single_related_posts_by_param' ) ) {
	/**
	 * @param $post_id - Post ID
	 * @param $term_ids - Category or Tag IDs
	 * @param $taxonomy
	 *
	 * @return WP_Query
	 */
	function coney_qodef_get_portfolio_single_related_posts_by_param( $post_id, $term_ids, $taxonomy ) {
		$args = array(
			'post_status'    => 'publish',
			'post__not_in'   => array( $post_id ),
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => '4',
			'tax_query'      => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $term_ids,
				),
			)
		);

		$related_by_taxonomy = new WP_Query( $args );

		return $related_by_taxonomy;
	}
}