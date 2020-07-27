<?php defined('ABSPATH') or die("No script kiddies please!");
/*
  Plugin name: WP Comment Designer Lite
  Plugin URI:  https://accesspressthemes.com/wordpress-plugins/wp-comment-designer-lite
  Description: WP Comment Designer Lite helps you customize your WordPress comments and comment form.
  Version:     2.0.2
  Author:      AccessPress Themes
  Author URI:  http://accesspressthemes.com
  License:     GPL2
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Text Domain: wp-comment-designer-lite
  Domain Path: /languages
 */
  if (!class_exists('WPCD_LITE_CLASS')) {
    class WPCD_LITE_CLASS {
        function __construct() {
            $this->define_constants();
            register_activation_hook(__FILE__, array($this, 'default_plugin_settings'));
            add_action('init', array($this, 'plugin_text_domain'));
            add_action('admin_menu', array($this, 'WPCD_menu'));
            add_action('admin_enqueue_scripts', array($this, 'register_backend_assets'));
            add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets'), 11);
            add_action('admin_post_wpcd_settings_save', array($this, 'save_settings'));
            add_action('admin_post_wpcd_form_settings_save', array($this, 'save_form_settings'));
            add_action('admin_post_wpcd_restore_default', array($this, 'fn_restore_plugin_settings'));
            add_action('admin_post_wpcd_form_restore_default', array($this, 'fn_form_restore_plugin_settings'));
            add_filter('comments_template', array($this, 'wpcd_plugin_comment_template'));
            add_action('comment_post', array($this, 'save_comment_meta_data'));
            add_action('wp_head', array($this, 'wpcd_custom_css'));
            add_action('wp_ajax_wpcd_comment_ajax_action', array($this, 'like_dislike_action')); 
            add_action('wp_ajax_nopriv_wpcd_comment_ajax_action', array($this, 'like_dislike_action'));
            add_action('wp_ajax_wpcd_comment_pagination_ajax_action', array($this, 'comment_pagination'));
            add_action('wp_ajax_nopriv_wpcd_comment_pagination_ajax_action', array($this, 'comment_pagination'));
            add_filter( 'plugin_row_meta', array( $this, 'wpcd_plugin_row_meta' ), 10, 2 );
            add_filter( 'admin_footer_text', array( $this, 'wpcd_admin_footer_text' ) );
            add_action( 'admin_init', array( $this, 'redirect_to_site' ), 1 );
        }

        function redirect_to_site(){

            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'wpcd-documentation' ) {
               wp_redirect( WPCD_LITE_DOC );
               exit();
            }

            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'wpcd-premium' ) {
               wp_redirect( WPCD_PRO_LINK );
               exit();
            }
       }

        function define_constants() {
            defined('WPCD_LITE_PLUGIN_URL') or define('WPCD_LITE_PLUGIN_URL', plugin_dir_url(__FILE__));
            defined('WPCD_LITE_PLUGIN_PATH') or define('WPCD_LITE_PLUGIN_PATH', plugin_dir_path(__FILE__));
            defined('WPCD_LITE_PLUGIN_VERSION') or define('WPCD_LITE_PLUGIN_VERSION', '2.0.2');
            defined('WPCD_LITE_PLUGIN_LANG_DIR') or define('WPCD_LITE_PLUGIN_LANG_DIR', basename(dirname(__FILE__)) . '/languages/');
            

            defined('WPCD_LITE_PLUGIN_NAME') or define('WPCD_LITE_PLUGIN_NAME', 'WP Comment Designer Lite');
            defined('WPCD_LITE_DEMO') or define('WPCD_LITE_DEMO', 'http://demo.accesspressthemes.com/wordpress-plugins/wp-comment-designer-lite');
            defined('WPCD_LITE_DOC') or define('WPCD_LITE_DOC', 'https://accesspressthemes.com/documentation/wp-comment-designer-lite/');
            defined('WPCD_LITE_DETAIL') or define('WPCD_LITE_DETAIL', 'https://accesspressthemes.com/wordpress-plugins/wp-comment-designer-lite/');
            defined('WPCD_LITE_RATING') or define('WPCD_LITE_RATING', 'https://wordpress.org/support/plugin/wp-comment-designer-lite/reviews/#new-post');


            defined('WPCD_PRO_PLUGIN_NAME') or define('WPCD_PRO_PLUGIN_NAME', 'WP Comment Designer');
            defined('WPCD_PRO_LINK') or define('WPCD_PRO_LINK', 'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Fwp-comment-designer-customize-and-design-wordpress-comments-and-comment-form%2F21640179');
            defined('WPCD_PRO_DEMO') or define('WPCD_PRO_DEMO', 'http://demo.accesspressthemes.com/wordpress-plugins/wp-comment-designer');
            defined('WPCD_PRO_DETAIL') or define('WPCD_PRO_DETAIL', 'https://accesspressthemes.com/wordpress-plugins/wp-comment-designer/');
        }

        function wpcd_plugin_row_meta( $links, $file ){
            if ( strpos( $file, 'wp-comment-designer-lite.php' ) !== false ) {
                $new_links = array(
                    'demo' => '<a href="'.WPCD_LITE_DEMO.'" target="_blank"><span class="dashicons dashicons-welcome-view-site"></span>Live Demo</a>',
                    'doc' => '<a href="'.WPCD_LITE_DOC.'" target="_blank"><span class="dashicons dashicons-media-document"></span>Documentation</a>',
                    'support' => '<a href="http://accesspressthemes.com/support" target="_blank"><span class="dashicons dashicons-admin-users"></span>Support</a>',
                    'pro' => '<a href="'.WPCD_PRO_LINK.'" target="_blank"><span class="dashicons dashicons-cart"></span>Premium version</a>'
                );
                $links = array_merge( $links, $new_links );
            }
            return $links;
        }


        function wpcd_admin_footer_text( $text ){
            global $post;
            $pages = Array('wp-comment-designer-lite', 'wpcd-custom-settings', 'wpcd-how-to-use', 'wpcd-about-us', 'wpcd-comment-form-builder' );

            if (isset( $_GET['page'] ) && in_array( $_GET['page'], $pages )) {

                $text = 'Enjoyed ' . WPCD_LITE_PLUGIN_NAME . '? <a href="' . WPCD_LITE_RATING . '" target="_blank">Please leave us a ★★★★★ rating</a> We really appreciate your support! | Try premium version <a href="' . WPCD_PRO_LINK . '" target="_blank">' . WPCD_PRO_PLUGIN_NAME . '</a> - more features, more power!';
                return $text;
                
            } else {
                return $text;
            }
        }


        function plugin_text_domain() {
            load_plugin_textdomain('wp-comment-designer-lite', false, WPCD_LITE_PLUGIN_LANG_DIR);
        }

        function WPCD_menu($submenu) {
            add_menu_page(__('WP Comment Designer Lite', 'wp-comment-designer-lite'), __('WP Comment Designer Lite', 'wp-comment-designer-lite'), 'manage_options', 'wp-comment-designer-lite', array($this, 'wpcd_settings'), 'dashicons-admin-comments');
            add_submenu_page('wp-comment-designer-lite', __('Comment Form Builder', 'wp-comment-designer-lite'), __('Comment Form Builder', 'wp-comment-designer-lite'), 'manage_options', 'wpcd-comment-form-builder', array($this, 'wpcd_submenu_one_settings'));
            add_submenu_page('wp-comment-designer-lite', __('How To Use', 'wp-comment-designer-lite'), __('How To Use', 'wp-comment-designer-lite'), 'manage_options', 'wpcd-how-to-use', array($this, 'wpcd_submenu_three_settings'));
            add_submenu_page('wp-comment-designer-lite', __('More WordPress Stuff', 'wp-comment-designer-lite'), __('More WordPress Stuff', 'wp-comment-designer-lite'), 'manage_options', 'wpcd-about-us', array($this, 'wpcd_submenu_four_settings'));


            add_submenu_page('wp-comment-designer-lite', __('Documentation', 'wp-comment-designer-lite'), __('Documentation', 'wp-comment-designer-lite'), 'manage_options', 'wpcd-documentation', '__return_false', null, 9);
            add_submenu_page('wp-comment-designer-lite', __('Check Premium Version', 'wp-comment-designer-lite'), __('Check Premium Version', 'wp-comment-designer-lite'), 'manage_options', 'wpcd-premium', '__return_false', null, 9);
        }

        function wpcd_settings() {
            include(WPCD_LITE_PLUGIN_PATH . 'inc/backend/main_settings/wpcd_settings.php');
        }

        function wpcd_submenu_one_settings() {
            include(WPCD_LITE_PLUGIN_PATH . 'inc/backend/form_builder/wpcd_form_settings.php');
        }

        function wpcd_submenu_three_settings() {
            include(WPCD_LITE_PLUGIN_PATH . 'inc/backend/wpcd_how_to_use.php');
        }

        function wpcd_submenu_four_settings() {
            include(WPCD_LITE_PLUGIN_PATH . 'inc/backend/wpcd_about_us.php');
        }

        // function wpcd_submenu_five_settings() {
        //     //ob_start();
        //    // wp_redirect( LITE_DOC, 301 );
        //     //ob_end_clean();
        //     //exit;
        // }

        // function wpcd_submenu_six_settings() {
        //     //wp_redirect( PRO_LINK, 301 );
        //     //exit;
        // }

        function register_backend_assets() {
            if (isset($_GET['page']) && ($_GET['page'] === 'wp-comment-designer-lite' || $_GET['page'] === 'wpcd-custom-settings' || $_GET['page'] === 'wpcd-how-to-use' || $_GET['page'] === 'wpcd-about-us')) {
                wp_enqueue_style('WPCD-backend-style', WPCD_LITE_PLUGIN_URL . 'css/wpcd-backend.css', array(), WPCD_LITE_PLUGIN_VERSION);
                wp_enqueue_script('WPCD-backend-script', WPCD_LITE_PLUGIN_URL . 'js/wpcd-backend.js', array('jquery', 'wp-color-picker'), WPCD_LITE_PLUGIN_VERSION);
                wp_enqueue_style('font-awesome', WPCD_LITE_PLUGIN_URL . 'css/font-awesome.min.css', false);
            }

            if(isset($_GET['page']) && $_GET['page'] === 'wpcd-comment-form-builder'){
                wp_enqueue_style('WPCD-backend-style', WPCD_LITE_PLUGIN_URL . 'css/wpcd-backend.css', array(), WPCD_LITE_PLUGIN_VERSION);
                wp_enqueue_script('WPCD-backend-form-script', WPCD_LITE_PLUGIN_URL . 'js/wpcd-comment-form/wpcd_form_backend.js', array('jquery', 'jquery-ui-sortable'), WPCD_LITE_PLUGIN_VERSION);
                wp_enqueue_style('font-awesome', WPCD_LITE_PLUGIN_URL . 'css/font-awesome.min.css', false);
                $js_obj = array('ajax_url' => admin_url('admin-ajax.php'),
                    'ajax_nonce' => wp_create_nonce('wpcd_ajax_nonce')
                );
                wp_localize_script('WPCD-backend-form-script', 'wpcd_js_obj', $js_obj);
            }
        }

        function register_frontend_assets() {
            $wpcd_form_settings = get_option('wpcd_form_settings');

            wp_enqueue_style('WPCD-frontend-style', WPCD_LITE_PLUGIN_URL . 'css/wpcd-frontend.css', array(), WPCD_LITE_PLUGIN_VERSION);
            wp_enqueue_style('font-awesome', WPCD_LITE_PLUGIN_URL . 'css/font-awesome.min.css', false);
            wp_enqueue_script('wpcd-frontend', WPCD_LITE_PLUGIN_URL . 'js/wpcd-frontend.js', array('jquery', 'comment-reply'), WPCD_LITE_PLUGIN_VERSION);
            wp_enqueue_script('wpcd-form-frontend', WPCD_LITE_PLUGIN_URL . 'js/wpcd-comment-form/wpcd_form_frontend.js', array('jquery', 'comment-reply'), WPCD_LITE_PLUGIN_VERSION);
            $comment_form_js_obj = array('ajax_url' => admin_url('admin-ajax.php'),
                'ajax_nonce' => wp_create_nonce('wpcd_comment_form_ajax_nonce'),
            );
            wp_localize_script('wpcd-form-frontend', 'wpcd_comment_form_js_obj', $comment_form_js_obj);

            $frontend_js_obj = array('ajax_url' => admin_url('admin-ajax.php'),
                'ajax_nonce' => wp_create_nonce('wpcd_frontend_ajax_nonce'),
                'empty_comment'=>__('Comment cannot be empty','wp-comment-designer-lite'),
                'page_number_loader'=> WPCD_LITE_PLUGIN_URL . 'img/ajax-loader.gif'
            );
            wp_localize_script('wpcd-frontend', 'wpcd_frontend_js_obj', $frontend_js_obj);
        }

        function wpcd_custom_css($comment_id) {
            include(WPCD_LITE_PLUGIN_PATH . '/inc/frontend/wpcd-custom-css.php');
        }

        function like_dislike_action($args) {
            if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'wpcd_frontend_ajax_nonce')) {

                $comment_id = intval(sanitize_text_field($_POST['comment_id']));
                if (!empty($comment_id)) {
                    $type = sanitize_text_field($_POST['type']);

                    $wpcd_like_cookie = sanitize_text_field($_POST['wpcd_like_cookie']);
                    $wpcd_dislike_cookie = sanitize_text_field($_POST['wpcd_dislike_cookie']);

                    $total_like_count = get_comment_meta($comment_id, 'wpcd_like_count', true);
                    $total_dislike_count = get_comment_meta($comment_id, 'wpcd_dislike_count', true);

                    $total_like_count=(empty($total_like_count)? 0 : $total_like_count);
                    $total_dislike_count=(empty($total_dislike_count)? 0 : $total_dislike_count);
                    
                    if ($type == 'like') {
                        $total_like_count = $total_like_count + 1;
                        if(!empty($wpcd_dislike_cookie)){
                            $total_dislike_count = ($total_dislike_count - 1);
                            if ($total_dislike_count < 0){
                                $total_dislike_count = 0;
                            }
                        }
                        $check = update_comment_meta($comment_id, 'wpcd_like_count', $total_like_count);
                        if ($check) {
                            update_comment_meta($comment_id, 'wpcd_dislike_count', $total_dislike_count);
                            $total_like_count = WPCD_LITE_CLASS::wpcd_number_format($total_like_count);
                            $total_dislike_count = WPCD_LITE_CLASS::wpcd_number_format($total_dislike_count);
                            $response_array = array('success' => true, 'latest_like_count' => $total_like_count, 'latest_dislike_count' => $total_dislike_count);
                        }
                        else{
                            $response_array = array('success' => false, 'latest_like_count' => '');
                        }
                    }
                    if ($type == 'dislike') {
                        $total_dislike_count = $total_dislike_count + 1;
                        if(!empty($wpcd_like_cookie)){
                            $total_like_count = ($total_like_count -1);
                            if ($total_like_count < 0){
                                $total_like_count= 0;
                            }
                        }
                        $check = update_comment_meta($comment_id, 'wpcd_dislike_count', $total_dislike_count);
                        if ($check) {
                            update_comment_meta($comment_id, 'wpcd_like_count', $total_like_count);
                            $total_like_count = WPCD_LITE_CLASS::wpcd_number_format($total_like_count);
                            $total_dislike_count = WPCD_LITE_CLASS::wpcd_number_format($total_dislike_count);
                            $response_array = array('success' => true, 'latest_like_count' => $total_like_count, 'latest_dislike_count' => $total_dislike_count);
                        }
                        else{
                            $response_array = array('success' => false, 'latest_dislike_count' =>'');
                        }
                    }
                }
                echo json_encode($response_array);
                die();
            }
        }

        public static function wpcd_number_format($input) {
            $prev = $input;
            $input = '10M';
            $input = number_format((float) $input);
            $input_count = substr_count($input, ',');
            $arr = array(1 => 'K', 'M', 'B', 'T');
            if (isset($arr[(int) $input_count])) {
                return substr($input, 0, (-1 * $input_count) * 4) . $arr[(int) $input_count];
            } else {
                return $prev;
            }
        }

        public static function wpcd_comment_rating($comment_id) {
            $wpcd_settings = get_option('wpcd_settings');
            if (isset($wpcd_settings['comment_rating']) && $wpcd_settings['comment_rating'] === "enable") {
                include(WPCD_LITE_PLUGIN_PATH . '/inc/frontend/wpcd_comment_like_dislike.php');
            }
        }
        
        function save_comment_meta_data($comment_id) {
            $wpcd_form_settings = get_option('wpcd_form_settings');
            if (isset($wpcd_form_settings['field']) && !empty($wpcd_form_settings['field'])) {
                foreach ($wpcd_form_settings['field'] as $key => $value) {
                    if ($key == 'name') {
                        if(isset($_POST['author'])&& $_POST['author']!=''){
                            $field = sanitize_text_field($_POST['author']);
                        } else{
                            $field="";
                        }
                    } elseif ($key == 'commentarea') {
                        if(isset($_POST['comment'])&& $_POST['comment']!=''){
                            $field = sanitize_text_field($_POST['comment']);
                        } else if(isset($_POST['comments'])&& $_POST['comments']!=''){
                            $field = sanitize_text_field($_POST['comments']);
                        } else{
                            $field="";
                        }
                    } else {
                        if(isset($_POST[$key])&& $_POST[$key]!=''){
                            $field = sanitize_text_field($_POST[$key]);
                        } else{
                            $field="";
                        }
                    }
                    if(isset($field)&&!empty($field)){
                        add_comment_meta($comment_id, $key, $field);
                    }
                }
            }
            add_comment_meta($comment_id, 'wpcd_like_count', 0);
            add_comment_meta($comment_id, 'wpcd_dislike_count', 0);
        }

        function wpcd_plugin_comment_template($comment_template) {
            global $EMBED;
            global $post;
            global $comments;
            $wpcd_settings = get_option('wpcd_settings');
            $wpcd_form_settings = get_option('wpcd_form_settings');
            $template = (isset($wpcd_settings['template_number']) && $wpcd_settings['template_number'] != "") ? esc_attr($wpcd_settings['template_number']) : 'template-1';
            
            if (!( is_singular() && ( have_comments() || 'open' == $post->comment_status ) )) {
                return;
            }
            echo"<div class='wp-comment-designer-lite-wrap wpcd-$template' data-template-demo = $template>";
            if (isset($wpcd_settings['enable_comment']) && $wpcd_settings['enable_comment'] == 'enable') {
                return dirname(__FILE__) . '/comments.php';
            }
            echo "</div>";
        }

        function save_settings() {
            if (isset($_POST['wpcd_nonce_field']) && wp_verify_nonce($_POST['wpcd_nonce_field'], 'wpcd_nonce')) {
                if (isset($_POST['wpcd_settings_submit'])) {
                    $_POST = array_map('stripslashes_deep', $_POST);
                    $wpcd_settings = $this->sanitize_array($_POST['wpcd_settings']);
                    $hashtag = sanitize_text_field($wpcd_settings['hashtag']);
                    update_option('wpcd_settings', $wpcd_settings);
                    wp_redirect(admin_url('admin.php?page=wp-comment-designer-lite&message=1' . $hashtag));
                    exit;
                }
            }
        }

        function save_form_settings() {
            if (isset($_POST['wpcd_form_nonce_field']) && wp_verify_nonce($_POST['wpcd_form_nonce_field'], 'wpcd_form_nonce')) {
                if (isset($_POST['wpcd_form_settings_submit'])) {
                    $_POST = array_map('stripslashes_deep', $_POST);
                    $wpcd_form_settings = $this->sanitize_array($_POST['wpcd_form_settings']);
                    $hashtag = sanitize_text_field($wpcd_form_settings['hashtag']);
                    update_option('wpcd_form_settings', $wpcd_form_settings);
                    wp_redirect(admin_url('admin.php?page=wpcd-comment-form-builder&message=1' . $hashtag));
                    exit;
                }
            }
        }

        function sanitize_array($array = array(), $sanitize_rule = array()) {
            if (!is_array($array) || count($array) == 0) {
                return array();
            }
            foreach ($array as $k => $v) {
                if (!is_array($v)) {
                    $default_sanitize_rule = (is_numeric($k)) ? 'text' : 'html';
                    $sanitize_type = isset($sanitize_rule[$k]) ? $sanitize_rule[$k] : $default_sanitize_rule;
                    $array[$k] = $this->sanitize_value($v, $sanitize_type);
                }
                if (is_array($v)) {
                    $array[$k] = $this->sanitize_array($v, $sanitize_rule);
                }
            }
            return $array;
        }

        function sanitize_value($value = '', $sanitize_type = 'text') {
            switch ($sanitize_type) {
                case 'html':
                $allowed_html = wp_kses_allowed_html('post');
                return wp_kses($value, $allowed_html);
                break;
                default:
                return sanitize_text_field($value);
                break;
            }
        }

        function default_plugin_settings() {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            if (is_plugin_active('wp-comment-designer/wp-comment-designer.php')) {
                wp_die(__('You need to deactivate WP Comment Designer Plugin in order to activate WP Comment Designer Lite premium plugin.Please deactivate premium one.', 'wp-comment-designer'));
            }
            if (!get_option('wpcd_settings')) {
                $default_settings = $this->get_default_settings();
                update_option('wpcd_settings', $default_settings);
            }
            if (!get_option('wpcd_form_settings')) {
                $default_form_settings = $this->get_default_form_settings();
                update_option('wpcd_form_settings', $default_form_settings);
            }
        }

        function fn_restore_plugin_settings() {
            if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'wpcd_restore_nonce')) {
                $default_settings = $this->get_default_settings();
                update_option('wpcd_settings', $default_settings);
                wp_redirect(admin_url('admin.php?page=wp-comment-designer-lite&message=2'));
                exit;
            }
        }

        function get_default_settings() {
            $wpcd_settings = array();
            $wpcd_settings['hashtag'] = '#General';

            $wpcd_settings['enable_comment'] = 'enable';
            $wpcd_settings['comment_number'] = 'show';
            $wpcd_settings['hide_replies'] = 'disable';
            $wpcd_settings['comment_rating'] = 'disable';

            $wpcd_settings['template_number'] = 'template-1';

            $wpcd_settings['pagination'] = '';
            $wpcd_settings['items_per_page'] = '5';
            
            $wpcd_settings['comment_notes_before'] = '';
            $wpcd_settings['comment_notes_after'] = '';
            $wpcd_settings['title_reply'] = 'Leave A Comment';
            $wpcd_settings['reply_button_label'] ='Reply';
            $wpcd_settings['cancel_reply_link'] = 'Cancel Reply';
            $wpcd_settings['label_submit'] = 'Post Comment';
            $wpcd_settings['font_family'] ='Default';
            return $wpcd_settings;
        }

        function fn_form_restore_plugin_settings() {
            if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'wpcd_form_restore_nonce')) {
                $default_form_settings = $this->get_default_form_settings();
                update_option('wpcd_form_settings', $default_form_settings);
                wp_redirect(admin_url('admin.php?page=wpcd-comment-form-builder&message=2'));
                exit;
            }
        }

        function get_default_form_settings() {
            $wpcd_form_settings = array();

            $wpcd_form_settings['hashtag'] = '#Field';

            $wpcd_form_settings['field']['commentarea']['label'] = 'COMMENT AREA';
            $wpcd_form_settings['field']['commentarea']['display_label'] = 'yes';
            $wpcd_form_settings['field']['commentarea']['field_type'] = 'textarea';
            $wpcd_form_settings['field']['commentarea']['element_type'] = 'default';

            $wpcd_form_settings['field']['name']['show_on_form'] = 'enable';
            $wpcd_form_settings['field']['name']['label'] = 'NAME';
            $wpcd_form_settings['field']['name']['display_label'] = 'yes';
            $wpcd_form_settings['field']['name']['field_type'] = 'text';
            $wpcd_form_settings['field']['name']['element_type'] = 'default';

            $wpcd_form_settings['field']['email']['show_on_form'] = 'enable';
            $wpcd_form_settings['field']['email']['label'] = 'EMAIL';
            $wpcd_form_settings['field']['email']['display_label'] = 'yes';
            $wpcd_form_settings['field']['email']['field_type'] = 'email';
            $wpcd_form_settings['field']['email']['element_type'] = 'default';

            $wpcd_form_settings['field']['url']['show_on_form'] = 'enable';
            $wpcd_form_settings['field']['url']['label'] = 'URL';
            $wpcd_form_settings['field']['url']['display_label'] = 'yes';
            $wpcd_form_settings['field']['url']['field_type'] = 'url';
            $wpcd_form_settings['field']['url']['element_type'] = 'default';

            return $wpcd_form_settings;
        }

        function print_array($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

        function comment_pagination() {
            if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'wpcd_frontend_ajax_nonce')) {
                $page_number = intval(sanitize_text_field($_POST['page_number']));
                $post_id = intval(sanitize_text_field($_POST['post_id']));
                $ajax_template = sanitize_text_field($_POST['template']);
                $sort_type = 'default';
                include(WPCD_LITE_PLUGIN_PATH . 'inc/frontend/wpcd_comment_listing_inner.php');
                die();
            }
        }

        public static function parent_comment_counter($post_id) {
            global $wpdb;
            $db_table_name = $wpdb->prefix . "comments";
            $query = "SELECT COUNT(comment_post_id) AS count FROM $db_table_name WHERE comment_approved = 1 AND comment_post_ID = $post_id AND comment_parent = 0";
            $parents = $wpdb->get_row($query);
            return $parents->count;
        }

        public static function wpcd_recursive_array_builder($db_table_name, $parent, $parent_child, $post_id, $sort_type, $pagination, $items_per_page, $pagination_type, $page_number) {

            global $wpdb;
            $db_table_name = $wpdb->prefix . "comments";
            $wpcdcommentmeta = $wpdb->prefix . "commentmeta";

            if ($pagination != '') {
                $all_comments_approved = WPCD_LITE_CLASS::parent_comment_counter($post_id);
                /* How many comments offset */
                $offset = (($page_number - 1) * $items_per_page);
                $max_num_pages = ceil($all_comments_approved / $items_per_page);
                $page_query = 'LIMIT' . ' ' . $offset . ', ' . $items_per_page;
            } else {
                $page_query = '';
            }

            $wpcd_comments = $wpdb->get_results("SELECT * FROM $db_table_name  WHERE comment_parent = $parent AND comment_post_ID = $post_id AND comment_approved =1 $page_query");
            $list = array();

            if(!empty($wpcd_comments)){
                foreach ($wpcd_comments as $comment) {
                    $list[] = array(
                        'author_name' => $comment->comment_author,
                        'time' => $comment->comment_date,
                        'comment_text' => get_comment_text($comment->comment_ID),
                        'author_email' => $comment->comment_author_email,
                        'gravatar' => get_avatar_url($comment->comment_author_email),
                        'comment_id' => $comment->comment_ID,
                        'post_id' => $comment->comment_post_ID,
                        "child" => ($parent_child) ? WPCD_LITE_CLASS::wpcd_recursive_array_builder($db_table_name, $comment->comment_ID, true, $comment->comment_post_ID, $sort_type, $pagination, $items_per_page, $pagination_type, $page_number) : ''
                    );
                }
                return $list;
            }
        }

        public static function wpcd_list_comments($comment_listing, $class, $css, $template) {
            if(!empty($comment_listing)){
                foreach ($comment_listing as $listing) {
                    $gravatar = $listing['gravatar'];
                    $author_name = $listing['author_name'];
                    $time = $listing['time'];
                    $comment_content = $listing['comment_text'];
                    $comment_id = $listing['comment_id'];
                    $post_id = $listing['post_id'];
                    if (!empty($listing['child'])) {
                        $children = $listing['child'];
                    } else {
                        $children = null;
                    }
                    include(WPCD_LITE_PLUGIN_PATH . 'inc/frontend/wpcd-comment-listing-html.php');
                }
            }
        }

        public static function wpcd_build_frontend_form() {
            if (comments_open()) {
                $commenter = wp_get_current_commenter();
                $user = wp_get_current_user();
                $user_identity = $user->exists() ? $user->display_name : '';
                $wpcd_form_settings = get_option('wpcd_form_settings');
                $wpcd_settings = get_option('wpcd_settings');

                $family=(isset($wpcd_settings['font_family']) && $wpcd_settings['font_family'] != '')?esc_attr($wpcd_settings['font_family']):'';
                $style= "style = 'font-family:" .$family. " ;'" ;

                $fields = array();

                if (isset($wpcd_form_settings['field']) && !empty($wpcd_form_settings['field'])) {

                    foreach ($wpcd_form_settings['field'] as $key => $value) {
                        if (isset($value['display_label']) && $value['display_label']=='yes'){
                            $label = (isset($value['label']) && $value['label']!= '') ? esc_attr($value['label']) :'';
                        }
                        else{
                            $label =''; 
                        }
                        $placeholder = (isset($value['placeholder']) && $value['placeholder']!='') ? esc_attr($value['placeholder']) : '';
                        include(WPCD_LITE_PLUGIN_PATH . 'inc/frontend/fields/wpcd-' . $value['field_type'] . '.php');
                    }
                }

                $comment_notes_before = (isset($wpcd_settings['comment_notes_before']) && $wpcd_settings['comment_notes_before'] != '') ? esc_attr($wpcd_settings['comment_notes_before']) : "";

                $comment_notes_after = (isset($wpcd_settings['comment_notes_after']) && $wpcd_settings['comment_notes_after'] != '') ? esc_attr($wpcd_settings['comment_notes_after']) : "";

                $title_reply = (isset($wpcd_settings['title_reply']) && $wpcd_settings['title_reply'] != '') ? esc_attr($wpcd_settings['title_reply']) : esc_html__('Leave a Comment', 'wp-comment-designer-lite');

                $title_reply_to = (isset($wpcd_settings['title_reply_to']) && $wpcd_settings['title_reply_to'] != '') ? esc_attr($wpcd_settings['title_reply_to']) : esc_html__('Leave a Reply', 'wp-comment-designer-lite');

                $cancel_reply_link = (isset($wpcd_settings['cancel_reply_link']) && $wpcd_settings['cancel_reply_link'] != '') ? esc_attr($wpcd_settings['cancel_reply_link']) : esc_html__('Cancel Reply', 'wp-comment-designer-lite');

                $label_submit = (isset($wpcd_settings['label_submit']) && $wpcd_settings['label_submit'] != '') ? esc_attr($wpcd_settings['label_submit']) : esc_html__('Post Comment', 'wp-comment-designer-lite');

                $comments_args = array(
                    'fields' => apply_filters('comment_form_default_fields', $fields),
                    'comment_field' => '',
                    'title_reply' => $title_reply,
                    'title_reply_to' => $title_reply_to,
                    /* translators: Opening and closing link tags. */
                    'must_log_in' => '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a comment.', 'wp-comment-designer-lite'), '<a href="' . wp_login_url(apply_filters('the_permalink', get_permalink())) . '">', '</a>') . '</p>',
                    'logged_in_as' => '<p class="logged-in-as">' . sprintf(esc_html__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'wp-comment-designer-lite'), '<a href="' . admin_url('profile.php') . '">' . $user_identity . '</a>', '<a href="' . wp_logout_url(apply_filters('the_permalink', get_permalink())) . '" title="' . esc_html__('Log out of this account', 'wp-comment-designer-lite') . '">', '</a>') . '</p>',
                    'comment_notes_before' => $comment_notes_before,
                    'comment_notes_after' => $comment_notes_after,
                    'cancel_reply_link' => $cancel_reply_link,
                    'id_submit' => 'wpcd-comment-submit',
                    'class_submit' => 'wpcd-comment-form-submit',
                    'label_submit' => $label_submit,
                    'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
                    'submit_field' => '<div class="wpcd-form-submit">%1$s %2$s</div>',
                    'id_form' => 'wpcd-commentform',
                    'id_submit' => 'wpcd-submit',
                    'class_form' => 'wpcd-comment-form wpcd-clearfix',
                );
                WPCD_LITE_CLASS::wpcd_comment_form($comments_args);
            } 
        }
        
        public static function wpcd_comment_form($args = array(), $post_id = null) {
            if (null === $post_id)
                $post_id = get_the_ID();

            // Exit the function when comments for the post are closed.
            if (!comments_open($post_id)) {
                do_action('comment_form_comments_closed');
                return;
            }

            $commenter = wp_get_current_commenter();
            $user = wp_get_current_user();
            $user_identity = $user->exists() ? $user->display_name : '';

            $args = wp_parse_args($args);
            if (!isset($args['format']))
                $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';

            $req = get_option('require_name_email');
            $aria_req = ( $req ? " aria-required='true'" : '' );
            $html_req = ( $req ? " required='required'" : '' );
            $html5 = 'html5' === $args['format'];
            $fields = array(
                'author' => '<p class="comment-form-author">' . '<label for="author">' . __('Name') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
                'email' => '<p class="comment-form-email"><label for="email">' . __('Email') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>',
                'url' => '<p class="comment-form-url"><label for="url">' . __('Website') . '</label> ' .
                '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" /></p>',
            );

            $required_text = sprintf(' ' . __('Required fields are marked %s'), '<span class="required">*</span>');
            $fields = apply_filters('comment_form_default_fields', $fields);
            $defaults = array(
                'fields' => $fields,
                'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun') . '</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p>',
                'must_log_in' => '<p class="must-log-in">' . sprintf(
                    __('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url(apply_filters('the_permalink', get_permalink($post_id), $post_id))
                ) . '</p>',
                'logged_in_as' => '<p class="logged-in-as">' . sprintf(
                    __('<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>'), get_edit_user_link(),
                    esc_attr(sprintf(__('Logged in as %s. Edit your profile.'), $user_identity)), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id), $post_id))
                ) . '</p>',
                'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __('Your email address will not be published.') . '</span>' . ( $req ? $required_text : '' ) . '</p>',
                'comment_notes_after' => '',
                'action' => site_url('/wp-comments-post.php'),
                'id_form' => 'commentform',
                'id_submit' => 'submit',
                'class_form' => 'comment-form',
                'class_submit' => 'submit',
                'name_submit' => 'submit',
                'title_reply' => __('Leave a Reply'),
                'title_reply_to' => __('Leave a Reply to %s'),
                'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title wpcd-clearfix">',
                'title_reply_after' => '</h3>',
                'cancel_reply_before' => ' <small>',
                'cancel_reply_after' => '</small>',
                'cancel_reply_link' => __('Cancel reply'),
                'label_submit' => __('Post Comment'),
                'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
                'submit_field' => '<p class="form-submit">%1$s %2$s</p>',
                'format' => 'xhtml',
            );
            $args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));

            $args = array_merge($defaults, $args);

            do_action('comment_form_before');
            ?>
            <div id="respond" class="comment-respond">
                <?php
                echo $args['title_reply_before'];

                comment_form_title($args['title_reply'], $args['title_reply_to']);

                echo $args['cancel_reply_before'];

                cancel_comment_reply_link($args['cancel_reply_link']);

                echo $args['cancel_reply_after'];

                echo $args['title_reply_after'];

                if (get_option('comment_registration') && !is_user_logged_in()) :
                    echo $args['must_log_in'];
                do_action('comment_form_must_log_in_after');
            else :
                ?>
                <form action="<?php echo esc_url($args['action']); ?>" method="post" id="<?php echo esc_attr($args['id_form']); ?>" class="<?php echo esc_attr($args['class_form']); ?>"<?php echo $html5 ? ' novalidate' : ''; ?>>
                    <?php
                    do_action('comment_form_top');

                    if (is_user_logged_in()) :

                        echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity);
                        do_action('comment_form_logged_in_after', $commenter, $user_identity);

                    else :

                        echo $args['comment_notes_before'];

                    endif;

                    $comment_fields = array('comment' => $args['comment_field']) + (array) $args['fields'];

                    $comment_fields = apply_filters('comment_form_fields', $comment_fields);

                    $comment_field_keys = array_diff(array_keys($comment_fields), array('comment'));

                    $first_field = reset($comment_field_keys);
                    $last_field = end($comment_field_keys);
                    foreach ($comment_fields as $name => $field) {
                        if (!is_user_logged_in()) {

                            if ($first_field === $name) {
                                do_action('comment_form_before_fields');
                            }
                            echo apply_filters("comment_form_field_{$name}", $field) . "\n";

                            if ($last_field === $name) {
                                do_action('comment_form_after_fields');
                            }
                        } else {

                            if ($first_field === $name) {
                                do_action('comment_form_before_fields');
                            }
                            if ($name != 'name' && $name != 'email' && $name != 'url') {
                                echo apply_filters("comment_form_field_{$name}", $field) . "\n";
                            }

                            if ($last_field === $name) {
                                do_action('comment_form_after_fields');
                            }
                        }
                    }
                    echo $args['comment_notes_after'];

                    $submit_button = sprintf(
                        $args['submit_button'], esc_attr($args['name_submit']), esc_attr($args['id_submit']), esc_attr($args['class_submit']), esc_attr($args['label_submit'])
                    );
                    $submit_button = apply_filters('comment_form_submit_button', $submit_button, $args);

                    $submit_field = sprintf(
                        $args['submit_field'], $submit_button, get_comment_id_fields($post_id)
                    );
                    echo apply_filters('comment_form_submit_field', $submit_field, $args);
                    do_action('wpcd_comment_form', $post_id);
                    ?>
                </form>
            <?php endif; ?>
        </div>
        <?php
    }       
}
$wpcd_lite_obj = new WPCD_LITE_CLASS();
}