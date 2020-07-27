<?php
namespace ConeyQodef\Modules\Header\Types;

use ConeyQodef\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Simple layout and option
 *
 * Class HeaderFullScreen
 */
class HeaderFullScreen extends HeaderType {
    protected $heightOfTransparency;
    protected $heightOfCompleteTransparency;
    protected $headerHeight;
    protected $mobileHeaderHeight;

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-full-screen';

        if(!is_admin()) {

            $menuAreaHeight       = coney_qodef_filter_px(coney_qodef_options()->getOptionValue('menu_area_height_header_full_screen'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? intval($menuAreaHeight) : 85;

            $mobileHeaderHeight       = coney_qodef_filter_px(coney_qodef_options()->getOptionValue('mobile_header_height'));
            $this->mobileHeaderHeight = $mobileHeaderHeight !== '' ? intval($mobileHeaderHeight) : 100;

            add_action('wp', array($this, 'setHeaderHeightProps'));

            add_filter('coney_qodef_js_global_variables', array($this, 'getGlobalJSVariables'));
            add_filter('coney_qodef_per_page_js_vars', array($this, 'getPerPageJSVariables'));
        }
    }

    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters = apply_filters('coney_qodef_header_fullscreen_parameters', $parameters);

        coney_qodef_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Sets header height properties after WP object is set up
     */
    public function setHeaderHeightProps(){
        $this->heightOfTransparency         = $this->calculateHeightOfTransparency();
        $this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
        $this->headerHeight                 = $this->calculateHeaderHeight();
        $this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
    }

    /**
     * Returns total height of transparent parts of header
     *
     * @return int
     */
    public function calculateHeightOfTransparency() {
        $id = coney_qodef_get_page_id();
        $transparencyHeight = 0;
	
	    if(get_post_meta($id, 'qodef_header_area_background_transparency_meta', true) !== '1' && get_post_meta($id, 'qodef_header_area_background_transparency_meta', true) !== ''){
		    $menuAreaTransparent = true;
	    } else if (coney_qodef_options()->getOptionValue('header_area_background_transparency') !== '1' && coney_qodef_options()->getOptionValue('header_area_background_transparency') !== '') {
		    $menuAreaTransparent = true;
	    } else if (is_404() && coney_qodef_options()->getOptionValue('404_menu_area_background_transparency_header') !== '1' && coney_qodef_options()->getOptionValue('404_menu_area_background_transparency_header') !== '') {
	        $menuAreaTransparent = true;
        } else {
            $menuAreaTransparent = false;
        }

        if($menuAreaTransparent) {
            $transparencyHeight = $this->menuAreaHeight;

            if(coney_qodef_is_top_bar_enabled() || coney_qodef_is_top_bar_enabled() && coney_qodef_is_top_bar_transparent()) {
                $transparencyHeight += coney_qodef_get_top_bar_height();
            }
        }

        return $transparencyHeight;
    }

    /**
     * Returns height of completely transparent header parts
     *
     * @return int
     */
    public function calculateHeightOfCompleteTransparency() {
        $id = coney_qodef_get_page_id();
        $transparencyHeight = 0;

        $menuAreaTransparent = coney_qodef_options()->getOptionValue('fixed_header_transparency') === '0';

        if($menuAreaTransparent) {
            $transparencyHeight = $this->menuAreaHeight;
        }

        return $transparencyHeight;
    }


    /**
     * Returns total height of header
     *
     * @return int|string
     */
    public function calculateHeaderHeight() {
        $headerHeight = $this->menuAreaHeight;
        if(coney_qodef_is_top_bar_enabled()) {
            $headerHeight += coney_qodef_get_top_bar_height();
        }

        return $headerHeight;
    }

    /**
     * Returns total height of mobile header
     *
     * @return int|string
     */
    public function calculateMobileHeaderHeight() {
        $mobileHeaderHeight = $this->mobileHeaderHeight;

        return $mobileHeaderHeight;
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['qodefLogoAreaHeight'] = 0;
        $globalVariables['qodefMenuAreaHeight'] = $this->headerHeight;
        $globalVariables['qodefMobileHeaderHeight'] = $this->mobileHeaderHeight;

        return $globalVariables;
    }

    /**
     * Returns per page js variables of header
     *
     * @param $perPageVars
     * @return int|string
     */
    public function getPerPageJSVariables($perPageVars) {
        //calculate transparency height only if header has no sticky behaviour
        $perPageVars['qodefHeaderTransparencyHeight'] = 0;

        return $perPageVars;
    }
}