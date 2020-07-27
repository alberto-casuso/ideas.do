<?php
namespace ConeyQodef\Modules\Shortcodes\SingleImage;

use ConeyQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

class SingleImage implements ShortcodeInterface{

    private $base;

    /**
     * Image With Text constructor.
     */
    public function __construct() {
        $this->base = 'qodef_single_image';

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
            'name'                      => esc_html__('Select Single Image', 'select-core'),
            'base'                      => $this->getBase(),
            'category'                  => esc_html__('by SELECT', 'select-core'),
            'icon' 						=> 'icon-wpb-single-image extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'		  => 'attach_image',
                    'param_name'  => 'image',
                    'heading'	  => esc_html__('Image', 'select-core'),
                    'description' => esc_html__('Select image from media library', 'select-core')
                ),
                array(
                    'type'		  => 'textfield',
                    'param_name'  => 'image_size',
                    'heading'	  => esc_html__('Image Size', 'select-core'),
                    'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'select-core')
                ),
                array(
                    'type'		  => 'dropdown',
                    'param_name'  => 'enable_lightbox',
                    'heading'	  => esc_html__('Enable Lightbox Functionality', 'select-core'),
                    'value'       => array_flip(coney_qodef_get_yes_no_select_array(false))
                ),
                array(
                    'type'		  => 'textfield',
                    'param_name'  => 'link',
                    'heading'	  => esc_html__('Link', 'select-core'),
                    'description' => esc_html__('Enter link for image', 'select-core'),
                    'dependency' => array('element' => 'enable_lightbox', 'value' => 'no'),
                ),
            )
        ));
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'image'			  => '',
            'image_size'	  => 'full',
            'enable_lightbox' => 'no',
            'link' => '',
        );

        $params = shortcode_atts($args, $atts);

        $params['image'] = $this->getImage($params);
        $params['image_size'] = $this->getImageSize($params['image_size']);
        $params['enable_lightbox'] = ($params['enable_lightbox'] === 'yes') ? true : false;


        $html = select_core_get_shortcode_template_part('templates/single-image', 'single-image', '', $params);

        return $html;
    }

    /**
     * Return image for shortcode
     *
     * @param $params
     * @return array
     */
    private function getImage($params) {
        $image = array();

        if (!empty($params['image']) && is_numeric($params['image'])) {
            $id = $params['image'];
        } else {
            $id = coney_qodef_get_attachment_id_from_url($params['image']);
        }
            $image['image_id'] = $id;
            $image_original = wp_get_attachment_image_src($id, 'full');
            $image['url'] = $image_original[0];
            $image['alt'] = get_post_meta($id, '_wp_attachment_image_alt', true);


        return $image;
    }

    /**
     * Return image size or custom image size array
     *
     * @param $image_size
     * @return array
     */
    private function getImageSize($image_size) {
        $image_size = trim($image_size);
        //Find digits
        preg_match_all( '/\d+/', $image_size, $matches );
        if(in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
            return $image_size;
        } elseif(!empty($matches[0])) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        } else {
            return 'thumbnail';
        }
    }
}