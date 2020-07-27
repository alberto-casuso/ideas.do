<?php

class ConeyQodefSearchOpener extends ConeyQodefWidget {
    public function __construct() {
        parent::__construct(
            'qodef_search_opener',
	        esc_html__('Select Search Opener', 'select-core'),
	        array( 'description' => esc_html__( 'Display a "search" icon that opens the search form', 'select-core'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_size',
                'title'       => esc_html__('Icon Size (px)', 'select-core'),
                'description' => esc_html__('Define size for search icon', 'select-core')
            ),
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_color',
                'title'       => esc_html__('Icon Color', 'select-core'),
                'description' => esc_html__('Define color for search icon', 'select-core')
            ),
            array(
	            'type'        => 'textfield',
	            'name'        => 'search_icon_hover_color',
                'title'       => esc_html__('Icon Hover Color', 'select-core'),
                'description' => esc_html__('Define hover color for search icon', 'select-core')
            ),
	        array(
		        'type' => 'textfield',
		        'name' => 'search_icon_margin',
		        'title' => esc_html__('Icon Margin', 'select-core'),
		        'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'select-core')
	        )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        global $coney_qodef_options, $coney_qodef_IconCollections;

	    $search_type_class    = 'qodef-search-opener qodef-icon-has-hover';
	    $styles = array();

	    if(!empty($instance['search_icon_size'])) {
		    $styles[] = 'font-size: '.intval($instance['search_icon_size']).'px';
	    }

	    if(!empty($instance['search_icon_color'])) {
		    $styles[] = 'color: '.$instance['search_icon_color'].';';
	    }

	    if (!empty($instance['search_icon_margin'])) {
		    $styles[] = 'margin: ' . $instance['search_icon_margin'].';';
	    }
	    ?>

	    <div <?php coney_qodef_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?> <?php coney_qodef_inline_style($styles); ?>
		    <?php coney_qodef_class_attribute($search_type_class); ?> >
            <div class="qodef-search-opener-wrapper">
                <?php do_action('coney_qodef_before_search_opener'); ?>
                <span class="qodef-search-icon">
                    <?php if(isset($coney_qodef_options['search_icon_pack'])) {
                        $coney_qodef_IconCollections->getSearchIcon($coney_qodef_options['search_icon_pack'], false);
                    } ?>
                </span>
            </div>
	    </div>
    <?php }
}