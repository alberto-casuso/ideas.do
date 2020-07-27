<?php $icon_html = coney_qodef_icon_collections()->renderIcon( $icon, $icon_pack, $params ); ?>
<div class="qodef-icon-list-holder" <?php echo coney_qodef_get_inline_style( $holder_styles ); ?>>
    <div class="qodef-il-icon-holder">
		<?php print wp_kses_post( $icon_html ); ?>
    </div>
    <p class="qodef-il-text" <?php echo coney_qodef_get_inline_style( $title_styles ); ?>><?php echo esc_html( $title ); ?></p>
</div>