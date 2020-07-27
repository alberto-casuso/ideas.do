<?php
namespace ConeyQodef\Modules\Shortcodes\Highlight;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Highlight
 */
class Highlight implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'qodef_highlight';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/*
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'color'             => '',
			'background_color'  => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;
		$params['highlight_style'] = $this->getHighlightStyles($params);

		//Get HTML from template
		$html = select_core_get_shortcode_template_part('templates/highlight-template', 'highlight', '', $params);

		return $html;
	}

	/**
	 * Return Style for Highlight
	 *
	 * @param $params
	 * @return string
	 */
	private function getHighlightStyles($params) {
		$styles = array();

		if ($params['color'] !== '') {
			$styles[] = 'color: '.$params['color'];
		}

		if ($params['background_color'] !== '') {
			$styles[] = 'background-color: '.$params['background_color'];
		}

		return implode(';', $styles);
	}
}