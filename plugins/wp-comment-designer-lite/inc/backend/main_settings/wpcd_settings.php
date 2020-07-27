<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="wpcd-wrapper wpcd-comment-designer-wrapper">
    <div class="wpcd-head">
        <h1>
            <img src="<?php  echo WPCD_LITE_PLUGIN_URL . 'img/logo.png'  ?>"/>
        </h1>
        <div> Version <?php echo WPCD_LITE_PLUGIN_VERSION; ?> </div>    
    </div>
    <?php if (isset($_GET['message']) && $_GET['message'] == 1) { ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e('Settings saved successfully', 'wp-comment-designer-lite'); ?> </p>
        </div>
    <?php } ?>
    <?php if (isset($_GET['message']) && $_GET['message'] == 2) { ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e('Settings restored to default', 'wp-comment-designer-lite'); ?></p>
        </div>
    <?php }
    ?>
    <div class= "wpcd-settings-container">
        <div class="wpcd-backend-settings">
            <div class="wpcd-menu-settings">
                <ul>
                    <li  class="wpcd-general"><a href="#General" data-link="General" class="menu-click wpcd-menu-active" id="general-menu"><?php _e('General Settings', 'wp-comment-designer-lite') ?></a></li>
                    <li  class="wpcd-display"><a href="#Display" data-link="Display"  class="menu-click" id="display-menu"><?php _e('Display Settings', 'wp-comment-designer-lite') ?></a></li>
                    <li  class="wpcd-pagination"><a href="#Pagination" data-link="Pagination" class="menu-click" id="pagination-menu"><?php _e('Pagination Settings', 'wp-comment-designer-lite') ?></a></li>
                    <li  class="wpcd-customization"><a href="#Customization" data-link="Customization" class="menu-click" id="customization-menu"><?php _e('Customization Settings', 'wp-comment-designer-lite') ?></a></li>
                </ul> 
            </div>
            <div class="panels-container">
                <form action="<?php echo admin_url() . 'admin-post.php' ?>"  method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="wpcd_settings_save"/>
                    <div class="wpcd-hashtag-save" id="wpcd-fa">
                        <input type="hidden" name="wpcd_settings[hashtag]" value="#General"/>
                    </div>
                    <div class="wpcd-panel">
                        <?php
                        /**
                         * General Settings
                         * */
                        include(WPCD_LITE_PLUGIN_PATH . 'inc/backend/main_settings/panel/wpcd_general.php');
                        /**
                         * Display Settings
                         * */
                        include(WPCD_LITE_PLUGIN_PATH . 'inc/backend/main_settings/panel/wpcd_display.php');
                        /**
                         * Pagination Settings
                         * */
                        include(WPCD_LITE_PLUGIN_PATH . 'inc/backend/main_settings/panel/wpcd_pagination.php');
                        /**
                         * Customization Settings
                         * */
                        include(WPCD_LITE_PLUGIN_PATH . 'inc/backend/main_settings/panel/wpcd_customization.php');
                        ?>
                        <div class="wpcd-field-wrap">
                            <div class="wpcd-field">
                                <?php
                                ?>
                                <div class="wpcd-save-btn">
                                    <?php
                                    wp_nonce_field('wpcd_nonce', 'wpcd_nonce_field');
                                    ?>
                                    <input type="submit" class="button-primary wpcd-submit-button" name="wpcd_settings_submit" value="<?php _e('Save Options', 'wp-comment-designer-lite') ?>"  />
                                </div>
                                <div class="wpcd-restore-btn">
                                    <?php $nonce = wp_create_nonce('wpcd_restore_nonce'); ?>  
                                    <a class="button-primary wpcd-submit-button" href="<?php echo admin_url() . 'admin-post.php?action=wpcd_restore_default&_wpnonce=' . $nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to restore default settings?', 'wp-comment-designer-lite'); ?>')"><?php _e('Restore Default', 'wp-comment-designer-lite'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="wpcd-upgrade-wrapper">
            <a href="<?php echo WPCD_PRO_LINK ?>" target="_blank">
                <img src="<?php echo WPCD_LITE_PLUGIN_URL . 'img/upgrade-to-pro/upgrade-to-pro.png' ?>" style="width:100%;">
            </a>

            <div class="wpcd-upgrade-button-wrap-backend">

                <a href="<?php echo WPCD_PRO_DEMO; ?>" class="smls-demo-btn" target="_blank">Demo</a>

                <a href="<?php echo WPCD_PRO_LINK; ?>" target="_blank" class="smls-upgrade-btn">Upgrade</a>

                <a href="<?php echo WPCD_PRO_DETAIL; ?>" target="_blank" class="smls-upgrade-btn">Plugin Information</a>

            </div>

            <a href="<?php echo WPCD_PRO_LINK ?>" target="_blank">
                <img src="<?php echo WPCD_LITE_PLUGIN_URL; ?>img/upgrade-to-pro/upgrade-to-pro-feature.png" alt="<?php _e( 'WP Comment Designer', 'wp-comment-designer-lite' ); ?>" style="width:100%;">
            </a>
        </div>
    </div>
</div>
