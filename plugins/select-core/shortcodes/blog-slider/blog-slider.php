<?php

namespace ConeyQodef\Modules\Shortcodes\BlogSlider;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class BlogList
 */
class BlogSlider implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'qodef_blog_slider';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

		//Category filter
		add_filter( 'vc_autocomplete_qodef_blog_slider_category_callback', array(
			&$this,
			'blogListCategoryAutocompleteSuggester',
		), 10, 1 ); // Get suggestion(find). Must return an array

		//Category render
		add_filter( 'vc_autocomplete_qodef_blog_slider_category_render', array(
			&$this,
			'blogListCategoryAutocompleteRender',
		), 10, 1 ); // Get suggestion(find). Must return an array

	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name'                      => esc_html__( 'Select Blog Slider', 'select-core' ),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-blog-slider extended-custom-icon',
			'category'                  => esc_html__( 'by SELECT', 'select-core' ),
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Slider Type', 'select-core' ),
					'param_name' => 'type',
					'value'      => array(
						esc_html__( 'Standard', 'select-core' ) => 'standard',
						esc_html__( 'Boxed', 'select-core' )    => 'boxed',
						esc_html__( 'Simple', 'select-core' )   => 'simple',
					)
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'in_grid',
					'heading'    => esc_html__( 'Post Info in Grid', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
					'dependency' => Array( 'element' => 'type', 'value' => 'standard' ),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'centered',
					'heading'    => esc_html__( 'Show Prev/Next Post', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( true, true ) ),
					'dependency' => Array( 'element' => 'type', 'value' => 'boxed' ),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'show_arrow',
					'heading'    => esc_html__( 'Show Arrow Navigation', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'show_dots',
					'heading'    => esc_html__( 'Show Dots Navigation', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'number_of_posts',
					'heading'    => esc_html__( 'Number of Posts', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Order By', 'select-core' ),
					'param_name' => 'order_by',
					'value'      => array(
						esc_html__( 'Title', 'select-core' )     => 'title',
						esc_html__( 'Date', 'select-core' )      => 'date',
						esc_html__( 'Random', 'select-core' )    => 'rand',
						esc_html__( 'Post Name', 'select-core' ) => 'name'
					)
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'order',
					'heading'    => esc_html__( 'Order', 'select-core' ),
					'value'      => array(
						esc_html__( 'ASC', 'select-core' )  => 'ASC',
						esc_html__( 'DESC', 'select-core' ) => 'DESC'
					)
				),
				array(
					'type'        => 'autocomplete',
					'param_name'  => 'category',
					'heading'     => esc_html__( 'Category', 'select-core' ),
					'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title Tag', 'select-core' ),
					'param_name' => 'title_tag',
					'value'      => array_flip( coney_qodef_get_title_tag( true ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'post_info_author',
					'heading'    => esc_html__( 'Enable Post Info Author', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'post_info_date',
					'heading'    => esc_html__( 'Enable Post Info Date', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'post_info_category',
					'heading'    => esc_html__( 'Enable Post Info Category', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'font_size',
					'heading'    => esc_html__( 'Title Font Size', 'select-core' ),
					'group'      => esc_html__( 'Desing Options', 'select-core' )
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'line_height',
					'heading'    => esc_html__( 'Title Line Height', 'select-core' ),
					'group'      => esc_html__( 'Desing Options', 'select-core' )
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'text_font_weight',
					'heading'     => esc_html__( 'Text Font Weight', 'select-core' ),
					'value'       => array_flip( coney_qodef_get_font_weight_array( true ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Desing Options', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'skin',
					'heading'    => esc_html__( 'Skin', 'select-core' ),
					'value'      => array(
						esc_html__( 'Dark', 'select-core' )  => 'qodef-dark-skin',
						esc_html__( 'Light', 'select-core' ) => 'qodef-light-skin',
					),
					'group'      => esc_html__( 'Desing Options', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'button_size',
					'heading'    => esc_html__( 'Button Size', 'select-core' ),
					'value'      => array(
						esc_html__( 'Default', 'select-core' ) => '',
						esc_html__( 'Small', 'select-core' )   => 'small',
						esc_html__( 'Medium', 'select-core' )  => 'medium',
						esc_html__( 'Large', 'select-core' )   => 'large',
						esc_html__( 'Huge', 'select-core' )    => 'huge'
					),
					'group'      => esc_html__( 'Desing Options', 'select-core' )
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'title_color',
					'heading'    => esc_html__( 'Title Color', 'select-core' ),
					'group'      => esc_html__( 'Desing Options', 'select-core' )
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'info_color',
					'heading'    => esc_html__( 'Post Info Color', 'select-core' ),
					'group'      => esc_html__( 'Desing Options', 'select-core' )
				),
			)
		) );
	}

	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'               => 'standard',
			'in_grid'            => 'yes',
			'centered'           => 'yes',
			'show_arrow'         => 'yes',
			'show_dots'          => 'yes',
			'number_of_posts'    => '-1',
			'order_by'           => 'title',
			'order'              => 'ASC',
			'category'           => '',
			'title_tag'          => 'h2',
			'post_info_author'   => 'yes',
			'post_info_date'     => 'yes',
			'post_info_category' => 'yes',
			'post_info_comments' => 'yes',
			'font_size'          => '',
			'line_height'        => '',
			'title_color'        => '',
			'info_color'         => '',
			'text_font_weight'   => '',
			'skin'               => 'dark',
			'button_size'        => 'medium',
		);

		$params = shortcode_atts( $default_atts, $atts );
		extract( $params );

		$queryArray             = $this->generateBlogQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['title_styles']   = $this->getTitleStyles( $params );
		$params['info_styles']    = $this->getPostInfoStyles( $params );
		$params['slider_data']    = $this->getSliderData( $params );
		$params['size']           = ! empty( $params['button_size'] ) ? $params['button_size'] : 'medium';

		//ob_start();
		//coney_qodef_get_module_template_part( 'shortcodes/blog-slider/holder', 'blog', '', $params );
		//$html = ob_get_contents();
		//ob_end_clean();

		$html = select_core_get_shortcode_template_part( 'holder', 'blog-slider', '', $params );

		return $html;
	}

	/**
	 * Generates query array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function generateBlogQueryArray( $params ) {
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'orderby'        => $params['order_by'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'post__not_in'   => get_option( 'sticky_posts' )
		);

		if ( ! empty( $params['category'] ) ) {
			$queryArray['category_name'] = $params['category'];
		}

		return $queryArray;
	}

	/**
	 * Filter categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogListCategoryAutocompleteSuggester( $query ) {
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
	 * Find categories by slug
	 *
	 * @param $query
	 *
	 * @return bool|array
	 * @since 4.4
	 *
	 */
	public function blogListCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get category
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
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getHolderClasses( $params ) {
		$holderClasses = '';

		$listType = ! empty( $params['type'] ) ? 'qodef-bls-' . $params['type'] : 'qodef-bls-standard';
		$inGrid   = ( $params['in_grid'] == 'yes' && $params['type'] == 'standard' ) ? 'qodef-bls-in-grid' : '';
		$centered = ( $params['centered'] == 'yes' && $params['type'] == 'boxed' ) ? 'qodef-bls-centered' : '';
		$skin     = ! empty( $params['skin'] ) ? $params['skin'] : 'qodef-dark-skin';

		$holderClasses .= $listType . ' ' . $inGrid . ' ' . $skin . ' ' . $centered;

		return $holderClasses;
	}

	/**
	 * Returns inline content styles
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getTitleStyles( $params ) {
		$styles = array();

		if ( $params['font_size'] !== '' ) {
			$styles[] = 'font-size: ' . coney_qodef_filter_px( $params['font_size'] ) . 'px';
		}

		if ( $params['line_height'] !== '' ) {
			$styles[] = 'line-height: ' . coney_qodef_filter_px( $params['line_height'] ) . 'px';
		}

		if ( $params['text_font_weight'] !== '' ) {
			$styles[] = 'font-weight: ' . coney_qodef_filter_px( $params['text_font_weight'] );
		}

		if ( $params['title_color'] !== '' ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		return implode( ';', $styles );
	}

	private function getPostInfoStyles( $params ) {
		$styles = array();

		if ( $params['info_color'] !== '' ) {
			$styles[] = 'color: ' . $params['info_color'];
		}

		return implode( ';', $styles );
	}

	/**
	 * Returns data for js
	 *
	 * @param $params
	 *
	 * @return string
	 */

	private function getSliderData( $params ) {
		$data = array();

		if ( ! empty( $params['type'] ) && $params['type'] == 'boxed' && ! empty( $params['centered'] ) ) {
			$data['data-centered'] = $params['centered'];
		}
		if ( ! empty( $params['show_dots'] ) ) {
			$data['data-dots'] = $params['show_dots'];
		}
		if ( ! empty( $params['show_arrow'] ) ) {
			$data['data-navigation'] = $params['show_arrow'];
		}

		return $data;
	}
}
