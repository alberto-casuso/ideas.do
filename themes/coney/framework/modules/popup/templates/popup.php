<div class="qodef-popup-holder">
    <div class="qodef-popup-shader"></div>
    <div class="qodef-popup-table">
        <div class="qodef-popup-table-cell">
            <div class="qodef-popup-inner">
                <a class="qodef-popup-close" href="javascript:void(0)">
                    <span class="icon_close"></span>
                </a>
                <div class="qodef-popup-content-container">
                    <div class="qodef-popup-title-holder">
                        <h2 class="qodef-popup-title"><?php echo esc_html($title); ?></h2>
                    </div>
                    <div class="qodef-popup-subtitle">
                        <?php echo esc_html($subtitle); ?>
                    </div>
                    <?php echo do_shortcode('[contact-form-7 id="' . $contact_form .'" html_class="'. $contact_form_style .'"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
