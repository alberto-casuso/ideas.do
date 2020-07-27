<?php

namespace ConeyQodef\Modules\Shortcodes\BlogPostCalendar;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Button that represents button shortcode
 * @package ConeyQodef\Modules\Shortcodes\BlogPostCalendar
 */
class BlogPostCalendar implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * Sets base attribute and registers shortcode with Visual Composer
	 */
	public function __construct() {
		$this->base = 'qodef_blog_post_calendar';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	/**
	 * Returns base attribute
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 */
	public function vcMap() {
		vc_map( array(
			'name'                      => esc_html__( 'Select Blog Post Calendar', 'select-core' ),
			'base'                      => $this->base,
			'admin_enqueue_css'         => array( coney_qodef_get_skin_uri() . '/assets/css/qodef-vc-extend.css' ),
			'category'                  => esc_html__( 'by SELECT', 'select-core' ),
			'icon'                      => 'icon-wpb-blog-post-calendar extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'       => 'textfield',
					'param_name' => 'year',
					'heading'    => esc_html__( 'Year', 'select-core' ),
				)
			)
		) );
	}

	/**
	 * Renders HTML for button shortcode
	 *
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {
		$args = array(
			'year' => '',
		);

		$params = shortcode_atts( $args, $atts );

		$year = $params['year'];

		$html = "";

		$html .= "<div class='qodef-archive-wrapper'>";
		$html .= "<h4>" . $year . "</h4>";
		$html .= "<ul>";

		$has_posts = $this->checkYearPosts( $year );
		//If there are any posts
		if ( $has_posts ) {
			$months = $this->getMonthsArray();
			//Loop through every year and check each monnth of each year for posts
			foreach ( $months as $month_num => $month_name ) {
				//Checks to see if a month a has posts
				$month_has_posts           = $this->checkMonthPosts( $year, $month_num );
				$params['month_has_posts'] = $month_has_posts;
				$params['month']           = $month_num;
				$params['month_name']      = $month_name;

				//ob_start();
				//coney_qodef_get_module_template_part('shortcodes/blog-post-calendar/templates/blog-post-calendar', 'blog', '', $params);
				//$html .= ob_get_contents();
				//ob_end_clean();

				$html .= select_core_get_shortcode_template_part( 'templates/blog-post-calendar', 'blog-post-calendar', '', $params );
			}
		} else {
			$html .= "<li>" . esc_html__( 'Sorry, no posts matched your criteria.', 'select-core' ) . "</li>";
		}

		$html .= "</ul>";
		$html .= "</div>";

		return $html;
	}

	private function checkYearPosts( $year ) {
		global $wpdb;

		$year_has_post = $wpdb->get_var(
			"
              SELECT COUNT(*) as total 
              FROM $wpdb->posts 
              WHERE post_status = 'publish' 
              AND post_type = 'post'
              AND YEAR(post_date) = $year 
            "
		);

		return $year_has_post;
	}

	private function checkMonthPosts( $year, $month ) {
		global $wpdb;

		$month_has_posts = $wpdb->get_var(
			"
              SELECT COUNT(*) as total 
              FROM $wpdb->posts 
              WHERE post_status = 'publish' 
              AND post_type = 'post'
              AND YEAR(post_date) = $year 
              AND MONTH(post_date) = $month
            "
		);

		return $month_has_posts;
	}

	private function getMonthsArray() {
		//Setup months
		$months = array(
			1  => "January",
			2  => "February",
			3  => "March",
			4  => "April",
			5  => "May",
			6  => "June",
			7  => "July",
			8  => "August",
			9  => "September",
			10 => "October",
			11 => "November",
			12 => "December"
		);

		return $months;
	}
}