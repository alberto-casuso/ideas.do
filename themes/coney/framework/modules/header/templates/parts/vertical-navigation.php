<?php do_action('coney_qodef_before_top_navigation'); ?>

<nav class="qodef-vertical-menu qodef-vertical-dropdown-on-click">
    <?php
        wp_nav_menu(array(
            'theme_location'  => 'vertical-navigation',
            'container'       => '',
            'container_class' => '',
            'menu_class'      => '',
            'menu_id'         => '',
            'fallback_cb'     => 'top_navigation_fallback',
            'link_before'     => '<span>',
            'link_after'      => '</span>',
            'walker'          => new ConeyQodefStickyNavigationWalker()
        ));
    ?>
</nav>

<?php do_action('coney_qodef_after_top_navigation'); ?>