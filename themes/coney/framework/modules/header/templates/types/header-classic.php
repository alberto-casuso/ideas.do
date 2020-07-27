<?php do_action('coney_qodef_before_page_header'); ?>

<header class="qodef-page-header">
    <div class="qodef-logo-area">
        <div class="qodef-vertical-align-containers">
            <div class="qodef-position-center">
                <div class="qodef-position-center-inner">
                    <?php if(!$hide_logo) {
                        coney_qodef_get_logo('classic');
                    } ?>
                    <?php if(!empty($logo_text)) { ?>
                        <div class="qodef-text-wrapper">
                            <span class="qodef-text-under-logo"><?php echo esc_html($logo_text); ?></span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php if($show_fixed_wrapper) : ?>
        <div class="qodef-fixed-wrapper">
    <?php endif; ?>
    <?php if($header_in_grid) : ?>
    <div class="qodef-grid">
    <?php endif; ?>
            <div class="qodef-menu-area">
                <?php do_action( 'coney_qodef_after_header_menu_area_html_open' )?>
                <div class="qodef-vertical-align-containers">
                    <div class="qodef-position-center">
                        <div class="qodef-position-center-inner">
                            <?php coney_qodef_get_main_menu(); ?>
                            <?php coney_qodef_get_header_widget_area(); ?>
                        </div>
                    </div>
                </div>
            </div>
    <?php if($header_in_grid) : ?>
        </div>
    <?php endif; ?>
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