<?php
if(!function_exists('coney_qodef_design_styles')) {
    /**
     * Generates general custom styles
     */
    function coney_qodef_design_styles() {

		if (coney_qodef_options()->getOptionValue('google_fonts')){
			$font_family = coney_qodef_options()->getOptionValue('google_fonts');
			if(coney_qodef_is_font_option_valid($font_family)) {
				echo coney_qodef_dynamic_css('body', array('font-family' => coney_qodef_get_font_option_val($font_family)));
			}
		}

        if(coney_qodef_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                'a:hover',
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'p a:hover',
                '.qodef-comment-holder .qodef-comment-text .comment-edit-link:hover',
                '.qodef-comment-holder .qodef-comment-text .comment-reply-link:hover',
                '.qodef-comment-holder .qodef-comment-text .replay:hover',
                '.qodef-comment-holder .qodef-comment-text #cancel-comment-reply-link',
                '.qodef-main-menu>ul>li.qodef-active-item>a',
                '.qodef-main-menu>ul>li:hover>a',
                '.qodef-drop-down .second .inner ul li a:hover',
                '.qodef-drop-down .second .inner ul li.current-menu-ancestor>a',
                '.qodef-drop-down .second .inner ul li.current-menu-item>a',
                '.qodef-drop-down .wide .second .inner>ul>li.current-menu-ancestor>a',
                '.qodef-drop-down .wide .second .inner>ul>li.current-menu-item>a',
                '.qodef-header-vertical .qodef-vertical-menu ul li a:hover',
                '.qodef-header-vertical .qodef-vertical-menu ul li.current-menu-ancestor>a',
                '.qodef-header-vertical .qodef-vertical-menu ul li.current-menu-item>a',
                '.qodef-header-vertical .qodef-vertical-menu ul li.current_page_item>a',
                '.qodef-header-vertical .qodef-vertical-menu ul li.qodef-active-item>a',
                '.qodef-mobile-header .qodef-mobile-nav .qodef-grid>ul>li.qodef-active-item>a',
                '.qodef-mobile-header .qodef-mobile-nav ul li a:hover',
                '.qodef-mobile-header .qodef-mobile-nav ul li h5:hover',
                '.qodef-mobile-header .qodef-mobile-nav ul ul li.current-menu-ancestor>a',
                '.qodef-mobile-header .qodef-mobile-nav ul ul li.current-menu-item>a',
                '.qodef-mobile-header .qodef-mobile-menu-opener.qodef-mobile-menu-opened a .qodef-mo-icon-holder h6',
                '.qodef-mobile-header .qodef-mobile-menu-opener.qodef-mobile-menu-opened a .qodef-mo-icon-holder>i',
                '.qodef-mobile-header .qodef-mobile-menu-opener.qodef-mobile-menu-opened a .qodef-mo-icon-holder>span',
                'nav.qodef-fullscreen-menu ul li ul li.current-menu-ancestor>a',
                'nav.qodef-fullscreen-menu ul li ul li.current-menu-item>a',
                '.qodef-search-page-holder .qodef-search-page-form .qodef-form-holder .qodef-search-submit:hover',
                '.qodef-search-page-holder article.sticky .qodef-post-title-area h3 a',
                '.qodef-pl-filter-holder ul li.qodef-pl-current span',
                '.qodef-pl-filter-holder ul li:hover span',
                '.qodef-pl-standard-pagination ul li.qodef-pl-pag-active a',
                '.qodef-portfolio-slider-holder .owl-nav .owl-next:hover .qodef-next-icon',
                '.qodef-portfolio-slider-holder .owl-nav .owl-next:hover .qodef-prev-icon',
                '.qodef-portfolio-slider-holder .owl-nav .owl-prev:hover .qodef-next-icon',
                '.qodef-portfolio-slider-holder .owl-nav .owl-prev:hover .qodef-prev-icon',
                '.qodef-blog-holder article.sticky .qodef-post-title a',
                '.qodef-blog-holder.qodef-blog-centered article.format-link .qodef-post-mark',
                '.qodef-blog-holder.qodef-blog-centered article.format-quote .qodef-post-mark',
                '.qodef-blog-holder.qodef-blog-centered article.format-link .qodef-post-info',
                '.qodef-blog-holder.qodef-blog-centered article.format-quote .qodef-post-info',
                '.qodef-blog-holder.qodef-blog-centered article.format-link .qodef-post-title a:hover',
                '.qodef-blog-holder.qodef-blog-centered article.format-quote .qodef-post-title a:hover',
                '.qodef-blog-holder.qodef-blog-centered article .qodef-post-info .qodef-post-info-category a',
                '.qodef-blog-holder.qodef-blog-full-width-photo article .qodef-post-info-section-top .qodef-post-info-category a',
                '.qodef-blog-holder.qodef-blog-full-width-photo article .qodef-post-info-section-left .qodef-post-info>* a',
                '.qodef-blog-holder.qodef-blog-full-width-photo article .qodef-post-info-section-left .qodef-post-info-author a:hover',
                '.qodef-blog-holder.qodef-blog-full-width-photo article .qodef-post-info-section-left .qodef-social-share-holder.qodef-list li a:hover',
                '.qodef-blog-holder.qodef-blog-masonry article .qodef-post-info-top .qodef-post-info-category a',
                '.qodef-blog-holder.qodef-blog-masonry article .qodef-post-info-bottom .qodef-post-info-author a:hover',
                '.qodef-blog-holder.qodef-blog-masonry article .qodef-post-info-bottom .qodef-blog-like:hover i:first-child',
                '.qodef-blog-holder.qodef-blog-masonry article .qodef-post-info-bottom .qodef-blog-like:hover span:first-child',
                '.qodef-blog-holder.qodef-blog-masonry article .qodef-post-info-bottom .qodef-post-info-comments-holder:hover span:first-child',
                '.qodef-blog-holder.qodef-blog-masonry article.format-link .qodef-post-title a:hover',
                '.qodef-blog-holder.qodef-blog-masonry article.format-quote .qodef-post-title a:hover',
                '.qodef-blog-holder.qodef-blog-metro article.format-standard .qodef-post-info .qodef-post-top-section .qodef-post-info-category a',
                '.qodef-blog-holder.qodef-blog-narrow article .qodef-post-info.qodef-section-top .qodef-post-info-category',
                '.qodef-blog-holder.qodef-blog-narrow article .qodef-post-info.qodef-section-bottom .qodef-blog-share .qodef-social-share-holder.qodef-list li a:hover',
                '.qodef-blog-holder.qodef-blog-narrow article .qodef-post-info.qodef-section-bottom .qodef-post-info-author a:hover',
                '.qodef-blog-holder.qodef-blog-narrow article .qodef-post-info.qodef-section-bottom .qodef-blog-like:hover i:first-child',
                '.qodef-blog-holder.qodef-blog-narrow article .qodef-post-info.qodef-section-bottom .qodef-blog-like:hover span:first-child',
                '.qodef-blog-holder.qodef-blog-narrow article .qodef-post-info.qodef-section-bottom .qodef-post-info-comments-holder:hover span:first-child',
                '.qodef-blog-holder.qodef-blog-split-column article .qodef-post-text .qodef-post-info-category',
                '.qodef-blog-holder.qodef-blog-split-column article .qodef-post-info-bottom .qodef-social-share-holder.qodef-list li a:hover',
                '.qodef-blog-holder.qodef-blog-split-column article.format-quote .qodef-post-text .qodef-post-title a:hover',
                '.qodef-blog-holder.qodef-blog-split-column article.format-quote .qodef-post-mark',
                '.qodef-blog-holder.qodef-blog-split-column article.format-link .qodef-post-text .qodef-post-title a:hover',
                '.qodef-blog-holder.qodef-blog-split-column article.format-link .qodef-post-mark',
                '.qodef-blog-holder.qodef-blog-standard article .qodef-post-info-top .qodef-post-info-category a',
                '.qodef-blog-holder.qodef-blog-standard article .qodef-post-info-bottom .qodef-post-info-author a:hover',
                '.qodef-blog-holder.qodef-blog-standard article .qodef-post-info-bottom .qodef-blog-like:hover i:first-child',
                '.qodef-blog-holder.qodef-blog-standard article .qodef-post-info-bottom .qodef-blog-like:hover span:first-child',
                '.qodef-blog-holder.qodef-blog-standard article .qodef-post-info-bottom .qodef-post-info-comments-holder:hover span:first-child',
                '.qodef-blog-holder.qodef-blog-standard article.format-link .qodef-post-title a:hover',
                '.qodef-blog-holder.qodef-blog-standard article.format-quote .qodef-post-title a:hover',
                '.qodef-blog-holder.qodef-blog-single.qodef-blog-single-standard article .qodef-post-info-top .qodef-post-info-category',
                '.qodef-blog-holder.qodef-blog-single.qodef-blog-single-standard article .qodef-post-info-bottom .qodef-tags a',
                '.qodef-blog-holder.qodef-blog-single-full-width-image article .qodef-post-content .qodef-post-info-top .qodef-post-info-category',
                '.qodef-blog-holder.qodef-blog-single-full-width-image article .qodef-post-content .qodef-post-info-bottom .qodef-tags a',
                '.qodef-blog-holder.qodef-blog-single-full-width-image article.format-quote .qodef-post-info-bottom .qodef-tags a',
                '.qodef-blog-holder.qodef-blog-single-full-width-image article.format-link .qodef-post-info-bottom .qodef-tags a',
                '.qodef-blog-holder.qodef-blog-single-narrow article .qodef-post-content .qodef-post-info-top .qodef-post-info-category a',
                '.qodef-blog-holder.qodef-blog-single-narrow article .qodef-post-content .qodef-post-info-bottom .qodef-tags a',
                '.qodef-blog-holder.qodef-blog-single-narrow article.format-quote .qodef-post-info-bottom .qodef-tags a',
                '.qodef-blog-holder.qodef-blog-single-narrow article.format-link .qodef-post-info-bottom .qodef-tags a',
                '.qodef-author-description .qodef-author-description-text-holder .qodef-author-name a:hover',
                '.qodef-author-description .qodef-author-description-text-holder .qodef-author-social-icons a:hover',
                '.qodef-bl-standard-pagination ul li.qodef-bl-pag-active a',
                '.qodef-blog-single-navigation .qodef-blog-single-next:hover',
                '.qodef-blog-single-navigation .qodef-blog-single-prev:hover',
                '.qodef-related-posts-holder.qodef-related-posts-list .qodef-related-post .qodef-post-info>div a:hover',
                '.qodef-blog-list-holder.qodef-bl-masonry .qodef-post-info-category a',
                '.qodef-blog-list-holder.qodef-bl-image-left .qodef-post-info-category a',
                '.qodef-blog-list-holder.qodef-bl-standard .qodef-post-info-category a',
                '.qodef-blog-slider-holder.qodef-bls-boxed .qodef-blog-slider-item .qodef-item-text-holder .qodef-item-info-section-top .qodef-post-info-category a',
                '.qodef-banner-holder:hover .qodef-banner-title',
                '.qodef-image-gallery .owl-nav .owl-next:hover .qodef-next-icon',
                '.qodef-image-gallery .owl-nav .owl-next:hover .qodef-prev-icon',
                '.qodef-image-gallery .owl-nav .owl-prev:hover .qodef-next-icon',
                '.qodef-image-gallery .owl-nav .owl-prev:hover .qodef-prev-icon',
                '.qodef-social-share-holder.qodef-dropdown .qodef-social-share-dropdown-opener:hover',
                '.qodef-team.main-info-below-image.info-below-image-boxed .qodef-team-social-wrapp .qodef-icon-shortcode .flip-icon-holder .icon-normal span',
                '.qodef-team.main-info-below-image.info-below-image-standard .qodef-team-social-wrapp .qodef-icon-shortcode .flip-icon-holder .icon-flip span',
                '.qodef-testimonials-holder .owl-nav .owl-next:hover .qodef-next-icon',
                '.qodef-testimonials-holder .owl-nav .owl-next:hover .qodef-prev-icon',
                '.qodef-testimonials-holder .owl-nav .owl-prev:hover .qodef-next-icon',
                '.qodef-testimonials-holder .owl-nav .owl-prev:hover .qodef-prev-icon',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-standard li .qodef-twitter-icon i',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-standard li .qodef-tweet-text a:hover',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-slider li .qodef-tweet-text a',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-slider li .qodef-tweet-text span',
                '.wpb_widgetised_column .widget ul li a:hover',
                'aside.qodef-sidebar .widget ul li a:hover',
                '.wpb_widgetised_column .widget #wp-calendar tfoot a:hover',
                'aside.qodef-sidebar .widget #wp-calendar tfoot a:hover',
                '.wpb_widgetised_column .widget.widget_search .input-holder button:hover',
                'aside.qodef-sidebar .widget.widget_search .input-holder button:hover',
                '.wpb_widgetised_column .widget.widget_tag_cloud a:hover',
                'aside.qodef-sidebar .widget.widget_tag_cloud a:hover',
                'footer .widget ul li a:hover',
                'footer .widget #wp-calendar tfoot a:hover',
                'footer .widget.widget_search .input-holder button:hover'
            );

            $woo_color_selector = array();
            if(coney_qodef_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.qodef-woo-single-page .qodef-single-product-summary .product_meta>span a:hover',
                    '.widget.woocommerce.widget_layered_nav ul li.chosen a',
                    '.qodef-shopping-cart-dropdown .qodef-item-info-holder .remove:hover'
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

	        $color_important_selector = array(
                '.qodef-top-light .qodef-top-bar .widget a:hover',
                '.qodef-top-light .qodef-top-bar .qodef-social-icon-widget-holder:hover',
                '.qodef-top-light .qodef-top-bar .qodef-popup-opener:hover',
                '.qodef-fullscreen-menu-opener:hover',
                '.qodef-btn.qodef-btn-simple:not(.qodef-btn-custom-hover-color):hover',
                '.qodef-top-light .qodef-top-bar #lang_sel a:hover span'
	        );

            $background_color_selector = array(
                '.qodef-st-loader .pulse',
                '.qodef-st-loader .double_pulse .double-bounce1',
                '.qodef-st-loader .double_pulse .double-bounce2',
                '.qodef-st-loader .cube',
                '.qodef-st-loader .rotating_cubes .cube1',
                '.qodef-st-loader .rotating_cubes .cube2',
                '.qodef-st-loader .stripes>div',
                '.qodef-st-loader .wave>div',
                '.qodef-st-loader .two_rotating_circles .dot1',
                '.qodef-st-loader .two_rotating_circles .dot2',
                '.qodef-st-loader .five_rotating_circles .container1>div',
                '.qodef-st-loader .five_rotating_circles .container2>div',
                '.qodef-st-loader .five_rotating_circles .container3>div',
                '.qodef-st-loader .atom .ball-1:before',
                '.qodef-st-loader .atom .ball-2:before',
                '.qodef-st-loader .atom .ball-3:before',
                '.qodef-st-loader .atom .ball-4:before',
                '.qodef-st-loader .clock .ball:before',
                '.qodef-st-loader .mitosis .ball',
                '.qodef-st-loader .lines .line1',
                '.qodef-st-loader .lines .line2',
                '.qodef-st-loader .lines .line3',
                '.qodef-st-loader .lines .line4',
                '.qodef-st-loader .fussion .ball',
                '.qodef-st-loader .fussion .ball-1',
                '.qodef-st-loader .fussion .ball-2',
                '.qodef-st-loader .fussion .ball-3',
                '.qodef-st-loader .fussion .ball-4',
                '.qodef-st-loader .wave_circles .ball',
                '.qodef-st-loader .pulse_circles .ball',
                '#submit_comment:hover',
                '.post-password-form input[type=submit]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '#qodef-back-to-top>span',
                '.qodef-main-menu>ul>li.qodef-active-item>a>span.item_outer .item_text:before',
                '.qodef-main-menu>ul>li:hover>a>span.item_outer .item_text:before',
                '.qodef-side-menu-button-opener.opened .qodef-side-menu-button',
                '.qodef-side-menu-button-opener:hover .qodef-side-menu-button',
                '.qodef-search-opener .qodef-search-icon',
                '.qodef-blog-holder article.format-audio .qodef-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
                '.qodef-blog-holder article.format-audio .qodef-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                '.qodef-blog-pagination ul li.qodef-pag-number a.qodef-pag-active',
                '.qodef-tabs.qodef-tabs-boxed .qodef-tabs-nav li.ui-state-active a',
                '.qodef-tabs.qodef-tabs-boxed .qodef-tabs-nav li.ui-state-hover a',
                'footer .qodef-subscription-form .wpcf7-form-control.wpcf7-submit',
                '.qodef-popup-holder input.wpcf7-form-control.wpcf7-submit'
            );

            $woo_background_color_selector = array();
            if(coney_qodef_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.woocommerce-page .qodef-content .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    '.woocommerce-page .qodef-content a.added_to_cart:hover',
                    '.woocommerce-page .qodef-content a.button:hover',
                    '.woocommerce-page .qodef-content button[type=submit]:hover',
                    '.woocommerce-page .qodef-content input[type=submit]:hover',
                    'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    'div.woocommerce a.added_to_cart:hover',
                    'div.woocommerce a.button:hover',
                    'div.woocommerce button[type=submit]:hover',
                    'div.woocommerce input[type=submit]:hover',
                    '.woocommerce-pagination .page-numbers li a.current:not(.next)',
                    '.woocommerce-pagination .page-numbers li a:hover:not(.next)',
                    '.woocommerce-pagination .page-numbers li span.current:not(.next)',
                    '.woocommerce-pagination .page-numbers li span:hover:not(.next)',
                    '.woocommerce-page .qodef-content .qodef-quantity-buttons .qodef-quantity-minus:hover',
                    '.woocommerce-page .qodef-content .qodef-quantity-buttons .qodef-quantity-plus:hover',
                    'div.woocommerce .qodef-quantity-buttons .qodef-quantity-minus:hover',
                    'div.woocommerce .qodef-quantity-buttons .qodef-quantity-plus:hover',
                    '.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-range',
                    '.qodef-shopping-cart-dropdown .qodef-cart-bottom .qodef-view-cart'
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $background_color_important_selector = array(
                '.qodef-btn.qodef-btn-solid:not(.qodef-btn-custom-hover-bg):hover',
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-hover-bg):hover'
            );

            $border_color_selector = array(
                '.qodef-st-loader .pulse_circles .ball',
                '#submit_comment:hover',
                '.post-password-form input[type=submit]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '#qodef-back-to-top>span',
                'footer .qodef-subscription-form .wpcf7-form-control.wpcf7-submit',
                '.qodef-popup-holder .qodef-popup-inner',
                '.qodef-popup-holder input.wpcf7-form-control.wpcf7-submit'
            );

            $woo_border_color_selector = array();
            if(coney_qodef_is_woocommerce_installed()) {
                $woo_border_color_selector = array(
                    '.woocommerce-page .qodef-content .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    '.woocommerce-page .qodef-content a.added_to_cart:hover',
                    '.woocommerce-page .qodef-content a.button:hover',
                    '.woocommerce-page .qodef-content button[type=submit]:hover',
                    '.woocommerce-page .qodef-content input[type=submit]:hover',
                    'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    'div.woocommerce a.added_to_cart:hover',
                    'div.woocommerce a.button:hover',
                    'div.woocommerce button[type=submit]:hover',
                    'div.woocommerce input[type=submit]:hover'
                );
            }

            $border_color_selector = array_merge($border_color_selector, $woo_border_color_selector);

            $border_color_important_selector = array(
                '.qodef-btn.qodef-btn-solid:not(.qodef-btn-custom-border-hover):hover',
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-border-hover):hover'
            );

            $border_top_color_selector = array(
                '.qodef-drop-down .narrow .second .inner ul,.qodef-drop-down .wide.wide_background .second',
                '.qodef-drop-down .wide .second .inner>ul',
                '.qodef-top-bar .wpml-ls ul ul'
            );

            $border_bottom_color_selector = array(
                '.qodef-blog-list-holder.qodef-bl-masonry .qodef-post-info-category a:after',
                '.qodef-blog-list-holder.qodef-bl-image-left .qodef-post-info-category a:after',
                '.qodef-blog-list-holder.qodef-bl-standard .qodef-post-info-category a:after'
            );

            echo coney_qodef_dynamic_css($color_selector, array('color' => coney_qodef_options()->getOptionValue('first_color')));
	        echo coney_qodef_dynamic_css($color_important_selector, array('color' => coney_qodef_options()->getOptionValue('first_color').'!important'));
            echo coney_qodef_dynamic_css('::selection', array('background' => coney_qodef_options()->getOptionValue('first_color')));
            echo coney_qodef_dynamic_css('::-moz-selection', array('background' => coney_qodef_options()->getOptionValue('first_color')));
            echo coney_qodef_dynamic_css($background_color_selector, array('background-color' => coney_qodef_options()->getOptionValue('first_color')));
            echo coney_qodef_dynamic_css($background_color_important_selector, array('background-color' => coney_qodef_options()->getOptionValue('first_color').'!important'));
            echo coney_qodef_dynamic_css($border_color_selector, array('border-color' => coney_qodef_options()->getOptionValue('first_color')));
            echo coney_qodef_dynamic_css($border_color_important_selector, array('border-color' => coney_qodef_options()->getOptionValue('first_color').'!important'));
            echo coney_qodef_dynamic_css($border_top_color_selector, array('border-top-color' => coney_qodef_options()->getOptionValue('first_color')));
            echo coney_qodef_dynamic_css($border_bottom_color_selector, array('border-bottom-color' => coney_qodef_options()->getOptionValue('first_color')));
        }

		if (coney_qodef_options()->getOptionValue('page_background_color') !== '') {
			$background_color_selector = array(
				'.qodef-wrapper-inner',
				'.qodef-content'
			);
			echo coney_qodef_dynamic_css($background_color_selector, array('background-color' => coney_qodef_options()->getOptionValue('page_background_color')));
		}

		if (coney_qodef_options()->getOptionValue('selection_color') !== '') {
			echo coney_qodef_dynamic_css('::selection', array('background' => coney_qodef_options()->getOptionValue('selection_color')));
			echo coney_qodef_dynamic_css('::-moz-selection', array('background' => coney_qodef_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (coney_qodef_options()->getOptionValue('page_background_color_in_box') !== '') {
			$boxed_background_style['background-color'] = coney_qodef_options()->getOptionValue('page_background_color_in_box');
		}

		if (coney_qodef_options()->getOptionValue('boxed_background_image') !== '') {
			$boxed_background_style['background-image'] = 'url('.esc_url(coney_qodef_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (coney_qodef_options()->getOptionValue('boxed_pattern_background_image') !== '') {
			$boxed_background_style['background-image'] = 'url('.esc_url(coney_qodef_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (coney_qodef_options()->getOptionValue('boxed_background_image_attachment') !== '') {
			$boxed_background_style['background-attachment'] = (coney_qodef_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo coney_qodef_dynamic_css('.qodef-boxed .qodef-wrapper', $boxed_background_style);

        $paspartu_style = array();
        if (coney_qodef_options()->getOptionValue('paspartu_color') !== '') {
            $paspartu_style['background-color'] = coney_qodef_options()->getOptionValue('paspartu_color');
        }

        if (coney_qodef_options()->getOptionValue('paspartu_width') !== '') {
            $paspartu_style['padding'] = coney_qodef_options()->getOptionValue('paspartu_width').'%';
        }

        echo coney_qodef_dynamic_css('.qodef-paspartu-enabled .qodef-wrapper', $paspartu_style);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_design_styles');
}

if(!function_exists('coney_qodef_content_styles')) {
    /**
     * Generates content custom styles
     */
    function coney_qodef_content_styles() {

        $content_style = array();
	    
	    $padding_top = coney_qodef_options()->getOptionValue('content_top_padding');
	    if ($padding_top !== '') {
            $content_style['padding-top'] = coney_qodef_filter_px($padding_top).'px';
        }

        $content_selector = array(
            '.qodef-content .qodef-content-inner > .qodef-full-width > .qodef-full-width-inner',
        );

        echo coney_qodef_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
	    
	    $padding_top_in_grid = coney_qodef_options()->getOptionValue('content_top_padding_in_grid');
	    if ($padding_top_in_grid !== '') {
            $content_style_in_grid['padding-top'] = coney_qodef_filter_px($padding_top_in_grid).'px';

        }

        $content_selector_in_grid = array(
            '.qodef-content .qodef-content-inner > .qodef-container > .qodef-container-inner',
        );

        echo coney_qodef_dynamic_css($content_selector_in_grid, $content_style_in_grid);

    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_content_styles');
}

if (!function_exists('coney_qodef_h1_styles')) {

    function coney_qodef_h1_styles() {
	    $margin_top = coney_qodef_options()->getOptionValue('h1_margin_top');
	    $margin_bottom = coney_qodef_options()->getOptionValue('h1_margin_bottom');
	    
	    $item_styles = coney_qodef_get_typography_styles('h1');
	    
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = coney_qodef_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = coney_qodef_filter_px($margin_bottom).'px';
	    }
	    
	    $item_selector = array(
		    'h1'
	    );
	
	    echo coney_qodef_dynamic_css($item_selector, $item_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_h1_styles');
}

if (!function_exists('coney_qodef_h2_styles')) {

    function coney_qodef_h2_styles() {
	    $margin_top = coney_qodef_options()->getOptionValue('h2_margin_top');
	    $margin_bottom = coney_qodef_options()->getOptionValue('h2_margin_bottom');
	
	    $item_styles = coney_qodef_get_typography_styles('h2');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = coney_qodef_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = coney_qodef_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h2'
	    );
	
	    echo coney_qodef_dynamic_css($item_selector, $item_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_h2_styles');
}

if (!function_exists('coney_qodef_h3_styles')) {

    function coney_qodef_h3_styles() {
	    $margin_top = coney_qodef_options()->getOptionValue('h3_margin_top');
	    $margin_bottom = coney_qodef_options()->getOptionValue('h3_margin_bottom');
	
	    $item_styles = coney_qodef_get_typography_styles('h3');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = coney_qodef_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = coney_qodef_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h3'
	    );
	
	    echo coney_qodef_dynamic_css($item_selector, $item_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_h3_styles');
}

if (!function_exists('coney_qodef_h4_styles')) {

    function coney_qodef_h4_styles() {
	    $margin_top = coney_qodef_options()->getOptionValue('h4_margin_top');
	    $margin_bottom = coney_qodef_options()->getOptionValue('h4_margin_bottom');
	
	    $item_styles = coney_qodef_get_typography_styles('h4');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = coney_qodef_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = coney_qodef_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h4'
	    );
	
	    echo coney_qodef_dynamic_css($item_selector, $item_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_h4_styles');
}

if (!function_exists('coney_qodef_h5_styles')) {

    function coney_qodef_h5_styles() {
	    $margin_top = coney_qodef_options()->getOptionValue('h5_margin_top');
	    $margin_bottom = coney_qodef_options()->getOptionValue('h5_margin_bottom');
	
	    $item_styles = coney_qodef_get_typography_styles('h5');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = coney_qodef_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = coney_qodef_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h5'
	    );
	
	    echo coney_qodef_dynamic_css($item_selector, $item_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_h5_styles');
}

if (!function_exists('coney_qodef_h6_styles')) {

    function coney_qodef_h6_styles() {
	    $margin_top = coney_qodef_options()->getOptionValue('h6_margin_top');
	    $margin_bottom = coney_qodef_options()->getOptionValue('h6_margin_bottom');
	
	    $item_styles = coney_qodef_get_typography_styles('h6');
	
	    if($margin_top !== '') {
		    $item_styles['margin-top'] = coney_qodef_filter_px($margin_top).'px';
	    }
	    if($margin_bottom !== '') {
		    $item_styles['margin-bottom'] = coney_qodef_filter_px($margin_bottom).'px';
	    }
	
	    $item_selector = array(
		    'h6'
	    );
	
	    echo coney_qodef_dynamic_css($item_selector, $item_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_h6_styles');
}

if (!function_exists('coney_qodef_text_styles')) {

    function coney_qodef_text_styles() {
	    $item_styles = coney_qodef_get_typography_styles('text');
	
	    $item_selector = array(
		    'p'
	    );
	
	    echo coney_qodef_dynamic_css($item_selector, $item_styles);
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_text_styles');
}

if (!function_exists('coney_qodef_link_styles')) {

    function coney_qodef_link_styles() {

        $link_styles = array();

        if(coney_qodef_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = coney_qodef_options()->getOptionValue('link_color');
        }
        if(coney_qodef_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = coney_qodef_options()->getOptionValue('link_fontstyle');
        }
        if(coney_qodef_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = coney_qodef_options()->getOptionValue('link_fontweight');
        }
        if(coney_qodef_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = coney_qodef_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo coney_qodef_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_link_styles');
}

if (!function_exists('coney_qodef_link_hover_styles')) {

    function coney_qodef_link_hover_styles() {

        $link_hover_styles = array();

        if(coney_qodef_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = coney_qodef_options()->getOptionValue('link_hovercolor');
        }
        if(coney_qodef_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = coney_qodef_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo coney_qodef_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(coney_qodef_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = coney_qodef_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo coney_qodef_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('coney_qodef_style_dynamic', 'coney_qodef_link_hover_styles');
}

if (!function_exists('coney_qodef_smooth_page_transition_styles')) {

    function coney_qodef_smooth_page_transition_styles($style) {
        $id = coney_qodef_get_page_id();
        $loader_style = array();
        $current_style = '';

        if(coney_qodef_get_meta_field_intersect('smooth_pt_bgnd_color',$id) !== '') {
            $loader_style['background-color'] = coney_qodef_get_meta_field_intersect('smooth_pt_bgnd_color',$id);
        }

        $loader_selector = array('.qodef-smooth-transition-loader');

        if (!empty($loader_style)) {
            $current_style .= coney_qodef_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();
        $spinner_color_style = array();

        if(coney_qodef_get_meta_field_intersect('smooth_pt_spinner_color',$id) !== '') {
            $spinner_style['background-color'] = coney_qodef_get_meta_field_intersect('smooth_pt_spinner_color',$id);
            $spinner_color_style['color'] = coney_qodef_get_meta_field_intersect('smooth_pt_spinner_color',$id);
        }

        $spinner_selectors = array(
            '.qodef-st-loader .qodef-rotate-circles > div', 
            '.qodef-st-loader .pulse', 
            '.qodef-st-loader .double_pulse .double-bounce1', 
            '.qodef-st-loader .double_pulse .double-bounce2', 
            '.qodef-st-loader .cube', 
            '.qodef-st-loader .rotating_cubes .cube1', 
            '.qodef-st-loader .rotating_cubes .cube2', 
            '.qodef-st-loader .stripes > div', 
            '.qodef-st-loader .wave > div', 
            '.qodef-st-loader .two_rotating_circles .dot1', 
            '.qodef-st-loader .two_rotating_circles .dot2', 
            '.qodef-st-loader .five_rotating_circles .container1 > div', 
            '.qodef-st-loader .five_rotating_circles .container2 > div', 
            '.qodef-st-loader .five_rotating_circles .container3 > div', 
            '.qodef-st-loader .atom .ball-1:before', 
            '.qodef-st-loader .atom .ball-2:before', 
            '.qodef-st-loader .atom .ball-3:before', 
            '.qodef-st-loader .atom .ball-4:before', 
            '.qodef-st-loader .clock .ball:before', 
            '.qodef-st-loader .mitosis .ball', 
            '.qodef-st-loader .lines .line1', 
            '.qodef-st-loader .lines .line2', 
            '.qodef-st-loader .lines .line3', 
            '.qodef-st-loader .lines .line4', 
            '.qodef-st-loader .fussion .ball', 
            '.qodef-st-loader .fussion .ball-1', 
            '.qodef-st-loader .fussion .ball-2', 
            '.qodef-st-loader .fussion .ball-3', 
            '.qodef-st-loader .fussion .ball-4', 
            '.qodef-st-loader .wave_circles .ball', 
            '.qodef-st-loader .pulse_circles .ball',
            '.qodef-st-loader .progress-loader-holder .progress-loader-holder-line'
        );

        $spinner_color_selectors = array(
            '.qodef-st-loader .progress-loader-holder .progress-loader-holder-text',
        );

        if (!empty($spinner_style)) {
            $current_style .= coney_qodef_dynamic_css($spinner_selectors, $spinner_style);
        }
        if (!empty($spinner_color_style)) {
            $current_style .= coney_qodef_dynamic_css($spinner_color_selectors, $spinner_color_style);
        }

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('coney_qodef_add_page_custom_style', 'coney_qodef_smooth_page_transition_styles');
}