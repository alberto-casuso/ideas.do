<li class="qodef-<?php echo esc_html( $name ) ?>-share">
    <a itemprop="url" class="qodef-share-link" href="#" onclick="<?php print coney_qodef_get_module_part( $link ); ?>">
		<?php if ( $custom_icon !== '' ) { ?>
            <img itemprop="image" src="<?php echo esc_url( $custom_icon ); ?>" alt="<?php echo esc_attr( $name ); ?>"/>
		<?php } else { ?>
            <span class="qodef-social-network-icon <?php echo esc_attr( $icon ); ?>"></span>
		<?php } ?>
    </a>
</li>