<?php do_action('coney_qodef_before_page_header'); ?>

<header class="qodef-page-header">
    <?php if($show_fixed_wrapper) : ?>
        <div class="qodef-fixed-wrapper">
    <?php endif; ?>
    <?php do_action('coney_qodef_after_header_area_html_open'); ?>
    <div class="qodef-menu-area">
		<?php do_action( 'coney_qodef_after_header_menu_area_html_open' )?>
        <?php if($header_in_grid) : ?>
            <div class="qodef-grid">
        <?php endif; ?>
        <div class="qodef-vertical-align-containers">
            <div class="qodef-position-left">
                <div class="qodef-position-left-inner">
                    <?php coney_qodef_get_divided_left_main_menu(); ?>
                </div>
            </div>
            <div class="qodef-position-center">
                <div class="qodef-position-center-inner">
                    <?php if(!$hide_logo) {
                        coney_qodef_get_logo('divided');
                    } ?>
                </div>
            </div>
            <div class="qodef-position-right">
                <div class="qodef-position-right-inner">
                    <?php coney_qodef_get_divided_right_main_menu(); ?>
                    
                    <?php coney_qodef_get_header_widget_area(); ?>
                </div>
            </div>
        </div>
        <?php if($header_in_grid) : ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if($show_fixed_wrapper) { ?>
        <?php do_action('coney_qodef_end_of_page_header_html'); ?>
        </div>
    <?php } else {
        do_action('coney_qodef_end_of_page_header_html');
    } ?>
    <?php if($show_sticky) {
        coney_qodef_get_sticky_header();
    } ?>
</header>

<?php do_action('coney_qodef_after_page_header'); ?>