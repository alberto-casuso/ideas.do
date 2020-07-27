<?php do_action('coney_qodef_before_mobile_header'); ?>

<header class="qodef-mobile-header">
    <div class="qodef-mobile-header-inner">
        <?php do_action( 'coney_qodef_after_mobile_header_html_open' ) ?>
        <div class="qodef-mobile-header-holder">
            <div class="qodef-grid">
                <div class="qodef-vertical-align-containers">
                    <?php if($show_navigation_opener) : ?>
                        <div class="qodef-mobile-menu-opener">
                            <a href="javascript:void(0)">
                                <div class="qodef-mo-icon-holder">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    <?php if($mobile_menu_title !== '') { ?>
                                        <h6 class="qodef-mobile-menu-text"><?php echo esc_attr($mobile_menu_title); ?></h6>
                                    <?php } ?>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($show_logo) : ?>
                        <div class="qodef-position-center">
                            <div class="qodef-position-center-inner">
                                <?php coney_qodef_get_mobile_logo(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="qodef-position-right">
                        <div class="qodef-position-right-inner">
                            <?php if(is_active_sidebar('qodef-right-from-mobile-logo')) {
                                dynamic_sidebar('qodef-right-from-mobile-logo');
                            } ?>
                        </div>
                    </div>
                </div> <!-- close .qodef-vertical-align-containers -->
            </div>
        </div>
        <?php coney_qodef_get_mobile_nav(); ?>
        <?php do_action('coney_qodef_end_of_page_header_html'); ?>
    </div>
</header> <!-- close .qodef-mobile-header -->

<?php do_action('coney_qodef_after_mobile_header'); ?>