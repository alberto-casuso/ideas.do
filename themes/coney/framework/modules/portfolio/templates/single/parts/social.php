<?php if(coney_qodef_core_plugin_installed() && coney_qodef_options()->getOptionValue('enable_social_share') == 'yes' && coney_qodef_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="qodef-ps-info-item qodef-ps-social-share">
        <?php echo coney_qodef_get_social_share_html() ?>
    </div>
<?php endif; ?>