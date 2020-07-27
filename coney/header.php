<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * coney_qodef_header_meta hook
     *
     * @see coney_qodef_header_meta() - hooked with 10
     * @see coney_qodef_user_scalable_meta - hooked with 10
     */
    do_action('coney_qodef_header_meta');

    wp_head(); ?>
</head>
<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
    <?php
    /**
     * coney_qodef_after_body_tag hook
     *
     * @see coney_qodef_get_side_area() - hooked with 10
     * @see coney_qodef_smooth_page_transitions() - hooked with 10
     */
    do_action('coney_qodef_after_body_tag'); ?>

    <div class="qodef-wrapper">
        <div class="qodef-wrapper-inner">
            <?php coney_qodef_get_header(); ?>
	
	        <?php
	        /**
	         * coney_qodef_after_header_area hook
	         *
	         * @see coney_qodef_back_to_top_button() - hooked with 10
	         * @see coney_qodef_get_full_screen_menu() - hooked with 10
	         */
	        do_action('coney_qodef_after_header_area'); ?>
	        
            <div class="qodef-content" <?php coney_qodef_content_elem_style_attr(); ?>>
                <div class="qodef-content-inner">