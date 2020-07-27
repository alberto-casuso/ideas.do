<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="pagination-menu-wrap settings-content" id="Pagination" style="display:none;" >
    <div class="wpcd-subhead">
        <h2><?php _e('PAGINATION OPTION', 'wp-comment-designer-lite') ?></h2>
    </div>
    <?php $wpcd_settings = get_option('wpcd_settings'); ?>
    <div class="wpcd-row-odd">
        <div class="wpcd-pagination-div wpcd-general-div" >
            <div class="wpcd-title-div">
                <label for= "pagination">
                    <h3>  <?php _e('Pagination', 'wp-comment-designer-lite') ?> </h3>
                </label>
            </div>
            <div class="wpcd-option-value">
                <label class="pagination wpcd-switch">
                    <input type="checkbox" name="wpcd_settings[pagination]" id= "pagination" value="enable" <?php if (isset($wpcd_settings['pagination']) && $wpcd_settings['pagination'] === "enable") {
        ?>checked="checked"<?php } ?>>
                    <label class="wpcd-general-checkbox" for ="pagination"></label>
                    <?php _e('Enable', 'wp-comment-designer-lite') ?>
                    <div class="wpcd-check round"></div>
                </label>
                <p class="description"> <?php _e('Enable to allow pagination for the comments', 'wp-comment-designer-lite') ?> </p>             
            </div>
        </div>
    </div>
    <div class="wpcd-row-even">
        <div class="wpcd-items-per-page-div wpcd-general-div" >
            <div class="wpcd-title-div">
                <h3>  <?php _e('Enter The Number Of Items Per Page', 'wp-comment-designer-lite') ?> </h3>
            </div>
            <div class="wpcd-option-value">
                <label class="enable">
                    <input type="number" name="wpcd_settings[items_per_page]"  value="<?php echo (isset($wpcd_settings['items_per_page'])) ? esc_attr($wpcd_settings['items_per_page']) : ''; ?>"/> 
                </label>
                <p class="description"> <?php _e('Enter the number of comments to be displayed per page', 'wp-comment-designer-lite') ?> </p>
            </div>
        </div>
    </div>
</div>