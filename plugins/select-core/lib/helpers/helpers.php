<?php

if ( ! function_exists( 'qodef_core_version_class' ) ) {
	/**
	 * Adds plugins version class to body
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function qodef_core_version_class( $classes ) {
		$classes[] = 'select-core-' . QODE_CORE_VERSION;

		return $classes;
	}

	add_filter( 'body_class', 'qodef_core_version_class' );
}

if ( ! function_exists( 'qodef_core_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function qodef_core_theme_installed() {
		return defined( 'QODE_ROOT' );
	}
}

if ( ! function_exists( 'qodef_core_get_shortcode_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $shortcode name of the shortcode folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function qodef_core_get_shortcode_module_template_part( $shortcode, $template, $slug = '', $params = array(), $additional_params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = QODE_CORE_CPT_PATH . '/' . $shortcode . '/shortcodes/templates';

		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		if ( is_array( $additional_params ) && count( $additional_params ) ) {
			extract( $additional_params );
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'qode_core_init_shortcode_loader' ) ) {
	function qode_core_init_shortcode_loader() {

		include_once 'shortcode-loader.php';
	}

	add_action( 'coney_qodef_shortcode_loader', 'qode_core_init_shortcode_loader' );
}

if ( ! function_exists( 'coney_qodef_add_user_custom_fields' ) ) {
	/**
	 * Function creates custom social fields for users
	 *
	 * return $user_contact
	 */
	function coney_qodef_add_user_custom_fields( $user_contact ) {
		/**
		 * Function that add custom user fields
		 **/
		$user_contact['facebook']   = esc_html__( 'Facebook', 'select-core' );
		$user_contact['twitter']    = esc_html__( 'Twitter', 'select-core' );
		$user_contact['linkedin']   = esc_html__( 'Linkedin', 'select-core' );
		$user_contact['instagram']  = esc_html__( 'Instagram', 'select-core' );
		$user_contact['pinterest']  = esc_html__( 'Pinterest', 'select-core' );
		$user_contact['tumblr']     = esc_html__( 'Tumbrl', 'select-core' );
		$user_contact['googleplus'] = esc_html__( 'Google Plus', 'select-core' );

		return $user_contact;
	}

	add_filter( 'user_contactmethods', 'coney_qodef_add_user_custom_fields' );
}

if ( ! function_exists( 'qodef_core_get_yes_no_select_array' ) ) {
	/**
	 * Returns array of yes no
	 * @return array
	 */
	function qodef_core_get_yes_no_select_array( $enable_default = true, $set_yes_to_be_first = false ) {
		$select_options = array();

		if ( $enable_default ) {
			$select_options[''] = esc_html__( 'Default', 'select-core' );
		}

		if ( $set_yes_to_be_first ) {
			$select_options['yes'] = esc_html__( 'Yes', 'select-core' );
			$select_options['no']  = esc_html__( 'No', 'select-core' );
		} else {
			$select_options['no']  = esc_html__( 'No', 'select-core' );
			$select_options['yes'] = esc_html__( 'Yes', 'select-core' );
		}

		return $select_options;
	}
}

if ( ! function_exists( 'qodef_core_get_text_transform_array' ) ) {
	/**
	 * Returns array of text transforms
	 *
	 * @param bool $first_empty
	 *
	 * @return array
	 */
	function qodef_core_get_text_transform_array( $first_empty = false ) {
		$text_transforms = array();

		if ( $first_empty ) {
			$text_transforms[''] = esc_html__( 'Default', 'select-core' );
		}

		$text_transforms['none']       = esc_html__( 'None', 'select-core' );
		$text_transforms['capitalize'] = esc_html__( 'Capitalize', 'select-core' );
		$text_transforms['uppercase']  = esc_html__( 'Uppercase', 'select-core' );
		$text_transforms['lowercase']  = esc_html__( 'Lowercase', 'select-core' );
		$text_transforms['initial']    = esc_html__( 'Initial', 'select-core' );
		$text_transforms['inherit']    = esc_html__( 'Inherit', 'select-core' );

		return $text_transforms;
	}
}

if ( ! function_exists( 'qodef_core_get_title_tag' ) ) {
	/**
	 * Returns array of title tags
	 *
	 * @param bool $first_empty
	 * @param array $additional_elements
	 *
	 * @return array
	 */
	function qodef_core_get_title_tag( $first_empty = false, $additional_elements = array() ) {
		$title_tag = array();

		if ( $first_empty ) {
			$title_tag[''] = esc_html__( 'Default', 'select-core' );
		}

		$title_tag['h1'] = 'h1';
		$title_tag['h2'] = 'h2';
		$title_tag['h3'] = 'h3';
		$title_tag['h4'] = 'h4';
		$title_tag['h5'] = 'h5';
		$title_tag['h6'] = 'h6';

		if ( ! empty( $additional_elements ) ) {
			$title_tag = array_merge( $title_tag, $additional_elements );
		}

		return $title_tag;
	}
}

/* Function for adding custom meta boxes hooked to default action */
if ( class_exists( 'WP_Block_Type' ) && defined( 'QODE_ROOT' ) ) {
	add_action( 'admin_head', 'coney_qodef_meta_box_add' );
} else {
	add_action( 'add_meta_boxes', 'coney_qodef_meta_box_add' );
}

if ( ! function_exists( 'coney_qodef_create_meta_box_handler' ) ) {
	function coney_qodef_create_meta_box_handler( $box, $key, $screen ) {
		add_meta_box(
			'qodef-meta-box-' . $key,
			$box->title,
			'coney_qodef_render_meta_box',
			$screen,
			'advanced',
			'high',
			array( 'box' => $box )
		);
	}
}

if ( ! function_exists( 'select_core_get_shortcode_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $shortcode name of the shortcode folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function select_core_get_shortcode_template_part( $template, $shortcode, $slug = '', $params = array() ) {
		//HTML Content from template
		$html          = '';
		$template_path = QODE_CORE_ABS_PATH . '/shortcodes/' . $shortcode;

		$temp = $template_path . '/' . $template;

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}