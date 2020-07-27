<?php do_action('coney_qodef_before_sticky_header'); ?>

<div class="qodef-sticky-header <?php echo esc_attr($standard_menu_area_class); ?>">
    <?php do_action( 'coney_qodef_after_sticky_menu_html_open' ); ?>
    <div class="qodef-sticky-holder">
    <?php if($sticky_header_in_grid) : ?>
        <div class="qodef-grid">
            <?php endif; ?>
            <div class=" qodef-vertical-align-containers">
                <div class="qodef-position-left">
                    <div class="qodef-position-left-inner">
                        <?php if(!$hide_logo) {
                            coney_qodef_get_logo('sticky');
                        } ?>
                        <?php if($set_menu_area_position === 'left') : ?>
                            <?php coney_qodef_get_sticky_menu('qodef-sticky-nav'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($set_menu_area_position === 'center') : ?>
                <div class="qodef-position-center">
                    <div class="qodef-position-center-inner">
                        <?php coney_qodef_get_sticky_menu('qodef-sticky-nav'); ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="qodef-position-right">
                    <div class="qodef-position-right-inner">
                        <?php if($set_menu_area_position === 'right') : ?>
                            <?php coney_qodef_get_sticky_menu('qodef-sticky-nav'); ?>
                        <?php endif; ?>
                        <?php if(is_active_sidebar('qodef-sticky-right')) : ?>
                            <?php dynamic_sidebar('qodef-sticky-right'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php do_action('coney_qodef_end_of_sticky_header_html'); ?>
</div>

<?php do_action('coney_qodef_after_sticky_header'); ?>