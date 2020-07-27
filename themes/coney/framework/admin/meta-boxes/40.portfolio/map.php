<?php

if (!function_exists('coney_qodef_map_portfolio_meta')) {
    function coney_qodef_map_portfolio_meta() {
        global $coney_qodef_Framework;

        $qode_pages = array();
        $pages = get_pages();
        foreach ($pages as $page) {
            $qode_pages[$page->ID] = $page->post_title;
        }

        //Portfolio Images

        $qodePortfolioImages = new ConeyQodefMetaBox('portfolio-item', esc_html__('Portfolio Images (multiple upload)', 'coney'), '', '', 'portfolio_images');
        $coney_qodef_Framework->qodeMetaBoxes->addMetaBox('portfolio_images', $qodePortfolioImages);

        $qodef_portfolio_image_gallery = new ConeyQodefMultipleImages('qodef-portfolio-image-gallery', esc_html__('Portfolio Images', 'coney'), esc_html__('Choose your portfolio images', 'coney'));
        $qodePortfolioImages->addChild('qodef-portfolio-image-gallery', $qodef_portfolio_image_gallery);

        //Portfolio Images/Videos 2

        $qodePortfolioImagesVideos2 = new ConeyQodefMetaBox('portfolio-item', esc_html__('Portfolio Images/Videos (single upload)', 'coney'));
        $coney_qodef_Framework->qodeMetaBoxes->addMetaBox('portfolio_images_videos2', $qodePortfolioImagesVideos2);

        $qodef_portfolio_images_videos2 = new ConeyQodefImagesVideosFramework('', '');
        $qodePortfolioImagesVideos2->addChild('qode_portfolio_images_videos2', $qodef_portfolio_images_videos2);

        //Portfolio Additional Sidebar Items

        $qodeAdditionalSidebarItems = coney_qodef_create_meta_box(
            array(
                'scope' => array('portfolio-item'),
                'title' => esc_html__('Additional Portfolio Sidebar Items', 'coney'),
                'name' => 'portfolio_properties'
            )
        );

        $qode_portfolio_properties = coney_qodef_add_options_framework(
            array(
                'label' => esc_html__('Portfolio Properties', 'coney'),
                'name' => 'qode_portfolio_properties',
                'parent' => $qodeAdditionalSidebarItems
            )
        );
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_portfolio_meta', 40);
}