<?php

namespace ConeyQodef\Modules\Shortcodes\Banner;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

class Banner implements ShortcodeInterface {

	private $base;

	/**
	 * Banner constructor.
	 */
	public function __construct() {
		$this->base = 'qodef_banner';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		vc_map( array(
			'name'                      => esc_html__( 'Select Banner', 'select-core' ),
			'base'                      => $this->getBase(),
			'category'                  => esc_html__( 'by SELECT', 'select-core' ),
			'icon'                      => 'icon-wpb-banner extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'attach_image',
					'param_name'  => 'image',
					'heading'     => esc_html__( 'Image', 'select-core' ),
					'description' => esc_html__( 'Select image from media library', 'select-core' )
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'link',
					'heading'    => esc_html__( 'Link', 'select-core' )
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'target',
					'heading'    => esc_html__( 'Target', 'select-core' ),
					'value'      => array(
						esc_html__( 'Same Window', 'select-core' ) => '_self',
						esc_html__( 'New Window', 'select-core' )  => '_blank'
					),
					'dependency' => array( 'element' => 'link', 'not_empty' => true ),
				),
				array(
					'type'       => 'textfield',
					'param_name' => 'title',
					'heading'    => esc_html__( 'Title', 'select-core' )
				),
				array(
					'type'        => 'dropdown',
					'param_name'  => 'title_tag',
					'heading'     => esc_html__( 'Title Tag', 'select-core' ),
					'value'       => array_flip( coney_qodef_get_title_tag( true, array( 'p' => 'p' ) ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'title', 'not_empty' => true )
				),
				array(
					'type'       => 'colorpicker',
					'param_name' => 'title_color',
					'heading'    => esc_html__( 'Title Color', 'select-core' ),
					'dependency' => array( 'element' => 'title', 'not_empty' => true )
				)
			)
		) );
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {
		$args = array(
			'image'       => '',
			'link'        => '',
			'target'      => '_self',
			'title'       => '',
			'title_tag'   => 'h5',
			'title_color' => ''
		);

		$params = shortcode_atts( $args, $atts );

		$params['title_tag']    = ! empty( $title_tag ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles'] = $this->getTitleStyles( $params );

		$html = select_core_get_shortcode_template_part( 'templates/banner', 'banner', '', $params );

		return $html;
	}

	private function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		if ( ! empty( $params['title_top_margin'] ) ) {
			$styles[] = 'margin-top: ' . coney_qodef_filter_px( $params['title_top_margin'] ) . 'px';
		}

		return implode( ';', $styles );
	}
}