<?php

namespace ConeyQodef\Modules\Shortcodes\BlogCategory;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class BlogCategory
 */
class BlogCategory implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'qodef_blog_category';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

		//Category filter
		add_filter( 'vc_autocomplete_qodef_blog_category_category_callback', array(
			&$this,
			'blogCategoryAutocompleteSuggester',
		), 10, 1 ); // Get suggestion(find). Must return an array

		//Category render
		add_filter( 'vc_autocomplete_qodef_blog_category_category_render', array(
			&$this,
			'blogCategoryAutocompleteRender',
		), 10, 1 ); // Get suggestion(find). Must return an array

		//Tag filter
		add_filter( 'vc_autocomplete_qodef_blog_category_tag_callback', array(
			&$this,
			'blogTagAutocompleteSuggester',
		), 10, 1 ); // Get suggestion(find). Must return an array

		//Tag render
		add_filter( 'vc_autocomplete_qodef_blog_category_tag_render', array(
			&$this,
			'blogTagAutocompleteRender',
		), 10, 1 ); // Get suggestion(find). Must return an array

	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name'                      => esc_html__( 'Select Blog Category', 'select-core' ),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-blog-category extended-custom-icon',
			'category'                  => esc_html__( 'by SELECT', 'select-core' ),
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'type',
					'heading'    => esc_html__( 'Type', 'select-core' ),
					'value'      => array(
						esc_html__( 'Category', 'select-core' ) => 'category',
						esc_html__( 'Tag', 'select-core' )      => 'tag',
					),
				),
				array(
					'type'        => 'autocomplete',
					'param_name'  => 'category',
					'heading'     => esc_html__( 'Category', 'select-core' ),
					'description' => esc_html__( 'Enter one category slug', 'select-core' ),
					'dependency'  => array( 'element' => 'type', 'value' => array( 'category' ) )
				),
				array(
					'type'        => 'autocomplete',
					'param_name'  => 'tag',
					'heading'     => esc_html__( 'Tag', 'select-core' ),
					'description' => esc_html__( 'Enter one tag slug', 'select-core' ),
					'dependency'  => array( 'element' => 'type', 'value' => array( 'tag' ) )
				),
				array(
					'type'        => 'attach_image',
					'param_name'  => 'category_image',
					'heading'     => esc_html__( 'Image', 'select-core' ),
					'description' => esc_html__( 'Select image from media library', 'select-core' )
				),
			)
		) );
	}

	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'           => 'category',
			'category'       => '',
			'tag'            => '',
			'category_image' => ''
		);

		$params = shortcode_atts( $default_atts, $atts );
		extract( $params );

		$params['category_link'] = $this->getCategoryLink( $params );
		$params['category_name'] = $this->getCategoryName( $params );

		$params['this_object'] = $this;
		//ob_start();
		//
		//coney_qodef_get_module_template_part('shortcodes/blog-category/templates/blog-category', 'blog', '',  $params);
		//
		//$html = ob_get_contents();
		//ob_end_clean();

		$html = select_core_get_shortcode_template_part( 'templates/blog-category', 'blog-category', '', $params );

		return $html;
	}

	/**
	 * Get Category Link
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getCategoryLink( $params ) {
		$category_link = '';

		if ( ! empty( $params['category'] ) ) {
			$idObj         = get_category_by_slug( $params['category'] );
			$category_id   = $idObj->term_id;
			$category_link = get_category_link( $category_id );
		} else if ( ! empty( $params['tag'] ) ) {
			$idObj         = get_term_by( 'slug', $params['tag'], 'post_tag' );
			$category_id   = $idObj->term_id;
			$category_link = get_tag_link( $category_id );
		}

		return $category_link;
	}

	/**
	 * Get Category Link
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getCategoryName( $params ) {
		$category_name = '';

		if ( ! empty( $params['category'] ) ) {
			$idObj         = get_category_by_slug( $params['category'] );
			$category_id   = $idObj->term_id;
			$category_name = get_cat_name( $category_id );
		} else if ( ! empty( $params['tag'] ) ) {
			$idObj         = get_term_by( 'slug', $params['tag'], 'post_tag' );
			$category_name = $idObj->name;
		}

		return $category_name;
	}

	/**
	 * Filter blog categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'select-core' ) . ': ' . $value['category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find blog category by slug
	 *
	 * @param $query
	 *
	 * @return bool|array
	 * @since 4.4
	 *
	 */
	public function blogCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$category = get_term_by( 'slug', $query, 'category' );
			if ( is_object( $category ) ) {

				$category_slug  = $category->slug;
				$category_title = $category->name;

				$category_title_display = '';
				if ( ! empty( $category_title ) ) {
					$category_title_display = esc_html__( 'Category', 'select-core' ) . ': ' . $category_title;
				}

				$data          = array();
				$data['value'] = $category_slug;
				$data['label'] = $category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter blog tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'post_tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'select-core' ) . ': ' . $value['tag_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find blog tag by slug
	 *
	 * @param $query
	 *
	 * @return bool|array
	 * @since 4.4
	 *
	 */
	public function blogTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get blog tag
			$tag = get_term_by( 'slug', $query, 'post_tag' );
			if ( is_object( $tag ) ) {

				$tag_slug  = $tag->slug;
				$tag_title = $tag->name;

				$tag_title_display = '';
				if ( ! empty( $tag_title ) ) {
					$tag_title_display = esc_html__( 'Tag', 'select-core' ) . ': ' . $tag_title;
				}

				$data          = array();
				$data['value'] = $tag_slug;
				$data['label'] = $tag_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}