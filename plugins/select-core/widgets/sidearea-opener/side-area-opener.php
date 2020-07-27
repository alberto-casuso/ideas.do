<?php

class ConeyQodefSideAreaOpener extends ConeyQodefWidget {
    public function __construct() {
        parent::__construct(
            'qodef_side_area_opener',
	        esc_html__('Select Side Area Opener', 'select-core'),
	        array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'select-core'))
        );

        $this->setParams();
    }
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'widget_margin',
				'title'       => esc_html__('Side Area Opener Margin', 'select-core'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'select-core')
			),
			array(
				'type' => 'textfield',
				'name' => 'widget_title',
				'title' => esc_html__('Side Area Opener Title', 'select-core')
			)
		);
	}
	
	public function widget($args, $instance) {
		$holder_styles = array();
		if (!empty($instance['icon_color'])) {
			$holder_styles[] = 'color: ' . $instance['icon_color'].';';
		}
		if (!empty($instance['widget_margin'])) {
			$holder_styles[] = 'margin: ' . $instance['widget_margin'];
		}
		?>
		<a class="qodef-side-menu-button-opener qodef-icon-has-hover" href="javascript:void(0)">
			<?php if (!empty($instance['widget_title'])) { ?>
				<h6 class="qodef-side-menu-title"><?php echo esc_html($instance['widget_title']); ?></h6>
			<?php } ?>
            <span class="qodef-side-menu-button">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </span>
		</a>
	<?php }
}