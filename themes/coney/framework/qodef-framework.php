<?php

require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.kses.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.layout1.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.layout2.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.layout3.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.optionsapi.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.framework.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.functions.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.icons/qodef.icons.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/admin/options/qodef-options-setup.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/admin/meta-boxes/qodef-meta-boxes-setup.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/modules/qodef-modules-loader.php";

if ( ! function_exists( 'coney_qodef_admin_scripts_init' ) ) {
	/**
	 * Function that registers all scripts that are necessary for our back-end
	 */
	function coney_qodef_admin_scripts_init() {

		/**
		 * @see QodeSkinAbstract::registerScripts - hooked with 10
		 * @see QodeSkinAbstract::registerStyles - hooked with 10
		 */
		do_action( 'coney_qodef_admin_scripts_init' );
	}

	add_action( 'admin_init', 'coney_qodef_admin_scripts_init' );
}

if ( ! function_exists( 'coney_qodef_enqueue_admin_styles' ) ) {
	/**
	 * Function that enqueues styles for options page
	 */
	function coney_qodef_enqueue_admin_styles() {

		wp_enqueue_style( 'wp-color-picker' );

		/**
		 * @see QodeSkinAbstract::enqueueStyles - hooked with 10
		 */
		do_action( 'coney_qodef_enqueue_admin_styles' );
	}
}

if ( ! function_exists( 'coney_qodef_enqueue_admin_scripts' ) ) {
	/**
	 * Function that enqueues styles for options page
	 */
	function coney_qodef_enqueue_admin_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
		wp_enqueue_script( 'coney-qodef-dependence', get_template_directory_uri() . '/framework/admin/assets/js/qodef-ui/qodef-dependence.js', array(), false, true );
		wp_enqueue_script( 'coney-qodef-twitter-connect', get_template_directory_uri() . '/framework/admin/assets/js/qodef-twitter-connect.js', array(), false, true );

		/**
		 * @see QodeSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action( 'coney_qodef_enqueue_admin_scripts' );
	}
}

if ( ! function_exists( 'coney_qodef_enqueue_meta_box_styles' ) ) {
	/**
	 * Function that enqueues styles for meta boxes
	 */
	function coney_qodef_enqueue_meta_box_styles() {
		global $post;
		wp_enqueue_style( 'wp-color-picker' );
		if ( $post->post_type == 'team-member' ) {
			wp_enqueue_style( 'coney-qodef-jquery-ui', get_template_directory_uri() . '/framework/admin/assets/css/jquery-ui/jquery-ui.css' );
		}

		/**
		 * @see QodeSkinAbstract::enqueueStyles - hooked with 10
		 */
		do_action( 'coney_qodef_enqueue_meta_box_styles' );
	}
}

if ( ! function_exists( 'coney_qodef_enqueue_meta_box_scripts' ) ) {
	/**
	 * Function that enqueues scripts for meta boxes
	 */
	function coney_qodef_enqueue_meta_box_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
		wp_enqueue_script( 'coney-qodef-dependence' );

		/**
		 * @see QodeSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action( 'coney_qodef_enqueue_meta_box_scripts' );
	}
}

if ( ! function_exists( 'coney_qodef_enqueue_nav_menu_script' ) ) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 *
	 * @param $hook string current page hook to check
	 */
	function coney_qodef_enqueue_nav_menu_script( $hook ) {
		if ( $hook == 'nav-menus.php' ) {
			wp_enqueue_script( 'coney-qodef-nav-menu', get_template_directory_uri() . '/framework/admin/assets/js/qodef-nav-menu.js' );
			wp_enqueue_style( 'coney-qodef-nav-menu', get_template_directory_uri() . '/framework/admin/assets/css/qodef-nav-menu.css' );
		}
	}

	add_action( 'admin_enqueue_scripts', 'coney_qodef_enqueue_nav_menu_script' );
}


if ( ! function_exists( 'coney_qodef_enqueue_widgets_admin_script' ) ) {
	/**
	 * Function that enqueues styles and scripts for admin widgets page.
	 *
	 * @param $hook string current page hook to check
	 */
	function coney_qodef_enqueue_widgets_admin_script( $hook ) {
		if ( $hook == 'widgets.php' ) {
			wp_enqueue_script( 'coney-qodef-dependence' );
		}
	}

	add_action( 'admin_enqueue_scripts', 'coney_qodef_enqueue_widgets_admin_script' );
}


if ( ! function_exists( 'coney_qodef_enqueue_styles_slider_taxonomy' ) ) {
	/**
	 * Enqueue styles when on slider taxonomy page in admin
	 */
	function coney_qodef_enqueue_styles_slider_taxonomy() {
		if ( isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] == 'slides_category' ) {
			coney_qodef_enqueue_admin_styles();
		}
	}

	add_action( 'admin_print_scripts-edit-tags.php', 'coney_qodef_enqueue_styles_slider_taxonomy' );
}

if ( ! function_exists( 'coney_qodef_init_theme_options_array' ) ) {
	/**
	 * Function that merges $coney_qodef_options and default options array into one array.
	 *
	 * @see array_merge()
	 */
	function coney_qodef_init_theme_options_array() {
		global $coney_qodef_options, $coney_qodef_Framework;

		$db_options = get_option( 'qode_options_coney' );

		//does qode_options exists in db?
		if ( is_array( $db_options ) ) {
			//merge with default options
			$coney_qodef_options = array_merge( $coney_qodef_Framework->qodeOptions->options, get_option( 'qode_options_coney' ) );
		} else {
			//options don't exists in db, take default ones
			$coney_qodef_options = $coney_qodef_Framework->qodeOptions->options;
		}
	}

	add_action( 'coney_qodef_after_options_map', 'coney_qodef_init_theme_options_array', 0 );
}

if ( ! function_exists( 'coney_qodef_init_theme_options' ) ) {
	/**
	 * Function that sets $coney_qodef_options variable if it does'nt exists
	 */
	function coney_qodef_init_theme_options() {
		global $coney_qodef_options;
		global $coney_qodef_Framework;
		if ( isset( $coney_qodef_options['reset_to_defaults'] ) ) {
			if ( $coney_qodef_options['reset_to_defaults'] == 'yes' ) {
				delete_option( "qode_options_coney" );
			}
		}

		if ( ! get_option( "qode_options_coney" ) ) {
			add_option( "qode_options_coney",
				$coney_qodef_Framework->qodeOptions->options
			);

			$coney_qodef_options = $coney_qodef_Framework->qodeOptions->options;
		}
	}
}

if ( ! function_exists( 'coney_qodef_register_theme_settings' ) ) {
	/**
	 * Function that registers setting that will be used to store theme options
	 */
	function coney_qodef_register_theme_settings() {
		register_setting( 'coney_qodef_theme_menu', 'qode_options' );
	}

	add_action( 'admin_init', 'coney_qodef_register_theme_settings' );
}

if ( ! function_exists( 'coney_qodef_get_admin_tab' ) ) {
	/**
	 * Helper function that returns current tab from url.
	 * @return null
	 */
	function coney_qodef_get_admin_tab() {
		return isset( $_GET['page'] ) ? coney_qodef_strafter( $_GET['page'], 'tab' ) : null;
	}
}

if ( ! function_exists( 'coney_qodef_strafter' ) ) {
	/**
	 * Function that returns string that comes after found string
	 *
	 * @param $string string where to search
	 * @param $substring string what to search for
	 *
	 * @return null|string string that comes after found string
	 */
	function coney_qodef_strafter( $string, $substring ) {
		$pos = strpos( $string, $substring );
		if ( $pos === false ) {
			return null;
		}

		return ( substr( $string, $pos + strlen( $substring ) ) );
	}
}

if ( ! function_exists( 'coney_qodef_save_options' ) ) {
	/**
	 * Function that saves theme options to db.
	 * It hooks to ajax wp_ajax_qodef_save_options action.
	 */
	function coney_qodef_save_options() {
		global $coney_qodef_options;

		if ( current_user_can( 'administrator' ) ) {

			$_REQUEST = stripslashes_deep( $_REQUEST );

			unset( $_REQUEST['action'] );

			check_ajax_referer( 'qodef_ajax_save_nonce', 'qodef_ajax_save_nonce' );

			$coney_qodef_options = array_merge( $coney_qodef_options, $_REQUEST );

			update_option( 'qode_options_coney', $coney_qodef_options );

			do_action( 'coney_qodef_after_theme_option_save' );
			echo "Saved";

			die();

		}
	}

	add_action( 'wp_ajax_coney_qodef_save_options', 'coney_qodef_save_options' );
}

if ( ! function_exists( 'coney_qodef_meta_box_add' ) ) {
	/**
	 * Function that adds all defined meta boxes.
	 * It loops through array of created meta boxes and adds them
	 */
	function coney_qodef_meta_box_add() {
		global $coney_qodef_Framework;

		foreach ( $coney_qodef_Framework->qodeMetaBoxes->metaBoxes as $key => $box ) {
			$hidden = false;
			if ( ! empty( $box->hidden_property ) ) {
				foreach ( $box->hidden_values as $value ) {
					if ( coney_qodef_option_get_value( $box->hidden_property ) == $value ) {
						$hidden = true;
					}

				}
			}

			if ( is_string( $box->scope ) ) {
				$box->scope = array( $box->scope );
			}

			if ( is_array( $box->scope ) && count( $box->scope ) ) {
				foreach ( $box->scope as $screen ) {
					coney_qodef_create_meta_box_handler( $box, $key, $screen );

					if ( $hidden ) {
						add_filter( 'postbox_classes_' . $screen . '_qodef-meta-box-' . $key, 'coney_qodef_meta_box_add_hidden_class' );
					}
				}
			}
		}

		if ( coney_qodef_is_gutenberg_installed() || coney_qodef_is_gutenberg_editor() ) {
			coney_qodef_enqueue_meta_box_styles();
			coney_qodef_enqueue_meta_box_scripts();
		} else {
			add_action( 'admin_enqueue_scripts', 'coney_qodef_enqueue_meta_box_styles' );
			add_action( 'admin_enqueue_scripts', 'coney_qodef_enqueue_meta_box_scripts' );
		}
	}
}

if ( ! function_exists( 'coney_qodef_meta_box_save' ) ) {
	/**
	 * Function that saves meta box to postmeta table
	 *
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function coney_qodef_meta_box_save( $post_id, $post ) {
		global $coney_qodef_Framework;
		global $coney_qodef_IconCollections;

		$nonces_array = array();
		$meta_boxes   = coney_qodef_framework()->qodeMetaBoxes->getMetaBoxesByScope( $post->post_type );

		if ( is_array( $meta_boxes ) && count( $meta_boxes ) ) {
			foreach ( $meta_boxes as $meta_box ) {
				$nonces_array[] = 'coney_qodef_meta_box_' . $meta_box->name . '_save';
			}
		}

		if ( is_array( $nonces_array ) && count( $nonces_array ) ) {
			foreach ( $nonces_array as $nonce ) {
				if ( ! isset( $_POST[ $nonce ] ) || ! wp_verify_nonce( $_POST[ $nonce ], $nonce ) ) {
					return;
				}
			}
		}

		$postTypes = array(
			"page",
			"post",
			"portfolio-item",
			"testimonials",
			"masonry-gallery",
			"product",
			"team-member"
		);

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['_wpnonce'] ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! in_array( $post->post_type, $postTypes ) ) {
			return;
		}

		foreach ( $coney_qodef_Framework->qodeMetaBoxes->options as $key => $box ) {

			if ( isset( $_POST[ $key ] ) && trim( $_POST[ $key ] !== '' ) ) {

				$value = $_POST[ $key ];

				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}

		$portfolios = false;
		if ( isset( $_POST['optionLabel'] ) ) {
			foreach ( $_POST['optionLabel'] as $key => $value ) {
				$portfolios_val[ $key ] = array(
					'optionLabel'            => $value,
					'optionValue'            => $_POST['optionValue'][ $key ],
					'optionUrl'              => $_POST['optionUrl'][ $key ],
					'optionlabelordernumber' => $_POST['optionlabelordernumber'][ $key ]
				);
				$portfolios             = true;

			}
		}

		if ( $portfolios ) {
			update_post_meta( $post_id, 'qode_portfolios', $portfolios_val );
		} else {
			delete_post_meta( $post_id, 'qode_portfolios' );
		}

		$portfolio_images = false;
		if ( isset( $_POST['portfolioimg'] ) ) {
			foreach ( $_POST['portfolioimg'] as $key => $value ) {
				$portfolio_images_val[ $key ] = array(
					'portfolioimg'            => $_POST['portfolioimg'][ $key ],
					'portfoliotitle'          => $_POST['portfoliotitle'][ $key ],
					'portfolioimgordernumber' => $_POST['portfolioimgordernumber'][ $key ],
					'portfoliovideotype'      => $_POST['portfoliovideotype'][ $key ],
					'portfoliovideoid'        => $_POST['portfoliovideoid'][ $key ],
					'portfoliovideoimage'     => $_POST['portfoliovideoimage'][ $key ],
					'portfoliovideowebm'      => $_POST['portfoliovideowebm'][ $key ],
					'portfoliovideomp4'       => $_POST['portfoliovideomp4'][ $key ],
					'portfoliovideoogv'       => $_POST['portfoliovideoogv'][ $key ],
					'portfolioimgtype'        => $_POST['portfolioimgtype'][ $key ]
				);
				$portfolio_images             = true;
			}
		}

		if ( $portfolio_images ) {
			update_post_meta( $post_id, 'qode_portfolio_images', $portfolio_images_val );
		} else {
			delete_post_meta( $post_id, 'qode_portfolio_images' );
		}
	}

	add_action( 'save_post', 'coney_qodef_meta_box_save', 1, 2 );
}

if ( ! function_exists( 'coney_qodef_render_meta_box' ) ) {
	/**
	 * Function that renders meta box
	 *
	 * @param $post WP_Post post object
	 * @param $metabox array array of current meta box parameters
	 */
	function coney_qodef_render_meta_box( $post, $metabox ) { ?>

        <div class="qodef-meta-box qodef-page">
            <div class="qodef-meta-box-holder">

				<?php $metabox['args']['box']->render(); ?>
				<?php wp_nonce_field( 'coney_qodef_meta_box_' . $metabox['args']['box']->name . '_save', 'coney_qodef_meta_box_' . $metabox['args']['box']->name . '_save' ); ?>

            </div>
        </div>

		<?php
	}
}

if ( ! function_exists( 'coney_qodef_meta_box_add_hidden_class' ) ) {
	/**
	 * Function that adds class that will initially hide meta box
	 *
	 * @param array $classes array of classes
	 *
	 * @return array modified array of classes
	 */
	function coney_qodef_meta_box_add_hidden_class( $classes = array() ) {
		if ( ! in_array( 'qodef-meta-box-hidden', $classes ) ) {
			$classes[] = 'qodef-meta-box-hidden';
		}

		return $classes;
	}
}

if ( ! function_exists( 'coney_qodef_remove_default_custom_fields' ) ) {
	/**
	 * Function that removes default WordPress custom fields interface
	 */
	function coney_qodef_remove_default_custom_fields() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach ( array( "page", "post", "portfolio-item", "testimonials", "masonry-gallery" ) as $postType ) {
				remove_meta_box( 'postcustom', $postType, $context );
			}
		}
	}

	add_action( 'do_meta_boxes', 'coney_qodef_remove_default_custom_fields' );
}

if ( ! function_exists( 'coney_qodef_generate_icon_pack_options' ) ) {
	/**
	 * Generates options HTML for each icon in given icon pack
	 * Hooked to wp_ajax_update_admin_nav_icon_options action
	 */
	function coney_qodef_generate_icon_pack_options() {
		global $coney_qodef_IconCollections;
        check_ajax_referer('update-nav_menu', 'update_nav_menu_nonce');
		$html               = '';
		$icon_pack          = isset( $_POST['icon_pack'] ) ? $_POST['icon_pack'] : '';
		$collections_object = $coney_qodef_IconCollections->getIconCollection( $icon_pack );

		if ( $collections_object ) {
			$icons = $collections_object->getIconsArray();
			if ( is_array( $icons ) && count( $icons ) ) {
				foreach ( $icons as $key => $icon ) {
					$html .= '<option value="' . esc_attr( $key ) . '">' . esc_html( $key ) . '</option>';
				}
			}
		}

		print coney_qodef_get_module_part( $html );
	}

	add_action( 'wp_ajax_update_admin_nav_icon_options', 'coney_qodef_generate_icon_pack_options' );
}

if ( ! function_exists( 'coney_qodef_admin_notice' ) ) {
	/**
	 * Prints admin notice. It checks if notice has been disabled and if it hasn't then it displays it
	 *
	 * @param $id string id of notice. It will be used to store notice dismis
	 * @param $message string message to show to the user
	 * @param $class string HTML class of notice
	 * @param bool $is_dismisable whether notice is dismisable or not
	 */
	function coney_qodef_admin_notice( $id, $message, $class, $is_dismisable = true ) {
		$is_dismised = get_user_meta( get_current_user_id(), 'dismis_' . $id );

		//if notice isn't dismissed
		if ( ! $is_dismised && is_admin() ) {
			echo '<div style="display: block;" class="' . esc_attr( $class ) . ' is-dismissible notice">';
			echo '<p>';

			echo wp_kses_post( $message );

			if ( $is_dismisable ) {
				echo '<strong style="display: block; margin-top: 7px;"><a href="' . esc_url( add_query_arg( 'qode_dismis_notice', $id ) ) . '">' . esc_html__( 'Dismiss this notice', 'coney' ) . '</a></strong>';
			}

			echo '</p>';

			echo '</div>';
		}

	}
}

if ( ! function_exists( 'coney_qodef_save_dismisable_notice' ) ) {
	/**
	 * Updates user meta with dismisable notice. Hooks to admin_init action
	 * in order to check this on every page request in admin
	 */
	function coney_qodef_save_dismisable_notice() {
		if ( is_admin() && ! empty( $_GET['qode_dismis_notice'] ) ) {
			$notice_id       = sanitize_key( $_GET['qode_dismis_notice'] );
			$current_user_id = get_current_user_id();

			update_user_meta( $current_user_id, 'dismis_' . $notice_id, 1 );
		}
	}

	add_action( 'admin_init', 'coney_qodef_save_dismisable_notice' );
}

if ( ! function_exists( 'coney_qodef_hook_twitter_request_ajax' ) ) {
	/**
	 * Wrapper function for obtaining twitter request token.
	 * Hooks to wp_ajax_qode_twitter_obtain_request_token ajax action
	 *
	 * @see QodeTwitterApi::obtainRequestToken()
	 */
	function coney_qodef_hook_twitter_request_ajax() {
        check_ajax_referer( 'qodef_twitter_connect_nonce', 'twitter_connect_nonce' );

		QodefTwitterApi::getInstance()->obtainRequestToken();
	}

	add_action( 'wp_ajax_qode_twitter_obtain_request_token', 'coney_qodef_hook_twitter_request_ajax' );
}

if ( ! function_exists( 'coney_qodef_comment' ) ) {
	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */
	function coney_qodef_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment   = $post->post_author == $comment->user_id;

		$comment_class = 'qodef-comment clearfix';

		if ( $is_author_comment ) {
			$comment_class .= ' qodef-post-author-comment';
		}

		if ( $is_pingback_comment ) {
			$comment_class .= ' qodef-pingback-comment';
		}
		?>

        <li>
        <div class="<?php echo esc_attr( $comment_class ); ?>">
			<?php if ( ! $is_pingback_comment ) { ?>
                <div class="qodef-comment-image"> <?php echo coney_qodef_kses_img( get_avatar( $comment, 'thumbnail' ) ); ?> </div>
			<?php } ?>
            <div class="qodef-comment-text">
                <div class="qodef-comment-info">
                    <h5 class="qodef-comment-name">
						<?php if ( $is_pingback_comment ) {
							esc_html_e( 'Pingback:', 'coney' );
						} ?>
						<?php echo wp_kses_post( get_comment_author_link() ); ?>
                    </h5>
                </div>
                <div class="qodef-comment-date"><?php comment_time( get_option( 'date_format' ) ); ?></div>
				<?php if ( ! $is_pingback_comment ) { ?>
                    <div class="qodef-text-holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
                    </div>
				<?php } ?>
				<?php
				comment_reply_link( array_merge( $args, array(
					'reply_text' => esc_html__( 'reply', 'coney' ),
					'depth'      => $depth,
					'max_depth'  => $args['max_depth']
				) ) );
				edit_comment_link( esc_html__( 'edit', 'coney' ) );
				?>
            </div>
        </div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}
?>