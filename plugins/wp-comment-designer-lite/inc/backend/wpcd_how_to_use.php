<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="aboutus-menu-wrap settings-content">
    <div class="wpcd-head">
        <h1>
            <img src="<?php  echo WPCD_LITE_PLUGIN_URL . 'img/logo.png'  ?>"/>
        </h1>
        <div> Version <?php echo WPCD_LITE_PLUGIN_VERSION; ?> </div>         
    </div>
    <div class="wpcd-subhead">
        <h2><?php _e('HOW TO USE', 'wp-comment-designer-lite') ?></h2>
    </div>
    <div class="wpcd-content-wrap">
        <div class="wpcd-top-tab">
            <div  class="wpcd-content-title wpcd-main-title"><?php _e('WP Comment Designer Lite','wp-comment-designer-lite') ?> </div>
            <div class="wpcd-content-title wpcd-sub-title"><?php _e('General Settings','wp-commment-designer') ?> </div>
            <span><?php _e('This setting allows you to','wp-comment-designer-lite')?> </span>
            <div class="wpcd-detail">
                <ul>
                    <li>
                        <div class="wpcd-title-div">
                            <strong><?php _e('Enable WP Comment Designer Lite','wp-comment-designer-lite') ?></strong>

                        </div>
                        <div class="wpcd-option-value"> 
                            <?php _e("Enable/Disable our plugin's feature in your website", 'wp-comment-designer-lite')?>
                        </div>
                    </li>
                    <li>
                        <div class="wpcd-title-div">
                            <strong><?php _e('Total Comment Number','wp-comment-designer-lite') ?></strong> 
                        </div>
                        <div class="wpcd-option-value"> 
                            <?php _e('Show/Hide total number of comments in the frontend','wp-comment-designer-lite') ?>
                        </div>
                    </li>
                    <li>
                        <div class="wpcd-title-div">
                            <strong><?php _e('Show/Hide Replies','wp-comment-designer-lite') ?></strong>
                        </div>
                        <div class="wpcd-option-value">  
                            <?php _e('Enable/Disable hiding the replies to a comment','wp-comment-designer-lite') ?>
                        </div>
                    </li>
                    <li>
                        <div class="wpcd-title-div">
                            <strong><?php _e('Comment Rating','wp-comment-designer-lite') ?></strong>
                        </div>
                        <div class="wpcd-option-value">  
                            <?php _e('Enable/Disable comment rating feature in the frontend','wp-comment-designer-lite') ?>
                        </div>
                    </li>
                    <li>
                        <div class="wpcd-title-div">
                            <strong><?php _e('Post Categories','wp-comment-designer-lite') ?></strong>
                        </div>
                        <div class="wpcd-option-value">  
                            <?php _e('Select the category posts to enable WP Comment Designer Lite in','wp-comment-designer-lite') ?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="wpcd-content-title wpcd-sub-title"><?php _e('Display Settings','wp-comment-designer-lite') ?> </div>
            <span><?php _e('This setting allows you to','wp-comment-designer-lite')?></span>
            <div class="wpcd-detail">
                <ul>
                    <li>
                        <div class="wpcd-title-div">
                            <strong><?php _e('Comment Listing Template','wp-comment-designer-lite') ?></strong>

                        </div>
                        <div class="wpcd-option-value"> 
                            <?php _e("Select one of the 3 different available templates for you comments and comment form", 'wp-comment-designer-lite')?>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="wpcd-content-title wpcd-sub-title"><?php _e('Pagination Option','wp-comment-designer-lite') ?> </div>
            <span><?php _e('This setting allows you to','wp-comment-designer-lite')?></span>
            <ul>
                <li>
                    <div class="wpcd-title-div">
                        <strong><?php _e('Pagination','wp-comment-designer-lite') ?></strong>

                    </div>
                    <div class="wpcd-option-value"> 
                        <?php _e("Enable/Disable comment pagination in the frontend", 'wp-comment-designer-lite')?>
                    </div>
                </li>
                <li>
                    <div class="wpcd-title-div">
                        <strong><?php _e('Enter The Number Of Items Per Page','wp-comment-designer-lite') ?></strong>

                    </div>
                    <div class="wpcd-option-value"> 
                        <?php _e("Enter the number of comments to be displayed per page", 'wp-comment-designer-lite')?>
                    </div>
                </li>
            </ul>

            <div class="wpcd-content-title wpcd-sub-title"><?php _e('Customization Settings','wp-comment-designer-lite') ?> </div>
            <span><?php _e('This setting allows you to','wp-comment-designer-lite')?></span>
            <ul>
                <li>
                    <div class="wpcd-title-div">
                        <strong><?php _e('Before Notes Text','wp-comment-designer-lite') ?></strong>

                    </div>
                    <div class="wpcd-option-value"> 
                        <?php _e("Enter the text to be displayed before the set of comment form fields if the user is not logged in", 'wp-comment-designer-lite')?>
                    </div>
                </li>
                <li>
                    <div class="wpcd-title-div">
                        <strong><?php _e('After Notes Text','wp-comment-designer-lite') ?></strong>

                    </div>
                    <div class="wpcd-option-value"> 
                        <?php _e("Enter the text to be displayed after the set of comment form fields and before the submit button", 'wp-comment-designer-lite')?>
                    </div>
                </li>
                <li>
                    <div class="wpcd-title-div">
                        <strong><?php _e('Comment Label','wp-comment-designer-lite') ?></strong>

                    </div>
                    <div class="wpcd-option-value"> 
                        <?php _e("Enter the label to be displayed for asking the users to leave a comment for a post. Note: If left empty, this field will take the value 'Leave A Comment'",'wp-comment-designer-lite') ?>
                    </div>
                </li>
                <li>
                    <div class="wpcd-title-div">
                        <strong><?php _e('Cancel Reply Label','wp-comment-designer-lite') ?></strong>
                    </div>
                    <div class="wpcd-option-value"> 
                        <?php _e('Enter the label to be displayed for canceling a reply. Note: if empty, this field will take the value "Cancel Reply"','wp-comment-designer-lite') ?>
                    </div>
                </li>
                <li>
                    <div class="wpcd-title-div">
                        <strong><?php _e('Comment Form Submit Label','wp-comment-designer-lite') ?></strong>
                    </div>
                    <div class="wpcd-option-value"> 
                        <?php _e('Enter the label you want for your comment form submit button. Note: if empty, this field will take the value "Post Comment"','wp-comment-designer-lite') ?>
                    </div>
                </li>
                <li>
                    <div class="wpcd-title-div">
                        <strong><?php _e('Font family','wp-comment-designer-lite') ?></strong>
                    </div>
                    <div class="wpcd-option-value"> 
                        <?php _e("Select the font family for the comments section",'wp-comment-designer-lite') ?>
                    </div>
                </li>
            </ul>
        </div>
        <div class="wpcd-top-tab">
            <div  class="wpcd-content-title wpcd-main-title"><?php _e('Comment Form Builder','wp-comment-designer-lite') ?> </div>
            <span><?php _e('In this tab you can customize all the detailed settings regarding the form.You can setup all the necessary fields that needs to be shown in the form for comment submission.','wp-comment-designer-lite')?> </span>
           
            <div class="wpcd-content-title wpcd-sub-title"><?php _e('Field Settings','wp-commment-designer') ?> </div>
            <div class="wpcd-option-value"> 
                <?php _e("This tab allows you to customize the field elements of the comment form. Besides the default Name, Email, Url and Comment area you can further add others fields. Currently five input types are available: text field, text area, select option, radio buttons and checkbox. Each of the fields both custom and defualt are customizable. You can select the field types from the custom fields at the left. The fields displayed at the right are all sortable and they appear in the same order at the frontend. ", 'wp-comment-designer-lite')?>
            </div>
        </div>
    </div>
</div>