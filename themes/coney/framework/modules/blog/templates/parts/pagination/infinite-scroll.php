<?php if($max_num_pages > 1) { ?>
	<div class="qodef-blog-pag-loading">
		<div class="progress-loader-holder">
			<div class="progress-loader-holder-text">
				<div class="progress-loader-holder-number">0</div>
			</div>
		</div>
	</div>
    <?php
        $unique_id = rand( 1000, 9999 );
        wp_nonce_field( 'qodef_blog_load_more_nonce_' . $unique_id, 'qodef_blog_load_more_nonce_' . $unique_id );
    ?>
<?php }