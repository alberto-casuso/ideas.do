<?php

namespace ConeyQodef\Modules\Shortcodes\BlogVideoList;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class BlogVideoList
 */
class BlogVideoList implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'qodef_blog_video_list';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );

		//Category filter
		add_filter( 'vc_autocomplete_qodef_blog_video_list_category_callback', array(
			&$this,
			'blogCategoryAutocompleteSuggester',
		), 10, 1 ); // Get suggestion(find). Must return an array

		//Category render
		add_filter( 'vc_autocomplete_qodef_blog_video_list_category_render', array(
			&$this,
			'blogCategoryAutocompleteRender',
		), 10, 1 ); // Get suggestion(find). Must return an array

	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			'name'                      => esc_html__( 'Select Blog Video List', 'select-core' ),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-blog-video-list extended-custom-icon',
			'category'                  => esc_html__( 'by SELECT', 'select-core' ),
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
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
						esc_html__( 'One', 'select-core' )   => '1',
						esc_html__( 'Two', 'select-core' )   => '2',
						esc_html__( 'Three', 'select-core' ) => '3',
						esc_html__( 'Four', 'select-core' )  => '4',
						esc_html__( 'Five', 'select-core' )  => '5'
					),
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
			'number_of_posts'         => '-1',
			'number_of_columns'       => '3',
			'space_between_columns'   => 'normal',
			'category'                => '',
			'order_by'                => 'title',
			'order'                   => 'ASC',
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

		$params['holder_classes'] = $this->getHolderClasses( $params );

		if ( $params['section_title'] == 'yes' ) {
			$params['section_title_style'] = $this->generateTitleStyle( $params );
		}

		//ob_start();
		//coney_qodef_get_module_template_part('shortcodes/blog-video-list/holder', 'blog', '', $params);
		//$html = ob_get_contents();
		//ob_end_clean();

		$html = select_core_get_shortcode_template_part( 'holder', 'blog-video-list', '', $params );

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
			'post__not_in'   => get_option( 'sticky_posts' ),
			'tax_query'      => array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => 'post-format-video',
				),
			),
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
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getHolderClasses( $params ) {
		$holderClasses = '';

		$columnNumber = $this->getColumnNumberClass( $params );
		$columnsSpace = ! empty( $params['space_between_columns'] ) ? 'qodef-bvl-' . $params['space_between_columns'] . '-space' : 'qodef-bvl-normal-space';

		$holderClasses .= $columnNumber . ' ' . $columnsSpace;

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
				$classes = 'qodef-bvl-one-column';
				break;
			case 2:
				$classes = 'qodef-bvl-two-columns';
				break;
			case 3:
				$classes = 'qodef-bvl-three-columns';
				break;
			case 4:
				$classes = 'qodef-bvl-four-columns';
				break;
			case 5:
				$classes = 'qodef-bvl-five-columns';
				break;
			default:
				$classes = 'qodef-bvl-three-columns';
				break;
		}

		return $classes;
	}

	/**
	 * Get Video Link
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getVideoLink() {
		$video_link = '';

		$has_video_link = get_post_meta( get_the_ID(), "qodef_post_video_link_meta", true ) !== '';

		if ( $has_video_link ) {
			$video_link = get_post_meta( get_the_ID(), "qodef_post_video_link_meta", true );
		}

		return $video_link;
	}

	/**
	 * Get Video Image
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getVideoImage() {

		$featured_image_meta = get_post_meta( get_the_ID(), 'qodef_blog_list_featured_image_meta', true );
		$video_image         = ! empty( $featured_image_meta ) && coney_qodef_blog_item_has_link() ? $featured_image_meta : get_the_post_thumbnail_url( get_the_ID(), 'full' );;


		return $video_image;
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