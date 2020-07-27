<?php

namespace ConeyQodef\Modules\Shortcodes\BlogList;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class BlogList
 */
class BlogList implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'qodef_blog_list';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

		//Category filter
		add_filter( 'vc_autocomplete_qodef_blog_list_category_callback', array(
			&$this,
			'blogCategoryAutocompleteSuggester',
		), 10, 1 ); // Get suggestion(find). Must return an array

		//Category render
		add_filter( 'vc_autocomplete_qodef_blog_list_category_render', array(
			&$this,
			'blogCategoryAutocompleteRender',
		), 10, 1 ); // Get suggestion(find). Must return an array

	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name'                      => esc_html__( 'Select Blog List', 'select-core' ),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-blog-list extended-custom-icon',
			'category'                  => esc_html__( 'by SELECT', 'select-core' ),
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'type',
					'heading'    => esc_html__( 'Type', 'select-core' ),
					'value'      => array(
						esc_html__( 'Standard', 'select-core' )   => 'standard',
						esc_html__( 'Masonry', 'select-core' )    => 'masonry',
						esc_html__( 'Image Left', 'select-core' ) => 'image-left',
						esc_html__( 'Simple', 'select-core' )     => 'simple',
					)
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'number_of_posts',
					'heading'    => esc_html__( 'Number of Posts', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'number_of_columns',
					'heading'    => esc_html__( 'Number of Columns', 'select-core' ),
					'value'      => array(
						esc_html__( '', 'select-core' )      => '',
						esc_html__( 'One', 'select-core' )   => '1',
						esc_html__( 'Two', 'select-core' )   => '2',
						esc_html__( 'Three', 'select-core' ) => '3',
						esc_html__( 'Four', 'select-core' )  => '4',
						esc_html__( 'Five', 'select-core' )  => '5'
					),
					'dependency' => Array(
						'element' => 'type',
						'value'   => array( 'standard', 'image-left', 'masonry' )
					)
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'space_between_columns',
					'heading'    => esc_html__( 'Space Between Columns', 'select-core' ),
					'value'      => array(
						esc_html__( 'Normal', 'select-core' )   => 'normal',
						esc_html__( 'Small', 'select-core' )    => 'small',
						esc_html__( 'Tiny', 'select-core' )     => 'tiny',
						esc_html__( 'No Space', 'select-core' ) => 'no'
					),
					'dependency' => Array(
						'element' => 'type',
						'value'   => array( 'standard', 'image-left', 'masonry' )
					)
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'order_by',
					'heading'    => esc_html__( 'Order By', 'select-core' ),
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
					'param_name' => 'image_size',
					'heading'    => esc_html__( 'Image Size', 'select-core' ),
					'value'      => array(
						esc_html__( 'Original', 'select-core' )  => 'full',
						esc_html__( 'Square', 'select-core' )    => 'square',
						esc_html__( 'Landscape', 'select-core' ) => 'landscape',
						esc_html__( 'Portrait', 'select-core' )  => 'portrait',
						esc_html__( 'Medium', 'select-core' )    => 'medium',
						esc_html__( 'Large', 'select-core' )     => 'large'
					),
					'dependency' => Array(
						'element' => 'type',
						'value'   => array( 'standard', 'image-left', 'masonry' )
					)
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'title_tag',
					'heading'    => esc_html__( 'Title Tag', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_title_tag( true ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'post_info_image',
					'heading'    => esc_html__( 'Enable Post Info Image', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'post_info_author',
					'heading'    => esc_html__( 'Enable Post Info Author', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false ) ),
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
					'type'       => 'dropdown',
					'param_name' => 'post_info_comments',
					'heading'    => esc_html__( 'Enable Post Info Comments', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'post_info_like',
					'heading'    => esc_html__( 'Enable Post Info Like', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'post_excerpt_section',
					'heading'    => esc_html__( 'Enable Post Excerpt Section', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
					'dependency' => Array(
						'element' => 'type',
						'value'   => array( 'standard', 'image-left', 'masonry' )
					),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'post_info_excerpt',
					'heading'    => esc_html__( 'Enable Post Info Excerpt', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
					'dependency' => Array( 'element' => 'post_excerpt_section', 'value' => array( 'yes' ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'excerpt_length',
					'heading'     => esc_html__( 'Text Length', 'select-core' ),
					'description' => esc_html__( 'Number of words', 'select-core' ),
					'group'       => esc_html__( 'Post Info', 'select-core' ),
					'dependency'  => Array( 'element' => 'post_info_excerpt', 'value' => array( 'yes' ) ),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'post_info_share',
					'heading'    => esc_html__( 'Enable Post Info Share', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
					'dependency' => Array( 'element' => 'post_excerpt_section', 'value' => array( 'yes' ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'post_info_read_more',
					'heading'    => esc_html__( 'Enable Post Info Read More', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array( false, true ) ),
					'dependency' => Array( 'element' => 'post_excerpt_section', 'value' => array( 'yes' ) ),
					'group'      => esc_html__( 'Post Info', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'pagination_type',
					'heading'    => esc_html__( 'Pagination Type', 'select-core' ),
					'value'      => array(
						esc_html__( 'None', 'select-core' )            => 'no-pagination',
						esc_html__( 'Standard', 'select-core' )        => 'standard-blog-list',
						esc_html__( 'Load More', 'select-core' )       => 'load-more',
						esc_html__( 'Infinite Scroll', 'select-core' ) => 'infinite-scroll'
					),
					'group'      => esc_html__( 'Additional Features', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'section_title',
					'heading'    => esc_html__( 'Enable Title', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_yes_no_select_array() ),
					'group'      => esc_html__( 'Additional Features', 'select-core' )
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'title',
					'heading'     => esc_html__( 'Title', 'select-core' ),
					'description' => esc_html__( 'Enter title for posts section', 'select-core' ),
					'group'       => esc_html__( 'Additional Features', 'select-core' ),
					'dependency'  => Array( 'element' => 'section_title', 'value' => array( 'yes' ) ),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'section_title_tag',
					'heading'    => esc_html__( 'Title Tag', 'select-core' ),
					'value'      => array_flip( coney_qodef_get_title_tag( true ) ),
					'group'      => esc_html__( 'Additional Features', 'select-core' ),
					'dependency' => Array( 'element' => 'section_title', 'value' => array( 'yes' ) )
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'section_title_font_size',
					'heading'     => esc_html__( 'Title Font Size', 'select-core' ),
					'description' => esc_html__( 'Font size for title', 'select-core' ),
					'group'       => esc_html__( 'Additional Features', 'select-core' ),
					'dependency'  => Array( 'element' => 'section_title', 'value' => array( 'yes' ) )
				),
			)
		) );
	}

	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                    => 'standard',
			'number_of_posts'         => '-1',
			'number_of_columns'       => '3',
			'space_between_columns'   => 'normal',
			'category'                => '',
			'order_by'                => 'title',
			'order'                   => 'ASC',
			'image_size'              => 'full',
			'title_tag'               => 'h5',
			'excerpt_length'          => '90',
			'post_info_image'         => 'yes',
			'post_info_author'        => 'no',
			'post_info_date'          => 'yes',
			'post_info_category'      => 'yes',
			'post_info_comments'      => 'no',
			'post_info_like'          => 'no',
			'post_excerpt_section'    => 'yes',
			'post_info_excerpt'       => 'yes',
			'post_info_read_more'     => 'yes',
			'post_info_share'         => 'yes',
			'pagination_type'         => 'no-pagination',
			'section_title'           => 'no',
			'title'                   => '',
			'section_title_tag'       => 'h6',
			'section_title_font_size' => ''
		);

		$params = shortcode_atts( $default_atts, $atts );
		extract( $params );

		$queryArray             = $this->generateQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;

		$params['holder_data']    = $this->getHolderData( $params );
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['module']         = 'list';

		$params['max_num_pages'] = $query_result->max_num_pages;
		$params['paged']         = isset( $query_result->query['paged'] ) ? $query_result->query['paged'] : 1;

		$params['featured_image_size'] = $this->generateImageSize( $params );

		if ( $params['section_title'] == 'yes' ) {
			$params['section_title_style'] = $this->generateTitleStyle( $params );
		}

		$params['this_object'] = $this;

		//ob_start();
		//coney_qodef_get_module_template_part('shortcodes/blog-list/holder', 'blog', $params['type'], $params);
		//$html = ob_get_contents();
		//ob_end_clean();

		$html = select_core_get_shortcode_template_part( 'holder', 'blog-list', $params['type'], $params );

		return $html;
	}

	/**
	 * Generates query array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function generateQueryArray( $params ) {
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

		if ( ! empty( $params['next_page'] ) ) {
			$queryArray['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}

		return $queryArray;
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

		$listType          = ! empty( $params['type'] ) ? 'qodef-bl-' . $params['type'] : 'qodef-bl-standard';
		$columnNumber      = $this->getColumnNumberClass( $params );
		$columnsSpace      = ! empty( $params['space_between_columns'] ) ? 'qodef-bl-' . $params['space_between_columns'] . '-space' : 'qodef-bl-normal-space';
		$paginationClasses = ! empty( $params['pagination_type'] ) ? 'qodef-bl-pag-' . $params['pagination_type'] : 'qodef-bl-pag-no-pagination';

		$holderClasses .= $listType . ' ' . $columnNumber . ' ' . $columnsSpace . ' ' . $paginationClasses;

		return $holderClasses;
	}

	/**
	 * Generates columns number classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getColumnNumberClass( $params ) {
		$classes = '';
		$columns = $params['number_of_columns'];

		switch ( $columns ) {
			case 1:
				$classes = 'qodef-bl-one-column';
				break;
			case 2:
				$classes = 'qodef-bl-two-columns';
				break;
			case 3:
				$classes = 'qodef-bl-three-columns';
				break;
			case 4:
				$classes = 'qodef-bl-four-columns';
				break;
			case 5:
				$classes = 'qodef-bl-five-columns';
				break;
			default:
				$classes = 'qodef-bl-three-columns';
				break;
		}

		return $classes;
	}

	/**
	 * Generates datta attributes array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getHolderData( $params ) {
		$dataString = '';

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$query_result = $params['query_result'];

		$params['max_num_pages'] = $query_result->max_num_pages;

		if ( ! empty( $paged ) ) {
			$params['next-page'] = $paged + 1;
		}

		foreach ( $params as $key => $value ) {
			if ( $key !== 'query_result' && $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );

				$dataString .= ' data-' . $new_key . '="' . esc_attr( $value ) . '"';
			}
		}

		return $dataString;
	}

	/**
	 * Generates image size option
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function generateImageSize( $params ) {
		$thumb_size = '';
		$image_size = $params['image_size'];

		switch ( $image_size ) {
			case 'landscape':
				$thumb_size = 'coney_qodef_landscape';
				break;
			case 'portrait':
				$thumb_size = 'coney_qodef_portrait';
				break;
			case 'square':
				$thumb_size = 'coney_qodef_square';
				break;
			case 'medium':
				$thumb_size = 'medium';
				break;
			case 'large':
				$thumb_size = 'large';
				break;
			case 'full':
				$thumb_size = 'full';
				break;
		}

		if ( $params['type'] == 'simple' ) {
			$thumb_size = 'coney_qodef_square';
		}

		return $thumb_size;
	}

	/**
	 * Generates section title style
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function generateTitleStyle( $params ) {
		$styles = array();

		if ( ! empty( $params['section_title_font_size'] ) ) {
			$styles[] = 'font-size: ' . $params['section_title_font_size'] . 'px';
		}

		return implode( ';', $styles );
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
}