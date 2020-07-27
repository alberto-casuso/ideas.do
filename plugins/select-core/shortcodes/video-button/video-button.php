<?php
namespace ConeyQodef\Modules\Shortcodes\VideoButton;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class VideoButton
 */
class VideoButton implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'qodef_video_button';

        add_action('vc_before_init', array($this, 'vcMap'));
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
        vc_map(array(
            'name'                      => esc_html__('Select Video Button', 'select-core'),
            'base'                      => $this->getBase(),
            'category'                  => esc_html__('by SELECT', 'select-core'),
            'icon'                      => 'icon-wpb-video-button extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
	            array(
		            'type'       => 'textfield',
		            'param_name' => 'video_link',
		            'heading'    => esc_html__('Video Link', 'select-core')
	            ),
	            array(
		            'type'		  => 'attach_image',
		            'param_name'  => 'video_image',
		            'heading'	  => esc_html__('Video Image', 'select-core'),
		            'description' => esc_html__('Select image from media library', 'select-core')
	            ),
	            array(
		            'type'       => 'colorpicker',
		            'param_name' => 'play_button_color',
		            'heading'    => esc_html__('Play Button Color', 'select-core')
	            ),
	            array(
		            'type'       => 'textfield',
		            'param_name' => 'play_button_size',
		            'heading'    => esc_html__('Play Button Size (px)', 'select-core')
	            )
            )
        ));
    }
	
	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'video_link'        => '#',
			'video_image'       => '',
			'play_button_color' => '',
			'play_button_size'  => ''
		);
		
		$params = shortcode_atts($args, $atts);
		
		if(!is_numeric($params['video_image']) && !empty($params['video_image'])) {
			$params['video_image'] = coney_qodef_get_attachment_id_from_url($params['video_image']);
		}

		$params['play_button_styles'] = $this->getPlayButtonStyles($params);

		//Get HTML from template
		$html = select_core_get_shortcode_template_part('templates/video-button', 'video-button', '', $params);
		
		return $html;
	}
	
	private function getPlayButtonStyles($params) {
		$styles = array();
		
		if (!empty($params['play_button_color'])) {
			$styles[] = 'color: '.$params['play_button_color'];
		}
		
		if (!empty($params['play_button_size'])) {
			$styles[] = 'font-size: '.coney_qodef_filter_px($params['play_button_size']) .'px';
		}
		
		return implode(';', $styles);
	}
}