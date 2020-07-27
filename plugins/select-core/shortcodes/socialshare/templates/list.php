<div class="qodef-social-share-holder qodef-list">
    <ul>
		<?php foreach ( $networks as $net ) {
			print wp_kses_post( $net );
		} ?>
    </ul>
</div>