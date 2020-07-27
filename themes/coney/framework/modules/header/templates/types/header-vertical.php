<?php do_action('coney_qodef_before_page_header'); ?>

<aside class="qodef-vertical-menu-area">
    <div class="qodef-vertical-menu-area-inner <?php echo esc_attr($vertical_text_align_class); ?>">
        <div class="qodef-vertical-area-background"></div>
        <?php if(!$hide_logo) {
            coney_qodef_get_logo('vertical');
        } ?>
        
        <?php coney_qodef_get_vertical_main_menu(); ?>

        <div class="qodef-vertical-area-widget-holder">
            <?php coney_qodef_get_header_widget_area(); ?>
        </div>
    </div>
</aside>

<?php do_action('coney_qodef_after_page_header'); ?>