<?php

if (!function_exists('coney_qodef_social_options_map')) {

    function coney_qodef_social_options_map() {

        coney_qodef_add_admin_page(
            array(
                'slug' => '_social_page',
                'title' => esc_html__('Social Networks', 'coney'),
                'icon' => 'fa fa-share-alt'
            )
        );

        /**
         * Enable Social Share
         */
        $panel_social_share = coney_qodef_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_social_share',
            'title' => esc_html__('Enable Social Share', 'coney')
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Social Share', 'coney'),
            'description' => esc_html__('Enabling this option will allow social share on networks of your choice', 'coney'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#qodef_panel_social_networks, #qodef_panel_show_social_share_on'
            ),
            'parent' => $panel_social_share
        ));

        $panel_show_social_share_on = coney_qodef_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_show_social_share_on',
            'title' => esc_html__('Show Social Share On', 'coney'),
            'hidden_property' => 'enable_social_share',
            'hidden_value' => 'no'
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share_on_post',
            'default_value' => 'no',
            'label' => esc_html__('Posts', 'coney'),
            'description' => esc_html__('Show Social Share on Blog Posts', 'coney'),
            'parent' => $panel_show_social_share_on
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share_on_page',
            'default_value' => 'no',
            'label' => esc_html__('Pages', 'coney'),
            'description' => esc_html__('Show Social Share on Pages', 'coney'),
            'parent' => $panel_show_social_share_on
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_social_share_on_portfolio-item',
            'default_value' => 'no',
            'label' => esc_html__('Portfolio Item', 'coney'),
            'description' => esc_html__('Show Social Share for Portfolio Items', 'coney'),
            'parent' => $panel_show_social_share_on
        ));

        if (coney_qodef_is_woocommerce_installed()) {
            coney_qodef_add_admin_field(array(
                'type' => 'yesno',
                'name' => 'enable_social_share_on_product',
                'default_value' => 'no',
                'label' => esc_html__('Product', 'coney'),
                'description' => esc_html__('Show Social Share for Product Items', 'coney'),
                'parent' => $panel_show_social_share_on
            ));
        }

        /**
         * Social Share Networks
         */
        $panel_social_networks = coney_qodef_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_social_networks',
            'title' => esc_html__('Social Networks', 'coney'),
            'hidden_property' => 'enable_social_share',
            'hidden_value' => 'no'
        ));

        /**
         * Facebook
         */
        coney_qodef_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'facebook_title',
            'title' => esc_html__('Share on Facebook', 'coney')
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_facebook_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'coney'),
            'description' => esc_html__('Enabling this option will allow sharing via Facebook', 'coney'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#qodef_enable_facebook_share_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_facebook_share_container = coney_qodef_add_admin_container(array(
            'name' => 'enable_facebook_share_container',
            'hidden_property' => 'enable_facebook_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'image',
            'name' => 'facebook_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'coney'),
            'parent' => $enable_facebook_share_container
        ));

        /**
         * Twitter
         */
        coney_qodef_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'twitter_title',
            'title' => esc_html__('Share on Twitter', 'coney')
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_twitter_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'coney'),
            'description' => esc_html__('Enabling this option will allow sharing via Twitter', 'coney'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#qodef_enable_twitter_share_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_twitter_share_container = coney_qodef_add_admin_container(array(
            'name' => 'enable_twitter_share_container',
            'hidden_property' => 'enable_twitter_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'image',
            'name' => 'twitter_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'coney'),
            'parent' => $enable_twitter_share_container
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'text',
            'name' => 'twitter_via',
            'default_value' => '',
            'label' => esc_html__('Via', 'coney'),
            'parent' => $enable_twitter_share_container
        ));

        /**
         * Google Plus
         */
        coney_qodef_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'google_plus_title',
            'title' => esc_html__('Share on Google Plus', 'coney')
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_google_plus_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'coney'),
            'description' => esc_html__('Enabling this option will allow sharing via Google Plus', 'coney'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#qodef_enable_google_plus_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_google_plus_container = coney_qodef_add_admin_container(array(
            'name' => 'enable_google_plus_container',
            'hidden_property' => 'enable_google_plus_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'image',
            'name' => 'google_plus_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'coney'),
            'parent' => $enable_google_plus_container
        ));

        /**
         * Linked In
         */
        coney_qodef_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'linkedin_title',
            'title' => esc_html__('Share on LinkedIn', 'coney')
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_linkedin_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'coney'),
            'description' => esc_html__('Enabling this option will allow sharing via LinkedIn', 'coney'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#qodef_enable_linkedin_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_linkedin_container = coney_qodef_add_admin_container(array(
            'name' => 'enable_linkedin_container',
            'hidden_property' => 'enable_linkedin_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'image',
            'name' => 'linkedin_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'coney'),
            'parent' => $enable_linkedin_container
        ));

        /**
         * Tumblr
         */
        coney_qodef_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'tumblr_title',
            'title' => esc_html__('Share on Tumblr', 'coney')
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_tumblr_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'coney'),
            'description' => esc_html__('Enabling this option will allow sharing via Tumblr', 'coney'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#qodef_enable_tumblr_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_tumblr_container = coney_qodef_add_admin_container(array(
            'name' => 'enable_tumblr_container',
            'hidden_property' => 'enable_tumblr_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'image',
            'name' => 'tumblr_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'coney'),
            'parent' => $enable_tumblr_container
        ));

        /**
         * Pinterest
         */
        coney_qodef_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'pinterest_title',
            'title' => esc_html__('Share on Pinterest', 'coney')
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_pinterest_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'coney'),
            'description' => esc_html__('Enabling this option will allow sharing via Pinterest', 'coney'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#qodef_enable_pinterest_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_pinterest_container = coney_qodef_add_admin_container(array(
            'name' => 'enable_pinterest_container',
            'hidden_property' => 'enable_pinterest_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'image',
            'name' => 'pinterest_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'coney'),
            'parent' => $enable_pinterest_container
        ));

        /**
         * VK
         */
        coney_qodef_add_admin_section_title(array(
            'parent' => $panel_social_networks,
            'name' => 'vk_title',
            'title' => esc_html__('Share on VK', 'coney')
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_vk_share',
            'default_value' => 'no',
            'label' => esc_html__('Enable Share', 'coney'),
            'description' => esc_html__('Enabling this option will allow sharing via VK', 'coney'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#qodef_enable_vk_container'
            ),
            'parent' => $panel_social_networks
        ));

        $enable_vk_container = coney_qodef_add_admin_container(array(
            'name' => 'enable_vk_container',
            'hidden_property' => 'enable_vk_share',
            'hidden_value' => 'no',
            'parent' => $panel_social_networks
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'image',
            'name' => 'vk_icon',
            'default_value' => '',
            'label' => esc_html__('Upload Icon', 'coney'),
            'parent' => $enable_vk_container
        ));

        if (defined('QODEF_TWITTER_FEED_VERSION')) {
            $twitter_panel = coney_qodef_add_admin_panel(array(
                'title' => esc_html__('Twitter', 'coney'),
                'name' => 'panel_twitter',
                'page' => '_social_page'
            ));

            coney_qodef_add_admin_twitter_button(array(
                'name' => 'twitter_button',
                'parent' => $twitter_panel
            ));
        }

        if (defined('QODEF_INSTAGRAM_FEED_VERSION')) {
            $instagram_panel = coney_qodef_add_admin_panel(array(
                'title' => esc_html__('Instagram', 'coney'),
                'name' => 'panel_instagram',
                'page' => '_social_page'
            ));

            coney_qodef_add_admin_instagram_button(array(
                'name' => 'instagram_button',
                'parent' => $instagram_panel
            ));
        }

        /**
         * Open Graph
         */
        $panel_open_graph = coney_qodef_add_admin_panel(array(
            'page' => '_social_page',
            'name' => 'panel_open_graph',
            'title' => esc_html__('Open Graph', 'coney'),
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'enable_open_graph',
            'default_value' => 'no',
            'label' => esc_html__('Enable Open Graph', 'coney'),
            'description' => esc_html__('Enabling this option will allow usage of Open Graph protocol on your site', 'coney'),
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#qodef_enable_open_graph_container'
            ),
            'parent' => $panel_open_graph
        ));

        $enable_open_graph_container = coney_qodef_add_admin_container(array(
            'name' => 'enable_open_graph_container',
            'hidden_property' => 'enable_open_graph',
            'hidden_value' => 'no',
            'parent' => $panel_open_graph
        ));

        coney_qodef_add_admin_field(array(
            'type' => 'image',
            'name' => 'open_graph_image',
            'default_value' => QODE_ASSETS_ROOT . '/img/open_graph.jpg',
            'label' => esc_html__('Default Share Image', 'coney'),
            'parent' => $enable_open_graph_container,
            'description' => esc_html('Used when featured image is not set. Make sure that image is at least 1200 x 630 pixels, up to 8MB in size', 'coney'),
        ));

    }

    add_action('coney_qodef_options_map', 'coney_qodef_social_options_map', 18);
}