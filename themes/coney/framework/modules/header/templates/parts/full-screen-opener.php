<?php
$icon_size = '';
$fullscreen_icon_styles = array();

if (coney_qodef_options()->getOptionValue('fullscreen_menu_icon_size') !== '' ) {
    $icon_size = coney_qodef_options()->getOptionValue('fullscreen_menu_icon_size');
}

?>
<?php do_action('coney_qodef_before_top_navigation'); ?>
    <a href="javascript:void(0)" class="qodef-fullscreen-menu-opener">
        <span class="qodef-fm-lines">
            <span class="qodef-fm-icon-open"><i class="fa fa-bars" aria-hidden="true"></i></span>
            <span class="qodef-fm-icon-close"><i class="fa fa-times" aria-hidden="true"></i></span>
        </span>
    </a>
<?php do_action('coney_qodef_after_top_navigation'); ?>