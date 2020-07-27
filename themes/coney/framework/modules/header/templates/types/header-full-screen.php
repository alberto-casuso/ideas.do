<?php do_action('coney_qodef_before_page_header'); ?>

<header class="qodef-page-header">
    <div class="qodef-menu-area">
		<?php do_action( 'coney_qodef_after_header_menu_area_html_open' )?>
        <?php if($header_in_grid) : ?>
            <div class="qodef-grid">
        <?php endif; ?>
        <div class="qodef-vertical-align-containers">
            <div class="qodef-position-left">
                <div class="qodef-position-left-inner">
                    <?php if(!$hide_logo) {
                        coney_qodef_get_logo();
                    } ?>
                </div>
            </div>
            <div class="qodef-position-right">
                <div class="qodef-position-right-inner">
                    <?php coney_qodef_get_full_screen_opener(); ?>
                </div>
            </div>
        </div>
        <?php if($header_in_grid) : ?>
            </div>
        <?php endif; ?>
    </div>
    <?php do_action('coney_qodef_end_of_page_header_html'); ?>
</header>

<?php do_action('coney_qodef_after_page_header'); ?>